<?php
	global $FORM_CHECK_RESULT;
	$FORM_CHECK_RESULT=false;
	if(	$_POST['fio']!="" && $_POST['email']!="" && $_POST['phone']!="" && $_POST['ves']!="" && $_POST['objem']!="" && $_POST['description']!="")
		$FORM_CHECK_RESULT=true;
?>