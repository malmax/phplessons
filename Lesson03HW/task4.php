<?php
/**
 * Created by PhpStorm.
 * User: Малахов Максим
 * Date: 10.11.2016
 * Time: 13:15
 */

//В имеющемся шаблоне сайта замените статичное меню (ul - li) на генерируемое через PHP. Необходимо представить
// пункты меню как элементы массива и вывести их циклом. Подумайте, как можно реализовать меню с вложенными подменю?
// Попробуйте его реализовать.

$menu = Array(
  "Главная" => "#",
  "Меню1" => "#",
  "DropDown Menu" => Array(
    "Menu2" => "#",
    "Menu3" => "#",
  ),
);
$username = "Пользователь1";

date_default_timezone_set('Europe/Moscow');
$hour = date("G");
if ($hour < 12) {
  $hello = "Доброе утро";
}
elseif ($hour > 17) {
  $hello = "Добрый вечер";
}
else {
  $hello = "Добрый день";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
<header>
  <h1>
    <?= $hello ?>, <?= $username ?>
  </h1>

  <nav>
    <ul>
      <?php
      foreach ($menu as $name => $value) {
        echo "<li>";

        if (is_array($value)) {
          echo "<a href='#'>$name</a>";
          echo "<ul>";
          foreach ($value as $name2 => $value2) {
            echo "<li>";
            echo "<a href='$value2'>$name2</a>";
            echo "</li>";
          }
          echo "</ul>";
        }
        else {
          echo "<a href='$value'>$name</a>";
        }
        echo "</li>";
      }
      ?>
    </ul>
  </nav>
</header>

<section style="width:960px;margin:0 auto;">
  <article class="">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas impedit,
    dolor cumque neque suscipit, tempora quasi perspiciatis ducimus numquam nemo
    accusantium sit accusamus in modi asperiores fuga. Iure asperiores ea ullam
    similique nobis dolores
    facere magnam libero eos voluptatem et fuga velit sint obcaecati natus ut
    tempora consectetur accusantium laboriosam, praesentium cum commodi
    voluptates exercitationem fugit. Natus quisquam sint ex, mollitia tenetur
    recusandae ipsa hic labore
    optio cumque at facere voluptatum ipsam voluptas? Velit saepe eveniet facere
    totam culpa sapiente, numquam iure id omnis reiciendis, nulla cumque cum
    nobis, voluptatem enim. Odit ducimus fuga quam. Labore fugiat repellat saepe
    dolorem.
  </article>
</section>
</body>

</html>
