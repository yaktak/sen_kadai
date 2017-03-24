<?php
/**
 *  List/Imgs.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  list_imgs Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_ListImgs extends Testapp_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
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
 *  list_imgs action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Action_ListImgs extends Testapp_ActionClass
{
    /**
     *  preprocess of list_imgs Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
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
     *  list_imgs action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        // 画像のパス、元の名前を取得するクエリ
        $q = "SELECT path, original_name
              FROM image WHERE owner=?;";

        // ユーザーに関連するレコード(連想配列)のリストを取得
        $records = $this->backend->getDB()->getAll($q, $this->session->get('user'));
        if (Ethna::isError($records)) {
            $this->ae->addObject(null, $records);
        }

        // AFにセット
        $this->af->set('img_info_list', $records);

        return 'list_imgs';
    }
}
