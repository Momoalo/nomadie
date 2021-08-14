<?php
  require_once(ROOT_PATH .'/Models/Db.php');
  require_once(ROOT_PATH .'/Models/dbconnect.php');

  class UserLogic extends Db {
    private $userstable = 'users';

    /**
    * ユーザーを登録する
    * @param array $userData
    * @return bool $result
    **/
    public function createUser($userData) {
      $result = false;
      $sql = 'INSERT INTO users (name, country_id, email, password)
              VALUES (:name, :country_id, :email, :password)';
      try {
        $params = array(
          ':name' => $userData['username'],
          ':country_id' => $userData['country_id'],
  				':email' => $userData['email'],
  				':password' => password_hash($userData['password'], PASSWORD_DEFAULT));
        $sth = $this->dbh->prepare($sql);
  			$result = $sth->execute($params);
  			$b = $sth->errorInfo();
  			return $result;
  		} catch(\Exception $e){
  			return $result;
  		}
  	}

    /**
    * ログイン処理
    * @param string $email, $password
    * @return bool $result
    **/
    public static function login($email,$password) {
      $result = false;
      $user = self::getUserByEmail($email);
      if (!$user) {
        $_SESSION['msg'] = 'メールアドレスが一致しません';
        return $result;
      }
      // パスワードの照会
      if(password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['login_user'] = $user;
        $result = true;
        return $result;
      } else {
        $_SESSION['msg'] = 'パスワードが一致しません';
        $result = true;
        return $result;
      }
    }


    /**
    * emailからユーザーを取得
    * @param string $email
    * @return array|bool $user|false
    **/
    public static function getUserByEmail($email) {
  		$sql = 'SELECT * FROM users WHERE email = ?';
  		$arr = [];
  		$arr[] = $email;
  		try {
  			$sth = connect()->prepare($sql);
  			$sth->execute($arr);
  			$user = $sth->fetch();
  			return $user;
  		} catch(\Exception $e){
  			return false;
  		}
  	}


    /**
    * ログインチェック
    * @param void
    * @return bool $result
    **/
    public static function checkLogin() {
  		$result = false;
      // セッションにログインユーザーが入っていなかったらfalse
  		if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
        return $result = true;
  		}
      // return $result;
  		// if($result = false){
      //   // $result = false;
  		// 	$_SESSION['loginerror'] = 'ページを閲覧するにはログインが必要です';
  		// 	header('Location: login.php');
  		// 	return $result;
  		// }
    }

    /**
    * ログアウト処理
    **/
    public static function logout() {
      $_SESSION = array();
      session_destroy();
    }


    // /**
    // * 新規投稿
    // **/
    // public static function insertPost($login_user,$filename,$new_post,$save_path) {
    //  $result = false;
    //  try {
    //  $sql = 'INSERT INTO images(user_id, country_id, image_name, image_path, image_content,description) VALUES (:user_id, :country_id, :image_name, :image_path, :image_content ,:description)';
    //    $sth = $this->dbh->prepare($sql);
    //    $sth->bindValue(':user_id', $login_user['id'], PDO::PARAM_INT);
    //    $sth->bindValue(':country_id', $new_post['country_id'], PDO::PARAM_INT);
    //    $sth->bindValue(':image_name', $filename, PDO::PARAM_STR);
    //    $sth->bindValue(':image_path', $save_path, PDO::PARAM_STR);
    //    $sth->bindValue(':image_content', $new_post['content'], PDO::PARAM_STR);
    //    $sth->bindValue(':description', $new_post['content'], PDO::PARAM_STR);
    //    $result = $sth->execute();
    //    return $result;
    //    // $dbh = null;
    //  } catch(\Exception $e) {
    //    echo $e->getMessage();
    //    // return $result;
    //  }
    // }



    /**
    * 画像取得
    **/
    public static function getAllFile() {
       $sql = 'SELECT * FROM images';
       $fileData = connect()->query($sql);
       return $fileData;
     }

    /**
    * emailからユーザーを取得
    * @param string $email
    * @return array|bool $user|false
    **/
    public static function getCountries() {
   		$sql = 'SELECT name FROM countries';
   		try {
   			$sth = connect()->prepare($sql);
   			$sth->execute();
   			$result = $sth->fetchAll();
   			return $result;
   		} catch(\Exception $e){
   			return false;
   		}
   	}
}
?>
