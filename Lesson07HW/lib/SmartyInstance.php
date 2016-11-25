<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 25.11.2016
 * Time: 11:17
 */

require_once SMARTY_DIR . 'Smarty.class.php';

// Singleton
class SmartyInstance {

  static $_instance = null;

  private function __construct() {

  }

  private static function setSmarty() {
//    echo "Create Smarty Object";

    $smarty = new Smarty;
    $smarty->debugging = false;
    $smarty->caching = false;
    $smarty->cache_lifetime = 120;

    $smarty->template_dir = TPL_DIR;
    $smarty->compile_dir = TPL_DIR . "/compile";
    $smarty->config_dir = SMARTY_DIR;
    $smarty->cache_dir = '/web/www.example.com/guestbook/cache/';

    return $smarty;
  }

  protected function __clone() {

  }

  public static function getSmarty() {
    if(self::$_instance == null)
      self::$_instance = self::setSmarty();

    return self::$_instance;
}
}