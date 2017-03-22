<?php /* Smarty version 2.6.30, created on 2017-03-22 22:57:17
         compiled from layout.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="/css/ethna.css" type="text/css" />
<title>Testapp</title>
</head>
<body>
<div id="header">
    <h1>
        Testapp<?php if (isset ( $this->_tpl_vars['session']['user'] )): ?> - Hello! <?php echo $this->_tpl_vars['session']['user']; ?>
<?php endif; ?>
    </h1>
</div>

<div id="main">
<?php echo $this->_tpl_vars['content']; ?>

</div>

<div id="footer">
    Powered By Ethnam - <?php echo @ETHNA_VERSION; ?>
.
</div>
</body>
</html>