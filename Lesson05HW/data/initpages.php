<?php
/**
 * Created by PhpStorm.
 * User: malma
 * Date: 14.11.2016
 * Time: 15:29
 */


require_once ("../config.php");
require_once ("../lib/page.php");
require_once ("../lib/game.php");
require_once ("../lib/term.php");

//Страница index

$index = new Page('index');
$index->title = 'Главная страница';
$index->header = 'Новинки магазина';
$index->content = 'Идет занятие';
$index->pre_header = array('template'=>array('baneronindex.tpl.html'));
$index->side_bar = array('function'=>array('Term','getHierarchicalSideBar'));
echo $index->savePageToFile();

// страница about
$index = new Page('about');
$index->title = 'О сайте';
$index->header = 'Контактная информация';
$index->content = array('template'=>array('contact.tpl.html','contactform.tpl.html','clear.tpl.html','map.tpl.html'));
$index->pre_header = "";
echo $index->savePageToFile();

// страница news
$index = new Page('news');
$index->title = 'Новости магазина';
$index->header = 'Контактная информация';
$index->content = array('template'=>array('contact.tpl.html','contactform.tpl.html','clear.tpl.html','map.tpl.html'));
$index->pre_header = "";
echo $index->savePageToFile();

/* ТРЕМИНЫ */
$terms = array(
  array('title'=>'Жанр игр','id'=>1,'parent'=>0),
    array('title'=>'Стрелялка','id'=>2,'parent'=>1),
    array('title'=>'RPG','id'=>3,'parent'=>1),
    array('title'=>'Спорт','id'=>4,'parent'=>1),
    array('title'=>'Драки','id'=>5,'parent'=>1),
    array('title'=>'Приключения','id'=>6,'parent'=>1),
    array('title'=>'Экшен','id'=>7,'parent'=>1),
    array('title'=>'Гонки','id'=>8,'parent'=>1),

  array('title'=>'Особенности','id'=>9,'parent'=>0),
    array('title'=>'новинка','id'=>10,'parent'=>9),
    array('title'=>'распродажа','id'=>11,'parent'=>9),
    array('title'=>'популярные','id'=>12,'parent'=>9),
    array('title'=>'предзаказ','id'=>13,'parent'=>9),
    array('title'=>'выбор редакции','id'=>14,'parent'=>9),
);

//обнуляем файл с терминами
file_put_contents(DATA_DIR . '/terms.csv',"");

foreach($terms as $value) {
  $term = new Term();
  $term->title = $value['title'];
  $term->parent = $value['parent'];
  $term->termId = $value['id'];
  $term->save();
}




//обнуляем файл с играми
file_put_contents(DATA_DIR . '/games.csv',"");
// игра 1
$game = new Game();
$game->title = "Fifa 17 для PS4";
$game->price = 3990;
$game->image = "./i/fifa-17-ps4_ps-4_cover.png";
$game->shortText = "FIFA 17, подарит игрокам по-настоящему реалистичную игру. В игровом процессе произошли большие изменения, теперь футболисты еще более реалистично двигаются, мыслят, физически контактируют с игроками соперника, исполняют стандартные положения и используют новые приемы во время атакующих действий, благодаря чему вы сможете контролировать каждый момент на футбольном поле.";
$game->save();

// игра 2
$game = new Game();
$game->title = "Battlefield 1 для PS4";
$game->price = 3490;
$game->image = "./i/battlefield-1-ps4_ps-4_cover.png";
$game->shortText = "Станьте свидетелем рассвета мировых войн в игре Battlefield 1. Откройте новый мир в захватывающей кампании или присоединяйтесь к масштабным многопользовательским битвам с поддержкой до 64 игроков.";
$game->save();

// игра 3
$game = new Game();
$game->title = "Skyrim Special Ed для PS4";
$game->price = 2790;
$game->image = "./i/elder-scrolls-v-skyrim-special-edition-ps4_ps-4_cover.png";
$game->shortText = "Самая популярная фэнтезийная RPG в истории Ремастеринг в потрясающем HD качестве для Xbox One и Playstation 4 Обладатель более 200 наград \"Игра года\" Включает в себя всю мощь модов ПК для консолей Также включает в себя все DLC (Dawnguard, Heathfire, Dragonborn)";
$game->save();

// игра 4
$game = new Game();
$game->title = "Uncharted 4: Путь вора (A Thief's End) для PS4";
$game->price = 1990;
$game->image = "./i/uncharted-4-thiefs-end-ps4_ps-4_cover.png";
$game->shortText = "Серия Uncharted знаменита своим кинематографическим подходом, и «Путь вора» продолжает эту традицию, обещая стать самым впечатляющим приключением на PlayStation 4. В арсенале Натана Дрейка появится веревка, крюк-кошка и прочая экипировка для скалолазания. Кроме того, впервые в истории серии Uncharted игроки смогут свободно управлять различными средствами передвижения. На новый уровень качества выйдет знаменитый мультиплеер Uncharted.";
$game->save();

// игра 5
$game = new Game();
$game->title = "Mafia 3 (Мафия III) для PS4";
$game->price = 1990;
$game->image = "./i/mafia-3-ps4_ps-4_cover.png";
$game->shortText = "Бонус за предзаказ: Набор «Семейный откат»: 3 эксклюзивных ствола и 3 автомобиля.";
$game->save();

// игра 6
$game = new Game();
$game->title = "Ведьмак 3: Дикая Охота (Witcher 3: Wild Hunt) для PS4";
$game->price = 2990;
$game->image = "./i/3-witcher-3-wild-hunt-goty-ps4_ps-4_cover.png";
$game->shortText = "У Меча Предназначения два острия. Одно из них – ты.";
$game->save();