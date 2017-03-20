<?php /* Smarty version 2.6.30, created on 2017-03-19 23:53:54
         compiled from upload/img.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'upload/img.tpl', 10, false),array('function', 'form_input', 'upload/img.tpl', 11, false),array('function', 'form_submit', 'upload/img.tpl', 12, false),)), $this); ?>
<h2>Upload</h2>
<?php if (count ( $this->_tpl_vars['errors'] )): ?>     <ul>
    <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
        <li><?php echo $this->_tpl_vars['error']; ?>
</li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
<?php endif; ?>
<?php $this->_tag_stack[] = array('form', array('ethna_action' => 'upload_img','enctype' => "multipart/form-data")); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php echo smarty_function_form_input(array('name' => 'img_upload'), $this);?>

    <?php echo smarty_function_form_submit(array('value' => "アップロード"), $this);?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>