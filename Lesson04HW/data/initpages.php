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

//Страница index

$index = new Page('index');
$index->title = 'Главная страница';
$index->header = 'Новость';
$index->content = 'Идет занятие';
$index->top_content = "<div class=\"container-9\">
            <img src=\"./i/cod_iw_pre_688x400.jpg\" alt=\"Call of Duty Preorder\"/>
        </div>
        <div class=\"container-3\">
            <img src=\"http://placehold.it/225x185\"/>
            <img src=\"http://placehold.it/225x185\"/>
        </div>
        <div class=\"clear\"></div>";
$index->side_bar = "<h3>Жанры игр</h3>
                        <ul>
                            <li><a href=\"#\">аркада</a></li>
                            <li><a href=\"#\">драки</a></li>
                            <li><a href=\"#\">симуляторы</a></li>
                            <li><a href=\"#\">спорт</a></li>
                            <li><a href=\"#\">гонки</a></li>
                            <li><a href=\"#\">приключения</a></li>
                            <li><a href=\"#\">стрелялки</a></li>
                            <li><a href=\"#\">стратегии</a></li>
                            <li><a href=\"#\">головоломки</a></li>
                        </ul>
                        <h3>Особенности</h3>
                        <ul>
                            <li><a href=\"#\">новинка</a></li>
                            <li><a href=\"#\">распродажа</a></li>
                            <li><a href=\"#\">популярные</a></li>
                            <li><a href=\"#\">предзаказ</a></li>
                            <li><a href=\"#\">выбор редакции</a></li>
                        </ul>
                        <h3>По цене</h3>
                        <ul>
                            <li><a href=\"#\">до 500р</a></li>
                            <li><a href=\"#\">от 501 до 1000р</a></li>
                            <li><a href=\"#\">от 1001 до 2000р</a></li>
                            <li><a href=\"#\">от 2001 до 3000р</a></li>
                            <li><a href=\"#\">свыше 3000р</a></li>
                        </ul>";
echo $index->savePageToFile();

// страница



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