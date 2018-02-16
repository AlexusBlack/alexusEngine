<?php
/**
* Класс описывающий меню
*/
class cbrf extends Component
{
	function setInfo() {
		$this->name="cbrf";
	}
	function actions() {
		if(!isset($this->params['currency'])) die("No such category =(");
		$currency=explode(",", $this->params['currency']);
		$currency_id=array(
	 		"USD"=>"R01235",
	 		"RMB"=>"R01375",
	 		"CNY"=>"R01375"
	 	);

		//TODO: проверка кэша
		$chache_file="cache/components/".$this->name."/cbRf.txt";
		$chache_exists=file_exists($chache_file);
		if($chache_exists)
			$chache_data=filemtime($chache_file);
		else
			if(!file_exists("cache/components/".$this->name))
				mkdir("cache/components/".$this->name);

		
		if(!$chache_exists || $chache_data+24*60*60<time()) {
			$xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');
			$curr=array();
			foreach ($currency as $key => $value) {
				if(in_array($value, array_keys($currency_id))) {
					$data=$this->xml_getByAttr($xml, "ID", array($currency_id[$value]));
					$val=floatval(str_replace(",", ".", $data[0]->Value));
					$nom=floatval(str_replace(",", ".", $data[0]->Nominal));
					$val=$val/$nom;
					if(isset($this->params['percent']))
						$val=$val*(floatval($this->params['percent'])/100.00);
					$curr[$value]=$val;
				} else
					$curr[$value]=1;
			}
			file_put_contents($chache_file, json_encode($curr));
		} else
			$curr=json_decode(file_get_contents($chache_file), true);
		

		$this->params['currency']=$curr;
		
	}
	private function xml_getByAttr($xml, $name, $values) {
    	if(!is_array($values)) $values=array($values);
    	$result=array();
    	foreach ($xml as $key => $value) {
    		$attr=$value->attributes();
    		if(isset($attr[$name]) && in_array($attr[$name], $values))
    			array_push($result, $value);
    	}
    	return $result;
    }
}

?>