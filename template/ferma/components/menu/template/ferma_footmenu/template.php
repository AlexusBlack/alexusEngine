<div id="footmenu">
	<ul>
<?php foreach ($TPL_VALUES as $menuItem): ?>
	<li><a href="<?php print $menuItem['src'];?>"><?php print $menuItem['text'];?></a></li>
<?php endforeach; ?>
	</ul>
</div>