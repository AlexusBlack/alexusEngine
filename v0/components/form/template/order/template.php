<?php
global $FORM_CHECK_RESULT;
if(count($_POST)!=0 && $FORM_CHECK_RESULT):
?>

<b style='color:green'>Заявка успешно отправлена!</b>

<?elseif(count($_POST)!=0 && !$FORM_CHECK_RESULT):?>

<b style='color:red'>Вы не заполнили все необходимые поля!</b>

<?endif;?>
<style>
.order input {
	/*переписываем стандартный стиль input для сайта*/
	font-style: normal;
}
</style>
<form action="?" method="post" name="sendorder" class="order">
*Адрес отправки, фирма, конт. лицо, тел.<br>
<textarea name="country_source" rows="5" cols="40"></textarea>
<br>
*Адрес доставки, фирма, конт. лицо, тел.<br>
<textarea name="country_dest" rows="5" cols="40"></textarea>
   <br>                                 
*Наименование товара/характер груза<br>
<textarea name="name_goods" rows="5" cols="40"></textarea>                               
<br>
<table>
	<tr>
		<td>
			*Вес нетто,кг
		</td>
		<td>
			<input type="text" name="weightNettoGoods">
		</td>
	</tr>
	<tr>
		<td>
			*Вес брутто,кг
		</td>
		<td>
			<input type="text" name="weightBruttoGoods">
		</td>
	</tr>
	<tr>
		<td>
			*Объем,м3
		</td>
		<td>
			<input type="text" name="volumeGoods">
		</td>
	</tr>
	<tr>
		<td>
			*Кол во мест ( шт.)
		</td>
		<td>
			<input type="text" name="pcs">
		</td>
	</tr>
	<tr>
		<td>
			*Стоим. груза,$
		</td>
		<td>
			<input type="text" name="valueGoods">
		</td>
	</tr>
	<tr>
		<td>
			Вид упаковки
		</td>
		<td>
			<select name="upakType">
				<option value="картон">картон</option>
				<option value="пленка">пленка</option>
				<option value="дер.ящик">дер.ящик</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			ТНВЭД
		</td>
		<td>
			<input type="text" name="tnved">
		</td>
	</tr>
	<tr>
		<td>
			Торговая марка
		</td>
		<td>
			<input type="text" name="trademark">
		</td>
	</tr>
	<tr>
		<td>
			Ссылка на сайт или ссылка на фото
		</td>
		<td>
			<input type="text" name="url">
		</td>
	</tr>
	<tr>
		<td>
			Ваш бюджет на доставку,$
		</td>
		<td>
			<input type="text" name="deliv">
		</td>
	</tr>
	<tr>
		<td>
			*e-mail:
		</td>
		<td>
			<input type="text" name="email">
		</td>
	</tr>
</table>
<Br>
Примечания:<br>
<textarea name="remarks" rows="5" cols="40"></textarea>
<br>
<input type="submit" value="Отправить">

</form>