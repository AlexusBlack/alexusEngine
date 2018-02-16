{if isset($success)}
<script>
{literal}
$(function() {
	$(".tabbable a:last").tab("show");
});
{/literal}
</script>
	{if $success eq 'true'}
		<b style='color:green'>Заявка успешно отправлена!</b><br>
	{elseif $success eq 'false'}
		<b style='color:red'>Вы не заполнили все необходимые поля!</b><br>
	{/if}
{/if}
<form method="post">
	<input type="hidden" name="formid" value="order">
*Адрес отправки, фирма, конт. лицо, тел.<br>
<textarea name="country_source" style="width:100%; height:80px;">{if isset($fields.country_source)}{$fields.country_source.value}{/if}</textarea>
{if isset($fields.country_source.requered)}
	<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
{/if}
<br>
*Адрес доставки, фирма, конт. лицо, тел.<br>
<textarea name="country_dest" style="width:100%; height:80px;">{if isset($fields.country_dest)}{$fields.country_dest.value}{/if}</textarea>
{if isset($fields.country_dest.requered)}
	<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
{/if}
   <br>                                 
*Наименование товара/характер груза<br>
<textarea name="name_goods" style="width:100%; height:80px;">{if isset($fields.country_dest)}{$fields.country_dest.value}{/if}</textarea>
{if isset($fields.name_goods.requered)}
	<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
{/if}                               
<br>
<table>
	<tr>
		<td>
			*Вес нетто,кг
		</td>
		<td>
			<input type="text" name="weightNettoGoods"{if isset($fields.weightNettoGoods)} value="{$fields.weightNettoGoods.value}"{/if}>
			{if isset($fields.weightNettoGoods.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>
			*Вес брутто,кг
		</td>
		<td>
			<input type="text" name="weightBruttoGoods"{if isset($fields.weightBruttoGoods)} value="{$fields.weightBruttoGoods.value}"{/if}>
			{if isset($fields.weightNettoGoods.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>
			*Объем,м3
		</td>
		<td>
			<input type="text" name="volumeGoods"{if isset($fields.volumeGoods)} value="{$fields.volumeGoods.value}"{/if}>
			{if isset($fields.volumeGoods.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>
			*Кол во мест ( шт.)
		</td>
		<td>
			<input type="text" name="pcs"{if isset($fields.pcs)} value="{$fields.pcs.value}"{/if}>
			{if isset($fields.pcs.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>
			*Стоим. груза,$
		</td>
		<td>
			<input type="text" name="valueGoods"{if isset($fields.valueGoods)} value="{$fields.valueGoods.value}"{/if}>
			{if isset($fields.valueGoods.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
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
			<input type="text" name="tnved"{if isset($fields.tnved)} value="{$fields.tnved.value}"{/if}>
		</td>
	</tr>
	<tr>
		<td>
			Торговая марка
		</td>
		<td>
			<input type="text" name="trademark"{if isset($fields.trademark)} value="{$fields.trademark.value}"{/if}>
		</td>
	</tr>
	<tr>
		<td>
			Ссылка на сайт или ссылка на фото
		</td>
		<td>
			<input type="text" name="url"{if isset($fields.url)} value="{$fields.url.value}"{/if}>
		</td>
	</tr>
	<tr>
		<td>
			Ваш бюджет на доставку,$
		</td>
		<td>
			<input type="text" name="deliv"{if isset($fields.deliv)} value="{$fields.deliv.value}"{/if}>
		</td>
	</tr>
	<tr>
		<td>
			*e-mail:
		</td>
		<td>
			<input type="text" name="email"{if isset($fields.email)} value="{$fields.email.value}"{/if}>
			{if isset($fields.email.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
		</td>
	</tr>
</table>
<Br>
Примечания:<br>
<textarea name="remarks" style="width:100%; height:80px;">{if isset($fields.remarks)}{$fields.remarks.value}{/if}</textarea>
<br>
<input type="submit" value="Отправить" class="btn btn-primary">

</form>