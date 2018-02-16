<?php if(SITE_ENGINE!=true) die("=)"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php print $PAGE_TITLE; ?></title>
<link href="<?php echo $SITE_ROOT.$TEMPLATE_PATH; ?>css/style.css" type="text/css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="<?php echo $SITE_ROOT; ?>js/alexus-ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $SITE_ROOT.$TEMPLATE_PATH; ?>js/jquery.fancybox.pack.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo $SITE_ROOT.$TEMPLATE_PATH; ?>css/jquery.fancybox.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
$(function() {
	$('a.video-response').fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
</head>
<body>
<div id="wrapper">
	<div id="header-top">
		<a class="logo" href="#"></a>
		<div class="contacts">
			<b>Обратная связь:</b>
			<ul>
				<li class="phone">+7 (499) 638-39-58</li>
				<li class="email"><a href="mailto:info@svoichelovek.ru">info@svoichelovek.ru</a></li>
			</ul>
		</div>
		<div class="worktime">
			<b>График работы:</b>
			<ul>
				<li>Работаем с Пон-Пят:</li>
				<li>с 6:00 до 14:00 по МСК;</li>
			</ul>
		</div>
		<div class="address">
			<b>Адрес офиса:</b>
			<ul>
				<li>Китай, г. Гуанчжоу, ул. Тонкан,</li>
				<li>здание 268, офис B1-1</li>
			</ul>
		</div>
	</div>
<div id="header">
	<?php ShowComponent("menu", "ferma_top", array("NAME"=>"main")); ?>
</div>
<div id="content">
	<div id="sidebar">
		<?php ShowComponent("menu", "ferma_left", array("NAME"=>"LeftMenu")); ?>
		<?php /*<div class="block">
			<h2>Авторизация</h2>
			<span id="login">
			<p><label>Имя<input type="text" name="author" id="author" placeholder="Ваше имя"></label></p>
			<p><label>E-mail<input type="text" name="email" id="email" placeholder="Ваш мыльник"></label></p>
			</span>
			<span id="zr">
			<p><label><input type="checkbox" name="zm" id="zm">Запомнить меня</label></p>
			<a href="/">Регистрация</a>
			</span>
			<a href="/" id="vhod">Войти</a>
		</div>
		<div class="block">
			<h2>Поиск по сайту</h2>
		<input type="text" name="search" id="search" placeholder="Ваш запрос">
		</div>*/?>
		<?php /*<div class="block" id="banner">
			<img src="<?php echo $SITE_ROOT.$TEMPLATE_PATH; ?>css/images/banner1.png" width="111" height="112" alt="">
			<img src="<?php echo $SITE_ROOT.$TEMPLATE_PATH; ?>css/images/banner2.png" width="111" height="110" alt="">
		</div> */?>
	</div>
	<div id="center">
<div id="alexus-ajax">