<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 14.11.2016
 * Time: 15:04
 */
require_once("../config.php");

class Page {

  public $title, $header, $content, $top_content, $side_bar;
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
      $this->top_content = $obj->top_content;
      $this->side_bar = $obj->side_bar;
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
    fclose();

    return $this . " сохранен в файл " . DATA_DIR . '/' . $this->pageName . '.dat';
  }

  function returnArray() {
    return array(
      'TITLE' => $this->title,
      'HEADER' => $this->header,
      'CONTENT' => $this->content,
      'TOP-CONTENT' => $this->top_content,
      'SIDE-BAR' => $this->side_bar,
    );
  }
}

