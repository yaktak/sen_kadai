<h1>ログイン</h1>
{* エラーがあれば表示 *}
{if isset($errors)}
    <p>{message name="login_error"}</p>
{/if}
{form ethna_action="login_do" name="login"}
<table border="0">
    <tr>
        <td>Email: </td>
        <td>{form_input name="email"} {message name="email"}</td>
    </tr>
    <tr>
        <td>パスワード: </td>
        <td>{form_input name="password"} {message name="password"}</td>
    </tr>
    <tr>
        <td>{form_submit value="ログイン"}</td>
    </tr>
</table>
{/form}
<p>登録していない？<a href="?action_register=true">新規登録</a></p>
<table>
<tr><td>Email:</td><td>admin</td></tr>
<tr><td>Password:</td><td>1234</td></tr>
</table>
<p>でログインできます</p>
