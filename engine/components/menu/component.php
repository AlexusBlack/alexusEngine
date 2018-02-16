<?php
/**
* Класс описывающий меню
*/
class Menu extends Component
{
	function setInfo() {
		$this->name="menu";
	}
	function actions() {
		if(!isset($this->params['name'])) die("No such menu =(");
		$menu_name=$this->params['name'];

		$menu=$this->db->get("*", "menus", array("name"=>$menu_name));
		if(count($menu)==0) die("No such menu =(");
		global $config;
		//print iconv('CP1251','UTF-8', print_r($menu, true));
		//print($menu[0]['content']);
		$this->params['menu']=json_decode( $menu[0]['content'], true);
		
		//var_dump($this->params['menu']);
		foreach ($this->params['menu'] as $key => $value) {
			if(isset($_GET['pid']) && ($value['src']==$_GET['pid'] || $value['src']==$config['site_root'].$_GET['pid']))
				$this->params['menu'][$key]['selected']=true;
		}
		if(!isset($this->params['sort']) || $this->params['sort']=="ASC")
			usort($this->params['menu'], array($this, "sortASC"));
		else
			usort($this->params['menu'], array($this, "sortDESC"));
	}
	private function sortASC($a, $b) {
		if ($a['sort'] == $b['sort']) {
	        return 0;
	    }
	   	return ($a['sort'] < $b['sort']) ? -1 : 1;
	}
	private function sortDESC($a, $b) {
		if ($a['sort'] == $b['sort']) {
	        return 0;
	    }
	   	return ($a['sort'] > $b['sort']) ? -1 : 1;
	}	
}

?>