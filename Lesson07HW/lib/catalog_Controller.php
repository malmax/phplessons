<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 22.11.2016
 * Time: 13:54
 */
class catalog_Controller extends AbstractController {

  function __construct() {
    //вызываем родительский конструктор
    parent::__construct("catalog");

    $array = Model::getContent($this->type);
    $this->title = $array['title'];
    $this->content = $array['content'];
  }

  function display() {
    $view = new View($this->title, 'index.tpl');
    $view->setValue('content', $this->content);
    $view->setValue('menu', array_reverse($this->getMenu()));

    return $view->render();
  }
}