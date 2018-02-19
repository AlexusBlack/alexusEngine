<?php /* Smarty version Smarty-3.1.13, created on 2018-02-18 23:45:06
         compiled from "engine/templates/alexus/components/menu/templates/default/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6739253115a8a100296bd86-15296050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2a91c9eb13e8b5587d3d9f1d87990895622cc01' => 
    array (
      0 => 'engine/templates/alexus/components/menu/templates/default/template.tpl',
      1 => 1518997062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6739253115a8a100296bd86-15296050',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'menuItem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a8a10029913d7_77241952',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a8a10029913d7_77241952')) {function content_5a8a10029913d7_77241952($_smarty_tpl) {?><ul class="nav pull-right">
	<?php  $_smarty_tpl->tpl_vars['menuItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->key => $_smarty_tpl->tpl_vars['menuItem']->value){
$_smarty_tpl->tpl_vars['menuItem']->_loop = true;
?>
    <li<?php if (isset($_smarty_tpl->tpl_vars['menuItem']->value['selected'])){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['menuItem']->value['src'];?>
"><?php echo $_smarty_tpl->tpl_vars['menuItem']->value['text'];?>
</a></li>
    <?php } ?>
</ul><?php }} ?>