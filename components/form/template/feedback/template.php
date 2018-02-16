<?php
global $FORM_CHECK_RESULT;
if(count($_POST)!=0 && $FORM_CHECK_RESULT):
?>

<b style='color:green'>Сообщение успешно отправлено!</b>

<?elseif(count($_POST)!=0 && !$FORM_CHECK_RESULT):?>

<b style='color:red'>Вы не заполнили все необходимые поля!</b>

<?endif;?>

<style>
.order input {
	/*переписываем стандартный стиль input для сайта*/
	font-style: normal;
}
</style>
<form method="post" class="feedback" action="?">
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
		<td colspan="3">
			Текст сообщения:<br>
			<textarea name="text" style="width:100%; height:100px;"></textarea>
		</td>	
	</tr>
</table>
<center>
<input type="submit" value="Отправить">
</center>
</form>