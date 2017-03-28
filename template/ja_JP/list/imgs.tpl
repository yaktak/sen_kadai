<h2>Uploaded images</h2>
{form ethna_action="list_imgs" method="GET"}
    <p>{form_input name="tag"}{form_submit value="検索"}</p>
{/form}
<table>
{if isset($app.img_list)}
    {foreach from=$app.img_list item=i}
        <tr>
            <td>
                {* 画像表示リンク *}
                <a href="?action_view_img=true&img_path={$i.path}">View</a>
            </td>
            <td>{$i.original_name}</td>
            <td>{$i.note}</td>
        </tr> 
    {/foreach}
{/if}
</table>
 
