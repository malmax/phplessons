<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 14.11.2016
 * Time: 15:52
 */
require_once("../config.php");

class Game {
  public $title, $price, $image, $shortText;
  private $gameId, $allGames, $maxId;

  function __construct($id = NULL) {

    //загружаем все игры в массив $allGames
    $this->load();


    //если задан id - присваиваем текущему объекту свойства из $allGames
    if ($id != NULL) {
      if (in_array($id, array_keys($this->allGames))) {
        $this->title = $this->allGames[$id][1];
        $this->price = $this->allGames[$id][2];
        $this->image = $this->allGames[$id][3];
        $this->shortText = $this->allGames[$id][4];
        $this->gameId = $id;
      }
      else {
        //итератор для следующей игры
        $this->gameId = $this->maxId + 1;
      }
    }
    else {
      //итератор для следующей игры
      $this->gameId = $this->maxId + 1;
    }

  }


  private function load($gameId = NULL) {

    //если уже были загружены
    if(sizeof($this->allGames) > 0)
      return $this->allGames;

    /*
     * загрузка данных о всех играх из файла
     * формат файла csv
     * gameId;title;price;image;shortText
     */

    if (!file_exists(DATA_DIR . '/games.csv')) {
      $file = fopen(DATA_DIR . '/games.csv', 'w');
      fwrite($file, " ");
      fclose($file);
    }

    $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/games.csv')));
    $array = explode("\n", $array);

    $this->maxId = 0;
    foreach ($array as $row) {
      $temp = explode(";", $row);
      $this->allGames[$temp[0]] = $temp;
      if ($temp[0] > $this->maxId) {
        $this->maxId = $temp[0];
      }
    }

    return $this->allGames;
  }


  function save() {
    /*
     * формат файла csv
     * gameId;title;price;image;shortText
     */
    //сериализация текущего объекта
    $toStr = implode(";", array(
      $this->gameId,
      str_replace(";", "", $this->title),
      $this->price,
      $this->image,
      str_replace(";", "", $this->shortText),
    ));
    //строчка для записи в файл. все объекты должны быть в однгу строчку. поэтому удаляем переносы строк
    $toStr = str_replace(array("\r\n", "\n"), "<br />", $toStr);

    //массив строк в конце запишем в файл games.csv
    $toFile = [];

    //получаем и превращаем в массив все строчки текущей базы
    $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/games.csv')));
    $array = explode("\n", $array);

    //обходим все строчки в текущей базе, чтобы обновить или добавить текущий объект
    foreach ($array as $row) {
      $temp = explode(";", $row);

      //находим строчку с тем же gameId
      if ($temp[0] == $this->gameId) {
        //если id игры равен $this->gameId - заменяем строчку на новую
        $toFile[] = $toStr;
        unset($toStr); //удаляем переменную, чтобы в дальнейшем понять, что данный объект был успешно записан
      }
      else {
        //если id игры не равен $this->gameId - оставляем строчку без изменений
        $toFile[] = $row;
      }
    }
    //если $toStr не была удалена - значит данного объекта не было в базе, добавляем в конец файла
    if (!empty($toStr)) {
      $toFile[] = $toStr;
    }

    //записываем
    file_put_contents(DATA_DIR . '/games.csv', implode("\n", $toFile));

  }

//выводим массив всех объектов
  static function loadAllGames() {
    $objs = [];
    //получаем и превращаем в массив все строчки текущей базы
    $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/games.csv')));
    $array = explode("\n", $array);

    //обходим все строчки в базе и создаем по каждой строчке - объект Game
    foreach ($array as $row) {
      $temp = explode(";", $row);
      //записываем каждый объект в массив
      $objs[] = new Game($temp[0]);
    }

    //возвращаем массив объектов
    return $objs;
  }

  //текстовое представление объекта
  function __toString() {
    return "<article class=\"product\">
                            <header>
                                <div>
                                    <img src=\"$this->image\" alt=\"\" />
                                </div>
                                <div>
                                    <h3><a href=\"./index.php?q=game/$this->gameId\">$this->title</a></h3>
                                </div>
                            </header>
                            <div class=\"price inline-block\">{$this->price}р</div>
                            <div class=\"buybutton inline-block\">
                                <input type=\"button\" name=\"{$this->gameId}\" value=\"купить\" />
                            </div>

                        </article>";

  }

}