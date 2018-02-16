<?php
if(count($_POST)!=0) {
	include($COM_PARAMS['tpl']."/check.php");
	global $FORM_CHECK_RESULT;
	if($FORM_CHECK_RESULT) {
		if($COM_PARAMS['TYPE']=='mail') {
			include("components/form/mail.php");
			global $siteEngine_config;
			saveForm($_POST, $siteEngine_config['emails'][$COM_PARAMS['TO']], $COM_PARAMS['tpl']);
		} else if($COM_PARAMS['TYPE']=='db') {
			include("components/form/mail.php");
		}
	}
}
?>