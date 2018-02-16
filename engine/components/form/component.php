<?php
/**
* Класс описывающий отправку почты
*/
class Form extends Component
{
	function setInfo() {
		$this->name="form";
	}
	function actions() {
		if(!isset($this->params['handler']) && !class_exists($this->params['handler'])) die("Unknown handler!");
		//Если форма была отправлена
		if(count($_POST)!=0) {
			if(isset($this->params['formid']) && $this->params['formid']!=$_POST['formid']) return;
			//TODO: проверяем существование файла параметров и считываем его
			global $SITE_TEMPLATE_DIR;
			$from_site_template=$SITE_TEMPLATE_DIR."components/".$this->name."/templates/".$this->template."/";
			$from_component_template="engine/components/".$this->name."/templates/".$this->template."/";
			if(file_exists($from_site_template."params.json"))
				$template_path=$from_site_template;		
			else if(file_exists($from_component_template."params.json"))
				$template_path=$from_component_template;
			else $template_path="";
			if($template_path!="") 
				$params=json_decode(file_get_contents($template_path."params.json"), true);
			else
				$params=array();

			//TODO: проверяем соответствие переданных данных параметрам, при ошибке помечаем поле
			$fields=$_POST;
			//TODO: конвертируем поля в формат формы
			foreach ($fields as $key => $value) $fields[$key]=array("value"=>$value);
			$status=true;
			foreach ($params as $key => $value) {
				if(isset($value['requered']) && $value['requered']=="true" && (!isset($fields[$key]) || $fields[$key]['value']=="") ) {
					$fields[$key]['requered']="true";
					$status=false;
					continue;
				} elseif (!isset($fields[$key])) continue;

				if(isset($value['symbols']) && preg_match("/[^".$value['symbols']."]/", $fields[$key]['value'])!=0) {
					$fields[$key]['symbols']="true";
					$status=false;
				}
				if(isset($value['deprecated_symbols']) && preg_match("/[".$value['deprecated_symbols']."]/", $fields[$key]['value'])!=0) {
					$fields[$key]['deprecated_symbols']="true";
					$fields[$key]['value']=preg_replace("/[".$value['deprecated_symbols']."]/", "", $fields[$key]['value']);
					$status=false;
				}
				if(isset($value['compare']) && preg_match("/".$value['compare']."/", $fields[$key]['value'])==0) {
					$fields[$key]['compare']="true";
					$status=false;
				}
			}
			//TODO: если всё верно определяем хендлер и отправляем данные, указываем успех в параметрах
			if($status) {
				$handler_params=array();
				if(isset($this->params['handler_params'])) $handler_params=$this->params['handler_params'];
				//TODO: конвертируем поля в формат обработчика
				$handler_fields=$fields;
				foreach ($handler_fields as $key => $value) $handler_fields[$key]=$value['value'];
				$handler_params['fields']=$handler_fields;
				$handler=new $this->params['handler']("default", $handler_params, $this->db);
				$this->params['success']="true";
			} else $this->params['success']="false";
			
			//TODO: возвращаем поля в список параметров для отображения в шаблоне
			$this->params['fields']=$fields;
		}
	}	
}
#[COMPONENT:form|default|{"handler":"Mail","handler_params":{"to":"alexusblack@gmail.com","mailTemplate":"default"}}]
?>