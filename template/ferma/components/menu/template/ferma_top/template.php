<script type="text/javascript">
$(function() {
	$("#menu a").click(function() {
		$("#menu li").removeClass("cur");
		$(this).parent().addClass("cur");
	});
});
</script>
<div id="menu">
	<ul>
<?php foreach ($TPL_VALUES as $key => $menuItem): ?>
<?php if(isset($menuItem['selected'])):?>
	<li class="cur"><a href="<?php print $menuItem['src'];?>"><?php print $menuItem['text'];?></a></li>
<?php else: ?>
	<li><a href="<?php print $menuItem['src'];?>"><?php print $menuItem['text'];?></a></li>
<?php endif; ?>
<?php endforeach; ?>
	</ul>
</div>