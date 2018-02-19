<?php /* Smarty version Smarty-3.1.13, created on 2018-02-18 23:45:06
         compiled from "engine/templates/alexus/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13745237415a8a10028ec563-89502072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '103e145a56621e0b1caf6e6e6547c245fa8e1e7c' => 
    array (
      0 => 'engine/templates/alexus/template.tpl',
      1 => 1518997062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13745237415a8a10028ec563-89502072',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'big_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a8a100295dfa1_00767163',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a8a100295dfa1_00767163')) {function content_5a8a100295dfa1_00767163($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ru">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootswatch/2.3.0/united/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	<!--HEADER-->
	    <div class="navbar navbar-static-top">
		    <div class="navbar-inner">
			    <a class="brand" href="#">ALEXUS Lab.</a>
			    
				[COMPONENT:menu|default|{"name":"main"}]
				
		    </div>
	    </div>
	<!--MAIN CONTENT-->
		<div class="row page main-page">
		    <div class="span12 page">
		    	<?php echo $_smarty_tpl->tpl_vars['big_content']->value;?>

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
</html><?php }} ?>