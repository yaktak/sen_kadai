<?php
/**
 *  View/Img.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  view_img view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_View_ViewImg extends Testapp_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        // 画像の情報を取得
        $img_info = $this->af->get('view_img_info');

        // Smarty変数をセット
        $this->af->setApp('img_path', $img_info['path']); 
        $this->af->setApp('note', $img_info['note']);
        $this->af->setApp('tags', $this->af->get('tags'));
    }
}

