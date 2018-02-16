<?php
/**
* Класс описывающий шаблон сайта
*/
class Template
{
	private $name;
	private $smarty;
	function __construct($name)
	{
		$this->name=$name;
		$this->smarty=new Smarty();
		global $SITE_TEMPLATE_DIR;
		$SITE_TEMPLATE_DIR="engine/templates/".$name."/";
		if(!file_exists($SITE_TEMPLATE_DIR."template.tpl")) die("Template ".$name." not exists!\n");
		$this->smarty->template_dir = $SITE_TEMPLATE_DIR;

		$this->smarty->compile_dir = "cache/templates/".$name."/compile/";
		$this->smarty->cache_dir = "cache/templates/".$name."/cache/";
		$this->smarty->caching = false;
		$this->smarty->error_reporting = E_ALL; // LEAVE E_ALL DURING DEVELOPMENT
		$this->smarty->debugging = true;
	}
	public function enable($params, $default_page=false) {
		global $SITE_TEMPLATE_DIR;
		$params['SITE_TEMPLATE_DIR']=$SITE_TEMPLATE_DIR;
		if($default_page) $params['IS_DEFAULT_PAGE']="true";
		foreach ($params as $key => $value) {
			$this->smarty->assign($key, $value);
		}
		return $this->smarty->fetch("template.tpl");
	}
}

?>