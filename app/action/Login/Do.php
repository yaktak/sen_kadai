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
        'email' => [
            'name'      => 'メールアドレス',
            'type'      => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,

            'required' => true,
        ],
        'password' => [
            'name'      => 'パスワード',
            'type'      => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_PASSWORD,

            'required'  => true,
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
        // メールアドレスとパスワードを取得
        $email = $this->af->get('email');
        $password_raw = $this->af->get('password');
        
        // 認証
        $um = $this->backend->getManager('user');
        $r = $um->auth($email, $password_raw);

        // 未登録の場合
        if (Ethna::isError($r)) {
            $this->ae->addObject("login_error", $r);
            return 'login';
        }    

        return 'mypage';
    }
}
