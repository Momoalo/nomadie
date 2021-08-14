<?php
// require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/database.php');

  class ForgetPass extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    public static function forgetPassword($email) {
      $sql = 'SELECT * from users where email = '.$_POST['email'].'';
      $arr = [];
      $arr[] = $email;
      try {
        $sth = connect()->prepare($sql);
        $sth->execute();
        $forget_pass = $sth->fetch();
        return $forget_pass;
      } catch(\Exception $e){
        return false;
      }
    }
  }
