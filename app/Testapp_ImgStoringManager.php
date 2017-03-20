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
     * @param  string                 移動先ディレクトリ
     * @return null | Ethna_Error     成功したらnull
     */
    public function store_img($upped_img_info, $move_dir){
        
        // Unix時間にリネームして画像を移動
        $move_file_path = $move_dir . '/' . microtime(true);
        $stored_path = $this->_move_img($upped_img_info['tmp_name'], $move_file_path);
        if (Ethna::isError($stored_path)) {
            return $stored_path;
        }
        
        // 画像のMD5ハッシュを計算
        $md5_hash = self::_calc_img_hash($stored_path);
        if (Ethna::isError($md5_hash)) {
            unlink($stored_path);
            return $md5_hash;
        }

        // TODO: owner, tags, noteはモック
        // DBに保存する情報
        $store_data = [
            'path'          => $stored_path, // 保管パス
            'md5_hash'      => $md5_hash,    // MD5ハッシュ
            'owner'         => 'a@email.com',
            'tags'          => 'tag1, tag2, tag3',
            'note'          => 'write something here',
            'original_name' => $upped_img_info['name'], // 元のファイル名
            'ext'           => self::_get_ext($upped_img_info['type']), // 拡張子
        ];

        // DBに情報を保存
        $r = $this->_store_in_db($store_data);
        if (Ethna::isError($r)) {
            unlink($stored_path);
            trigger_error("Error occurred while storing data");
            return $r;
        }
        
        return null;
    }

    /**
     * DBに画像の情報を登録
     * 
     * @param  assoc_array img_info
           ['path'     => 保管されたパス,   'owner'         => 所有ユーザー,
            'md5_hash' => 画像のMD5ハッシュ,'original_name' => 元のファイル名,
     *      'ext'      => 拡張子,           'tags'          => カンマ区切りのタグ,
     *      'note'     => メモ]
     * @return Ethna_Error | DB_Result
     */
    private function _store_in_db($img_info) 
    {
        $ii = $img_info;

        // 画像の詳細をimageテーブルに保存するクエリ
        $q = "INSERT INTO image(path, owner, md5_hash, original_name,
                                 extension, tags, note)
               VALUES('$ii[path]', '$ii[owner]', '$ii[md5_hash]', '$ii[original_name]',
                      '$ii[ext]',  '$ii[tags]',  '$ii[note]');";
        
        return $this->backend->getDB()->query($q);
    }

    private static function _move_img($img_path, $move_file_path)
    {
        $r = move_uploaded_file($img_path, $move_file_path);
        if (!$r) { 
            trigger_error("Error occurred while moving the image");
            return Ethna::raiseError("エラーが発生しました");
        }
        
        return $move_file_path;
    }

    private static function _get_ext($mimetype)
    {
        // 拡張子を切り出す
        return substr($mimetype, strrpos($mimetype, '/') + 1);
    }

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
