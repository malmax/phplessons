<?php
/* Smarty version 3.1.30, created on 2016-11-25 15:28:11
  from "C:\Users\malma\Documents\PHPLessons\tyre1\Lesson07HW\templates\comment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58382e5b83b5f1_85210753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '611fbe57cc61c18f5846d8e4caa40b143749afb0' => 
    array (
      0 => 'C:\\Users\\malma\\Documents\\PHPLessons\\tyre1\\Lesson07HW\\templates\\comment.tpl',
      1 => 1480076000,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58382e5b83b5f1_85210753 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div>
    <div>Автор: <?php echo $_smarty_tpl->tpl_vars['author']->value;?>
</div>
    <div>Дата публикации: <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</div>
    <div><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
</div>
<hr><?php }
}
