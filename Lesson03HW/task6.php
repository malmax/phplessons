<?php
/**
 * Created by PhpStorm.
 * User: Малахов Максим
 * Date: 10.11.2016
 * Time: 13:56
 */
//●	Повторите третье задание, но выводите на экран только города, начинающиеся с буквы «К».

$regions = [];
$fileContent = file_get_contents('regions.csv');
$fileContent = str_replace("\r","",$fileContent);
$rows = explode("\n",$fileContent);
foreach($rows as $value) {
  $value = explode(';',$value);
  $regions[$value[2]][] = $value[0];
}

// Вывод массива регионов
foreach ($regions as $region => $value) {
  echo "$region: <br />\n";
  foreach($value as $city) {
    if(strpos($city,"К") === 0)
      echo "-$city <br />\n";
  }
}