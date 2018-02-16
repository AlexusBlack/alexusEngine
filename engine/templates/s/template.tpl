<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lte IE9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<title>{$title}</title>
<link rel="shortcut icon" type="image/x-icon" href="/{$SITE_TEMPLATE_DIR}img/favicon.gif">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="keywords" content="{$keywords}" />
<meta name="description" content="{$description}" />
<meta name="author" content="" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css' />
<link href="/{$SITE_TEMPLATE_DIR}css/bootstrap.css" rel="stylesheet" />
<link href="/{$SITE_TEMPLATE_DIR}css/bootstrap-responsive.css" rel="stylesheet" />
<link href="/{$SITE_TEMPLATE_DIR}css/custom.css" rel="stylesheet" />
<script type="text/javascript" src="/{$SITE_TEMPLATE_DIR}js/jquery-1.9.1.min.js" ></script>
{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39190447-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
var anti_consult;
$(function() {
	anti_consult=setInterval(function() {
		var temp=$(".consultsystems_button_wrap");
		if(temp.length!=0) {
			$(temp).addClass("hidden-phone").addClass("hidden-tablet");
			clearInterval(anti_consult);
		}
	},500);
});
</script>
{/literal}
</head>



<body>

<div class="wrapper">
	<header id="header">
		<!--<div class="headInfo row-fluid">
			<div class="span6">
				<!--<p style="padding-top:5px">Email: <a href="mailto:info@svoichelovek.ru">info@svoichelovek.ru</a> | Skype: svchelovek</p>
			</div>
			<div  class="span6 hidden-phone hidden-tablet">
				<div class="pull-right">
					Мы в соц.сетях:
					<ul class="tooltip-title top-social">
						{*<li><a class="social1-top" rel="tooltip" href="#" data-original-title="Facebook"></a></li>*}
						<li><a class="social2-top" rel="tooltip" target="_blank" href="https://twitter.com/svoichel" data-original-title="Twitter"></a></li>
						<li><a class="social3-top" rel="tooltip" target="_blank" href="http://gplus.to/svoichelovek" data-original-title="Google+"></a></li>
						<li><a class="social4-top" rel="tooltip" target="_blank" href="http://china.svoichelovek.ru/feed/" data-original-title="Rss Feed"></a></li>
					</ul>
				</div>
			</div>
		</div>

		<hr>-->

		<div class="mainHead">
			{literal}
			[COMPONENT:menu|top|{"name":"top","class":"hidden-phone hidden-tablet"}]
			{/literal}

			<h1 class="logo"><a href="/"><img src="/{$SITE_TEMPLATE_DIR}img/logo.png" alt="Транспортная компания Свой человек" /></a></h1>
		</div>
	</header>


	{if isset($IS_DEFAULT_PAGE)}
	<div id="myCarousel" class="carousel slide hidden-phone hidden-tablet">
	<!-- Carousel items -->
		<div class="carousel-inner">
			<div class="active item">	<div class="hero-unit">
				<h2 class="slideTitle">Как доставить из Китая товары, чтобы пришли в срок?</h2>
				<p>Для вашего удобства мы предлагаем Вам различные варианты доставки грузов, включая КАРГО доставку. Доставим и растаможим!</p>
				<p class="text-center">
					<a class="btn btn-success btn-large" href="/how-we-work">Как мы работаем</a>&nbsp;<a class="btn btn-primary btn-large" href="/raschet-stoimosti">Оформить заявку</a>
				</p>
			</div>
			</div>

			<div class="item">	<div class="hero-unit">
				<h2 class="slideTitle">Как найти нужный товар и сэкономить при покупке!</h2>
				<p>Помощь при закупках оптовых и розничных товаров. Мы поможем найти любые товары в Китае. Закупки на Taobao, поиск поставщиков на Алибабе. Опыт работы 5 лет.</p>
				<p class="text-center">
					<a class="btn btn-success btn-large" href="/how-we-work">Как мы работаем</a>&nbsp;<a class="btn btn-primary btn-large" href="/raschet-stoimosti" style="background-color:#fc6c05;">Отправить заявку по таобао</a>
				</p>
			</div>
			</div>
		</div>

		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
	{else}
	<div class="infoLine hidden-phone hidden-tablet">
		<div class="pull-left lineBtn"><a class="btn btn-success" href="/how-we-work">Как мы работаем</a>&nbsp;<a class="btn btn-primary" href="/raschet-stoimosti">Оформить заявку</a></div>
		<p>Сегодня услугами нашей компании пользуются как предприятии малого и среднего бизнеса, так и крупные организации. <a href="/raschet-stoimosti"><strong>Стать нашим постоянным клиентом!</strong></a></p>
	</div>
	{/if}


	<div class="row-fluid">
		<div class="span3">
			{literal}
			[COMPONENT:menu|left|{"name":"top","title":"Информация","class":"hidden-desktop"}]
			[COMPONENT:menu|left|{"name":"logistics","title":"Доставка грузов из Китая","class":"hidden-phone hidden-tablet"}]
			[COMPONENT:menu|left|{"name":"goods","title":"Поставка товаров из Китая","class":"hidden-phone hidden-tablet"}]	
			{/literal}


			{*<div class="block">
				<p>Найдите свою посылку по номеру заказа</p>
				<a class="btn" type="button">Проверить &rarr;</a>
			</div>*}

			<div class="block hidden-phone hidden-tablet">
				<h2 class="blockTitle"><a href="/otzivi">Отзывы</a></h2>
				
				<ul class="reviews unstyled">
					<li>
						<div class="reviewFoto"><img alt="" src="http://svoichelovek.ru/upload/N62P2_image007.png"></div>
						<span class="reviewAuthor">Алексей Геннадьевич</span>
						<span class="reviewDate">Предприниматель</span>
						<p class="reviewText">Ребята молодцы. Купил через них партию фонариков из поднебесной, вот таких http://www.superfonarik.ru/Fonari/Fenix/Fenix-TK40-Cree-MC-E-630-lm-AA-8-sht--248.html, помогли и закупиться и доставить в мой город. Сделали фотоотчет, как я и просил. Посылка шла 22 дня. При общении видно, что разбираются в своем деле. Ждите в гости, хочу летом приехать в Китай, сможете встретить меня если что?! Удачи в бизнесе! C абсолютной уверенностью в Вашем успехе!</p>
					</li>
					<li>
						<div class="reviewFoto"><img alt="" src="http://svoichelovek.ru/upload/dolgov234234.jpg"></div>
						<span class="reviewAuthor">Игорь Долгов</span>
						<span class="reviewDate">Соучередитель ООО Диагностика ПРО</span>
						<p class="reviewText">Доставляем через "Свой Человек" профессиональное диагностическое оборудование для автомобилей из Китая. Многие коллеги предостерегали нас, говорили о сложности доставки подобного оборудования. На деле все оказалось очень просто - ребята работают четко и в срок. Спасибо!</p>
					</li>
				</ul>
				<p><a href="/otzivi">Смотреть все отзывы</a><br /><a href="/contacts">Оставить отзыв</a></p>
			</div>
		</div>

		<div class="span6">
			<article class="news" id="alexus-ajax">
				{$big_content}
			</article>
		</div>

		<div class="span3">
			<div class="block hidden-phone hidden-tablet">
				<strong>Видео отзывы</strong>
				<!--<p style="text-align:center;">-->
					<a href="#video" role="button" data-toggle="modal">
						<div id="star-photo"></div>
					</a>
				<!--</p>-->
				<p>Бари Алибасов - известный продюсер, заслуженный артист России и основатель музыкальной группы На-На. Недавно, он приезжал в Китай, чтобы купить себе мебель для дома. И наша компания помогала ему в закупке и доставке мебели в Москву!</p>
				<a href="#video" role="button" data-toggle="modal">Смотреть видео отзыв</a>
				
				<div id="video" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header" style="overflow:hidden"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
					<div class="modal-body"><object width="530" height="330"><param name="video" value="http://static.video.yandex.net/lite/svoichelovek/z8ii7qgcct.4303/"></param><param name="allowFullScreen" value="true"></param><param name="scale" value="noscale"></param><embed src="http://static.video.yandex.net/lite/svoichelovek/z8ii7qgcct.4303/" type="application/x-shockwave-flash" width="530" height="330" allowFullScreen="true" scale="noscale" ></embed></object>
					</div>
				</div>
			</div>
			{literal}
			[COMPONENT:cbrf|default|{"currency":"USD,RMB","percent":104}]
			{/literal}
			<!-- VK Widget -->
			<script type="text/javascript" src="//vk.com/js/api/openapi.js?79"></script>
			<div id="vk_groups" class="hidden-phone hidden-tablet"></div>
			<script type="text/javascript">
			{literal}
			VK.Widgets.Group("vk_groups", {mode: 0, width: "230", height: "290"}, 37989608);
			{/literal}
			</script>
			<!-- VK Widget -->
			<div style="margin-top:15px;">
				Мы в соц.сетях:
				<ul class="tooltip-title top-social">
					{*<li><a class="social1-top" rel="tooltip" href="#" data-original-title="Facebook"></a></li>*}
					<li><a class="social2-top" rel="tooltip" target="_blank" href="https://twitter.com/svoichel" data-original-title="Twitter"></a></li>
					<li><a class="social3-top" rel="tooltip" target="_blank" href="http://gplus.to/svoichelovek" data-original-title="Google+"></a></li>
					<li><a class="social4-top" rel="tooltip" target="_blank" href="http://china.svoichelovek.ru/feed/" data-original-title="Rss Feed"></a></li>
				</ul>
			</div>
		</div>
	</div>

	<hr>

	<div class="partners hidden-phone hidden-tablet">
		<h2>Наши партнёры</h2>
		<ul class="inline unstyled">
			{*<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part1.jpg" alt="" /></li>
			<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part2.jpg" alt="" /></li>
			<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part3.jpg" alt="" /></li>
			<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part4.jpg" alt="" /></li>
			<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part5.jpg" alt="" /></li>
			<li><img src="/{$SITE_TEMPLATE_DIR}tmp/part6.jpg" alt="" /></li>*}
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/1.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/7.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/8.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/9.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/10.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/11.jpg);"></div></li>
			<li><div class="partner" style="background:url(/{$SITE_TEMPLATE_DIR}tmp/12.jpg);"></div></li>
		</ul>
	</div>

	<hr>


	<footer class="footer">
		<div class="footerLeft">
			<nav class="footerNav">
				{literal}
				[COMPONENT:menu|bottom|{"name":"bottom","class":"hidden-phone hidden-tablet"}]
				{/literal}
				{*<ul class="navSecond unstyled">
					<li><a href="#">Поддержка</a></li>
					<li><a href="#">Pemium SMS</a></li>
					<li><a href="#">Мобильная подписка</a></li>
					<li><a href="#">Банковские карты</a></li>
				</ul>*}
			</nav>
		</div>
		
		<div class="footerRight">
			<div class="contact">
				<p><img src="/{$SITE_TEMPLATE_DIR}img/skype1.jpg">svchelovek</p>
				<p><a href="mailto:info@svoichelovek.ru">info@svoichelovek.ru</a></p>
			</div>
		</div>
	</footer>

</div>


<!-- Scripts -->
<script type="text/javascript" src="/{$SITE_TEMPLATE_DIR}js/bootstrap.js"></script>
<script type="text/javascript">
	{literal}
	$(function(){
		$('a[rel="tooltip"]').tooltip({placement: 'bottom'});
	});
	{/literal}
</script>
{literal}
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter20828335 = new Ya.Metrika({id:20828335, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/20828335" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
{/literal}
<script type="text/javascript" src="http://consultsystems.ru/script/5374/" charset="utf-8"></script>
</body>
</html>
