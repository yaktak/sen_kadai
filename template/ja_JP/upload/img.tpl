<h2>Upload form</h2>
{if count($errors)} {* エラーメッセージ *}
    <ul>
    {foreach from=$errors item=error}
        <li>{$error}</li>
    {/foreach}
    </ul>
{/if}
{* アップロードフォーム *}
{form ethna_action="upload_img" enctype="multipart/form-data"}
    {form_input name="img_upload"}
    {form_submit value="アップロード"}
{/form}
