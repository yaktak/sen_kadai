<?php /* Smarty version 2.6.30, created on 2017-03-21 19:47:59
         compiled from login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'message', 'login.tpl', 4, false),array('function', 'form_input', 'login.tpl', 10, false),array('function', 'form_submit', 'login.tpl', 17, false),array('block', 'form', 'login.tpl', 6, false),)), $this); ?>
<h1>ログイン</h1>
<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
    <p><?php echo smarty_function_message(array('name' => 'login_error'), $this);?>
</p>
<?php endif; ?>
<?php $this->_tag_stack[] = array('form', array('ethna_action' => 'login_do')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
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
        <td><?php echo smarty_function_form_submit(array('value' => "ログイン"), $this);?>
</td>
    </tr>
</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>