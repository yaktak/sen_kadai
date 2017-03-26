<?php
/**
 *  Upload/Img/Do.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  upload_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_UploadImgDo extends Testapp_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        // アップロードフォームの定義
        'img_upload' => [
           'type'       => VAR_TYPE_FILE,
           'form_type'  => FORM_TYPE_FILE,
           'name'       => 'アップロードする画像ファイル',

           // バリデーション
           'required'   => true, // 指定なしだとエラー
           'max'        => 5000, // 画像の最大KB
        ],
        // メモ 
        'note' => [
            'type'      => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'name'      => "メモ",
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
class Testapp_Action_UploadImgDo extends Testapp_ActionClass
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
        // アップロードされた情報を取得
        $img_info = $this->af->get('img_upload');
        $ex_info['tags'] = 'example_tag, tag2';
        $ex_info['note'] = $this->af->get('note');

        // サーバに保存
        $ism = $this->backend->getManager('img_storing');
        $result = $ism->store_img($img_info, $ex_info, /* store_dir= */ './uploads');

        if (Ethna::isError($result)) {
            $this->ae->addObject(null, $result);
        }

        return 'upload_img';
    }
}
