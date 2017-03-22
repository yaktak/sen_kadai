<?php
// vim: foldmethod=marker
/**
 *  Testapp_ActionClass.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

// {{{ Testapp_ActionClass
/**
 *  action execution class
 *
 *  @author     {$author}
 *  @package    Testapp
 *  @access     public
 */
class Testapp_ActionClass extends Ethna_ActionClass
{
    /**
     *  authenticate before executing action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    public function authenticate()
    {
        // このメソッドはprepare()よりも前に実行される
        // セッションが開始されていない場合は開始
        if (!$this->session->isStart()) $this->session->start(); 

        // ログイン状態を確認し、未認証の場合はログイン画面へ遷移
        // セッション値に'user'が登録されていなければ未認証と見なす
        $user = $this->session->get('user');
        if (empty($user)) return 'login'; 

        return parent::authenticate();
    }

    /**
     *  Preparation for executing action. (Form input check, etc.)
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    public function prepare()
    {
        return parent::prepare();
    }

    /**
     *  execute action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (we does not forward if returns null.)
     */
    public function perform()
    {
        return parent::perform();
    }
}
// }}}

