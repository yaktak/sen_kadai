<?php
require_once('adodb5/adodb.inc.php');

class Testapp_UserManager extends Ethna_AppManager
{
    // 認証処理、登録するときに使用する
    public function auth($mailaddress, $password)
    {
        // TODO: 実際にはまとも認証処理を行う
        if ($mailaddress != $password) { // メールアドレスとパスワードが違う場合
            return Ethna::raiseNotice('メールアドレスまたはパスワードが正しくありません',
            E_SAMPLE_AUTH);
        }

        // 成功時にはnullを返す
        return null;
    }

    /**
     * DBに登録されているか確認
     *  
     * @return bool    true: registered, false: not registered
     */
    public function is_registered($mailaddress)
    {
        // app_userから引数に該当するレコードを探す
        $sql = "select mail_address from app_user
                    where mail_address = '$mailaddress';";
        $r = $this->backend->getDB()->getOne($sql);

        // レコードがnullならばfalseを返す
        return empty($r) ? false : true;
    }

    /**
     * DBに登録
     *
     * @return bool    true: success, false: failed
     */
    public function register_user($mailaddress, $password_hashed)
    {
        // レコードを挿入
        $sql = "insert into app_user
                    values('$mailaddress', '$password_hashed');"; 
        $r = $this->backend->getDB()->query($sql);
                
        if (Ethna::isError($r)) {
            $this->ae->add($r); // エラーを登録
            return false;
        }

        return true;
    }

    // DBから登録を解除
    public function unregister_user($mailaddress, $password_hashed)
    {
        
    }
}
