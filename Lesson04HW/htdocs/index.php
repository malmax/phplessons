<?php
require_once('../config.php');
//класс page для хранения информации о страницах в файлах
require_once (LIB_DIR."/page.php");
// класс про игры
require_once (LIB_DIR."/game.php");

$vars = array(
  'index' => array_merge(Page::loadPageFromFile('index')->returnArray(), array(
    'SOME-ATR-NOT-IN-CLASS' => 'some text',
    //Переопределим CONTENT
    'CONTENT' => implode("\n",array_map(function($item) {
      return "<div class=\"container-3\">".$item."</div>\n";
    },Game::loadAllGames())),
  )),

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