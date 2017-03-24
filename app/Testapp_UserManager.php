<?php
require_once('adodb5/adodb.inc.php');

class Testapp_UserManager extends Ethna_AppManager
{
    /**
     * 認証処理を行う
     * 
     * @param  string  メールアドレス 
     * @param  string  ハッシュ化されていないパスワード
     * @return null | Ethna_Error    認証成功ならばnull
     */
    public function auth($email, $password_raw)
    {
        // メールアドレスに紐付けられたパスワードハッシュを探す
        $q = "SELECT password FROM app_user WHERE email=?"; 
        $password_hash = $this->backend->getDB()->getOne($q, $email);

        // メールアドレスが存在しない場合はエラー
        if (!$password_hash) 
            Ethna::raiseError("メールアドレスまたはパスワードが間違っています");

        // パスワードハッシュを比較
        // 異なる場合はエラー 
        if (!password_verify($password_raw, $password_hash))
            Ethna::raiseError("メールアドレスまたはパスワードが間違っています");

        return null;
    }

    /**
     * メールアドレスがDBに登録されているか確認
     *  
     * @param  string   メールアドレス
     * @return bool | Ethna_Error    true: registered, false: not registered, error: Ethna_Error
     */
    public function is_registered($email)
    {
        // app_userから引数に該当するレコードを探す
        $q = "SELECT * FROM app_user WHERE email=?;";
        $record = $this->backend->getDB()->getRow($q, $email);

        if (Ethna::isError($record)) return Ethna::raiseError("エラーが発生しました");

        // レコードがnullならばfalseを返す
        return empty($record) ? false : true;
    }

    /**
     * DBに登録
     *
     * @param  string   メールアドレス
     * @param  string   パスワードのハッシュ
     * @return null | Ethna_Error    成功したらnull
     */
    public function register_user($email, $password_hashed)
    {
        // app_userテーブルにレコードを挿入
        $q = "INSERT INTO app_user VALUES(?, ?);"; 
        $result = $this->backend->getDB()->query($q, [$email, $password_hashed]);
                
        if (Ethna::isError($result))
            return Ethna::raiseError("エラーが発生しました。もう一度お試しください。");
        
        return null;
    }

    // DBから登録を解除
    public function unregister_user($email, $password_hashed)
    {
        // TODO: 登録解除処理を実装    
    }
}
