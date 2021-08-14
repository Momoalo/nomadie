<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/User.php');
// require_once(ROOT_PATH .'/Models/Insert.php');

class UserController {
  private $User; //Userモデル
  private $Post;

  public function __construct() {
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;
    // モデルオブジェクトの生成
    $this->User = new User();
    // $this->Validation = new Validation();
    // $this->Post = new Post();

  }

  public function index() {
    if(isset($this->request['get']['page'])) {
      $page = $this->request['get']['page'];
    }
    $posts = $this->Post->findPosts();
    $posts_count = $this->Post->countAll();
    $params = [
      'posts' => $posts,
      'pages' => $posts_count / 6
    ];
    return $params;

    // $users = $this->User->findAll();
    // $params = [
    //   'users' => $users,
    // ];
    // return $params;
  }

  public function insert() {
      $insert = $this->Insert->inserted();
  }

  public function newuser(){
      $contact = $this->Validation->signUp();
  }

}
 ?>
