<b>Новая карго-заявка с сайта www.svoichelovek.ru</b><br><br>
<table border="0">
	<tr>
		<td><b>ФИО:</b></td>
		<td>{$fields.fio}</td>
	</tr>
	<tr>
	<td><b>E-mail:</b></td>
		<td>{$fields.email}</td>
	</tr>
		<tr>
		<td><b>Телефон:</b></td>
		<td>{$fields.phone}</td>
	</tr>
	<tr>
		<td><b>Откуда:</b></td>
		<td>{$fields.city_from}</td>
	</tr>
	<tr>
		<td><b>Куда:</b></td>
		<td>{$fields.city_to}</td>
	</tr>
	<tr>
		<td><b>Вес:</b></td>
		<td>{$fields.ves}</td>
	</tr>
	<tr>
		<td><b>Объем:</b></td>
		<td>{$fields.objem}</td>
	</tr>
	
	<tr>
		<td><b>Вид транспорта::</b></td>
	</tr>
	<tr>
		<td>ЖД {if isset($fields.jd)} Выбрано {/if}
		<br>АВИА {if isset($fields.avia)} Выбрано {/if}</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<b>Описание груза:</b>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{$fields.description}
		</td>
	</tr>
</table>