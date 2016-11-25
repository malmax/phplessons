<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 25.11.2016
 * Time: 12:32
 */

/**
 * CREATE TABLE IF NOT EXISTS `user` (
`userId` int(11) NOT NULL,
`login` varchar(50) NOT NULL,
`password` varchar(255) NOT NULL,
`name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 */
class ModelUser {
  public $userData, $userId, $name;

  function __construct($userId = null) {
    if(!$userId) {
      session_start();
      $userId = (int)$_SESSION['userId'];
    }

    if(!$userId)
      return false;

    $db = DB::getConnection();
    $query = mysqli_query($db,"SELECT * FROM user WHERE userId = '{$userId}' LIMIT 1");

    if(!($this->userData = mysqli_fetch_assoc($query)))
    {
      return false;
    }
    else {
      $this->userId = $this->userData['userId'];
      $this->name = $this->userData['name'];
    }
  }

  public static function checkLogin($login,$password) {
    $db = DB::getConnection();
    $query = mysqli_query($db,"SELECT userId FROM user WHERE login = '{$login}' AND password = '{$password}' LIMIT 1;");

    if($userId = @mysqli_fetch_array($query)[0])
      return $userId;
    else
      return false;
  }


}