<ul class="navFirst unstyled">
	{foreach from=$menu item=menuItem}
	<li{if isset($menuItem.selected)} class="active"{/if}><a href="{$menuItem.src}">{$menuItem.text}</a></li>
	{/foreach}
</ul>