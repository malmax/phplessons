<?php

/**
 * Created by PhpStorm.
 * User: malma
 * Date: 25.11.2016
 * Time: 14:49
 */

/**
 * Class ModelComment
 * CREATE TABLE `phplessons`.`comments` ( `id` INT NOT NULL AUTO_INCREMENT , `comment` TEXT NOT NULL , `authorId` INT NOT NULL , `datetime` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 */
class ModelComment {
  public $status;

  function __construct($message) {

    if($_SESSION['commenttime'] < mktime()) {
      $user = new ModelUser();
      if($user->userId) { //если пользователь есть
        $db = DB::getConnection();
        if (mysqli_query($db, "INSERT INTO `phplessons`.`comments` (`id`, `comment`, `authorId`, `datetime`) VALUES (NULL, '{$message}', '{$user->userId}', NOW())")) {
          $this->status = "Удачно добавили комментарий";

          //коммментарии возможны раз в минуту
          $_SESSION['commenttime'] = mktime() + 60;
        }
        else {
          $this->status = mysqli_error($db);
        }
      }
    }
    else
    {
      $this->status = 'Ограничение на один комментарий в минуту';

    }
  }

  static function getAllComments() {
    $comments = array();

    $db = DB::getConnection();
    $query = mysqli_query($db,"SELECT * FROM comments WHERE 1 ORDER BY `id` DESC");
    while($temp = mysqli_fetch_assoc($query)) {
      $comments[] = $temp;
    }
    return $comments;
  }
}