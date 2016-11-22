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
   require SMARTY_DIR.'/Smarty.class.php';

   $this->smarty = new Smarty;

   $this->smarty->compile_check = true;
   $this->smarty->debugging = true;

   $this->setValue('title',$title);
 }

 public function setValue($name,$value) {
   $this->smarty->assign($name,$value);
 }

 public function display() {
   return  $this->smarty->display('index.tpl');
 }
}