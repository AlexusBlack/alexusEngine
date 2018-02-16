<?php
/**
* Описание компонента
*/
class Component
{
	public $name;
	public $template;
	public $params;
	private $smarty;
	public $db;
	private $content;	
	function __construct($template, $params, $db)
	{
		$this->db=$db;
		$this->setInfo();
		$this->template=$template;
		$this->params=$params;

		$this->smarty=new Smarty();

		global $SITE_TEMPLATE_DIR;
		$from_site_template=$SITE_TEMPLATE_DIR."components/".$this->name."/templates/".$template."/";
		$from_component_template="engine/components/".$this->name."/templates/".$template."/";
		if(file_exists($from_site_template."template.tpl"))
			$template_path=$from_site_template;		
		else if(file_exists($from_component_template."template.tpl"))
			$template_path=$from_component_template;
		
		$this->smarty->template_dir = $template_path;

		$this->smarty->compile_dir = "cache/components/".$this->name."/".$template."/compile/";
		$this->smarty->cache_dir = "cache/components/".$this->name."/".$template."/cache/";
		$this->smarty->caching = false;
		$this->smarty->error_reporting = E_ALL; // LEAVE E_ALL DURING DEVELOPMENT
		$this->smarty->debugging = true;

		$this->actions();

		foreach ($this->params as $key => $value) {
			$this->smarty->assign($key, $value);
		}
	}
	function setInfo() {
		$this->name="default";
	}
	function actions() {
		$old=$this->params;
		$this->params=array("values"=>$old);
	}
	public function show() {
		return $this->smarty->fetch("template.tpl");
	}
}
/**
* Класс для работы с компонентами
*/
class Components
{
	private $db;
	function __construct($db)
	{
		$this->db=$db;
		$this->includeAllComponents();
	}
	public function exec($name, $template, $params) {
		if(!class_exists($name)) die("Component ".$name." not exists!\n");
		$com=new $name($template, $params, $this->db);
		return $com->show();
	}
	public function getList() {
		$classes = get_declared_classes();
		$implementsIModule = array();
		foreach($classes as $klass) {
		   $reflect = new ReflectionClass($klass);
		   if($reflect->implementsInterface('Component')) 
		      $implementsIModule[] = $klass;
		}
		return $implementsIModule;
	}
	public function replace($text) {
		if(preg_match_all("/\[COMPONENT\:([a-z]+?)\|([a-z]+?)\|(.+?)\]/i", $text, $arr)==0) return $text;
		foreach ($arr[0] as $key => $value) {
			$text=str_replace($value, $this->exec($arr[1][$key], $arr[2][$key], json_decode($arr[3][$key], true)), $text);
		}
		return $text;
	}
	private function includeAllComponents() {
		$com_list=scandir("engine/components");
		foreach ($com_list as $key => $value) {
			if($value=="." || $value=="..") continue;
			include("engine/components/".$value."/component.php");
		}
	}
}
?>