<?php
  require_once(ROOT_PATH .'/Models/Db.php');


  class PostDetail extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    /**
    *
    **/
    public function postDetail($id) {
      if(empty($id)) { //IDが不正の場合の処理
        exit('IDが不正です');
      }
      try {
        $sql = 'SELECT i.id, i.user_id, i.country_id, i.image_name, i.image_path, i.image_content, i.description, i.created_at, c.id AS c_id, c.name, u.id AS user_id, u.name AS username
                FROM images AS i
                LEFT JOIN users AS u
                ON i.user_id = u.id
                LEFT JOIN countries AS c
                ON i.country_id = c.id
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
  }
