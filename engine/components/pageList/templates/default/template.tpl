{foreach from=$pages item=pageItem}
    <div>
    	<a href="{$pageItem.path}"><h3>{$pageItem.title}</h3></a>
    	{if isset($pageItem.image)}<img src="{$pageItem.image}">{/if}
    	{$pageItem.small_content}
    </div>
{/foreach}