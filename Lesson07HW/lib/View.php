<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 22.11.2016
 * Time: 14:12
 */
class View extends AbstractView {
  function __construct($title, $template = 'index.tpl') {
    parent::__construct($title, $template);
  }
}