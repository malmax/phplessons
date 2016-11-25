<?php

class User_Controller extends AbstractController {
  private $out = "";
  public $userId = null;

  public function __construct() {
    parent::__construct("user");

    $array = Model::getContent($this->type);
    $this->title = $array['title'];
    $this->content = $array['content'];


  }

  private function getUser() {

//    $array = ModelUser::checkLogin($this->type);
//    $this->title = $array['title'];
//    $this->content = $array['content'];



  }
  private function login() {
    session_start();
    if($userId = $_SESSION['userId']) {
      $this->userId = $userId;
    }
  }

  private function showLoginForm($error = "") {
    $formView = new View($this->title,'loginForm.tpl');
    $formView->setValue('error',$error);
    return $formView->render();
  }

  private function checkLoginForm() {

  }

  public function display() {

    //если пользователь уже залогинен - устанавливаем userId
    $this->login();

    $view = new View($this->title, 'index.tpl');

    //Actions
    switch ($_GET['action']) {
      case sendForm: //отправка формы
        $login = trim($_POST['login']);
        $password = md5(trim($_POST['password']));

        //проверка формы
        if($this->userId = ModelUser::checkLogin($login,$password)) {
          $_SESSION['userId'] = $this->userId; // сохраняем в сессию
          $view->setValue('content', "Вы удачно залогинены. Время жизни сессии - 1 минута");
        }
        else {

          //выводим форму
          $this->content = $this->showLoginForm("Не найден пользователь с таким логином и паролем");
          $view->setValue('content', $this->content);
        }
        break;

      case 'logout':
        unset($_SESSION['userId']);
        $this->userId = null;
      default:
        //выводим форму
        $this->content = $this->showLoginForm();
        $view->setValue('content', $this->content);

        break;
    }

    if($this->userId)  {
      $user = new ModelUser($this->userId);
      $this->content = "";
      foreach ($user->userData as $key=>$value) {
        $this->content .= "<div>{$key}: {$value}</div>";
      }
      $this->content .= "<div><a href='./index.php?page=user&action=logout'>выйти из профиля</a></div>";
      $view->setValue('content', $this->content);
    }


    $view->setValue('menu', array_reverse($this->getMenu()));
    $this->out = $view->render();

    return $this->out;
  }
}

?>
