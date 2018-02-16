<?php
	global $FORM_CHECK_RESULT;
	$FORM_CHECK_RESULT=false;
	if(	$_POST['fio']!="" && $_POST['email']!="" && $_POST['text']!="")
		$FORM_CHECK_RESULT=true;
?>