<?php
function saveForm($data, $to, $tpl) {
	global $siteEngine_config;
	$content=file_get_contents($tpl."/send.html");
	foreach ($data as $key => $value) {
		$content=str_replace("[{$key}]", $value, $content);
	}
	$from="=?UTF-8?B?".base64_encode("ROBOT SVOICHEL")."?= <".$siteEngine_config['emails']['robot'].">";
	$tema="Новые данные"; 
	$tip="text/html";

	$header="From: $from\n";
	$header.="Subject: $tema\n";
	$header.="Content-type: $tip; charset=utf-8\n";

	mail($to, $tema, $content, $header);
}

?>