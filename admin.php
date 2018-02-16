<?php
if(!isset($_GET['s']) && !isset($_GET['req'])) {
	header('Location: ?s=pages');
	exit;
}
include("config.php");
include("lib.php");

if(isset($_GET['req']) && $_GET['req']=="remove") {
	removePage($_GET['pid']);
	print "Страница удалена!";
	exit;
} elseif(isset($_GET['req']) && $_GET['req']=="save") {
	$page_params=getPage($_GET['pid']);
	$page_params['PAGE_TITLE']=$_POST['PAGE_TITLE'];
	$page_params['PAGE_PATH']=$_POST['PAGE_PATH'];
	$page_params['PAGE_KEYWORDS']=$_POST['PAGE_KEYWORDS'];
	$page_params['PAGE_DESCRIPTION']=$_POST['PAGE_DESCRIPTION'];	
	$page_params['PAGE_CONTENT']=$_POST['PAGE_CONTENT'];

	savePage($_GET['pid'], $page_params);
	print "Страница сохранена!";
	exit;
} elseif (isset($_GET['req']) && $_GET['req']=="create") {
	$page_params=array();
	$page_params['PAGE_TITLE']=$_POST['PAGE_TITLE'];
	$page_params['PAGE_PATH']=$_POST['PAGE_PATH'];
	$page_params['PAGE_KEYWORDS']=$_POST['PAGE_KEYWORDS'];
	$page_params['PAGE_DESCRIPTION']=$_POST['PAGE_DESCRIPTION'];	
	$page_params['PAGE_CONTENT']=$_POST['PAGE_CONTENT'];
	$page_params['PAGE_SMALL_CONTENT']=$_POST['PAGE_SMALL_CONTENT'];


	createPage($page_params);
	print "Новая страница сохранена!";
	exit;
} elseif (isset($_GET['req']) && $_GET['req']=="save_menu") {
	$menu_params=array();
	$menu_params['MENU_NAME']=$_POST['MENU_NAME'];
	$menu_params['MENU_CONTENT']=json_decode($_POST['MENU_CONTENT'],true);
	
	setMenu($_GET['mid'], $menu_params);
	print "Меню сохранено!";
	exit;
} elseif (isset($_GET['req']) && $_GET['req']=="create_menu") {
	$menu_params=array();
	$menu_params['MENU_NAME']=$_POST['MENU_NAME'];
	$menu_params['MENU_CONTENT']=json_decode($_POST['MENU_CONTENT'],true);
	
	createMenu($menu_params);
	print "Новое меню сохранено!";
	exit;
} elseif(isset($_GET['req']) && $_GET['req']=="remove_menu") {
	removeMenu($_GET['mid']);
	print "Меню удалено!";
	exit;
} elseif(isset($_GET['req']) && $_GET['req']=="exec") {
	error_reporting(E_ALL | E_STRICT) ;
	ini_set('display_errors', 'On');
	print eval($_POST['command']);
	exit;
}
?>
<html>
<head>
<title>йаСайт Админка</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.min.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="css/elrte.min.css"                         type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

<script src="js/jquery-ui-1.10.0.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
<script src="js/i18n/elrte.ru.js"              type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jstree.js"              type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/elfinder.min.js"></script>
<script type="text/javascript" src="js/elfinder.ru.js"></script>

<!--<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>-->
<script src="js/jquery.mobile.custom.js"></script>
<style type="text/css">
.tree {
	font-family: Verdana;
    font-size: 15px;
    font-weight: normal;
    width: 230px;
    height: 650px;
    overflow-x: scroll;
    overflow-y: hidden;  
}
.tree:hover {
	position: absolute;
	z-index: 999;
	width: 600px;
	overflow-y: scroll; 
}
.tree a {
	color: black;
}
.tree li {
	padding-top: 3px;
	padding-bottom: 3px;
}
.page_remove , .menu_remove {
	color: red;
	font-weight: bold;
	cursor: pointer;
}
.ui-dialog-buttonset {
	text-align: center;
}
.ui-dialog-buttonset .ui-btn-hidden {
    background: none repeat scroll 0 0 white;
    border: 1px solid black;
    cursor: pointer;
    height: inherit;
    left: 0;
    opacity: 1.0;
    position: relative;
    text-indent: 0;
    top: 0;
    width: 40%;
}
</style>
<?php 
	if(!isset($_GET['s']) || $_GET['s']=="pages"): 
		if(isset($_GET['pid'])) 
 			$page=$_GET['pid'];
		else {
			global $siteEngine_config;
			$page=$siteEngine_config['default_page'];
		}
		if($page!="new_page")
			$page_params=getPage($page);
		else
			$page_params=array(
				"PAGE_TITLE"=>"Новая страница",
				"PAGE_PATH"=>(string)rand(5000,6000),
				"PAGE_KEYWORDS"=>"",
				"PAGE_DESCRIPTION"=>"",
				"PAGE_SMALL_CONTENT"=>"",
				"PAGE_CONTENT"=>"Содержимое новой страницы"
			);
?>
<script>
	function onLoadHandler() {
		// create editor
	    $('#page_text').elrte(elrte_opts);
	    $('.panel-save li, #save_page').click(function() {
	    	var action="save";
	    	if(document.location.href.indexOf("pid=new_page")!=-1) action="create";
	     	$.post("?req="+action+"&pid=<?php print $page; ?>", {
	     		'PAGE_TITLE':$('#page_title').val(),
	     		'PAGE_PATH':$('#page_path').val(),
	     		'PAGE_KEYWORDS':$('#page_keywords').val(),
	     		'PAGE_DESCRIPTION':$('#page_description').val(),
	     		'PAGE_CONTENT':$('#page_text').elrte('val'),
	     		'PAGE_SMALL_CONTENT':''
	     	}, function(data) {
	     		alert(data);
	     		if(document.location.href.indexOf("pid=new_page")!=-1) document.location.href="?s=pages";
	     	})
	    });
	    $(".page_remove").click(function() {
	    	if(confirm("Вы действительно хотите удалить страницу "+$(this).parent().find("a").text()+" ?")) {
	    		$.get("?req=remove&pid="+$(this).parent().find("a").attr("pid"),function(data) {
	    			alert(data);
	    			document.location.reload(true); 
	    		});
	    	} 
	    });
	    $("#page_add").click(function() {
	    	document.location.href="?s=pages&pid=new_page";
	    })
	    //create tree
	    $("#pages_tree").jstree({
	    	"themes" : {
	        	"theme" : "apple",
            	"dots"  : true,
            	"icons" : true
	        },
            "plugins" : [ "themes", "html_data", "ui" ]
        });
	}
</script>
<?php elseif($_GET['s']=="menus"): 
	if(isset($_GET['mid'])) 
		$menu=$_GET['mid'];
	else
		$menu="main";

	if($menu!="new_menu")
		$menu_params=getMenu($menu);
	else
		$menu_params=array(
			"MENU_NAME"=>"NewMenu",
			"MENU_CONTENT"=>array(
				array(
					"sort"=>1,
					"text"=>"Новый пункт меню",
					"src"=>"/"
				)
			)
		);
?>
<script type="text/javascript">
function onLoadHandler() {
    $("#save_menu").click(function() {
    	var menuItems=new Array();
    	var menu=$(".menuItem").toArray();
    	for(var menuItem in menu) {
    		menuItems.push({
    			"sort":$(menu[menuItem]).find(".link_sort").val(),
    			"text":$(menu[menuItem]).find(".link_text").val(),
    			"src":$(menu[menuItem]).find(".link_src").val()	
    		});
    	}
    	var action="save_menu";
	    if(document.location.href.indexOf("mid=new_menu")!=-1) action="create_menu";
    	$.post("?req="+action+"&mid=<?php print $menu; ?>", {
    		"MENU_NAME":$("#menu_name").val(),
    		"MENU_CONTENT":JSON.stringify(menuItems)
    	}, function(data) {
    		alert(data);
	     	if(document.location.href.indexOf("mid=new_menu")!=-1) document.location.href="?s=menus";
    	})
    });
    $(".menu_remove").click(function() {
    	if(confirm("Вы действительно хотите удалить меню "+$(this).parent().find("a").text()+" ?")) {
    		$.get("?req=remove_menu&mid="+$(this).parent().find("a").attr("mid"),function(data) {
    			alert(data);
    			document.location.reload(true); 
    		});
    	} 
    });
    $("#add_menu_item").click(function() {
    	$("#add_menu_item").closest("tr").before('<tr class="menuItem"><td><input type="text" class="link_text" value="Новый пункт"></td><td><input type="text" class="link_src" value="/"></td><td><input type="text" class="link_sort" value="'+($(".menuItem").toArray().length+1)+'"></td><td><button class="remove_menu_item">Удалить</button></td></tr>');
    	$(".menuItem:last").trigger("create")
    });
    $(".remove_menu_item").click(function() {
    	if(confirm("Вы действительно хотите удалить пункт меню?")) {
    		$(this).closest("tr").remove();
    	} 
    })
    $("#menu_add").click(function() {
    	document.location.href="?s=menus&mid=new_menu";
    })
    $("#menus_tree").jstree({
    	"themes" : {
        	"theme" : "apple",
        	"dots"  : true,
        	"icons" : true
        },
        "plugins" : [ "themes", "html_data", "ui" ]
    });
}
</script>
<?php elseif($_GET['s']=="files"):?>
<script>
	function onLoadHandler() {
		var elf = $('#elfinder').elfinder({
			lang: 'ru',             // language (OPTIONAL)
			url : 'php/connector.php'  // connector URL (REQUIRED)
		}).elfinder('instance');
	}
</script>
<?php elseif($_GET['s']=="console"):?>
<script>
	function onLoadHandler() {
		$("#console_exec").click(function() {
			var command=$("#console_request").val();
			$.post("?req=exec",{"command":command}, function(data) {
				$("#console_result").val(data);
			});
		});
	}
</script>
<?php endif; ?>
<script type="text/javascript">
var dialog;
var elrte_opts = {
	lang         : 'ru',   // set your language
	styleWithCSS : false,
	height       : 300,
	toolbar      : 'maxi',
	fmOpen		 : fm,
};
function fm(callback) {
	if (!dialog) {
	  // create new elFinder
	  dialog = $('#dialogel').dialogelfinder({
	    url: 'php/connector.php',
	    commandsOptions: {
	      getfile: {
	        oncomplete : 'close' // close/hide elFinder
	      }
	    },
	    getFileCallback: function(file) { callback(file); } // pass callback to file manager
	  });
	} else {
	  // reopen elFinder
	  dialog.dialogelfinder('open')
	}
}
$(onLoadHandler);
$(function() {
	$("#page_path").keyup(function() {
		if($(this).val().search(/[^A-Za-z\d\.\/_-]/)!=-1) {
			$(this).val($(this).val().replace(/[^A-Za-z\d\.\/_-]/g,""));
			alert("Разрешённые символы: a-z 0-9 \"\\\" \".\" \"_\" \"-\"");
		}
	})
})
function TreeLink(item) {
	document.location.href=$(item).attr("href");
}
</script>
</head>
<body>
	<div data-role="page" style="max-width:1000px; margin:0 auto; position: static;">
		<div data-role="header">
			<h1>йаСайт Админка</h1>
			<div data-role="navbar">
			<ul>
				<li><a href="?s=pages" data-ajax="false" <?php if($_GET['s']=='pages' || !isset($_GET['s'])) print 'class="ui-btn-active"';?>>Страницы</a></li>
				<li><a href="?s=menus" data-ajax="false" <?php if($_GET['s']=='menus') print 'class="ui-btn-active"';?>>Меню</a></li>
				<li><a href="?s=files" data-ajax="false" <?php if($_GET['s']=='files') print 'class="ui-btn-active"';?>>Файлы</a></li>
				<li><a href="?s=settings" data-ajax="false" <?php if($_GET['s']=='settings') print 'class="ui-btn-active"';?>>Настройки</a></li>
			</ul>
		</div><!-- /navbar -->
		</div><!-- /header -->
		<div data-role="content">
		<?php if(!isset($_GET['s']) || $_GET['s']=="pages"): ?>
			<table>
				<tr>
					<td width="230px" style="vertical-align:top;">
						<button id="page_add">Добавить страницу</button>
						<div id="pages_tree" class="tree">
							<ul>
								<?php
								$pages=getPageInfo("ALL");
								foreach ($pages as $params):
								?>
									<li><a onclick="TreeLink(this)" data-ajax="false" pid="<?php print $params['PAGE_PATH'];?>" href="?s=pages&pid=<?php print $params['PAGE_PATH'];?>"><?php print $params['PAGE_TITLE'];?></a><span class="page_remove">X</span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</td>
					<td>
						<table style="width:100%;">
							<tr>
								<td style="width:100px; text-align:center;">Title:</td>
								<td><input type="text" id="page_title" value="<?php print $page_params['PAGE_TITLE']; ?>"></td>
							</tr>
							<tr>
								<td style="width:100px; text-align:center;">Путь:</td>
								<td><input type="text" id="page_path" value="<?php print $page_params['PAGE_PATH']; ?>"></td>
							</tr>
							<tr>
								<td style="width:100px; text-align:center;">Keywords:</td>
								<td><input type="text" id="page_keywords" value="<?php print $page_params['PAGE_KEYWORDS']; ?>"></td>
							</tr>
							<tr>
								<td style="width:100px; text-align:center;">Description:</td>
								<td><input type="text" id="page_description" value="<?php print $page_params['PAGE_DESCRIPTION']; ?>"></td>
							</tr>				
						</table>
						<textarea id="page_text"><?php print $page_params['PAGE_CONTENT']; ?></textarea>
						<div id="dialogel"></div>
						<button id="save_page">Сохранить страницу</button>
					</td>
			</table>
		<?php elseif($_GET['s']=="menus"): ?>
			<table style="width:100%;">
				<tr>
					<td width="230px" style="vertical-align:top;">
						<button id="menu_add">Добавить меню</button>
						<div id="menus_tree" class="tree">
							<ul>
								<?php
								$menus=getMenu("ALL");
								foreach ($menus as $params):
								?>
									<li><a onclick="TreeLink(this)" data-ajax="false" mid="<?php print $params['MENU_NAME'];?>" href="?s=menus&mid=<?php print $params['MENU_NAME'];?>"><?php print $params['MENU_NAME'];?></a><span class="menu_remove">X</span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</td>
					<td>
						<table style="width:100%;">
							<tr>
								<td style="width:100px; text-align:center;">Имя меню:</td>
								<td><input type="text" id="menu_name" value="<?php print $menu_params['MENU_NAME']; ?>"></td>
							</tr>
							<tr>
								<td style="width:100px; text-align:center;" colspan="2">Пункты меню:</td>
							</tr>
							<tr>
								<td colspan="2">
									<table style="width:100%;">
										<tr><td>Текст</td><td>Ссылка</td><td>Позиция</td><td></td></tr>
										<?php foreach ($menu_params['MENU_CONTENT'] as $menuItem): ?>
											<tr class="menuItem">
												<td>
													<input type="text" class="link_text" value="<?php print $menuItem['text']; ?>">
												</td>
												<td>
													<input type="text" class="link_src" value="<?php print $menuItem['src']; ?>">
												</td>
												<td>
													<input type="text" class="link_sort" value="<?php print $menuItem['sort']; ?>">
												</td>
												<td>
													<button class="remove_menu_item">Удалить</button>
												</td>
											</tr>
										<?php endforeach; ?>
											<tr>
												<td colspan="3"></td>
												<td><button id="add_menu_item">Добавить</button></td>
											</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2"><button id="save_menu">Сохранить меню</button></td>
							</tr>				
						</table>
					</td>
			</table>
		<?php elseif($_GET['s']=="files"): ?>
		<div id="elfinder"></div>

		<?php elseif($_GET['s']=="settings"): ?>
		Настройки
		<?php elseif($_GET['s']=="console"): ?>
		Запрос:
		<textarea id="console_request" style="width:100%; height:120px;"></textarea>
		<button id="console_exec">Выполнить</button>
		Результат:
		<textarea id="console_result" style="width:100%; height:120px;"></textarea>

		<?php else: ?>	
			Нет такой секции
		<?php endif; ?>
			
		</div>
	</div>
</body>