<h2>Uploaded images</h2>
{form ethna_action="list_imgs"}
    <p>{form_input name="tag"}{form_submit value="検索"}</p>
{/form}
<table>
{if isset($app.img_list)}
    {foreach from=$app.img_list item=i}
        <tr>
            <td>
                {* 画像表示ボタン *}
                {form ethna_action="view_img"}
                    {form_input name="img_path" value=$i.path}
                    {form_submit value="view"}
                {/form}
            </td>
            <td>{$i.original_name}</td>
            <td>{$i.note}</td>
        </tr> 
    {/foreach}
{/if}
</table>
 
