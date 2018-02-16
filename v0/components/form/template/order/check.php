<?php
	global $FORM_CHECK_RESULT;
	$FORM_CHECK_RESULT=false;
	if(	$_POST['country_source']!="" && 
		$_POST['country_dest']!="" && 
		$_POST['name_goods']!="" && 
		$_POST['weightNettoGoods']!="" && 
		$_POST['volumeGoods']!="" &&
		$_POST['pcs']!="" &&
		$_POST['valueGoods']!="" &&
		$_POST['email']!="")
		$FORM_CHECK_RESULT=true;
?>