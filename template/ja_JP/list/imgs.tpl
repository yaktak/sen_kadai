<h2>Uploaded images</h2>
<table>
    {foreach from=$app.img_info_list item=i}
        <tr>
            <td>{$i.original_name}</td>
            <td>
                {* 画像表示ボタン *}
                {form ethna_action="view_img"}
                    {form_input name="img_path" value=$i.path}
                    {form_submit value="view"}
                {/form}
            </td>
        </tr> 
    {/foreach}
</table>
 
