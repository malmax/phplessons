<?php
// Малахов Максим
// Сделать небольшую веб-страницу, в которой заголовок задаётся из заранее объявленной
// переменной, а пользователю, в зависимости от времени суток, отображается приветствие: добрый
// день, доброе утро, добрый вечер, доброй ночи.

$username = "Пользователь1";

date_default_timezone_set('Europe/Moscow');
$hour = date("G");
if ($hour < 12) {
    $hello = "Доброе утро";
} elseif ($hour > 17) {
    $hello = "Добрый вечер";
} else {
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
            <?=$hello?>, <?=$username?>
        </h1>
    </header>

    <section style="width:960px;margin:0 auto;">
        <article class="">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas impedit, dolor cumque neque suscipit, tempora quasi perspiciatis ducimus numquam nemo accusantium sit accusamus in modi asperiores fuga. Iure asperiores ea ullam similique nobis dolores
            facere magnam libero eos voluptatem et fuga velit sint obcaecati natus ut tempora consectetur accusantium laboriosam, praesentium cum commodi voluptates exercitationem fugit. Natus quisquam sint ex, mollitia tenetur recusandae ipsa hic labore
            optio cumque at facere voluptatum ipsam voluptas? Velit saepe eveniet facere totam culpa sapiente, numquam iure id omnis reiciendis, nulla cumque cum nobis, voluptatem enim. Odit ducimus fuga quam. Labore fugiat repellat saepe dolorem.
        </article>
    </section>
</body>

</html>
