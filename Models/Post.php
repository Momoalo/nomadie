<?php
// require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/database.php');

  class Post extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }


 //新規投稿 NEW_POST.PHP
 public function newPost($new_post):Array {
   try {
     $sql ='INSERT INTO posts(country_id, content)
            VALUES (:country_id, :content)';
     $sth = $this->dbh->prepare($sql);
     $sth->bindValue(':country_id',$new_post['country_id'],PDO::PARAM_INT);
     $sth->bindValue(':content',$new_post['content'],PDO::PARAM_STR);
     $sth->execute();
     $results = $sth->fetchAll(PDO::FETCH_ASSOC);
     return $result;
     $dbh = null;
   } catch(PDOException $e) {
     echo 'データベースにアクセスできません' . $e->getMessage();
   }
 }
}
