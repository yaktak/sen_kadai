<?php
/**
 *  Upload/Img.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  upload_img Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_UploadImg extends Testapp_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'img_upload' => [
            // アップロードフォームの定義
           'type'       => [VAR_TYPE_FILE], // 入力はファイルの配列
           'form_type'  => FORM_TYPE_FILE,
           'name'       => 'アップロードする画像ファイル',

           // バリデーション
           'required'   => true, // 指定なしだとエラー
           'max'        => 2000, // 画像の最大KB
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
 *  upload_img action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
require_once('adodb5/adodb.inc.php');
class Testapp_Action_UploadImg extends Testapp_ActionClass
{
    /**
     *  preprocess of upload_img Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'upload_img';
        }

        return null;
    }

    /**
     *  upload_img action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        // アップロードされた画像
        $f_info = $this->af->get('img_upload');

        // バイト配列(String)の取り出し
        $img_str = file_get_contents($f_info['tmp_name']);
        
        // 取り出しに失敗した場合
        if ($img_str === false) {
            // TODO: Handle the error    
        }

        // IDのためのハッシュ
        $id = hash('md5', $img_str);

        // bytea型のためにエスケープ
        $img_str_escaped = pg_escape_bytea($img_str);

        // アップロードされたファイルの名前
        $name = $f_info['name'];
        
        // DBに保存
        $sql = "INSERT INTO uploaded_img
                    VALUES('$id', '$img_str_escaped');
                INSERT INTO img_info
                    VALUES('$id', '$name');";
        $r = $this->backend->getDB()->query($sql);

        // DB問い合わせに失敗した場合
        if (Ethna::isError($r)) {
            // TODO: Handle the error
        }
        
        return 'show_img';
    }
}
