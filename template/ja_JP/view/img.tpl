<script type="text/javascript" src="js/main.js"></script>
<h2>View image</h2>
<img id="img" src={$app.img_path} height="300">
{if isset($app.tags)}
    {foreach from=$app.tags item=i}<ul><li>{$i}</li></ul>{/foreach}
{/if}
{if isset($app.note)}<p>{$app.note}</p>{/if}
