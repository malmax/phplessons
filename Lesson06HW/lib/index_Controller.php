<?php

class index_Controller extends AbstractController {
  public function __construct() {
    parent::__construct("index");

    $array = Model::getContent($this->type);
    $this->title = $array['title'];
    $this->content = $array['content'];
  }

  public function display() {
    $view = new index_View($this->title);
    $view->setValue('content', $this->content);
    $view->setValue('menu', array_reverse($this->getMenu()));

    $view->display();
  }
}

?>
