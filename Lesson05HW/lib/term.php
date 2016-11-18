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

    return $maxId+1;
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

  public static function getHierarchicalSideBar() {
    $allTerms = self::_loadAllTermsToArray();
    $out[] = "<sidebar>";
    foreach($allTerms as $value) {
      //если корень
      if(!$value[2]) {
        if(sizeof($out > 1))
          $out[]= "</ul>";
        $out[] = "<h3>".$value[1]."</h3> <ul>";
      }
      else {
        $term = new Term($value[0]);
        $out[]="<li>".$term."</li>";
      }
    }

    $out[] = "</ul></sidebar>";
    return implode("\n",$out);
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

  public static function addTermToProduct($productId,$termId) {
    $terms = array(); //можно передать сразу массив ключей
    //проверка значений
    if($obj=new Game($productId)) {
      if(!is_array($termId)) {
        $termId = array($termId);
      }
      //обходим все термины переданные как второй параметр
      foreach($termId as $t) {
        if($temp = new Term($t)) { //проверяем на существование термина и загружаем его
          $terms[] = $temp; //добавляем объект-термин в массив
        }
        else {
          return false;
        }
      }
    }
    else {
      return false;
    }

    //обходим все термины, которые надо добавить в цикле
    $existingTerms = self::loadTermDataArray();
    foreach($terms as $term) {
      if(in_array($obj->gameId,$existingTerms[$term->$termId])) {
        //уже есть данный термин у продукта
        continue;
      }
      $existingTerms[$term->$termId][] = $obj->gameId;
    }

    self::saveTermDataFromArray($existingTerms);

  }

  private static function saveTermDataFromArray($array) {
    /*
      * формат файла csv
      * termId;productId
      */

    if (!file_exists(DATA_DIR . '/termdata.csv')) {
      $file = fopen(DATA_DIR . '/termdata.csv', 'w');
      fwrite($file, " ");
      fclose($file);
    }

    if(sizeof($array)) {
      //записываем
      file_put_contents(DATA_DIR . '/termdata.csv', implode("\n", $array));
    }

  }

  //возвращает все привязанные термины из базы в виде массива
  //array(termId => array(productId1, productId2,...), и т.д.
  private static function loadTermDataArray($recache = false) {
    static $termData = array();

    if ((!sizeof($termData)) || $recache) {
      /*
      * формат файла csv
      * termId;productId
      */

      if (!file_exists(DATA_DIR . '/termdata.csv')) {
        $file = fopen(DATA_DIR . '/termdata.csv', 'w');
        fwrite($file, " ");
        fclose($file);
      }

      $array = str_replace("\r", "", trim(file_get_contents(DATA_DIR . '/termdata.csv')));
      $array = explode("\n", $array);

      foreach ($array as $row) {
        $temp = explode(";", $row);
        $termData[$temp[0]][] = $temp[1];
      }
    }

    return $termData;
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
    return "<a href=./index.php?q=category_id/".$this->termId.">".$this->title."</a>\n";

  }

}