<?php

class index_Controller extends AbstractController {
  public function __construct() {
    parent::__construct("index");

    $array = Model::getContent($this->type);
    $this->title = $array['title'];
    $this->content = $array['content'];
  }

  private function showCommentForm() {
    $formView = new View($this->title,'commentForm.tpl');
    $formView->setValue('error',$_SESSION['commentFormMessage']);
    return $formView->render();
  }

  private function showComment($comment) {
    $author = new ModelUser($comment['authorId']);
    $commentView = new View($this->title,'comment.tpl');

    $commentView->setValue('author',$author->name);
    $commentView->setValue('date',$comment['datetime']);
    $commentView->setValue('message',$comment['comment']);
    return $commentView->render();
  }

  public function display() {
    $view = new View($this->title, 'index.tpl');
    $user = new ModelUser();

    switch ($_GET['action']) {

      case 'sendForm':
        $message = htmlspecialchars(trim($_POST['comment']));
        $comment = new ModelComment($message);
        $_SESSION['commentFormMessage'] = $comment->status;
        header("Location: ./index.php");
        exit();
        break;
    }

    //выводим комменты
    if(!$user->userId) {
      $this->content = "Отправлять сообщения может только авторизованный пользователь  <a href='./index.php?page=user'>авторизоваться</a>";
    }
    $this->content = $this->showCommentForm();
    foreach (ModelComment::getAllComments() as $comment) {
      $this->content .= $this->showComment($comment);
    }


    $view->setValue('content', $this->content);

    $view->setValue('menu', array_reverse($this->getMenu()));
    return $view->render();
  }

}

?>
