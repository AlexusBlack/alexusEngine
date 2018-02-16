<?php
error_reporting(E_ALL | E_STRICT);
if(DEBUG) {
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 'On');
} else {
	ini_set('display_errors', 0);
	error_reporting(-1);
}
define('SMARTY_DIR', 'engine/class/smarty/' );
require_once(SMARTY_DIR . 'Smarty.class.php');
include("config.php");
include("engine/class/db.php");
include("engine/class/pages.php");
include("engine/class/template.php");
include("engine/class/components.php");
include("engine/class/main.php");

if(isset($_GET['pid']))
	$pid=(string)$_GET['pid'];
else
	$pid="";
$engine=new Engine($pid, $config);
print $engine->getPage();
?>