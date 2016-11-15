<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 14.11.2016
 * Time: 15:04
 */
require_once("../config.php");

class Page {

  public $title, $header, $side_bar, $bottom;
  public $content, $pre_header; //могут быть массивом с указанием внешнего файла с контентом
  private $pageName;

  function __construct($pageName) {
    if (empty($pageName)) {
      die("Не задана страница");
    }

    if (file_exists(DATA_DIR . '/' . $pageName . '.dat')) {
      $obj = Page::loadPageFromFile($pageName);

      $this->title = $obj->title;
      $this->header = $obj->header;
      $this->content = $obj->content;
      $this->pre_header = $obj->pre_header;
      $this->side_bar = $obj->side_bar;
      $this->bottom = $obj->bottom;
      //TODO:как сразу присвоить все свойства массива текущей копии класса?
    }

    $this->pageName = $pageName;
  }

  static function loadPageFromFile($pageName = 'index') {
    if (file_exists(DATA_DIR . '/' . $pageName . '.dat')) {
      $filecontent = file_get_contents(DATA_DIR . '/' . $pageName . '.dat');
      return unserialize($filecontent);
    }
  }

  function savePageToFile() {
    $file = fopen(DATA_DIR . '/' . $this->pageName . '.dat', 'w');
    fwrite($file, serialize($this));
    fclose($file);

    return $this->title . " сохранен в файл " . DATA_DIR . '/' . $this->pageName . '.dat<br />';
  }

  function returnArray() {
    return array(
      'TITLE' => $this->title ? $this->title : " ",
      'HEADER' => $this->header ? $this->header : " ",
      'CONTENT' => $this->content ? $this->content : " ",
      'PRE-HEADER' => $this->pre_header ? $this->pre_header : " ",
      'SIDE-BAR' => $this->side_bar ? $this->side_bar : " ",
      'BOTTOM' => $this->bottom ? $this->bottom : " ",
    );
  }
}

