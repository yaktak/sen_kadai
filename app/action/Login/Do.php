<?php
/*
 *  Login/Do.php
 *
 *  @author     {$author}
 *  @pakage    Testapp
 */

/**
 *  login_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_LoginDo extends Testapp_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'mailaddress' => [
            'name'     => 'メールアドレス',
            'required' => true,
            'type'     => VAR_TYPE_STRING,
        ],
        'password' => [
            'name'     => 'パスワード',
            'required' => true,
            'type'     => VAR_TYPE_STRING,
        ],

       /*
        *  TODO: Write form definition which this action uses.
        *  @see http://ethna.jp/ethna-document-dev_guide-form.html
        *
        *  Example(You can omit all elements except for "type" one) :
        *
        *  'sample' => array(
        *      // Form definition
        *      'type'        => VAR_TYPE_INT,    // Input type
        *      'form_type'   => FORM_TYPE_TEXT,  // Form type
        *      'name'        => 'Sample',        // Display name
        *
        *      //  Validator (executes Validator by written order.)
        *      'required'    => true,            // Required Option(true/false)
        *      'min'         => null,            // Minimum value
        *      'max'         => null,            // Maximum value
        *      'regexp'      => null,            // String by Regexp
        *
        *      //  Filter
        *      'filter'      => 'sample',        // Optional Input filter to convert input
        *      'custom'      => null,            // Optional method name which
        *                                        // is defined in this(parent) class.
        *  ),
        */
    );

    /**
     *  Form input value convert filter : sample
     *
     *  @access protected
     *  @param  mixed   $value  Form Input Value
     *  @return mixed           Converted result.
     */
    /*
    protected function _filter_sample($value)
    {
        //  convert to upper case.
        return strtoupper($value);
    }
    */
}

/**
 *  login_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Action_LoginDo extends Testapp_ActionClass
{
    /**
     *  preprocess of login_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
      if ($this->af->validate() > 0) {
        return 'login';
      }
        /**
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'error';
        }
        $sample = $this->af->get('sample');
        */
        return null;
    }

    /**
     *  login_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $um = new Testapp_UserManager();
        $mailaddress = $this->af->get('mailaddress');
        $password    = $this->af->get('password');
        
        if ($um.is_registered(mailaddress, password)) {
            return 'mypage';
        } else {
            return 'sign_up';
        }
    }
    
    /**
     *  ユーザをデータベースに登録
     */
    private function register_user()
    {
        $um = new Testapp_UserManager();
        // 認証が成功ならnull、失敗ならエラーオブジェクト
        $result = $um->auth($this->af->get('mailaddress'), $this->af->get('password'));
        if (Ethna::isError($result)) { // エラーなら
            // エラーを登録
            $this->ae->addObject(null, $result);
            return 'login';
        }
        return 'index';
    }
}
