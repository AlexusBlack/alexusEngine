<ul>
{foreach from=$menu item=menuItem}
    <li>
    	{if isset($menuItem.selected)}*{/if}
    	<a href="{$menuItem.src}">{$menuItem.text}</a>
    </li>
{/foreach}

</ul>