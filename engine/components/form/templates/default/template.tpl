{if isset($success)}
	{if $success eq 'true'}
		<b>Данные успешно отправлены!<b><br>
	{elseif $success eq 'false'}
		<b>Вы неправильно заполнили данные формы!<b><br>
	{/if}
{/if}
<form method="post">
<table>
	<tr>
		<td>Имя:</td>
		<td><input type="text" name="name"{if isset($fields.name)} value="{$fields.name.value}"{/if}></td>
		<td>
			{if isset($fields.name.deprecated_symbols)}
				<b>Вы использовали запрещенные символы!<b><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>Логин:</td>
		<td><input type="text" name="login"{if isset($fields.login)} value="{$fields.login.value}"{/if}></td>
		<td>
			{if isset($fields.login.requered)}
				<b>Не заполнено обязательное поле!<b><br>
			{/if}
			{if isset($fields.login.symbols)}
				<b>Разрешенные символы: A-Za-z_-<b><br>
			{/if}
			{if isset($fields.login.deprecated_symbols)}
				<b>Вы использовали запрещенные символы!<b><br>
			{/if}
			{if isset($fields.login.compare)}
				<b>Значение не соответствует установленному формату!<b><br>
			{/if}
		</td>
	</tr>
	<tr>
		<td>Пароль:</td>
		<td><input type="password" name="password"></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3">
			<button type="submit">Отправить</button>
		</td>
	</tr>
</table>
</form>