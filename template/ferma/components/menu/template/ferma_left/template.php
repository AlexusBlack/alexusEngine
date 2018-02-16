<div class="block">
	<h2>Разделы</h2>
	<ul>
<?php foreach ($TPL_VALUES as $menuItem): ?>
	<li class="chicken"><a href="<?php print $menuItem['src'];?>"><?php print $menuItem['text'];?></a></li>
<?php endforeach; ?>
	</ul>
</div>