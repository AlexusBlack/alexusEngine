<?php
error_reporting(E_ALL | E_STRICT) ;
ini_set('display_errors', 'On');
$siteEngine_config=array(
	"template"=>"f",
	"site_root"=>"/siteEngine/",
	"default_page"=>"main",
	"db_host"=>"localhost",
	"db_database"=>"siteEngine",
	"db_user"=>"siteEngine",
	"db_password"=>"qazwsx",
	"emails"=>array(
		"robot"=>"robot@svoichel.ru",
		"admin"=>"alexusblack@gmail.com",
		"manager"=>"info@svoichel.ru"
	)
);

?>