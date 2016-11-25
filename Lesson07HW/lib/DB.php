<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 25.11.2016
 * Time: 12:36
 */
class DB {
  static $_dbConnection = null;

  private function __construct() {

  }

  private static function setDBConnection() {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_name = 'phplessons';
    $db_password = '';

    self::$_dbConnection = mysqli_connect($db_host,$db_user,$db_password,$db_name);
  }

  static function getConnection() {
    if(self::$_dbConnection == null) {
      self::setDBConnection();
    }
    return self::$_dbConnection;
  }
}