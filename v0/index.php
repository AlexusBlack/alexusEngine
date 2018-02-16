<?php
include("config.php");
include("lib.php");
$TEMPLATE_PATH="template/".$siteEngine_config["template"]."/";
$SITE_ROOT=$siteEngine_config["site_root"];
define("SITE_ENGINE", true);
loadCurrentPage();

if(!isset($_GET['alexus-ajax'])) include($TEMPLATE_PATH."header.php");
if(isset($_GET['alexus-ajax'])) ajaxPageData();
showContent();

if(!isset($_GET['alexus-ajax'])) include($TEMPLATE_PATH."footer.php");

?>