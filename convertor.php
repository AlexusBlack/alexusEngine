<?php
include("engine/class/db.php");
$old_db=new DB("localhost", "siteEngine", "qazwsx", "siteEngine", true);
$new_db=new DB("localhost", "svoichel", "JsH2BJduqt7GqHKF", "svoichel", true);

$old_pages=$old_db->get("*",'pages');
$new_pages=array();
foreach ($old_pages as $key => $value) {
	$new_pages[]=array(
		"path"			=>$value['path'],
		"category"		=>1,
		"title"			=>urlencode($value['title']),
		"keywords"		=>urlencode($value['keywords']),
		"description"	=>urlencode($value['description']),
		"small_content"	=>"",
		"big_content"	=>urlencode($value['text'])	
	);
}
foreach ($new_pages as $key => $value) {
	$new_db->add($value, 'pages');
	print "Страница $key добавлена<br>";
}
?>
<!--
Структура страниц старая
id - int
parent - int
path - string
title - string
keywords - string
description - string
text-mini - string
text - string
-->

<!--
Структура страниц новая
id - int
path - string
category - int
title - urlencode(string)
keywords - urlencode(string)
description - urlencode(string)
small_content - urlencode(string)
big_content - urlencode(string)
-->