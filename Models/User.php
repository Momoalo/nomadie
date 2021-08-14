<?php
  require_once(ROOT_PATH .'/Models/Db.php');

  class User extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    public function findAll():Array {
      try {
        $sql = 'SELECT * FROM nomadie';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
        echo 'アクセス成功';
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません！' . $e->getMessage();
      }
    }

    // public function findPosts($page = 0):Array {
    //   $sql = "SELECT * FROM posts";
    //   // $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
    //   $sth = $this->dbh->prepare($sql);
    //   $sth->execute();
    //   $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    //   return $result;
    // }


   //ポスト取得 USER.PHP
    // public function findPosts() {
    //   try {
    //     $sql = 'SELECT p.id, p.country_id, p.content, c.id AS c_id, c.name
    //             FROM posts p JOIN countries c
    //             ON p.country_id = c.id
    //             ';
    //     $sth = $this->dbh->query($sql);
    //     $sth->execute();
    //     $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    //     $dbh = null;
    //   } catch(PDOException $e) {
    //     echo 'データベースにアクセスできません！' . $e->getMessage();
    //   }
    // }

    //ポスト取得 USER.PHP
     public function findPosts() {
       try {
         $sql = 'SELECT i.id, i.country_id, i.image_content, c.id AS c_id, c.name, u.id, u.name AS username
                 FROM images i JOIN countries c
                 ON i.country_id = c.id
                 JOIN users u
                 ON i.user_id = u.id
                 WHERE i.id = :id';
         $sth = $this->dbh->prepare($sql);
         $sth->execute();
         $result = $sth->fetchAll(PDO::FETCH_ASSOC);
         return $result;
         $dbh = null;
       } catch(PDOException $e) {
         echo 'データベースにアクセスできません！' . $e->getMessage();
       }
     }


   //ポスト詳細 POST.PHP
    public function postDetail($id) {
      if(empty($id)) { //IDが不正の場合の処理
        exit('IDが不正です');
      }
      try {
        $sql = 'SELECT i.id, i.user_id, i.country_id, i.image_name, i.image_path, i.image_content, i.description, i.created_at, c.id AS c_id, c.name, u.id AS u_id, u.name AS username
                FROM images AS i
                LEFT JOIN countries AS c
                ON i.country_id = c.id
                LEFT JOIN users AS u
                ON i.user_id = u.id
                WHERE i.id = :id
                ';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
        if(!$result) {
          exit('ブログがありません');
        }
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません！' . $e->getMessage();
      }
    }

    //ポスト詳細 USER.PHP
   public function getEdit($id) {
      if(empty($id)) { //IDが不正の場合の処理
       exit('IDが不正です');
      }
      try {
        $sql = 'SELECT * FROM nomadie Where id = :id';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
        if(!$result) {
          exit('ブログがありません');
        }
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません！' . $e->getMessage();
      }
    }

    // country_idの取得
    public function getCountryId() {
      $sql = 'SELECT c.id, c.name, i.country_id
            FROM countries AS c
            JOIN images AS i
            ON c.id = i.country_id
            WHERE c.id =:id
            ';
      $sth = $this->dbh->prepare($sql);
      // $sth->bindValue(':id', $_SESSION['login_user']['country_id'], PDO::PARAM_INT);
      $sth->bindValue(':id', $_POST['country_id'], PDO::PARAM_INT);
      // $sth->bindValue(':country_id', $_POST['country_id'], PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
      if(!$result) {
        exit('ブログがありません');

    }
  }



    /**
    *検索フォームから国検索
    **/
    public function searchByCountry() {
      try {
        $sql = 'SELECT c.id, c.name, u.name as username, i.id as image_id, i.user_id, i.country_id, i.image_name, i.image_path, i.image_content
                FROM countries AS c
                JOIN users AS u
                ON c.id = u.country_id
                JOIN images AS i
                ON c.id = i.country_id
                WHERE i.country_id = '.$_POST['country_id'].'
                ';
        // $sth = $this->dbh->query($sql);
        // $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', $_POST['country_id'], PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_BOTH);
        return $results;
        $dbh = null;
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません！' . $e->getMessage();
      }
    }


    public function inserted($arr) {
      try {
        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':name', $arr['username'], PDO::PARAM_STR);
        $sth->bindParam(':email', $arr['email'], PDO::PARAM_STR);
        $sth->bindParam(':password', $arr['password'], PDO::PARAM_STR);
        $sth->execute();
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません' . $e->getMessage();
      }
    }

   // public function getAllFile() {
   //    $sql = 'SELECT * FROM images';
   //    $fileData = $this->dbh->query($sql);
   //    return $fileData;
   //  }


   /**
   * 投稿編集
   **/
  public function editPost() {
    try {
      $sql = "UPDATE images
              SET description = :description
              WHERE id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
      $sth->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    } catch(PDOException $e){
      exit($e);
    }
  }

  /**
  * 投稿の削除
  **/
  public function deletePost() {
   try {
     $sql = "DELETE FROM images
             WHERE id = :id";
     $sth = $this->dbh->prepare($sql);
     $sth->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
     $sth->execute();
   } catch(PDOException $e){
     exit($e);
   }
 }



  /**
  * ユーザー情報の取得
  **/
  public function userDetail($id) {
    if(empty($id)) { //IDが不正の場合の処理
      exit('IDが不正です');
    }
    try {
      $sql = 'SELECT u.id, u.country_id, u.name AS username, u.email, u.password, c.name, c.id
              FROM users AS u
              JOIN countries AS c
              ON u.country_id = c.id
              WHERE u.id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
      if(!$result) {
        exit('ブログがありません');
      }
    } catch(PDOException $e) {
      echo 'データベースにアクセスできません！' . $e->getMessage();
    }
  }
  /**
  * ユーザー情報の編集
  **/
  public function editUser() {
   try {
     $sql = "UPDATE users
             SET country_id = :country_id, name = :name, email =:email, password = :password
             WHERE id = :id";
     $sth = $this->dbh->prepare($sql);
     $sth->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
     $sth->bindValue(':country_id', $_POST['country_id'], PDO::PARAM_INT);
     $sth->bindValue(':name', $_POST['user_name'], PDO::PARAM_STR);
     $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
     $sth->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
     $sth->execute();
     $result = $sth->fetchAll(PDO::FETCH_ASSOC);
     return $result;
     $dbh = null;
   } catch(PDOException $e){
     exit($e);
   }
 }

 /**
 * ユーザー情報の削除
 **/
 public function 　deleteUser() {
  try {
    $sql = "DELETE FROM users
            WHERE id = :id";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  } catch(PDOException $e){
    exit($e);
  }
}

  /**
  * ユーザー情報の削除
  **/
  public function 　resetPassword() {


  }
}
 ?>
