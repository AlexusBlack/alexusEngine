<?php
/**
* Класс работы со структурой сайта
*/
class Pages
{
	private $db;
	function __construct($db)
	{
		$this->db=$db;
	}
	public function getPage($path) {
		$page=$this->db->get("*","pages",array("path"=>$path));
		//$page=$page[0];
		if(count($page)==0) 
			return $this->getPage("404");
		else
			return new Page($page[0]);
	}
	public function getPageList($category="all") {
		$pageListParams=array("id","path","category","title","small_content");
		if($category=="all")
			return $this->db->get($pageListParams,"pages");
		else
			return $this->db->get($pageListParams,"pages",array("category"=>$category));
	}
	public function changePage($path, $params) {
		$page=$this->getPage($path);
		$this->db->update($page->setParams($params)->getParams(), "pages", array("path"=>$path));
		return $this;
	}
	public function removePage($path) {
		$this->db->remove("pages", array("path"=>$path));
		return $this;
	}
	public function createPage($params) {
		$page=new Page($params);
		$this->db->add($page->getParams(), "pages");
		return $this;
	}
	public function getCategoryId($name=null) {
		if($name===null) return -1;
		$category=$this->db->get(array("id"), "category", array("name"=>$name));
		if(count($category)==0) return -1;
		return $category[0]['id'];
	}
	public function getCategoryList($category="all") {
		if($category=="all")
			return $this->db->get("*", "category");
		else
			return $this->db->get("*", "category", array("category"=>$category));
	}
	public function removeCategory($category) {
		$this->db->remove("category", array("id"=>$category));
		return $this;
	}
	public function createCategory($params) {
		$params['name']=urlencode($params['name']);
		$this->db->add($params, "category");
		return $this;
	}
}
/**
* Класс описывающий страницу сайта
*/
class Page
{
	private $id;
	private $path;
	private $category;
	private $title;
	private $keywords;
	private $description;
	private $small_content;
	private $big_content;
	function __construct($params)
	{
		if(isset($params['id'])) $this->id=$params['id'];
		$this->path=$params['path'];
		$this->category=$params['category'];
		$this->title=urldecode($params['title']);
		$this->keywords=urldecode($params['keywords']);
		$this->description=urldecode($params['description']);
		$this->small_content=urldecode($params['small_content']);
		$this->big_content=urldecode($params['big_content']);
	}
	public function id($value=null) {
		if($value===null)
			return $this->id;
		else {
			$this->id=(int)$value;
			return $this;
		}
	}
	public function path($value=null) {
		if($value===null)
			return $this->path;
		else {
			$this->path=(string)$value;
			return $this;
		}
	}
	public function category($value=null) {
		if($value===null)
			return $this->category;
		else {
			$this->category=(int)$value;
			return $this;
		}
	}
	public function title($value=null) {
		if($value===null)
			return $this->title;
		else {
			$this->title=(string)$value;
			return $this;
		}
	}
	public function keywords($value=null) {
		if($value===null)
			return $this->keywords;
		else {
			$this->keywords=(string)$value;
			return $this;
		}
	}
	public function description($value=null) {
		if($value===null)
			return $this->description;
		else {
			$this->description=(string)$value;
			return $this;
		}
	}
	public function small_content($value=null) {
		if($value===null)
			return $this->small_content;
		else {
			$this->small_content=(string)$value;
			return $this;
		}
	}
	public function big_content($value=null) {
		if($value===null)
			return $this->big_content;
		else {
			$this->big_content=(string)$value;
			return $this;
		}
	}
	public function getParams($decoded=false) {
		if($decoded)
			$params=array(
				'path'=>$this->path,
				'category'=>$this->category,
				'title'=>$this->title,
				'keywords'=>$this->keywords,
				'description'=>$this->description,
				'small_content'=>$this->small_content,
				'big_content'=>$this->big_content
			);
		else
			$params=array(
				'path'=>$this->path,
				'category'=>$this->category,
				'title'=>urlencode($this->title),
				'keywords'=>urlencode($this->keywords),
				'description'=>urlencode($this->description),
				'small_content'=>urlencode($this->small_content),
				'big_content'=>urlencode($this->big_content)
			);
		if(isset($this->id)) $params['id']=$this->id;
		return $params;
	}
	public function setParams($params) {
		if(isset($params['id'])) $this->id=$params['id'];
		if(isset($params['path'])) $this->path=$params['path'];
		if(isset($params['category'])) $this->category=$params['category'];
		if(isset($params['title'])) $this->title=$params['title'];
		if(isset($params['keywords'])) $this->keywords=$params['keywords'];
		if(isset($params['description'])) $this->description=$params['description'];
		if(isset($params['small_content'])) $this->small_content=$params['small_content'];
		if(isset($params['big_content'])) $this->big_content=$params['big_content'];
		return $this;
	}
}

?>