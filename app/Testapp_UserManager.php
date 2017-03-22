<?php
require_once('adodb5/adodb.inc.php');

class Testapp_UserManager extends Ethna_AppManager
{
    /**
     * 認証処理を行う
     * 
     * @return null | Ethna_Error    認証成功ならばnull
     */
    public function auth($email, $password_raw)
    {
        $err = function() {
            return Ethna::raiseError("メールアドレスまたはパスワードが間違っています");
        };

        // メールアドレスに紐付けられたパスワードハッシュを探す
        $q = "SELECT password FROM app_user WHERE email='$email'"; 
        $password_hash = $this->backend->getDB()->getOne($q);

        // メールアドレスが存在しない場合はエラー
        if (!$password_hash) return $err();
        
        // パスワードハッシュを比較
        // 異なる場合はエラー 
        if (!password_verify($password_raw, $password_hash)) return $err(); 

        return null;
    }

    /**
     * メールアドレスがDBに登録されているか確認
     *  
     * @return bool | Ethna_Error    true: registered, false: not registered, error: Ethna_Error
     */
    public function is_registered($email)
    {
        // app_userから引数に該当するレコードを探す
        $q = "SELECT * FROM app_user WHERE email='$email';";
        $r = $this->backend->getDB()->getOne($q);

        if (Ethna::isError($r)) return Ethna::raiseError("エラーが発生しました");

        // レコードがnullならばfalseを返す
        return empty($r) ? false : true;
    }

    /**
     * DBに登録
     *
     * @return null | Ethna_Error    成功したらnull
     */
    public function register_user($email, $password_hashed)
    {
        // レコードを挿入
        $q = "INSERT INTO app_user VALUES('$email', '$password_hashed');"; 
        $r = $this->backend->getDB()->query($q);
                
        if (Ethna::isError($r))
            return Ethna::raiseError("エラーが発生しました。もう一度お試しください。");
        
        return null;
    }

    // DBから登録を解除
    public function unregister_user($email, $password_hashed)
    {
        // TODO: 登録解除処理を実装    
    }
}
