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

    $this->load();

    if ($id != NULL) {
      if (in_array($id, array_keys($this->allGames))) {
        $this->title = $this->allGames[$id][1];
        $this->price = $this->allGames[$id][2];
        $this->image = $this->allGames[$id][3];
        $this->shortText = $this->allGames[$id][4];
        $this->gameId = $id;
      }
      else {
        $this->gameId = $this->maxId + 1;
      }

    }
    else {
      $this->gameId = $this->maxId + 1;
    }

  }


  private function load($gameId = NULL) {

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

    $this->maxId = 0;
    foreach ($array as $row) {
      $temp = explode(";", $row);
      $this->allGames[$temp[0]] = $temp;
      if ($temp[0] > $this->maxId) {
        $this->maxId = $temp[0];
      }
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

    $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/games.csv')));
    $array = explode("\n", $array);

    foreach ($array as $row) {
      $temp = explode(";", $row);

      if ($temp[0] == $this->gameId) { //находим строчку с тем же gameId
        $toFile[] = $toStr;
        unset($toStr);
      }
      else {
        $toFile[] = $row;
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