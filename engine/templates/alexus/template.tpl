<!DOCTYPE html>
<html lang="ru">
<head>
<title>{$title}</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="{$keywords}" />
<meta name="description" content="{$description}" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootswatch/2.3.0/united/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	<!--HEADER-->
	    <div class="navbar navbar-static-top">
		    <div class="navbar-inner">
			    <a class="brand" href="#">ALEXUS Lab.</a>
			    {literal}
				[COMPONENT:menu|default|{"name":"main"}]
				{/literal}
		    </div>
	    </div>
	<!--MAIN CONTENT-->
		<div class="row page main-page">
		    <div class="span12 page">
		    	{$big_content}
		    </div>
		</div>
		<div class="navbar navbar-fixed-bottom">
			<div class="navbar-inner container" style="text-align:center;">
	    		<p class="navbar-text">(c) <a href="http://a-l-e-x-u-s.ru" style="color:#fff;">www.a-l-e-x-u-s.ru</a> 2013</a>
	    	</div>
	    </div>
	</div>	
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
</body>
</html>