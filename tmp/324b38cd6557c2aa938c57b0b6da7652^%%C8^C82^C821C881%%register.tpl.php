<?php /* Smarty version 2.6.30, created on 2017-03-07 19:04:21
         compiled from register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'message', 'register.tpl', 14, false),)), $this); ?>
<form action="." method="post">
  <?php if (count ( $this->_tpl_vars['errors'] )): ?>
    <ul>
    <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
      <li><?php echo $this->_tpl_vars['error']; ?>
</li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  <?php endif; ?>
  <h1>Sign up</h1>
  <table border="0">
    <tr>
      <td>メールアドレス</td>
      <!--<td><input type="text" name="mailaddress" value=""></td> -->
      <td><input type="text" name="mailaddress" value="<?php echo $this->_tpl_vars['form']['mailaddress']; ?>
"><?php echo smarty_function_message(array('name' => 'mailaddress'), $this);?>
</td>
    </tr>
    <tr>
      <td>パスワード</td>
      <td><input type="password" name="password" value=""><?php echo smarty_function_message(array('name' => 'password'), $this);?>
</td>
    </tr>
  </table>
  <p>
  <input type="submit" name="action_register_do" value="Sign up">
  </p>
</form>