<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 22.11.2016
 * Time: 13:56
 */

abstract class AbstractView  {
  private $smarty;

 function __construct($title) {
   require SMARTY_DIR.'Smarty.class.php';

   $this->smarty = new Smarty;

   $this->smarty->template_dir = TPL_DIR;
   $this->smarty->compile_dir = TPL_DIR."/compile";
   $this->smarty->config_dir = SMARTY_DIR;
   //$this->smarty->cache_dir = '/web/www.example.com/guestbook/cache/';

   $this->smarty->compile_check = true;
   $this->smarty->debugging = false;

   $this->setValue('title',$title);
 }

 public function setValue($name,$value) {
   $this->smarty->assign($name,$value);
 }

 public function display() {
   $this->smarty->display('index.tpl');
 }
}