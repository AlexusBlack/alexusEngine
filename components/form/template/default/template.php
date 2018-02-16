<?php
global $FORM_CHECK_RESULT;
if(count($_POST)!=0 && $FORM_CHECK_RESULT):
?>
<b style='color:green'>Ваша заявка успешно отправлена!</b>

<?php
else:
	if(count($_POST)!=0 && !$FORM_CHECK_RESULT) echo "<b style='color:red'>Вы не заполнили все необходимые поля!</b>";
?>

<style>
.order input {
	font-style: normal;
}
</style>
<script type="text/javascript">
$(function() {
	$(".order input[type=text]").keyup(function() {
		var type=$(this).attr("name");
		var value=$(this).val();
		if(type=="fio") {
			if(value.search(/[^A-Za-zА-Яа-я\s]+/)!=-1) {
				$(this).parent().parent().children("td:last").css("color","red").text("Разрешённые символы: A-Z А-Я");
			} else {
				$(this).parent().parent().children("td:last").text("");
			}
		} else if(type=="email") {
			if(value.search(/[^A-Za-z\d\@\_\.-]+/)!=-1) {
				$(this).parent().parent().children("td:last").css("color","red").text("Несоответствие формату: user@email.com");
			} else {
				$(this).parent().parent().children("td:last").text("");
			}
		} else if(type=="phone") {
			if(value.search(/[^\d\+]+/)!=-1) {
				$(this).parent().parent().children("td:last").css("color","red").text("Разрешены только цифры и +");
			} else {
				$(this).parent().parent().children("td:last").text("");
			}
		} else if(type=="objem") {
			if(value.search(/[^\d\A-Za-zа-яА-Я\s]+/)!=-1) {
				$(this).parent().parent().children("td:last").css("color","red").text("Разрешены только буквы и цифры");
			} else {
				$(this).parent().parent().children("td:last").css("color","inherit").text("Если не знаете, оставьте поле пустым или напишите примерно.");
			}
		} else if(type=="ves") {
			if(value.search(/[^\d]+/)!=-1) {
				$(this).parent().parent().children("td:last").css("color","red").text("Разрешены только цифры");
			} else {
				$(this).parent().parent().children("td:last").css("color","inherit").text("Минимальный вес к отправке - 30кг!");
			}
		}
	});
	$(".order input[name=ves]").blur(function() {
		if(parseInt($(this).val())<30) {
			alert("Минимальный вес 30кг!");
			$(this).val("");
		}
	});
	$(".order").submit(function() {
		var fields=$(this).find("input[type=text], textarea").toArray();
		for(var id in fields) {
			if( $(fields[id]).attr("name")=="objem" || $(fields[id]).attr("name")=="city_from" ) continue;
			if( $(fields[id]).val()=="" ) {
				alert("Не заполнены все необходимые поля");
				if($(fields[id]).attr("name")!="description")
					$(fields[id]).parent().parent().children("td:last").css("color","red").text("Это поле должно быть заполнено!");
				return false;
			}
		}
	});
})
</script>
<form method="post" class="order" action="?">
<table border=0 style="width:100%;">
	<tr>
		<td width="100px">ФИО</td>
		<td><input type="text" name="fio"></td>	
		<td></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><input type="text" name="email"></td>
		<td></td>	
	</tr>
	<tr>
		<td>Телефон</td>
		<td><input type="text" name="phone"></td>
		<td></td>	
	</tr>
	<tr>
		<td>Откуда</td>
		<td><input type="text" name="city_from"></td>
		<td>Из какого города Китая</td>	
	</tr>
	<tr>
		<td>Куда</td>
		<td><input type="text" name="city_to"></td>
		<td>В какой город России</td>	
	</tr>
	<tr>
		<td>Вес</td>
		<td><input type="text" name="ves"></td>
		<td>Минимальный вес к отправке - 30кг! </td>	
	</tr>
	<tr>
		<td>Объем</td>
		<td><input type="text" name="objem"></td>
		<td>Если не знаете, оставьте поле пустым или напишите примерно.</td>	
	</tr>
	<tr>
		<td rowspan="2">
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
		<td colspan="3">
			Описание груза:<br>
			<textarea name="description" style="width:100%; height:100px;"></textarea>
		</td>	
	</tr>
</table>
<b>Сроки доставки до Москвы:</b><br>
ЖД 20-25 дней<br>
Авиа 12-15 дней
<center>
<input type="submit" value="Отправить">
</center>
</form>

<?php endif;?>