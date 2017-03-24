<h2>My page</h2>
<p>hello, {$session.user}</p>
{form ethna_action="upload_img"}{form_submit value="画像をアップロードする"}{/form}
{form ethna_action="list_imgs"}{form_submit value="画像一覧"}{/form}
{form ethna_action="logout"}{form_submit value="ログアウト"}{/form}


