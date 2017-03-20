<?php /* Smarty version 2.6.30, created on 2017-03-21 20:03:57
         compiled from register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'message', 'register.tpl', 4, false),array('function', 'form_input', 'register.tpl', 10, false),array('function', 'form_submit', 'register.tpl', 17, false),array('block', 'form', 'register.tpl', 6, false),)), $this); ?>
<h1>新規登録</h1>
<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
    <p><?php echo smarty_function_message(array('name' => 'register_error'), $this);?>
</p>
<?php endif; ?>
<?php $this->_tag_stack[] = array('form', array('ethna_action' => 'register_do')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table border="0">
    <tr>
        <td>Email: </td>
        <td><?php echo smarty_function_form_input(array('name' => 'email'), $this);?>
 <?php echo smarty_function_message(array('name' => 'email'), $this);?>
</td>
    </tr>
    <tr>
        <td>パスワード: </td>
        <td><?php echo smarty_function_form_input(array('name' => 'password'), $this);?>
 <?php echo smarty_function_message(array('name' => 'password'), $this);?>
</td>
    </tr>
    <tr>
        <td><?php echo smarty_function_form_submit(array('value' => "登録"), $this);?>
</td>
    </tr>
</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>