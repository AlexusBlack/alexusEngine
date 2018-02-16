<?php
/**
* Класс административной панели
*/
class Admin
{
	private $db;
	private $pages;
	private $config;
	private $params;
	private $auth;
	function __construct($login, $password, $params)
	{
		global $config;
		$this->config=$config;
		$this->params=$params;
		if($login==$config['admin']['login'] && $password==$config['admin']['password'])
			$this->auth=true;
		else {
			$this->auth=false;
			return;
		}
		$this->db=new DB($config['db']['host'] ,$config['db']['user'], $config['db']['password'], $config['db']['dbname'], DEBUG);
		if(!$this->db->isConnected()) die("DB connection error!\n");
		$this->pages=new Pages($this->db);

	}
	public function isAuthorized() {
		return $this->auth;
	}
	public function isAjaxResponse() {
		if(isset($this->params['req']))
			return true;
		else
			return false;
	}
	public function getResponse() {
		$req=$this->params['req'];
		if($req=="structure")
			print $this->getStructure();
		else if($req=="getPage")
			print $this->getPage();
		else if($req=="savePage")
			print $this->savePage();
		else if($req=="removePage")
			print $this->removePage();
		else if($req=="createPage")
			print $this->createPage();
		else if($req=="getMenus")
			print $this->getMenus();
		else if($req=="saveMenu")
			print $this->saveMenu();
		else if($req=="removeMenu")
			print $this->removeMenu();
		else if($req=="createMenu")
			print $this->createMenu();
		else if($req=="createCategory")
			print $this->createCategory();
		else if($req=="saveCategory")
			print $this->saveCategory();
		else if($req=="removeCategory")
			print $this->removeCategory();
		else if($req=="getSettings")
			print $this->getSettings();
		else if($req=="saveSettings")
			print $this->saveSettings();
		else print json_encode(array("status"=>"ERROR", "message"=>"bad request!"));
		
	}
	private function getStructure() {
		$category=$this->pages->getCategoryList();
		$pages=$this->pages->getPageList();
		$result=array();
		foreach ($category as $value) {
			$result[$value['id']]=$value;
			$result[$value['id']]['pages']=array();
		}
			$result[$value['id']]=$value;
		foreach ($pages as $value) {
			$value['title']=urldecode($value['title']);
			$result[$value['category']]['pages'][]=$value;
		}
		return json_encode($result);
	}
	private function getPage() {
		$page=$this->pages->getPage($this->params['pid']);
		return json_encode(array(
			"id"		=> $page->id(),
			"path"		=> $page->path(),
			"title"		=> $page->title(),
			"category"	=> $page->category(),
			"keywords"	=> $page->keywords(),
			"description"=> $page->description(),
			"small_content"=> $page->small_content(),
			"big_content"=> $page->big_content()
		));
	}
	private function savePage() {
		$this->pages->changePage($this->params['pid'], json_decode($this->params['params'], true));
		return json_encode(array("status"=>"OK"));
	}
	private function removePage() {
		$this->pages->removePage($this->params['pid']);
		return json_encode(array("status"=>"OK"));
	}
	private function createPage() {
		$this->pages->createPage(json_decode($this->params['params'], true));
		return json_encode(array("status"=>"OK"));
	}
	private function getMenus() {
		/*$menus=$this->db->get("*", "menus");
		foreach ($menus as $key => $value) {
			$menus[$key]['content']=iconv('CP1251','UTF-8', $value['content']);
		}*/
		return json_encode($this->db->get("*", "menus"));
	}
	private function saveMenu() {
		$mid=$this->params['mid'];
		$params=json_decode($this->params['params'], true);
		$this->db->update($params, "menus", array("id"=>$mid));
		return json_encode(array("status"=>"OK"));
	}
	private function removeMenu() {
		$this->db->remove("menus", array("id"=>$this->params['mid']));
		return json_encode(array("status"=>"OK"));
	}
	private function createMenu() {
		$params=json_decode($this->params['params'], true);
		$this->db->add($params, "menus");
		return json_encode(array("status"=>"OK"));
	}
	private function createCategory() {
		$params=json_decode($this->params['params'], true);
		$this->db->add($params, "category");
		return json_encode(array("status"=>"OK"));
	}
	private function saveCategory() {
		$cid=$this->params['cid'];
		$params=json_decode($this->params['params'], true);
		$this->db->update($params, "category", array("id"=>$cid));
		return json_encode(array("status"=>"OK"));
	}
	private function removeCategory() {
		$this->db->remove("category", array("id"=>$this->params['cid']));
		return json_encode(array("status"=>"OK"));
	}
	private function getSettings() {
		$settings_data=$this->db->get("*","settings");

		$settings=array();
		foreach ($settings_data as $field)
			$settings[$field['name']]=$field['value'];
		return json_encode($settings);
	}
	private function saveSettings() {
		$params=json_decode($this->params['params'], true);
		foreach ($params as $key => $value) {
			$this->db->update(array("value"=>$value), 'settings', array("name"=>$key));
		}
		return json_encode(array("status"=>"OK"));
	}
}

?>