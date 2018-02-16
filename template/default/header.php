<?php if(SITE_ENGINE!=true) die("=)"); ?>
<html>
	<head>
		<title><?php print $PAGE_TITLE; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link href="<?php echo $TEMPLATE_PATH; ?>css/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
		<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>
		<script src="http://userapi.com/js/api/openapi.js" type="text/javascript" charset="windows-1251"></script>
		<link rel="stylesheet" href="<?php echo $TEMPLATE_PATH; ?>css/style.css" />
	</head>
	<body>
		<!--ШАПКА САЙТА-->
		<div class="page header">
			<center><img src="<?php echo $TEMPLATE_PATH; ?>css/img/logo.jpg" width="200px" alt="Alexus"></center>
			<?php ShowComponent("menu", "default", array("NAME"=>"main")); ?>
		</div>
		<!--ГЛАВНАЯ СТРАНИЦА-->
		<div class="page content main">
