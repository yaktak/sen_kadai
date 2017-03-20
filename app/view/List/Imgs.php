<?php
/**
 *  List/Imgs.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

/**
 *  list_imgs view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Testapp
 */
class Testapp_View_ListImgs extends Testapp_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        // 画像の配列を取得 
        $img_list = $this->af->get('img_info_list');
        
        // Smary変数にセット
        $this->af->setApp('img_info_list', $img_list);
    }
}

