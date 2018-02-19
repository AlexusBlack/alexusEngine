<?php /* Smarty version Smarty-3.1.13, created on 2018-02-18 23:45:06
         compiled from "engine/components/form/templates/default/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1051834325a8a10029bd2b0-87303278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa13a41cebec935e6133acb197ebe3a3ab5d9bb8' => 
    array (
      0 => 'engine/components/form/templates/default/template.tpl',
      1 => 1518997062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1051834325a8a10029bd2b0-87303278',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'success' => 0,
    'fields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a8a10029f3874_78186429',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a8a10029f3874_78186429')) {function content_5a8a10029f3874_78186429($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['success']->value)){?>
	<?php if ($_smarty_tpl->tpl_vars['success']->value=='true'){?>
		<b>Данные успешно отправлены!<b><br>
	<?php }elseif($_smarty_tpl->tpl_vars['success']->value=='false'){?>
		<b>Вы неправильно заполнили данные формы!<b><br>
	<?php }?>
<?php }?>
<form method="post">
<table>
	<tr>
		<td>Имя:</td>
		<td><input type="text" name="name"<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['name'])){?> value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['name']['value'];?>
"<?php }?>></td>
		<td>
			<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['name']['deprecated_symbols'])){?>
				<b>Вы использовали запрещенные символы!<b><br>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td>Логин:</td>
		<td><input type="text" name="login"<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['login'])){?> value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['login']['value'];?>
"<?php }?>></td>
		<td>
			<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['login']['requered'])){?>
				<b>Не заполнено обязательное поле!<b><br>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['login']['symbols'])){?>
				<b>Разрешенные символы: A-Za-z_-<b><br>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['login']['deprecated_symbols'])){?>
				<b>Вы использовали запрещенные символы!<b><br>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['fields']->value['login']['compare'])){?>
				<b>Значение не соответствует установленному формату!<b><br>
			<?php }?>
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
</form><?php }} ?>