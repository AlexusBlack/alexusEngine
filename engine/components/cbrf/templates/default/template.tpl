<div class="block">
	<center><strong>Внутренние курсы валют на {$smarty.now|date_format:"%d.%m.%Y"}</strong></center>
	<table class="table">
		<tbody>
			{foreach from=$currency key=name item=curr}
			<tr>
				<td>1 <b>{$name}</b></td>
				<td>{$curr|string_format:"%.2f"} <b>RUB</b></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>