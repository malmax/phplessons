<?php
require_once('../config.php');

$vars = array(
    'index' =>
    array(
        'TITLE' => 'Главная страница',
        'HEADER' => 'Новость',
        'CONTENT' => 'Идет занятие'
    ),
    'about' =>
    array(
        'TITLE1' => 'О сайте',
        'HEADER1' => 'Создатели',
        'CONTENT1' => 'Команда программистов',
        'DIRECTORNAME1' => 'Имя директора'
    ),
);

//echo render('index');

$page_r = 'index';

echo render($page_r, $vars[$page_r]);

?>