<h1>新規登録</h1>
{* エラーがあれば表示 *}
{if isset($errors)}
    <p>{message name="register_error"}</p>
{/if}
{form ethna_action="register_do"}
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
        <td>{form_submit value="登録"}</td>
    </tr>
</table>
{/form}
