<?php
/**
* Класс работы с базой данных
*/
class DB
{
	private $db;
	private $status;
	private $column_regexp;
	private $table_regexp;
	private $value_regexp;
	private $DEBUG;
	function __construct($host, $user, $password, $dbname, $_DEBUG=false)
	{
		$this->DEBUG=$_DEBUG;
		$this->db=new mysqli($host, $user, $password, $dbname);
		if ($this->db->connect_errno) {
			$this->status=array(
				"ERROR"=>1,
				"errno"=>$this->db->connect_errno,
				"errname"=>$this->db->connect_error
			);
			if($this->DEBUG) $this->toDebug($status);
	    } else {
	    	$this->status="connected";
	    }
	    //def vars
	    $this->column_regexp="/[^a-z\d\_-]/iu";
	    $this->table_regexp="/[^a-z\d\_-]/iu";
	    $this->value_regexp='/([\'\"\`])/u';
	}
	public function isConnected() {
		if($this->status=="connected")
			return true;
		else
			return false;
	}
	public function get($columns, $from, $where=null) {
		if(($c=$this->makeColumns($columns))===false) return false;
		if(($t=$this->makeTables($from))===false) return false;
		if(($w=$this->makeCondition($where))===false) return false;
		
		$query = "SELECT {$c} FROM {$t} {$w}";
		if($this->DEBUG) $this->toDebug($query);
		$res = $this->db->query($query);

		$result=array();
		while ($row = $res->fetch_assoc())
			array_push($result, $row);
		return $result;
	}
	public function add($columns, $to) {
		if(($c=$this->makeColumns(array_keys($columns)))===false) return false;
		if(($t=$this->makeTables($to))===false) return false;
		if(($v=$this->makeValues($columns))===false) return false;

		$query = "INSERT INTO {$t} ({$c}) VALUES ({$v})";
		if($this->DEBUG) $this->toDebug($query);
		$this->db->query($query);
		return $this;
	}
	public function update($columns, $in, $where=null) {
		if(($v=$this->makeColValChain($columns))===false) return false;
		if(($t=$this->makeTables($in))===false) return false;
		if(($w=$this->makeCondition($where))===false) return false;
		$query = "UPDATE {$t} SET {$v} {$w}";
		if($this->DEBUG) $this->toDebug($query);
		$this->db->query($query);
		return $this;
	}
	public function remove($from, $where=null) {
		if(($t=$this->makeTables($from))===false) return false;
		if(($w=$this->makeCondition($where))===false) return false;
		$query = "DELETE FROM {$t} {$w}";
		if($this->DEBUG) $this->toDebug($query);
		$this->db->query($query);
		return $this;
	}
	private function makeColumns($columns) {
		if($columns=="*") 
			$c="*";
		else if(is_string($columns))
			$c=preg_replace($this->column_regexp, "", $columns);
		else if(is_array($columns)) {
			$c="";
			foreach ($columns as $key => $value) {
				$c.=preg_replace($this->column_regexp, "", $value);
				if(next($columns)!==false) $c.=", ";
			}
		} else
			return false;
		return $c;
	}
	private function makeTables($from) {
		if(is_string($from)) 
			$t="`".preg_replace($this->table_regexp, "", $from)."`";
		else
			return false;
		return $t;
	}
	private function makeCondition($where) {
		if($where===null)
			$w="";
		else if(is_array($where)) {
			$w="WHERE ";
			foreach ($where as $key => $value) {
				$w.="`".preg_replace($this->column_regexp, "", $key)."`=";
				if(is_int($value))
					$w.=$value;
				else if(is_string($value))
					$w.="'".preg_replace($this->value_regexp, "\\\\$1", $value)."'";
				else return false;
				if(next($where)!==false) $c.=" AND ";
			}
		} else return false;
		return $w;
	}
	private function makeValues($values) {
		if(is_string($values))
			$v="'{$values}'";
		else if(is_int($values))
			$v="{$values}";
		else if(is_array($values)) {
			$v="";
			foreach ($values as $key => $value) {
				if(is_string($value))
					$v.="'".preg_replace($this->value_regexp, "\\\\$1", $value)."'";
				else if(is_int($value))
					$v.="{$value}";
				else return false;
				if(next($values)!==false) $v.=", ";
			}
		} else return false;
		return $v;
	}
	private function makeColValChain($values) {
		if(is_array($values)) {
			$v="";
			foreach ($values as $key => $value) {
				$v.="`".preg_replace($this->column_regexp, "", $key)."`=";
				if(is_string($value))
					$v.="'".preg_replace($this->value_regexp, "\\\\$1", $value)."'";
				else if(is_int($value))
					$v.="{$value}";
				else return false;
				if(next($values)!==false) $v.=", ";
			}
		} else return false;
		return $v;
	}
	private function toDebug($text) {
		if(is_array($text)) {
			print "<pre>";
			print_r($text);
			print "</pre>";
		} else if(is_string($text)){
			print $text."\n";
		} else {
			var_dump($text);
		}
	}
}

?>