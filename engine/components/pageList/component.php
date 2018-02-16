<?php
/**
* Класс описывающий меню
*/
class pageList extends Component
{
	function setInfo() {
		$this->name="pageList";
	}
	function actions() {
		if(!isset($this->params['category'])) die("No such category =(");
		$category=$this->params['category'];

		$pages=new Pages($this->db);
		$cid=$pages->getCategoryId($category);
		if($cid==-1) die("No such category =(");

		global $config;
		$pageList=$pages->getPageList($cid);
		foreach ($pageList as $page_key => $pageFields) {
			foreach ($pageFields as $field_key => $field) {
				$pageList[$page_key][$field_key]=urldecode($field);
			}
			$pageList[$page_key]['path']=$config['site_root'].$pageList[$page_key]['path'];
			//TODO: парсинг первой картинки
			if(isset($this->params['parseImage']) && $this->params['parseImage']=="true")
				if(preg_match("/<img src=\"(.+?)\">/i", $pageList[$page_key]['small_content'], $arr)) {
					$pageList[$page_key]['small_content']=str_replace($arr[0], "", $pageList[$page_key]['small_content']);
					$pageList[$page_key]['image']=$arr[1];
				}
		}

		//TODO: сортировка
		if(!isset($this->params['sort']) || $this->params['sort']=="ASC")
			usort($pageList, "pageList::sortASC");
		else
			usort($pageList, "pageList::sortDESC");

		$this->params['pages']=$pageList;
	}
	private function sortASC($a, $b) {
		if ($a['id'] == $b['id']) {
	        return 0;
	    }
	   	return ($a['id'] < $b['id']) ? -1 : 1;
	}
	private function sortDESC($a, $b) {
		if ($a['id'] == $b['id']) {
	        return 0;
	    }
	   	return ($a['id'] > $b['id']) ? -1 : 1;
	}		
}

?>