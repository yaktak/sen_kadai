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
        Testapp{if isset($session.user)} - Hello! {$session.user}{/if}
    </h1>
</div>

<div id="main">
{$content}
</div>

<div id="footer">
    Powered By Ethnam - {$smarty.const.ETHNA_VERSION}.
</div>
</body>
</html>
