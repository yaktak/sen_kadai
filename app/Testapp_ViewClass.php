<?php
// vim: foldmethod=marker
/**
 *  Testapp_ViewClass.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */

// {{{ Testapp_ViewClass
/**
 *  View class.
 *
 *  @author     {$author}
 *  @package    Testapp
 *  @access     public
 */
class Testapp_ViewClass extends Ethna_ViewClass
{
    /**#@+
     *  @access protected
     */

    /** @var  string  set layout template file   */
    protected $_layout_file = 'layout';

    /**#@+
     *  @access public
     */

    /** @var boolean  layout template use flag   */
    public $use_layout = true;

    /**
     *  set common default value.
     *
     *  @access protected
     *  @param  object  Testapp_Renderer  Renderer object.
     */
    protected function _setDefault($renderer)
    {
    }

}
// }}}

