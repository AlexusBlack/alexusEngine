<?php
function loadCurrentPage() {
	global $siteEngine_config;
	if(isset($_GET['pid'])) {
		$page=$_GET['pid'];
	} else {
		$page=$siteEngine_config['default_page'];
	}
	if( !($page_data=getPage($page)) ) show404();

	global $PAGE_TITLE, $PAGE_KEYWORDS, $PAGE_DESCRIPTION, $PAGE_SMALL_CONTENT, $PAGE_CONTENT;
	$PAGE_TITLE=$page_data['PAGE_TITLE'];
	$PAGE_KEYWORDS=$page_data['PAGE_KEYWORDS'];
	$PAGE_DESCRIPTION=$page_data['PAGE_DESCRIPTION'];
	$PAGE_SMALL_CONTENT=$page_data['PAGE_SMALL_CONTENT'];
	$PAGE_CONTENT=$page_data['PAGE_CONTENT'];
}
function ajaxPageData() {
	global $PAGE_TITLE, $PAGE_KEYWORDS, $PAGE_DESCRIPTION;
	print json_encode(array(
		'PAGE_TITLE'=>$PAGE_TITLE,
		'PAGE_KEYWORDS'=>$PAGE_KEYWORDS,
		'PAGE_DESCRIPTION'=>$PAGE_DESCRIPTION
	))."\n[AJAX-PAGE-CONTENT]\n";
}
function ShowComponent($name, $template, $params) {
	global $COM_PARAMS;
	global $TEMPLATE_PATH;
	$COM_PARAMS=$params;

	$from_template=$TEMPLATE_PATH."components/".$name."/template/".$template;
	$from_component="components/".$name."/template/".$template;
	//Выбираем шаблон компонента
	if(file_exists($from_template."/template.php")) {
		$COM_PARAMS['tpl']=$from_template;
		$template=$from_template."/template.php";
	} else if(file_exists($from_component."/template.php")) {
		$COM_PARAMS['tpl']=$from_component;
		$template=$from_component."/template.php";
	} else {
		print "no such template!";
		exit;
	}
	//Подключаем компонент
	if(file_exists("components/".$name."/main.php")) {
		include("components/".$name."/main.php");
	} else {
		print "no such component!";
		exit;
	}
	//Подключаем шаблон компонента
	include($template);
}
function showContent() {
	global $PAGE_CONTENT;
	includeComponents($PAGE_CONTENT);
	//print $PAGE_CONTENT;
}
function includeComponents($content) {
	$data=$content;
	while(preg_match("/\[COMPONENT\:([a-z]+?)\|([a-z]+?)\|(.+?)\]/", $data, $arr, PREG_OFFSET_CAPTURE)) {
		print substr($data, 0, $arr[0][1]);
		$data=substr($data, $arr[0][1]+strlen($arr[0][0]));
		ShowComponent($arr[1][0], $arr[2][0], json_decode($arr[3][0], true));
	}
	print $data;
}
function getMenu($mid) {
	global $DB;
	if($DB==null) connectDB();
	if($mid=="ALL")
		$query = "SELECT * FROM `menus`";
	else {
		if( !($selector=makeGetSelector($mid, true)) ) return false;
		$query = "SELECT * FROM `menus` WHERE{$selector}";
	}
	$res = $DB->query($query);
	if($res->num_rows==0) return false;

	if(gettype($mid)=="integer" || (gettype($mid)=="string" && $mid!="ALL") ) {
		$menu_data = $res->fetch_assoc();
		return array(
				"MENU_NAME"=>$menu_data['name'],
				"MENU_CONTENT"=>json_decode($menu_data['content'], true)
			);
	} elseif(gettype($mid)=="array" || $mid=="ALL") {
		$result=array();
		while ($menu_data = $res->fetch_assoc()) {
			array_push($result, array(
				"MENU_NAME"=>$menu_data['name'],
				"MENU_CONTENT"=>json_decode($menu_data['content'], true)
			));
		}
		return $result;
	} else {
		return false;
	}	
}
function setMenu($mid, $params) {
	global $DB;
	if($DB==null) connectDB();
	if(gettype($mid)=="string") {
		$mid=preg_replace("/[^A-Za-z\d\.\/_-]/", "", $mid);
		$selector=" name='{$mid}'";
	} else  {
		$mid=intval($mid);
		$selector=" id={$mid}";
	}
	$params['MENU_CONTENT']=str_replace('\\', '\\\\', json_encode($params['MENU_CONTENT']));
	$query = "UPDATE `menus` SET `name`='{$params['MENU_NAME']}', `content`='{$params['MENU_CONTENT']}' WHERE{$selector}";
	$DB->query($query);
}
function createMenu($params) {
	global $DB;
	if($DB==null) connectDB();
	$params['MENU_CONTENT']=str_replace('\\', '\\\\', json_encode($params['MENU_CONTENT']));
	$query = "INSERT INTO `menus` (`name`, `content`) VALUES ('{$params['MENU_NAME']}','{$params['MENU_CONTENT']}')";
	$DB->query($query);
}
function removeMenu($mid) {
	global $DB;
	if($DB==null) connectDB();
	if(gettype($mid)=="string") {
		$mid=preg_replace("/[^A-Za-z\d\.\/_-]/", "", $mid);
		$selector=" name='{$mid}'";
	} else  {
		$mid=intval($mid);
		$selector=" id={$mid}";
	}
	$query = "DELETE FROM `menus` WHERE{$selector}";
	$DB->query($query);
}
function sortMenu($a, $b) {
	if ($a['sort'] == $b['sort']) {
        return 0;
    }
    return ($a['sort'] < $b['sort']) ? -1 : 1;
}
function getPage($pid) {
	global $DB;
	if($DB==null) connectDB();
	if($pid=="ALL")
		$query = "SELECT * FROM `pages`";
	else {
		if( !($selector=makeGetSelector($pid)) ) return false;
		$query = "SELECT * FROM `pages` WHERE{$selector}";
	} 
			
	$res = $DB->query($query);
	if($res->num_rows==0) return false;
	if(gettype($pid)=="integer" || (gettype($pid)=="string" && $pid!="ALL") ) {
		$page_data = $res->fetch_assoc();
		return array(
			"PAGE_TITLE"=>$page_data['title'],
			"PAGE_PATH"=>$page_data['path'],
			"PAGE_KEYWORDS"=>$page_data['keywords'],
			"PAGE_DESCRIPTION"=>$page_data['description'],
			"PAGE_SMALL_CONTENT"=>$page_data['text-mini'],
			"PAGE_CONTENT"=>$page_data['text']
			);
	} elseif(gettype($pid)=="array" || $pid=="ALL") {
		$result=array();
		while ($page_data = $res->fetch_assoc()) {
			array_push($result, array(
				"PAGE_TITLE"=>$page_data['title'],
				"PAGE_PATH"=>$page_data['path'],
				"PAGE_KEYWORDS"=>$page_data['keywords'],
				"PAGE_DESCRIPTION"=>$page_data['description'],
				"PAGE_SMALL_CONTENT"=>$page_data['text-mini'],
				"PAGE_CONTENT"=>$page_data['text']
			));
		}
		return $result;
	} else {
		return false;
	}	
}
function getPageInfo($pid) {
	global $DB;
	if($DB==null) connectDB();

	if($pid=="ALL")
		$query = "SELECT title, path, keywords, description FROM `pages`";
	else {
		if( !($selector=makeGetSelector($pid)) ) return false;
		$query = "SELECT title, path, keywords, description FROM `pages` WHERE{$selector}";
	} 

	
	$res = $DB->query($query);
	if($res->num_rows==0) return false;
	if(gettype($pid)=="integer" || (gettype($pid)=="string" && $pid!="ALL") ) {
		$page_data = $res->fetch_assoc();
		return array(
			"PAGE_TITLE"=>$page_data['title'],
			"PAGE_PATH"=>$page_data['path'],
			"PAGE_KEYWORDS"=>$page_data['keywords'],
			"PAGE_DESCRIPTION"=>$page_data['description']
			);
	} elseif(gettype($pid)=="array" || $pid=="ALL") {
		$result=array();
		while ($page_data = $res->fetch_assoc()) {
			array_push($result, array(
				"PAGE_TITLE"=>$page_data['title'],
				"PAGE_PATH"=>$page_data['path'],
				"PAGE_KEYWORDS"=>$page_data['keywords'],
				"PAGE_DESCRIPTION"=>$page_data['description']
			));
		}
		return $result;
	} else {
		return false;
	}	
}
function makeGetSelector($pid, $isMenu=false) {
	if(gettype($pid)=="array") {
		foreach ($pid as $key => $id) {
			$id=intval($id);
			if($key==0) {
				$selector=" id={$id}";
			} else {
				$selector.=" OR id={$id}";
			}
		}
	} elseif(gettype($pid)=="integer"){
		$pid=intval($pid);
		$selector=" id={$pid}";
	} elseif(gettype($pid)=="string") {
		$pid=preg_replace("/[^A-Za-z\d\.\/_-]/", "", $pid);
		if($isMenu) 
			$selector=" name='{$pid}'";
		else
			$selector=" path='{$pid}'";
	} else {
		return false;
	}
	return $selector;
}
function savePage($pid, $params) {
	if(gettype($pid)=="string") {
		$pid=preg_replace("/[^A-Za-z\d\.\/_-]/", "", $pid);
		$selector=" path='{$pid}'";
	} else  {
		$pid=intval($pid);
		$selector=" id={$pid}";
	}
	global $DB;
	if($DB==null) connectDB();
	$query = "UPDATE `pages` SET `title`='{$params['PAGE_TITLE']}', `path`='{$params['PAGE_PATH']}', `keywords`='{$params['PAGE_KEYWORDS']}', `description`='{$params['PAGE_DESCRIPTION']}', `text-mini`='{$params['PAGE_SMALL_CONTENT']}', `text`='{$params['PAGE_CONTENT']}' WHERE{$selector}";
	$DB->query($query);
}
function createPage($params) {
	global $DB;
	if($DB==null) connectDB();
	$query = "INSERT INTO `pages` (`title`, `path`, `keywords`, `description`,`text-mini`, `text`) VALUES ('{$params['PAGE_TITLE']}','{$params['PAGE_PATH']}','{$params['PAGE_KEYWORDS']}','{$params['PAGE_DESCRIPTION']}','{$params['PAGE_SMALL_CONTENT']}','{$params['PAGE_CONTENT']}')";
	$DB->query($query);
}
function removePage($pid) {
	global $DB;
	if($DB==null) connectDB();
	if(gettype($pid)=="string") {
		$pid=preg_replace("/[^A-Za-z\d\.\/_-]/", "", $pid);
		$selector=" path='{$pid}'";
	} else  {
		$pid=intval($pid);
		$selector=" id={$pid}";
	}
	$query = "DELETE FROM `pages` WHERE{$selector}";
	$DB->query($query);
}
function connectDB() {
	global $siteEngine_config;
	global $DB;
	// Соединяемся, выбираем базу данных
	$DB = new mysqli($siteEngine_config['db_host'], $siteEngine_config['db_user'], $siteEngine_config['db_password'], $siteEngine_config['db_database']);
	if ($DB->connect_errno) {
    	echo "Не удалось подключиться к MySQL: (" . $DB->connect_errno . ") " . $DB->connect_error;
    	exit;
    }
}
function show404() {
	echo "<h1>404 error</h1>";
	exit;
}
?>