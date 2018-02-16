<?php 
//print_r($COM_PARAMS);
if($COM_PARAMS['DIR']!="") $COM_PARAMS['DIR'].="/";
if(file_exists("content/".$COM_PARAMS['DIR'].$COM_PARAMS['TYPE'].".menu.json")) {
	$TPL_VALUES=json_decode(file_get_contents("content/".$COM_PARAMS['DIR']."/".$COM_PARAMS['TYPE'].".menu.json"), true);
} else {
	$TPL_VALUES=array();
}
?>