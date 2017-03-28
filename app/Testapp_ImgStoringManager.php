<?php
/**
 * アップロードされた画像を保存する
 */
class Testapp_ImgStoringManager extends Ethna_AppManager 
{
    /**
     * 画像を移動して詳細をDBに保存
     *
     * @param  assoc_array            ActionFormから渡される連想配列
     * @param  string                 画像に関するメモ
     * @param  array                  画像に関するタグ
     * @param  string                 移動先ディレクトリ
     * @return null | Ethna_Error     成功したらnull
     */
    public function store_img($upped_img_info, $note, $tags, $move_dir){

        // 画像かどうかチェック
        $ext = self::_check_imagetype($upped_img_info['tmp_name']);
        if ($ext === false) return Ethna::raiseError("対応していないファイル形式です");
        
        // Unix時間+ランダムな8桁の文字列
        // これをファイル名として画像を保存する
        $store_path = $move_dir . '/' . self::_rand_str(8). '_' . microtime(true) . '.' . $ext;
        
        // 画像を移動
        $result = move_uploaded_file($upped_img_info['tmp_name'], $store_path);
        if (!$result) { 
            trigger_error("Error occurred while moving the image");
            return Ethna::raiseError("エラーが発生しました");
        }
        
        // 画像のMD5ハッシュを計算
        $md5_hash = self::_calc_img_hash($store_path);
        if (Ethna::isError($md5_hash)) {
            unlink($store_path); // エラーなら画像を削除
            return $md5_hash;
        }

        // DBに保存する情報
        $store_data = [
            'path'          => $store_path,                 // 保管パス
            'md5_hash'      => $md5_hash,                   // MD5ハッシュ
            'owner'         => $this->session->get('user'), // アップロードしたユーザー名
            'tags'          => $tags,                       // タグ
            'note'          => $note,                       // メモ
            'original_name' => $upped_img_info['name'],     // 元のファイル名
            'ext'           => $ext                         // 拡張子
        ];

        // DBに情報を保存
        $result = $this->_store_in_db($store_data);
        if (Ethna::isError($result)) {
            unlink($store_path); // エラーなら画像を削除
            return $result;
        }
        
        return null;
    }

    /**
     * DBに画像の情報を登録
     * 
     * @param  assoc_array
     *     ['path'     => 保管されたパス,   'owner'         => 所有ユーザー,
     *      'md5_hash' => 画像のMD5ハッシュ,'original_name' => 元のファイル名,
     *      'ext'      => 拡張子,           'tags'          => タグの配列,
     *      'note'     => メモ]
     * @return null | Ethna_Error    成功ならnull
     */
    private function _store_in_db($data) 
    {
        // 画像の詳細をimageテーブルに保存するクエリ
        $q[] = "INSERT INTO image(path, owner, md5_hash, original_name, extension, note)
                VALUES(?, ?, ?, ?, ?, ?);";

        // メモが空ならnullを格納
        $data['note'] = empty($data['note']) ? null : $data['note'];

        // プレースホルダの値
        $v[] = [$data['path'],          $data['owner'], $data['md5_hash'],
                $data['original_name'], $data['ext'],   $data['note']];

        // タグをattached_tagテーブルに保存するクエリを追加
        // タグが空なら登録しない
        if (!empty($data['tags'])) {
            foreach ($data['tags'] as $t) {
                $q[] = "INSERT INTO attached_tag(path, tag) VALUES(?, ?);";
                $v[] = [$data['path'], $t];
            }
        }

        $db = $this->backend->getDB();
        $db->begin(); // トランザクション開始

        // クエリを順に実行
        for ($i = 0; $i < count($q); ++$i) {
            $result = $db->query($q[$i], $v[$i]);

            if (Ethna::isError($result)) {
                $db->rollback(); // エラーが起きたらロールバック
                trigger_error($result->getMessage());
                return Ethna::raiseError("エラーが発生しました"); 
            }
        }
        $db->commit(); // トランザクション終了

        return null;
    }


    /* -----以降はstaticメソッド----- */

    
    /**
     * 画像ファイルのタイプを判別
     * gif, jpg, png, bmp, icoを画像ファイルとして扱う
     *
     * @param  string    画像ファイルのパス
     * @return string | bool
     *     画像ファイル:     タイプに対応する拡張子
     *     画像ファイル以外: false
     */
    private static function _check_imagetype($img_path)
    {
        $type = exif_imagetype($img_path);
        if (!$type) return false; 

        switch ($type) {
            case IMAGETYPE_GIF:
                return 'gif';
            case IMAGETYPE_JPEG:
                return 'jpg';
            case IMAGETYPE_PNG:
                return 'png';
            case IMAGETYPE_BMP:
                return 'bmp';
            case IMAGETYPE_ICO:
                return 'ico';
            default:
                return false;
        }
    }

    /**
     * ランダムな文字列を生成
     *
     * @param  int      生成する文字列の桁数
     * @return string   ランダムな文字列
     */
    private static function _rand_str($digit)
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                         .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                         .'0123456789');
        $len = count($seed);
        $str = '';
        for ($i = 0; $i < $digit; ++$i) $str .= $seed[mt_rand(0, $len - 1)];
        return $str;
    }

    /**
     * 画像のMD5ハッシュを計算
     *
     * @param  string   画像のパス
     * @return string | Ethna_Error    成功なら画像のMD5ハッシュ
     */
    private static function _calc_img_hash($img_path)
    {
        // バイト配列(String)の取り出し
        $ba = file_get_contents($img_path);
        if ($ba === false) {
            trigger_error("Error occurred while converting the image to byte array for hashing");
            return Ethna::raiseError("エラーが発生しました");
        }
        
        // MD5ハッシュを計算
        return hash('md5', $ba);
    }
}
