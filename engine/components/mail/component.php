<?php
/**
* Класс описывающий отправку почты
*/
class Mail extends Component
{
	function setInfo() {
		$this->name="mail";
	}
	function actions() {
		if(!isset($this->params['to'])) die("Unknown recipient!");
		if(!isset($this->params['mailTemplate'])) die("Unknown mail template!");
		$mail_template="";

		global $SITE_TEMPLATE_DIR;
		$from_site_template=$SITE_TEMPLATE_DIR."components/".$this->name."/mail_templates/".$this->params['mailTemplate']."/";
		$from_component_template="engine/components/".$this->name."/mail_templates/".$this->params['mailTemplate']."/";
		if(file_exists($from_site_template."template.tpl"))
			$mail_template=$from_site_template;		
		else if(file_exists($from_component_template."template.tpl"))
			$mail_template=$from_component_template;
		else die("Unknown mail template!");
		//TODO: выясняем путь к почтовому шаблону

		$msmarty=new Smarty();
		$msmarty->template_dir = $mail_template;
		$msmarty->compile_dir = "cache/components/".$this->name."/".$mail_template."/compile/";
		$msmarty->cache_dir = "cache/components/".$this->name."/".$mail_template."/cache/";
		$msmarty->caching = false;
		$msmarty->error_reporting = E_ALL; // LEAVE E_ALL DURING DEVELOPMENT
		$msmarty->debugging = true;

		$fields=array();
		foreach ($this->params['fields'] as $key => $value) {
			$fields[$key]=$value;
		}
		$msmarty->assign("fields", $fields);
		$mail_body=$msmarty->fetch("template.tpl");
		$mail_params=json_decode(file_get_contents($mail_template."/params.json"), true);
		//TODO: компилируем параметры и шаблон
		$this->sendmail($this->params['to'], $mail_params['subject'], $mail_params['from'], $mail_params['fromname'], $mail_params['type'], $mail_body);
		//TODO: отсылаем письмо
	}
	private function sendmail($to, $subject, $from, $fromname, $type, $text) {
		if($type=='text')
			$tip="text/plain";
		else
			$tip="text/html";
		$fname=trim($fromname); $fname=substr($fname,0,100);
		$frommail=trim($from);  $frommail=substr($frommail,0,100);
		$from="=?UTF-8?B?".base64_encode($fname)."?= <$frommail>";
		$tema=$subject;

		$header="From: $from\n";
		$header.="Subject: $tema\n";
		$header.="Content-type: $tip; charset=utf-8\n";

		mail($to, $tema, $text, $header);
	}	
}
#[COMPONENT:mail|default|{"to":"alexusblack@gmail.com","mailTemplate":"default","fields":{"1":"test","2":"succ"}}]
?>