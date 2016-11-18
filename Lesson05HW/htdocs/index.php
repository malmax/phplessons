<?php
require_once('../config.php');
//класс page для хранения информации о страницах в файлах
require_once (LIB_DIR."/page.php");
// класс про игры
require_once (LIB_DIR."/game.php");
// класс про категории
require_once (LIB_DIR."/term.php");

//Если есть q, то разбиваем ее на аргументы
if (isset($_GET['q'])) {
  list($arg1,$arg2,$arg4) = explode("/",$_GET['q']);
}

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

  'category_id' => array(
    'template' => 'index',
    'TITLE' => 'Каталог',
    'HEADER' => 'Каталог магазина',
    'CONTENT' => implode("\n",array_map(function($item) {
      return "<div class=\"container-3\">".$item."</div>\n";
    },Term::showProductFromTerm((int)$arg2))),
    'PRE-HEADER' => ' ',
    'SIDE-BAR' => array('function'=>array('Term','getHierarchicalSideBar')),
    'BOTTOM' => ' ',
),
);

//по-умолчанию
$page_r = 'index';

if (isset($arg1)) {

  if(in_array($arg1, array_keys($vars))) {
    $page_r = $arg1;
    //свойства даннлой страницы
    $currentVars = $vars[$page_r];
    //если в свойствах задан template - используем его
    if (isset($currentVars['template'])) {
      $page_r = $currentVars['template'];
    }
  }
  else {
    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die();
  }
}
else {

  $currentVars = $vars[$page_r];
}

//print_r($currentVars);
echo render($page_r, $currentVars);

?>