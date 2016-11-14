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



// игра 1
$game = new Game();
$game->title = "Fifa 17 для PS4";
$game->price = 3990;
$game->image = "./i/fifa-17-ps4_ps-4_cover.png";
$game->shortText = "FIFA 17, подарит игрокам по-настоящему реалистичную игру. В игровом процессе произошли большие изменения, теперь футболисты еще более реалистично двигаются, мыслят, физически контактируют с игроками соперника, исполняют стандартные положения и используют новые приемы во время атакующих действий, благодаря чему вы сможете контролировать каждый момент на футбольном поле.";
$game->save();