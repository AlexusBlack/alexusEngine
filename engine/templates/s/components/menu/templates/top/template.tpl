<nav id="nav" class="pull-right">
	<ul class="nav nav-pills">
		{foreach from=$menu item=menuItem}
		<li{if isset($menuItem.selected)} class="active"{/if}><a href="{$menuItem.src}">{$menuItem.text}</a></li>
		 {/foreach}
	</ul>
</nav>