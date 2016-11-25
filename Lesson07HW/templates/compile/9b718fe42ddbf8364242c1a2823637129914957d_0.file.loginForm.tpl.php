<?php
/* Smarty version 3.1.30, created on 2016-11-25 15:24:41
  from "C:\Users\malma\Documents\PHPLessons\tyre1\Lesson07HW\templates\loginForm.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58382d89350a67_27461883',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b718fe42ddbf8364242c1a2823637129914957d' => 
    array (
      0 => 'C:\\Users\\malma\\Documents\\PHPLessons\\tyre1\\Lesson07HW\\templates\\loginForm.tpl',
      1 => 1480074495,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58382d89350a67_27461883 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div style="color: #9B410E;">
    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

</div>
<form action="index.php?page=user&action=sendForm" method="post">
    <label for="login">Логин (логин admin для теста):</label>
    <input type="text" name="login" id="login">

    <label for="password">Пароль (пароль admin для теста):</label>
    <input type="text" name="password" id="password">

    <input type="submit" value="Войти">
</form>
<?php }
}
