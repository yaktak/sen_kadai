<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="/css/ethna.css" type="text/css" />
<title>Testapp</title>
</head>
<body>
<div id="header">
    <h1>Testapp</h1>
</div>

<div id="main">
{$content}
</div>

<div id="footer">
    <a href="./?action_register=true">新規登録</a>
    {if isset($session.user)}
        <a href="./?action_mypage=true">マイページ</a>
        <a href="./?action_logout=true">ログアウト</a>
    {/if}
    Powered By Ethnam - {$smarty.const.ETHNA_VERSION}.
</div>
</body>
</html>
