<?php

class about_Controller extends AbstractController {
  public function __construct() {
    parent::__construct("about");
    $this->title = 'About';
    $this->content = 'This is content about content';
    if (isset($_GET['param1'])) {
      $this->changeContent();
    }
    $array = Model::getContent($this->type);
    $this->title = $array['title'];
    $this->content = $array['content'];
  }

  protected function changeContent() {
    $this->content = $_GET['param1'];
  }

  public function display() {
    $view = new View($this->title, 'index.tpl');
    $view->setValue('content', $this->content);
    $view->setValue('menu', array_reverse($this->getMenu()));

    return $view->render();
  }
}

?>
