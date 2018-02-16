{literal}
<script type="text/javascript">
var def_form_error=0;
$(function() {
	$(".order input[type=text]").keyup(function() {
		var type=$(this).attr("name");
		var value=$(this).val();
		if(type=="fio") {
			if(value.search(/[^A-Za-zА-Яа-я\s]+/)!=-1) 
				showWarning(this, "Разрешённые символы: A-Z А-Я");
			else
				showWarning(this, "");
		} else if(type=="email") {
			if(value.search(/^[A-Z\d\._-]+@[A-Z\d\._-]+\.[A-Z\d]{2,5}$/i)==-1) ///[^A-Za-z\d\@\_\.-]+/
				showWarning(this, "Несоответствие формату: user@email.com");
			else
				showWarning(this, "");
		} else if(type=="phone") {
			if(value.search(/[^\d\+\(\)\s-]+/)!=-1)
				showWarning(this, "Разрешены только цифры и +");
			else
				showWarning(this, "");
		} else if(type=="objem") {
			if(value.search(/[^\d\A-Za-zа-яА-Я\s\.\,]+/)!=-1)
				showWarning(this, "Разрешены только буквы и цифры", "red");
			else
				showWarning(this, "Если не знаете, оставьте поле пустым или укажите габариты, например 100 x 200 x 150.", "#333333");
		} else if(type=="ves") {
			if(value.search(/[^\d]+/)!=-1)
				showWarning(this, "Разрешены только цифры", "red");
			else
				showWarning(this, "");
		}
	});
	$(".order input[name=ves]").blur(function() {
		if(parseInt($(this).val())<30) {
			showWarning(this, "Минимальный вес 30кг!", "red");
			$(this).val("");
		} else {
			showWarning(this, "");
		}
	});
	$(".order input[name=email]").bind("click blur change",function() {
		if($(this).val().search(/^[A-Z\d\._-]+@[A-Z\d\._-]+\.[A-Z\d]{2,5}$/i)==-1) ///[^A-Za-z\d\@\_\.-]+/
			showWarning(this, "Несоответствие формату: user@email.com");
		else
			showWarning(this, "");
	});
	$(".order").submit(function() {
		var fields=$(this).find("input[type=text], textarea").toArray();
		for(var id in fields) {
			if( $(fields[id]).attr("name")=="objem" || $(fields[id]).attr("name")=="city_from" ) continue;
			if( $(fields[id]).val()=="" ) {
				alert("Не заполнены все необходимые поля");
				if($(fields[id]).attr("name")!="description")
					showWarning(fields[id], "Это поле должно быть заполнено!");
				return false;
			}
		}
		if($(this).find(".error").length!=0) return false;
	});
});
function showWarning(el, text, color) {
	var fcolor=color;
	if(fcolor==undefined) fcolor="red";
	var icontainer=$(el).parent();
	if($(icontainer).find(".help-block").length<=0) {
		$(icontainer).append('<span class="help-block" style="color:'+fcolor+'"></span>');
	} 
	$(icontainer).find(".help-block").css("color", fcolor);
	if(text=="") 
		$(icontainer).find(".help-block").remove();
	else {
		$(icontainer).find(".help-block").text(text);
		if(fcolor=="red") $(icontainer).find(".help-block").addClass("error");
	}		
}
</script>
{/literal}
{if isset($success)}
<script>
{literal}
$(function() {
	$(".tabbable a:first").tab("show");
});
{/literal}
</script>
	{if $success eq 'true'}
		<b style='color:green'>Заявка успешно отправлена!</b><br>
	{elseif $success eq 'false'}
		<b style='color:red'>Вы не заполнили все необходимые поля!</b><br>
	{/if}
{/if}
<form method="post" class="order">
	<input type="hidden" name="formid" value="def">
<table border=0 style="width:100%;">
	<tr>
		<td width="120px" style="vertical-align:top;">ФИО</td>
		<td><input type="text" class="input-xlarge" name="fio"{if isset($fields.fio)} value="{$fields.fio.value}"{/if}>
		{if isset($fields.fio.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">E-mail</td>
		<td><input type="text" class="input-xlarge" name="email"{if isset($fields.email)} value="{$fields.email.value}"{/if}>
		{if isset($fields.email.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Телефон</td>
		<td><input type="text" class="input-xlarge" name="phone"{if isset($fields.phone)} value="{$fields.phone.value}"{/if}>
		{if isset($fields.phone.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Откуда</td>
		<td><input type="text" class="input-xlarge" name="city_from"{if isset($fields.city_from)} value="{$fields.city_from.value}"{/if} placeholder="Из какого города Китая">
		{if isset($fields.city_from.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Куда</td>
		<td><input type="text" class="input-xlarge" name="city_to"{if isset($fields.city_to)} value="{$fields.city_to.value}"{/if} placeholder="В какой город России">
		{if isset($fields.city_to.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Вес</td>
		<td><input type="text" class="input-xlarge" name="ves"{if isset($fields.ves)} value="{$fields.ves.value}"{/if} placeholder="Минимальный вес к отправке - 30кг!">
		{if isset($fields.ves.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Объем</td>
		<td><input type="text" class="input-xlarge" name="objem"{if isset($fields.objem)} value="{$fields.objem.value}"{/if} placeholder="Если не знаете, оставьте поле пустым или напишите примерно.">
		{if isset($fields.objem.requered)}
			<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
		{/if}</td>
	</tr>
	<tr>
		<td rowspan="2" style="vertical-align:top;">
			Вид транспорта:
		</td>
		<td>
			<input type="checkbox" value="выбрано" name="jd"> ЖД
		</td>
	</tr>
	<tr>
		<td>
			<input type="checkbox" value="выбрано" name="avia"> Авиа
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Описание груза:<br>
			<textarea name="description" style="width:100%; height:100px;">{if isset($fields.description)}{$fields.description.value}{/if}</textarea>
			{if isset($fields.description.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span>
			{/if}
		</td>	
	</tr>
</table>
<b>Сроки доставки до Москвы:</b><br>
ЖД 20-25 дней<br>
Авиа 12-15 дней
<center>
<input type="submit" value="Отправить" class="btn btn-primary">
</center>
</form>