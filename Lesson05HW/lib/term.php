<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 17.11.2016
 * Time: 19:36
 */
class term {

  public $termId = 1; //термины начинаются с 1
  public $title = "";
  public $parent = 0; //родитель по-умолчанию = 0

  function __construct($id = NULL) {

    if ($id != NULL) {
      //загружаем объект
      if ($obj = $this->load($id)) {
        $this->title = $obj->title;
        $this->parent = $obj->parent;
        $this->termId = $obj->termId;

        return true;
      }
    }

    $this->termId = $this->getMaxId();


  }

  //Хелпер для нахождения максимального итератора
  private function getMaxId() {
    $maxId = 1; //базовое значение

    $allGames = self::_loadAllTermsToArray();
    foreach ($allGames as $key => $value) {
      if ($key > $maxId) {
        $maxId = $key;
      }
    }

    return $maxId;
  }

  //возвращает все термины из базы в виде массива
  //array(termId => array(title =>"..",...), и т.д.
  private static function _loadAllTermsToArray($recache = FALSE) {

    //кэшируем вызов чтения всех объектов
    static $allTerms = array();

    if ((!sizeof($allTerms)) || $recache) {
      /*
      * формат файла csv
      * termId;title;parent
      */

      if (!file_exists(DATA_DIR . '/terms.csv')) {
        $file = fopen(DATA_DIR . '/terms.csv', 'w');
        fwrite($file, " ");
        fclose($file);
      }

      $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/terms.csv')));
      $array = explode("\n", $array);

      foreach ($array as $row) {
        $temp = explode(";", $row);
        $allTerms[$temp[0]] = $temp;
      }
    }

    return $allTerms;
  }

  public static function getHierarchicalArray() {
    $allTerms = self::_loadAllTermsToArray();
    $newArray = array();
    foreach($allTerms as $value) {
      $newArray[$value['parent']][$value['title']] = new Term($value['termId']);
    }
    return(print_r($newArray,true));
 }

  //возвращаем конкретный объект из базы
  public function load($termId) {

    //получаем все объекты игра из базы
    $allTerms = self::_loadAllTermsToArray();

    if (in_array($termId, array_keys($allTerms))) {
      //возвращаем объект
      $obj = new stdClass();
      $obj->title = $allTerms[$termId][1];
      $obj->parent = $allTerms[$termId][2];
      $obj->termId = $allTerms[$termId][0];

      return $obj;
    }
    else {
      return FALSE;
    }
  }

  function save() {
    /*
     * формат файла csv
     * gameId;title;parent
     */
    //сериализация текущего объекта
    $toStr = implode(";", array(
      $this->termId,
      str_replace(";", "", $this->title),
      (int)$this->parent,
    ));
    //строчка для записи в файл. все объекты должны быть в одну строчку. поэтому удаляем переносы строк
    $toStr = str_replace(array("\r\n", "\n"), "<br />", $toStr);

    //массив строк в конце запишем в файл terms.csv
    $toFile = array();

    foreach (self::_loadAllTermsToArray() as $id => $temp) {

      //находим строчку с тем же termId
      if ($id === $this->termId) {
        //если id игры равен $this->termId - заменяем строчку на новую
        $toFile[] = $toStr;
        unset($toStr); //удаляем переменную, чтобы в дальнейшем понять, что данный объект был успешно записан
      }
      else {
        //если id игры не равен $this->termId - оставляем строчку без изменений
        $toFile[] = implode(";", $temp);
      }
    }
    //если $toStr не была удалена - значит данного объекта не было в базе, добавляем в конец файла
    if (!empty($toStr)) {
      $toFile[] = $toStr;
    }

    //записываем
    file_put_contents(DATA_DIR . '/terms.csv', implode("\n", $toFile));

    //сбрасываем кэш
    self::_loadAllTermsToArray(TRUE);
  }

//выводим массив всех объектов
  static function loadAllTerms() {
    $objs = [];

    //обходим все строчки в базе и создаем по каждой строчке - объект Term
    foreach (self::_loadAllTermsToArray() as $id=>$arr) {
      //записываем каждый объект в массив
      $objs[] = new Term($id);
    }

    //возвращаем массив объектов
    return $objs;
  }

  //текстовое представление объекта
  function __toString() {
    return "<a href=./index.php?q=term/".$this->termId.">".$this->title."</a>\n";

  }

}