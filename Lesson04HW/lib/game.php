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
  private $gameId, $maxId;
  private static $allGames = array(); //кэшируем вызов чтения всех объектов

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
    }
    else {
      $this->gameId = $this->getMaxId();
    }
  }

  //возвращает все игры из базы в виде массива
  //array(gameId => array(title =>"..",...), и т.д.
  private static function _loadAllGamesToArray() {
    /*
     * формат файла csv
     * gameId;title;price;image;shortText
     */
    $allGames = array();

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

    return $allGames;
  }

  //возвращаем конкретный объект из базы
  private function load($gameId = NULL) {

    //проверяем кэш
    if(!sizeof($this->allGames)) {
      $this->allGames = self::_loadAllGamesToArray();
    }
  }


  function save() {
    /*
     * формат файла csv
     * gameId;title;price;image;shortText
     */
    $toStr = implode(";", array(
      $this->gameId,
      str_replace(";", "", $this->title),
      $this->price,
      $this->image,
      str_replace(";", "", $this->shortText),
    ));
    $toStr = str_replace(array("\r\n", "\n"), "<br />", $toStr);

    //его будем записывать в файл games.csv
    $toFile = [];

    foreach (self::_loadAllGamesToArray() as $id=>$temp) {

      if ($id === $this->gameId) { //находим строчку с тем же gameId
        $toFile[] = $toStr;
        unset($toStr);
      }
      else {
        $toFile[] = implode(";",$temp);
      }
    }
    //если новая строчка
    if (!empty($toStr)) {
      $toFile[] = $toStr;
    }

    file_put_contents(DATA_DIR . '/games.csv', implode("\n", $toFile));

  }

//выводим массив всех объектов
  static function loadAllGames() {
    $objs = [];
    $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/games.csv')));
    $array = explode("\n", $array);

    foreach ($array as $row) {
      $temp = explode(";", $row);
      $objs[] = new Game($temp[0]);
    }

    return $objs;
  }

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