<?php
require_once('../config.php');

$vars = array(
  'index' =>
    array(
      'TITLE' => 'Главная страница',
      'HEADER' => 'Новость',
      'CONTENT' => 'Идет занятие',
      'menu' => get_menu(),
    ),
  'about' =>
    array(
      'TITLE1' => 'О сайте',
      'HEADER1' => 'Создатели',
      'CONTENT1' => 'Команда программистов',
      'DIRECTORNAME1' => 'Имя директора',
      'menu' => get_menu(),
    ),
  'news' =>
    array(
      'TITLE' => 'Новости',
      'HEADER' => 'Главные новости магазина',
      'CONTENT' => 'Поздравляем, наш магазин игр открылся. Добро пожаловать',
      'menu' => get_menu(),
    ),
);

//echo render('index');
if (isset($_GET['q']) && in_array($_GET['q'], array_keys($vars))) {
  $page_r = $_GET['q'];
}
else {
  $page_r = 'index';
}


echo render($page_r, $vars[$page_r]);

?>