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

        // 選択されたOptionタグのvalue値(配列の添字)が返る
        'tag'      => [
            'form_type'     => FORM_TYPE_SELECT,
            'name'          => 'tag',
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
 *  list_imgs action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_Action_ListImgs extends Testapp_ActionClass
{
    private $user_tags; // ユーザが登録したすべてのタグの配列

    /**
     *  preprocess of list_imgs Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        // タグの配列を取得
        $this->user_tags = $this->_fetch_tags();

        // 先頭にデフォルトのタグを追加
        array_unshift($this->user_tags, "すべて表示");

        // セレクトボックスの選択肢を初期化
        $this->af->form['tag']['option'] = $this->user_tags;
       
        return null;
    }

    /**
     * ユーザが登録した全てのタグを取得
     *
     * @return array    タグの配列
     */
    private function _fetch_tags()
    {
        $q = "SELECT DISTINCT t.tag
              FROM image AS i, attached_tag AS t
              WHERE i.path=t.path AND i.owner=?;"; 
        return $this->backend->getDB()->getCol($q, $this->session->get('user'));  
    }

    /**
     *  list_imgs action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if (empty($this->af->get('tag'))) { 
            // タグが指定されなければ
            // ユーザに関連する画像
            $q = "SELECT path, original_name, note 
                  FROM image
                  WHERE owner=?;";

            $img_list = $this->backend->getDB()->getAll($q, $this->session->get('user'));
        } else {                           
            // タグが指定されたら
            // ユーザに関連する画像 + タグで絞り込む
            $q = "SELECT i.path, i.original_name, i.note
                  FROM image AS i, attached_tag AS t
                  WHERE i.path=t.path AND i.owner=? AND t.tag=?;";

            $img_list = $this->backend->getDB()->getAll($q, [$this->session->get('user'),
                                                        $this->user_tags[$this->af->get('tag')]]);
        }
        
        // エラー処理
        if (Ethna::isError($img_list)) {
            trigger_error($img_list->getMessage());
            $this->ae->addObject(null, $img_list);
        }

        // AFにセット
        $this->af->set('img_list', $img_list);

        return 'list_imgs';
    }
}
