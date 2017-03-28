<?php
/**
 *  View/Img.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  view_img Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Form_ViewImg extends Testapp_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'img_path' => [
            'form_type'     => FORM_TYPE_HIDDEN, 
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
 *  view_img action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Action_ViewImg extends Testapp_ActionClass
{
    /**
     *  preprocess of view_img Action.
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
     *  view_img action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        // 選択された画像のパスを取得
        $img_path = $this->af->get('img_path');

        // 画像の情報を取得
        $q = "SELECT path, md5_hash, note, original_name, extension
              FROM image 
              WHERE path = ?;";
        $img_info = $this->backend->getDB()->getRow($q, $img_path);
        if (Ethna::isError($img_info)) $this->ae->addObject(null, $img_info);

        // タグの情報を取得
        $q = "SELECT tag FROM attached_tag WHERE path = ?;";
        $tags = $this->backend->getDB()->getCol($q, $img_path);
        if (Ethna::isError($tags)) $this->ae->addObject(null, $tags);

        // データがない場合はnullをセット
        $img_info = empty($img_info) ? null : $img_info;
        $tags     = empty($tag)      ? null : $tags;
        
        // 値をセット
        $this->af->set('view_img_info', $img_info);
        $this->af->set('tags', $tags);

        return 'view_img';
    }
}
