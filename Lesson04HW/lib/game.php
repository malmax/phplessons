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
        $this->id = $id;
      }
      else {
        $this->id = $this->maxId + 1;
      }

    }
    else {
      $this->id = $this->maxId + 1;
    }
  }


  private function load($gameId = NULL) {

    /*
     * формат файла csv
     * id;title;price;image;shortText
     */

    if (!file_exists(DATA_DIR . '/games.csv')) {
      $file = fopen(DATA_DIR . '/games.csv', 'w');
      fwrite($file, " ");
      fclose();
    }

    $handle = fopen(DATA_DIR . '/games.csv', "r");
    if ($handle) {

      $this->maxId = 0;
      while (($buffer = fgets($handle, 4096)) !== FALSE) {
        $temp = explode(";", $buffer);
        $this->gameId[$temp[0]] = $temp;
        if ($temp[0] > $this->maxId) {
          $this->maxId = $temp[0];
        }
      }

      fclose($handle);
    }
    function save() {
      /*
       * формат файла csv
       * id;title;price;image;shortText
       */
      $toStr = implode(";", array(
        $this->id,
        $this->price,
        $this->image,
        $this->shortText
      ));
      $toStr = str_replace(array("\r\n", "\n"), "<br />", $toStr);

      $toFile = [];

      $handle = fopen(DATA_DIR . '/games.csv', "w+");
      if ($handle) {

        while (($buffer = fgets($handle, 4096)) !== FALSE) {
          $temp = explode(";", $buffer);
          if ($temp[0] === $this->id) { //заменяем старую строчку на новую
            $toFile[] = $toStr;
            $toStr = "";
          }
          else {
            $toFile[] = $buffer;
          }
        }
        //если новая строчка
        if ($toStr) {
          $toFile[] = $toStr;
        }

        fwrite($handle, implode("\r\n", $toFile));
      }
    }

    fclose($handle);
  }

}