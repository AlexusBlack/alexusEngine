<?php 
//print_r($COM_PARAMS);
global $SITE_ROOT;
if($COM_PARAMS!=null) {
	if(isset($COM_PARAMS['NAME'])) {
		$MENU_DATA=getMenu($COM_PARAMS['NAME']);
	} elseif(isset($COM_PARAMS['ID'])) {
		$MENU_DATA=getMenu($COM_PARAMS['ID']);
	} else {
		print "no menu selected!"; exit;
	}
	if(!$MENU_DATA) {
		print "menu not exists!"; exit;
	}
	$TPL_VALUES=$MENU_DATA['MENU_CONTENT'];
	usort($TPL_VALUES, "sortMenu");
	//set selected
	foreach ($TPL_VALUES as $key => $menuItem) {
		if( !isset($_GET['pid']) && $key==0 ) {
			$TPL_VALUES[$key]['selected']=true;
			break;
		}
		if($_GET['pid']==$menuItem['src'] || $menuItem['src']==$SITE_ROOT.$_GET['pid']) {
			$TPL_VALUES[$key]['selected']=true;
			break;
		}
	}
}
?>