<?php /* Smarty version Smarty-3.1.13, created on 2018-02-18 23:45:06
         compiled from "engine/templates/alexus/components/pageList/templates/default/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8446070775a8a100299e157-14719138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f15a41a3bc0acca9fb305e407dc3625a7f600d97' => 
    array (
      0 => 'engine/templates/alexus/components/pageList/templates/default/template.tpl',
      1 => 1518997062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8446070775a8a100299e157-14719138',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
    'pageItem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5a8a10029b7a02_52511164',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a8a10029b7a02_52511164')) {function content_5a8a10029b7a02_52511164($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['pageItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pageItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pageItem']->key => $_smarty_tpl->tpl_vars['pageItem']->value){
$_smarty_tpl->tpl_vars['pageItem']->_loop = true;
?>
    <div class="well">
    	<div class="media">
    		<?php if (isset($_smarty_tpl->tpl_vars['pageItem']->value['image'])){?>
		    <a class="pull-left" href="<?php echo $_smarty_tpl->tpl_vars['pageItem']->value['path'];?>
">
		    	<img class="media-object" width="100px" src="<?php echo $_smarty_tpl->tpl_vars['pageItem']->value['image'];?>
">
		    </a>
		    <?php }?>
		    <div class="media-body">
		    <h4 class="media-heading"><?php echo $_smarty_tpl->tpl_vars['pageItem']->value['title'];?>
</h4>
		    <?php echo $_smarty_tpl->tpl_vars['pageItem']->value['small_content'];?>

		    </div>
		</div>
		<div class="pull-right"><a href="<?php echo $_smarty_tpl->tpl_vars['pageItem']->value['path'];?>
" style="font-weight:bold;">Подробнее</a></div>
    </div>
<?php } ?><?php }} ?>