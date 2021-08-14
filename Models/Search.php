<?php
  require_once(ROOT_PATH .'/Models/Db.php');


  class Search extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    /**
    *検索フォームから国検索
    **/
    public function searchByCountry() {
      try {
        $sql = 'SELECT c.id, c.name, u.name as username, i.id as image_id, i.user_id, i.country_id, i.image_name, i.image_path, i.image_content
                FROM images AS i
                LEFT JOIN users AS u
                ON i.user_id = u.id
                LEFT JOIN countries AS c
                ON c.id = i.country_id
                WHERE i.country_id = '.$_POST['country_id'].'
                ';
        // $sth = $this->dbh->query($sql);
        // $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', $_POST['country_id'], PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $results;
        $dbh = null;
      } catch(PDOException $e) {
        echo 'データベースにアクセスできません！' . $e->getMessage();
      }
    }
  }
