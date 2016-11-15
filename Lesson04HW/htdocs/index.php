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

  'about' =>array_merge(Page::loadPageFromFile('about')->returnArray(), array(
      'template' => 'index'
    )),

  'news' =>
    array(
      'template' => 'index',
      'TITLE' => 'Новости',
      'HEADER' => 'Главные новости магазина',
      'CONTENT' => 'Поздравляем, наш магазин игр открылся. Добро пожаловать',
      'PRE-HEADER' => ' ',
      'SIDE-BAR' => ' ',
      'BOTTOM' => ' ',
    ),
  'catalog' => array(
    'template' => 'index',
    'TITLE' => 'Каталог',
    'HEADER' => 'Каталог магазина',
    'CONTENT' => implode("\n",array_map(function($item) {
      return "<div class=\"container-3\">".$item."</div>\n";
    },Game::loadAllGames())),
    'PRE-HEADER' => ' ',
    'SIDE-BAR' => ' ',
    'BOTTOM' => ' ',
),
);

//echo render('index');
if (isset($_GET['q']) && in_array($_GET['q'], array_keys($vars))) {
  $page_r = $_GET['q'];
  //свойства даннлой страницы
  $currentVars = $vars[$page_r];
  //если в свойствах задан template - используем его
  if(isset($currentVars['template']))
    $page_r = $currentVars['template'];
}
else {
  $page_r = 'index';
  $currentVars = $vars[$page_r];
}


echo render($page_r, $currentVars);

?>