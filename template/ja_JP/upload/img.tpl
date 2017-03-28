<h2>Upload</h2>
{* エラーメッセージ *}
{if count($errors)} 
    <ul>
    {foreach from=$errors item=error}
        <li>{$error}</li>
    {/foreach}
    </ul>
{/if}
{* 完了メッセージ *}
{if $app.is_done}<p>アップロードが完了しました</p>{/if}
{* アップロードフォーム *}
{form ethna_action="upload_img_do" enctype="file"}
    <p>{form_input name="img_upload"}</p>
    <p>タグ: {form_input name="tags" size="50" placeholder="タグをつけてください(「,」で区切ると複数指定できます)"}</p>
    <p>メモ: {form_input name="note" size="50" placeholder="メモを書いてください"}</p>
    <p>{form_submit value="アップロード"}</p>
{/form}
