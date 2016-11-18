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
  public $gameId;

  function __construct($id = NULL) {

    if ($id != NULL) {
      //загружаем объект
      if ($obj = $this->load($id)) {
        $this->title = $obj->title;
        $this->price = $obj->price;
        $this->image = $obj->image;
        $this->shortText = $obj->shortText;
        $this->gameId = $obj->gameId;
      }
      else {
        return FALSE; //если id нет - возвращаем false
      }
    }
    else {
      $this->gameId = $this->getMaxId();
    }

  }

  //Хелпер для нахождения максимального итератора
  private function getMaxId() {
    $maxId = 0;
    $allGames = self::_loadAllGamesToArray();
    foreach ($allGames as $key => $value) {
      if ($key > $maxId) {
        $maxId = $key;
      }
    }

    return $maxId + 1;
  }

  //возвращает все игры из базы в виде массива
  //array(gameId => array(title =>"..",...), и т.д.
  private static function _loadAllGamesToArray($recache = FALSE) {

    //кэшируем вызов чтения всех объектов
    static $allGames = array();

    if ((!sizeof($allGames)) || $recache) {
      /*
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

      foreach ($array as $row) {
        $temp = explode(";", $row);
        $allGames[$temp[0]] = $temp;
      }
    }

    return $allGames;
  }


  //возвращаем конкретный объект из базы
  public function load($gameId) {

    //получаем все объекты игра из базы
    $allGames = self::_loadAllGamesToArray();

    if (in_array($gameId, array_keys($allGames))) {
      //возвращаем объект
      $obj = new stdClass();
      $obj->title = $allGames[$gameId][1];
      $obj->price = $allGames[$gameId][2];
      $obj->image = $allGames[$gameId][3];
      $obj->shortText = $allGames[$gameId][4];
      $obj->gameId = $allGames[$gameId][0];

      return $obj;
    }
    else {
      return FALSE;
    }
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
    $toFile = array();

    foreach (self::_loadAllGamesToArray() as $id => $temp) {

      //находим строчку с тем же gameId
      if ($id === $this->gameId) {
        //если id игры равен $this->gameId - заменяем строчку на новую
        $toFile[] = $toStr;
        unset($toStr); //удаляем переменную, чтобы в дальнейшем понять, что данный объект был успешно записан
      }
      else {
        //если id игры не равен $this->gameId - оставляем строчку без изменений
        $toFile[] = implode(";", $temp);
      }
    }
    //если $toStr не была удалена - значит данного объекта не было в базе, добавляем в конец файла
    if (!empty($toStr)) {
      $toFile[] = $toStr;
    }

    //записываем
    file_put_contents(DATA_DIR . '/games.csv', implode("\n", $toFile));

    //сбрасываем кэш
    self::_loadAllGamesToArray(TRUE);
  }

//выводим массив всех объектов
  static function loadAllGames() {
    $objs = [];

    //обходим все строчки в базе и создаем по каждой строчке - объект Game
    foreach (self::_loadAllGamesToArray() as $id => $arr) {
      //записываем каждый объект в массив
      $objs[] = new Game($id);
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