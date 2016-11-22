<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 22.11.2016
 * Time: 15:31
 */
class Model {
  static function getContent($type) {
    switch($type) {
      case 'index':
        $title = 'Hello';
        $content = 'Это основная страница сайта';
        break;
      case 'about':
        $title = 'About';
        $content = 'This is content about content';
        break;
      case 'catalog':
        $title = 'Каталог';
        $content = 'Здесь список товаров';
        break;
    }
    return [
      'title' => $title,
      'content' => $content
    ];
  }
}