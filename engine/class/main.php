<?php
/**
* Класс движка сайта
*/
class Engine
{
	private $path;
	private $config;
	private $settings;
	private $template;
	private $db;
	private $components;
	private $pages;
	function __construct($path, $config)
	{
		$this->path=$path;
		$this->config=$config;
		$this->db=new DB($config['db']['host'] ,$config['db']['user'], $config['db']['password'], $config['db']['dbname'], DEBUG);
		if(!$this->db->isConnected()) die("DB connection error!\n");
		//Получаем настройки сайта
		$settings=$this->db->get("*","settings");

		$this->settings=array();
		foreach ($settings as $field) {
			$this->settings[$field['name']]=$field['value'];
		}
		//Если страница не запрошена устанавливаем страницу по умолчанию
		if($this->path=="") $this->path=$this->settings['defaultPage'];
		$this->pages=new Pages($this->db);
		$this->components=new Components($this->db);
		$this->template=new Template($this->settings['template']);
	}
	function getPage() {
		$page=$this->pages->getPage($this->path);
		$page_params=$page->getParams("DECODED");
		$page_params['title'].=$this->settings['postfix'];
		if($this->path==$this->settings['defaultPage'])
			$page=$this->template->enable($page_params, true);
		else
			$page=$this->template->enable($page_params);
		$page=$this->components->replace($page);
		return $page;
	}
}

?>