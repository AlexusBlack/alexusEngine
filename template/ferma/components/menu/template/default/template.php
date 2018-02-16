<?php
foreach ($TPL_VALUES as $menuItem) {
?>
<a href="<?php print $menuItem['src'];?>" class="button"><?php print $menuItem['text'];?></a>
<?php
}
?>