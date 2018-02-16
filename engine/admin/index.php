<?php
include("../../config.php");
include("../class/db.php");
include("../class/pages.php");
include("../class/admin.php");
//AUTH
$auth=false;
if(isset($_COOKIE['alogin'], $_COOKIE['apassword'])){
	$admin=new Admin($_COOKIE['alogin'], $_COOKIE['apassword'], $_POST);
	if($admin->isAuthorized()) {
		$auth=true;
		if($admin->isAjaxResponse()) {
			print $admin->getResponse();
			exit;
		}
	}		
} else if(isset($_POST['alogin'], $_POST['apassword'])) {
	$admin=new Admin($_POST['alogin'], md5($_POST['apassword']), array());
	if($admin->isAuthorized()) {
		$auth=true;
		setcookie("alogin",$_POST['alogin']);
		setcookie("apassword",md5($_POST['apassword']));	
	}
} 	
	

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<title>йаСайт v1.0</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/theme.css">
<!--elFinder-->
<script type="text/javascript" src="../js/elfinder.min.js"></script>
<script type="text/javascript" src="../js/elfinder.ru.js"></script>

<!-- Bootstrap -->
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
<link href="../css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
<!--<script src="../js/beautify-html.js"></script>
<script src="../js/ave.js"></script>-->
<?php if(!$auth): ?>
<style>
body {
padding-top: 40px;
padding-bottom: 40px;
background-color: #f5f5f5;
}

.form-signin {
max-width: 300px;
padding: 19px 29px 29px;
margin: 0 auto 20px;
background-color: #fff;
border: 1px solid #e5e5e5;
-webkit-border-radius: 5px;
   -moz-border-radius: 5px;
        border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
font-size: 16px;
height: auto;
margin-bottom: 15px;
padding: 7px 9px;
}
</style>
<?php else:?>
<style>
.sidebar-nav-fixed {
    padding: 9px 0;
    position:fixed;
    top:60px;
}
.main-sidebar {
	width: 220px;
}
.page {
	margin-top: 15px;
}
.menu-page, .settings-page, .files-page {
	display: none;
}
.page_content {
	width: 820px;
	height: 150px;
}
.pageItem {
	white-space: nowrap;
}
#structure {
	overflow: hidden;
	height: 500px;
	z-index: 999;
}
#structure:hover {
	position: absolute;
	width: 500px;
	overflow-y: scroll; 
	min-height: 150px;
	background-color: #F5F5F5;
	border-radius: 4px 4px 4px 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
}
.visual_editor .editarea {
	height: 300px;
	overflow-y: scroll; 
	padding: 2px;
	margin-bottom: 2px;
}
.visual_editor .nav {
	margin-bottom: 3px;
}
.visual_editor .html {
	display: none;
}
.textEditArea {
	width: 100%;
	height: 300px;
}
</style>
<script type="text/javascript">
var menus;
$(function() {
	getStructure(true);
	getMenus(true);
	getSettings();
	//ave.init();
	$('.page_content').each(function() {
		$(this).wysihtml5({
			"html": true,
			stylesheets:false	
		});
	});
	var elf = $('#elfinder').elfinder({
		lang: 'ru',             // language (OPTIONAL)
		url : '../class/elFinder/connector.php'  // connector URL (REQUIRED)
	}).elfinder('instance');
	$("#save").click(saveThis);
	$("#remove").click(removeThis);
	$("#new_page").click(createPage);
	$("#new_category").click(createCategory);
	$("#new_menu").click(createMenu);
	$("#addChangeCategory .btn-primary").click(saveCategory);
	$("#addChangeCategory .btn-danger").click(removeCategory);
	
});
function togglePage(page,el) {
	$(".navbar-static-top li").removeClass("active");
	$(el).parent("li").addClass("active");
	$(".page").hide();
	$("."+page).show();
	if(page=="files-page")
		$(".saveremoveControls").hide();
	else
		$(".saveremoveControls").show();
	if(page=="settings-page")
		$("#remove").hide();
	else
		$("$remove").show();
}
function getStructure(first) {
	$.post("?",{req:"structure"}, function(data) {
		var structure=$.parseJSON(data);
		var structure_html="";
		var category_html="";
		var pages_html="";
		for(var key in structure) {
			structure_html+='<li>\n<a href="#" class="categoryItem" cid="'+structure[key]['id']+'" cname="'+structure[key]['name']+'"><i class="icon-folder-open"></i> '+structure[key]['name']+'</a>';
			category_html+='<option value="'+structure[key]['id']+'">'+structure[key]['name']+'</option>'
			if(structure[key]['pages']!=undefined) {
				structure_html+='<ul class="nav nav-list">';
				for(var key2 in structure[key]['pages']) {
					pages_html+='<option value="'+structure[key]['pages'][key2]['path']+'">'+structure[key]['pages'][key2]['title']+'</option>';
					structure_html+='<li><a href="#" class="pageItem" pid="'+structure[key]['pages'][key2]['path']+'"><i class="icon-file"></i> '+structure[key]['pages'][key2]['title']+'</a></li>';
				}
				structure_html+='</ul>';
			}
			structure_html+='</li>';
		}
		$("#structure").html(structure_html);
		$("#category").html(category_html);
		$("#defaultPage").html(pages_html);

		$(".pageItem").unbind("click", pageItemClick);
		$(".pageItem").click(pageItemClick);
		$(".categoryItem").unbind("click", editCategory);
		$(".categoryItem").click(editCategory);
		if(first) {
			var def=$(".pageItem:first");
			$(def).parent("li").addClass("active");
			getPage($(def).attr("pid"));
		}
	});
}
function getMenus(first) {
	$.post("?",{req:"getMenus"}, function(data) {
		menus_data=$.parseJSON(data);
		menus={};
		for(var i in menus_data) {
			menus[menus_data[i]['id']]=menus_data[i];
			menus[menus_data[i]['id']]['content']=$.parseJSON(menus[menus_data[i]['id']]['content']);
		}
			
		
		var menus_html='<ul class="nav nav-list">';
		for(var i in menus) {
			menus_html+='<li><a href="#" class="menuBox" mid="'+menus[i]['id']+'"><i class="icon-file"></i> '+menus[i]['name']+'</a></li>';
		}
		menus_html+="</ul>";
		$("#menus").html(menus_html);
		$(".menuBox").unbind("click", menuItemClick);
		$(".menuBox").click(menuItemClick);
		if(first) $(".menuBox:first").click();
	});
}
function menuItemClick() {
	$(".menuBox").parent("li").removeClass("active");
	$(this).parent("li").addClass("active");
	showMenu($(this).attr("mid"));
}
function pageItemClick() {
	$(".pageItem").parent("li").removeClass("active");
	$(this).parent("li").addClass("active");
	getPage($(this).attr("pid"));
}
function showMenu(mid) {
	var menu=menus[mid];
	
	$("#menu_name").val(menu['name']);
	$("#menu_id").val(mid);	
	var menu_items_html="";
	for(var i in menu['content']) {
		menu_items_html+='<tr class="menuItem">';
		menu_items_html+='<td><input type="text" class="input-mini sort" placeholder="1" value="'+menu['content'][i]['sort']+'"></td>';
		menu_items_html+='<td><input type="text" class="input-medium text" placeholder="Текст ссылки" value="'+menu['content'][i]['text']+'"></td>';
		menu_items_html+='<td><input type="text" class="input-xlarge src" placeholder="http://a-l-e-x-u-s.ru" value="'+menu['content'][i]['src']+'"></td>';
		menu_items_html+='<td><button class="btn addMenuItem" type="button"><i class="icon-plus"></i></button><button class="btn removeMenuItem" type="button"><i class="icon-minus"></i></button></td>';
		menu_items_html+='</tr>';	
	}
	$("#menu_items").html(menu_items_html);
	$(".addMenuItem").unbind("click", addMenuItem);
	$(".addMenuItem").click(addMenuItem);$(".removeMenuItem").unbind("click", removeMenuItem);$(".removeMenuItem").click(removeMenuItem);
}
function getPage(pid) {
	$.post("?",{req:"getPage",pid:pid}, function(data) {
		var page=$.parseJSON(data);
		$("#id").val(pid);
		$("#title").val(page['title']);
		$("#category").val(page['category']);
		$("#keywords").val(page['keywords']);
		$("#description").val(page['description']);
		$("#path").val(page['path']);
		$("#small_content").val(page['small_content']);
		$("#big_content").val(page['big_content']);	
	});
}
function saveThis() {
	var cpage=$(".page:visible");
	if($(cpage).hasClass("main-page"))
		savePage();
	else if($(cpage).hasClass("menu-page"))
		saveMenu();
	else if($(cpage).hasClass("settings-page"))
		saveSettings();
}
function removeThis() {
	var cpage=$(".page:visible");
	if($(cpage).hasClass("main-page"))
		removePage();
	else if($(cpage).hasClass("menu-page"))
		removeMenu();
}
function savePage() {
	if($("#path").val()=="" || $("#path").val().search(/[^A-Z0-9\_\-\/]/i)!=-1) {
		bootbox.alert("Путь не может быть пустым или содержать символы кроме A-Z _ -!");
		return;
	}
	var params={
		"title"			:$("#title").val(),
		"category"		:$("#category").val(),
		"keywords"		:$("#keywords").val(),
		"description"	:$("#description").val(),
		"path"			:$("#path").val(),
		"small_content"	:$("#small_content").val(),
		"big_content"	:$("#big_content").val()
	};
	if(params['path']=='new')
		params['path']='new'+Math.floor((Math.random()*1000)+1);
	var pid=$("#id").val();
	if(pid!="new")
		$.post("?",{req:"savePage",pid:pid,params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else {
				bootbox.alert("Страница сохранена!");
				if(params['path']!=pid)
					getStructure(true);
				else
					getStructure();
			}
				
		});
	else
		$.post("?",{req:"createPage",params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else {
				bootbox.alert("Страница создана!");
				getStructure(true);
			}
				
		});
}
function createPage() {
	$("#id").val("new");
	$("#title").val("Заголовок новой страницы");
	$("#keywords").val("Новые ключевые слова");
	$("#description").val("Новое описание");
	$("#path").val("new");
	//$("#small_content").data("wysihtml5").editor.setValue("Краткий текст новой страницы");
	//$("#big_content").data("wysihtml5").editor.setValue("Большой текст новой страницы");
	$("#small_content").val("Краткий текст новой страницы");
	$("#big_content").val("Большой текст новой страницы");
}
function createCategory() {
	$("#category_id").val("new");
	$("#category_name").val("new_category");
	$("#addChangeCategory").modal();
}
function editCategory() {
	var cid=$(this).attr("cid");
	var name=$(this).attr("cname");
	$("#category_id").val(cid);
	$("#category_name").val(name);
	$("#addChangeCategory").modal();
}
function saveCategory() {
	if($("#category_name").val()=="" || $("#category_name").val().search(/[^A-Z0-9\_\-]/i)!=-1) {
		bootbox.alert("Имя категории не может быть пустым или содержать символы кроме A-Z _ -!");
		return;
	}
	var cid=$("#category_id").val();
	var params={
		"name":$("#category_name").val(),
		"category":$("#parrent_category").val()
	};
	if(cid=="new") {
		$.post("?",{req:"createCategory",params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else {
				bootbox.alert("Категория создана!");
				getStructure();
			}
				
			$("#addChangeCategory").modal("hide");
		});
	} else {
		$.post("?",{req:"saveCategory",cid:cid, params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else 
				bootbox.alert("Категория сохранена!");
			$("#addChangeCategory").modal("hide");
		});
	}
}
function removeCategory() {
	var cid=$("#category_id").val();
	bootbox.confirm("Вы действительно хотите удалить категорию?", function(result) {
		if(result) {
			$.post("?",{req:"removeCategory",cid:cid}, function(data) {
				var response=$.parseJSON(data);
				if(response['status']!="OK")
					bootbox.alert("Ошибка:\n"+data);
				else {
					bootbox.alert("Категория удалена!");
					getStructure();
				}
					
				$("#addChangeCategory").modal("hide");
			});
		}
	});
}
function removePage() {
	var pid=$("#id").val();
	bootbox.confirm("Вы действительно хотите удалить страницу?", function(result) {
		if(result) {
			$.post("?",{req:"removePage",pid:pid}, function(data) {
				var response=$.parseJSON(data);
				if(response['status']!="OK")
					bootbox.alert("Ошибка:\n"+data);
				else {
					bootbox.alert("Страница удалена!");
					getStructure(true);
				}
			});
		}
	});
}
function saveMenu() {
	if($("#menu_name").val()=="" || $("#menu_name").val().search(/[^A-Z0-9\_\-]/i)!=-1) {
		bootbox.alert("Имя меню не может быть пустым или содержать символы кроме A-Z _ -!");
		return;
	}
	var mid=$("#menu_id").val();
	var content=new Array();
	var menuItems=$(".menuItem").toArray();
	for(var i in menuItems) {
		content.push({
			"sort":parseInt($(menuItems[i]).find(".sort").val()),
			"text":$(menuItems[i]).find(".text").val(),
			"src":$(menuItems[i]).find(".src").val()
		});
	}
	var params={
		"name"		:$("#menu_name").val(),
		"content"	:JSON.stringify(content)
	};
	if(mid=="new") {
		$.post("?",{req:"createMenu",params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else {
				bootbox.alert("Меню создано!");
				getMenus(true);
			}
		});
	} else {
		$.post("?",{req:"saveMenu",mid:mid, params:JSON.stringify(params)}, function(data) {
			var response=$.parseJSON(data);
			if(response['status']!="OK")
				bootbox.alert("Ошибка:\n"+data);
			else 
				bootbox.alert("Меню сохранено!");
		});
	}
}
function createMenu() {
	$("#menu_id").val("new");
	$("#menu_name").val("new_menu");
	var menu_items_html="";
	menu_items_html+='<tr class="menuItem">';
	menu_items_html+='<td><input type="text" class="input-mini sort" placeholder="1" value="1"></td>';
	menu_items_html+='<td><input type="text" class="input-medium text" placeholder="Текст ссылки" value="Новый пункт меню"></td>';
	menu_items_html+='<td><input type="text" class="input-xlarge src" placeholder="http://a-l-e-x-u-s.ru" value="/"></td>';
	menu_items_html+='<td><button class="btn addMenuItem" type="button"><i class="icon-plus"></i></button><button class="btn removeMenuItem" type="button"><i class="icon-minus"></i></button></td>';
	menu_items_html+='</tr>';	
	
	$("#menu_items").html(menu_items_html);
	$(".addMenuItem").unbind("click", addMenuItem);
	$(".addMenuItem").click(addMenuItem);$(".removeMenuItem").unbind("click", removeMenuItem);$(".removeMenuItem").click(removeMenuItem);
}
function removeMenu() {
	var mid=$("#menu_id").val();
	bootbox.confirm("Вы действительно хотите удалить меню?", function(result) {
		if(result) {
			$.post("?",{req:"removeMenu",mid:mid}, function(data) {
				var response=$.parseJSON(data);
				if(response['status']!="OK")
					bootbox.alert("Ошибка:\n"+data);
				else {
					bootbox.alert("Меню удалено!");
					getMenus(true);
				}
			});
		}
	});
}
function addMenuItem() {
	var menu_items_html="";
	menu_items_html+='<tr class="menuItem">';
	menu_items_html+='<td><input type="text" class="input-mini sort" placeholder="1" value="1"></td>';
	menu_items_html+='<td><input type="text" class="input-medium text" placeholder="Текст ссылки" value="Новый пункт меню"></td>';
	menu_items_html+='<td><input type="text" class="input-xlarge src" placeholder="http://a-l-e-x-u-s.ru" value="/"></td>';
	menu_items_html+='<td><button class="btn addMenuItem" type="button"><i class="icon-plus"></i></button><button class="btn removeMenuItem" type="button"><i class="icon-minus"></i></button></td>';
	menu_items_html+='</tr>';
	$(this).parent().parent().after(menu_items_html);
	$(".addMenuItem").unbind("click", addMenuItem);
	$(".addMenuItem").click(addMenuItem);$(".removeMenuItem").unbind("click", removeMenuItem);$(".removeMenuItem").click(removeMenuItem);
}
function removeMenuItem() {
	$(this).parent().parent().remove();
}
function getSettings() {
	$.post("?",{req:"getSettings"}, function(data) {
		var settings=$.parseJSON(data);
		$("#template").val(settings['template']);
		$("#defaultPage").val(settings['defaultPage']);
		$("#postfix").val(settings['postfix']);
	});
}
function saveSettings() {
	//Проверки на дурака
	if($("#template").val()=="") {
		bootbox.alert("Шаблон не может быть пустым!");
		return;
	}
	var params={
		"template":$("#template").val(),
		"defaultPage":$("#defaultPage").val(),
		"postfix":$("#postfix").val()
	};
	$.post("?",{req:"saveSettings", params:JSON.stringify(params)}, function(data) {
		var response=$.parseJSON(data);
		if(response['status']!="OK")
			bootbox.alert("Ошибка:\n"+data);
		else 
			bootbox.alert("Настройки сохранены!");
	});
}
</script>
<?php endif; ?>
</head>
<?php if(!$auth): ?>
	<body>

    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">йаСайт v1.0</h2>
        <input type="text" name="alogin" class="input-block-level" placeholder="Логин">
        <input type="password" name="apassword" class="input-block-level" placeholder="Пароль">
        <button class="btn btn-large btn-primary" type="submit">Войти</button>
      </form>

    </div> <!-- /container -->
<?php else: ?>
<body>
	<div class="container">
	<!--HEADER-->
	    <div class="navbar navbar-static-top">
		    <div class="navbar-inner">
			    <a class="brand" href="#">йаСайт v1.0</a>
			    <ul class="nav">
				    <li class="active"><a href="#" onclick="togglePage('main-page',this)"><i class="icon-home"></i> Структура</a></li>
				    <li><a href="#" onclick="togglePage('menu-page',this)"><i class="icon-tasks"></i> Меню</a></li>
				    <li><a href="#" onclick="togglePage('files-page',this)"><i class="icon-folder-open"></i> Файлы</a></li>
				    <!--<li><a href="#"><i class="icon-briefcase"></i> Ресурсы</a></li>-->
			    </ul>
			    <ul class="nav pull-right">
			    	<li><a href="#" onclick="togglePage('settings-page',this)"><i class="icon-wrench"></i> Настройки</a></li>
				    <!--<li><a href="#"><i class="icon-question-sign"></i> Справка</a></li>-->
			    </ur>
		    </div>
	    </div>
	<!--MAIN CONTENT-->
		<div class="row page main-page">
		    <div class="span3">
		    	<div class="well sidebar-nav-fixed main-sidebar">
		    	    <ul class="nav nav-list">
					    <li class="nav-header">Опции</li>
					    <li><a href="#" id="new_page"><i class="icon-plus"></i> Добавить страницу</a></li>
					    <li><a href="#" id="new_category"><i class="icon-plus"></i> Добавить категорию</a></li>
					    <li class="divider"></li>

					    <li class="nav-header">Структура</li>
					    <div id="structure">
					    <li class="active">
					    	<a href="#"><i class="icon-folder-open"></i> main</a>
					    	<ul class="nav nav-list">
					    		<li><a href="#"><i class="icon-file"></i> index</a></li>
					    		<li><a href="#"><i class="icon-file"></i> file2</a></li>
					    		<li><a href="#"><i class="icon-file"></i> file3</a></li>
					    	</ul>
					    </li>
					    </div>
					    

					</ul>
				</div>
		    </div>
		    <div class="span9">
		    	<form class="form-horizontal">
		    		<input type="hidden" id="id">
					<div class="control-group">
						<label class="control-label" for="path">Путь</label>
						<div class="controls">
							<input type="text" id="path" class="input-xxlarge" placeholder="main/somepage">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="title">Title</label>
						<div class="controls">
							<input type="text" id="title" class="input-xxlarge" placeholder="Заголовок страницы">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="keywords">Keywords</label>
						<div class="controls">
							<input type="text" id="keywords" class="input-xxlarge" placeholder="страница, страничка, сайт, статья">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="description">Description</label>
						<div class="controls">
							<input type="text" id="description" class="input-xxlarge" placeholder="это очень хорошая страница">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="category">Категория</label>
						<div class="controls">
							<select id="category">
								<option>main</option>
							</select>
						</div>
					</div>					
				</form>
				<div class="accordion" id="accordion2">
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							Краткий текст страницы
							</a>
						</div>
						<div id="collapseOne" class="accordion-body collapse">
							<div class="accordion-inner">
								<!--<div id="small_content" class="visual_editor"></div>-->
								<textarea id="small_content" class="textEditArea"></textarea>
							</div>
						</div>
					</div>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
							Основной текст страницы
							</a>
						</div>
						<div id="collapseTwo" class="accordion-body collapse in">
							<div class="accordion-inner">
								<textarea id="big_content" class="textEditArea"></textarea>
							</div>
						</div>
					</div>
				</div>
				
		    </div>
	    </div>
	    <div class="row page menu-page">
		    <div class="span3">
		    	<div class="well sidebar-nav-fixed main-sidebar">
		    	    <ul class="nav nav-list">
					    <li class="nav-header">Опции</li>
					    <li><a href="#" id="new_menu"><i class="icon-plus"></i> Добавить меню</a></li>
					    <li class="divider"></li>

					    <li class="nav-header">Структура</li>
					    <div id="menus">
					    <ul class="nav nav-list">
						    <li class="active">
						    	<a href="#"><i class="icon-file"></i> main</a>
						    </li>
						</ul>
					    </div>
					    <li class="divider"></li>

					</ul>
				</div>
		    </div>
		    <div class="span9">
		    	<form class="form-horizontal">
		    		<input type="hidden" id="menu_id">
					<div class="control-group">
						<label class="control-label" for="menu_name">Название</label>
						<div class="controls">
							<input type="text" id="menu_name" class="input-xxlarge" placeholder="main/somepage">
						</div>
					</div>				
				</form>
				
		    	<table class="table table-hover table-condensed">
				    <thead>
					    <tr>
						    <th>Сортировка</th>
						    <th>Текст</th>
						    <th>Ссылка</th>
						    <th>...</th>
					    </tr>
				    </thead>
				    <tbody id="menu_items">
				    	<tr class="menuItem">
						    <td><input type="text" class="input-mini sort" placeholder="1"></td>
						    <td><input type="text" class="input-medium text" placeholder="Текст ссылки"></td>
						    <td><input type="text" class="input-xlarge src" placeholder="http://a-l-e-x-u-s.ru"></td>
						    <td>
						    	<button class="btn addMenuItem" type="button"><i class="icon-plus"></i></button><button class="btn removeMenuItem" type="button"><i class="icon-minus"></i></button>
						    </td>
					    </tr>
					</tbody>
				</table>
					
		    </div>
	    </div>
	    <div class="row page settings-page">
		    <div class="span3">
		    	<div class="well sidebar-nav-fixed main-sidebar">
		    	    <ul class="nav nav-list">
					    <li class="nav-header">Опции</li>
					    <li class="active"><a href="#">Сайт включён</a></li>
					    <li class="divider"></li>

					    <li class="nav-header">Компоненты</li>
					    <li><a href="#">Menu</a></li>
					    <li><a href="#">PageList</a></li>
					    <li><a href="#">Mail</a></li>
					    <li><a href="#">Form</a></li>
					    <li class="divider"></li>
					</ul>
				</div>
		    </div>
		    <div class="span9">
		    	<form class="form-horizontal siteSettings">
		    		<h3>Свойства сайта</h3>
					<div class="control-group">
						<label class="control-label" for="template">Шаблон</label>
						<div class="controls">
							<input type="text" id="template" class="input-large src" placeholder="default">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="defaultPage">Страница по умолчанию</label>
						<div class="controls">
							<select id="defaultPage">
								<option>default</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="postfix">Постфикс заголовков</label>
						<div class="controls">
							<input type="text" id="postfix" class="input-xxlarge" placeholder=" :: Супер сайт">
						</div>
					</div>
					<!--<h3>Администрирование</h3>
					<div class="control-group">
						<label class="control-label" for="name">Пароль администратора</label>
						<div class="controls">
							<input type="password" class="input-xlarge src" placeholder="Пароль администратора">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="name">Еще раз</label>
						<div class="controls">
							<input type="password" class="input-xlarge src" placeholder="Пароль администратора">
						</div>
					</div>-->
				</form>
		    </div>
	    </div>
	    <div class="row page files-page">
		    <div class="span12">
		  		<div id="elfinder"></div>
		    </div>
	    </div>
	    <div class="row saveremoveControls">
	    	<div class="span3"></div>
	    	<div class="span9" style="text-align:center;">
	    		<button class="btn" type="button" id="save">Сохранить</button>
	    		<button class="btn btn-danger" type="button" id="remove">Удалить</button>
	    	</div>
	    </div>
	</div>
	<div class="modal hide fade" id="addChangeCategory">
	    <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h3>Управление категорией</h3>
		    </div>
		    <div class="modal-body">
		    <form class="form-horizontal">
	    		<input type="hidden" id="category_id">
	    		<input type="hidden" id="parrent_category" value="-1">
				<div class="control-group">
					<label class="control-label" for="category_name">Название</label>
					<div class="controls">
						<input type="text" id="category_name" class="input-large" placeholder="Название категории">
					</div>
				</div>
			</form>
		    </div>
		    <div class="modal-footer">
		    <a href="#" class="btn" data-dismiss="modal">Отмена</a>
		    <a href="#" class="btn btn-danger">Удалить</a>
		    <a href="#" class="btn btn-primary">Сохранить</a>
	    </div>
    </div>
<?php endif;?>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
<script src="../js/wysihtml5-0.3.0_rc2.min.js"></script>
<script src="../js/bootstrap-wysihtml5-0.0.2.min.js"></script>
<script src="../js/bootbox.min.js"></script>
</body>
</html>