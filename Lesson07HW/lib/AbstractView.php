<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 22.11.2016
 * Time: 13:56
 */
abstract class AbstractView {
  private $smarty;
  private $templateFile;

  function __construct($title, $template) {
    $this->smarty = SmartyInstance::getSmarty();
    $this->templateFile = $template;
    $this->setValue('title', $title);
  }

  public function setValue($name, $value) {
    $this->smarty->assign($name, $value);
  }

  public function render() {
    return $this->smarty->fetch($this->templateFile);
  }
}