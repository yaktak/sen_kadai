<?php /* Smarty version 2.6.30, created on 2017-03-20 01:30:37
         compiled from show/img.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'show/img.tpl', 8, false),array('function', 'form_input', 'show/img.tpl', 9, false),array('function', 'form_submit', 'show/img.tpl', 10, false),)), $this); ?>
<h2>Uploads</h2>
<table>
    <?php $_from = $this->_tpl_vars['app']['img_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['i']['original_name']; ?>
</td>
            <td>
                                <?php $this->_tag_stack[] = array('form', array('ethna_action' => 'view_img')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <?php echo smarty_function_form_input(array('name' => 'img_path','value' => $this->_tpl_vars['i']['path']), $this);?>

                    <?php echo smarty_function_form_submit(array('value' => 'view'), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
        </tr> 
    <?php endforeach; endif; unset($_from); ?>
</table>