<?php /* Smarty version Smarty-3.1.13, created on 2013-02-24 18:56:08
         compiled from "engine\components\default\templates\default\template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209015129f0e30e17a2-14201939%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '739ac0ba362b9e45845e3fb827f269d784b7995f' => 
    array (
      0 => 'engine\\components\\default\\templates\\default\\template.tpl',
      1 => 1361703364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209015129f0e30e17a2-14201939',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5129f0e3168726_64893604',
  'variables' => 
  array (
    'values' => 0,
    'param' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5129f0e3168726_64893604')) {function content_5129f0e3168726_64893604($_smarty_tpl) {?>шаблон компонента по умолчанию
<ul>
<?php  $_smarty_tpl->tpl_vars['param'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['param']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['values']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['param']->key => $_smarty_tpl->tpl_vars['param']->value){
$_smarty_tpl->tpl_vars['param']->_loop = true;
?>
    <li><?php echo $_smarty_tpl->tpl_vars['param']->value;?>
</li>
<?php } ?>
</ul><?php }} ?>