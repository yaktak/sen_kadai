<h2>Upload</h2>
{if count($errors)} {* エラーメッセージ *}
    <ul>
    {foreach from=$errors item=error}
        <li>{$error}</li>
    {/foreach}
    </ul>
{/if}
{* アップロードフォーム *}
{form ethna_action="upload_img_do" enctype="file"}
    <p>{form_input name="img_upload"}</p>
    <p>メモ: {form_input name="note" placeholder="何か書く"}</p>
    <p>{form_submit value="アップロード"}</p>
{/form}
