<?php
/**
 *  Register/Do.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  register_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_RegisterDo extends Testapp_ActionForm
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
 *  register_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Action_RegisterDo extends Testapp_ActionClass
{
    /**
     *  preprocess of register_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        // エラーの場合は登録画面へ戻す
        if ($this->af->validate() > 0) {
            return 'register';
        }
        //$sample = $this->af->get('sample');
        
        return null;
    }

    /**
     *  register_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $um = $this->backend->getManager('user');
        $mailaddress = $this->af->get('mailaddress');
        $password_hashed = password_hash($this->af->get('password'), PASSWORD_DEFAULT);

        // DBに登録済み
        if ($um->is_registered($mailaddress)) {
            // TODO: 登録済みメッセージ表示
            return 'login'; // ログイン画面へ
        }

        // ユーザー登録
        $r = $um->register_user($mailaddress, $password_hashed);

        // エラー発生時
        if (!$r) {
            // TODO: エラーメッセージを表示  
            return 'register'; // 画面を戻す
        }

        // マイページへ
        return 'mypage';
    }
}
