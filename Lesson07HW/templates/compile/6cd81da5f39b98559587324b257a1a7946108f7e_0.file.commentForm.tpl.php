<?php
/* Smarty version 3.1.30, created on 2016-11-25 15:23:16
  from "C:\Users\malma\Documents\PHPLessons\tyre1\Lesson07HW\templates\commentForm.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58382d34eca2e5_18175542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cd81da5f39b98559587324b257a1a7946108f7e' => 
    array (
      0 => 'C:\\Users\\malma\\Documents\\PHPLessons\\tyre1\\Lesson07HW\\templates\\commentForm.tpl',
      1 => 1480076000,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58382d34eca2e5_18175542 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div style="color: #9B410E;">
    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

</div>
<form action="index.php?page=index&action=sendForm" method="post">

    <label for="comment">Добавить комментарий:</label>
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>

    <input type="submit" value="Отправить">
</form>
<?php }
}
