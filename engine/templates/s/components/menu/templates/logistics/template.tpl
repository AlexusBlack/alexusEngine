<div class="mainmenu">
	<h2 class="menuTitle"><i class="icon-home"></i> Доставка грузов из Китая</h2>
	<ul class="nav nav-tabs nav-stacked noradius">
		{foreach from=$menu item=menuItem}
		<li{if isset($menuItem.selected)} class="active"{/if}><a href="{$menuItem.src}">{$menuItem.text}</a></li>
		{/foreach}
	</ul>
</div>