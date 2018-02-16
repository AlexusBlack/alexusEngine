{if isset($success)}
	{if $success eq 'true'}
		<b style='color:green'>Сообщение успешно отправлено!</b><br>
	{elseif $success eq 'false'}
		<b style='color:red'>Вы неправильно заполнили данные формы!</b><br>
	{/if}
{/if}
<script>
{literal}
$(function() {
	$(".feedback input[name=email]").bind("keyup click blur change",function() {
		if($(this).val().search(/^[A-Z\d\._-]+@[A-Z\d\._-]+\.[A-Z\d]{2,5}$/i)==-1) ///[^A-Za-z\d\@\_\.-]+/
			showWarning(this, "Несоответствие формату: user@email.com");
		else
			showWarning(this, "");
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
	else
		$(icontainer).find(".help-block").text(text);
}
{/literal}
</script>
<form method="post" class="feedback">
<table style="width:100%;">
	<tr>
		<td style="vertical-align:top;">ФИО:</td>
		<td>
			<input type="text" class="input-xlarge" name="name"{if isset($fields.name)} value="{$fields.name.value}"{/if} placeholder="Ваши ФИО">
			{if isset($fields.name.deprecated_symbols)}
				<span class="help-block" style='color:red'>Здесь блочный вспомогательный текст.</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Email:</td>
		<td>
			<input type="text" class="input-xlarge" name="email"{if isset($fields.email)} value="{$fields.email.value}"{/if} placeholder="Ваш e-mail">
			{if isset($fields.email.requered)}
				<span class="help-block" style='color:red'>Не заполнено обязательное поле!</span><br>
			{/if}
			{if isset($fields.email.deprecated_symbols)}
				<span class="help-block" style='color:red'>Вы использовали запрещенные символы!</span><br>
			{/if}
			{if isset($fields.email.compare)}
				<span class="help-block" style='color:red'>Значение не соответствует установленному формату!</span><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">Сообщение:</td>
		<td colspan="2">
			<textarea name="text" style="width:100%; height:100px;" placeholder="Ваше сообщение">{if isset($fields.name)}{$fields.name.value}{/if}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center;">
			<button type="submit" class="btn">Отправить</button>
		</td>
	</tr>
</table>
</form>