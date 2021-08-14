<?php
session_start();
  require_once(ROOT_PATH .'Models/Db.php');
  require_once(ROOT_PATH .'/Controllers/UserController.php');
  require_once(ROOT_PATH .'/Models/UserLogic.php');

$token = isset($_POST["token"]) ? $_POST["token"] : "";
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
unset($_SESSION["token"]);
if(!($token != "" && $token == $session_token)) {
  header("Location:mypage.php");
    exit;
  }

$files = UserLogic::getAllFile();

$new_post = $_POST;
$id = $new_post['id'];
$login_user = $_SESSION['login_user'];
$getCountry = new User();
$country = $getCountry->getCountryId();

$file =$_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'img/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir. $save_filename;

   $dsn = 'mysql:host=localhost;dbname=nomadie;charset=utf8';
   $user = 'nomadie_user';
   $pass = 'nomadlife';
   $dbh = new PDO($dsn, $user, $pass, [
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_EMULATE_PREPARES => false,
   ]);

$dbh->beginTransaction();
   $result = false;
   try {
   $sql = 'INSERT INTO images(user_id, country_id, image_name, image_path, image_content,description) VALUES (:user_id, :country_id, :image_name, :image_path, :image_content ,:description)';
     $sth = $dbh->prepare($sql);
     $sth->bindValue(':user_id', $login_user['id'], PDO::PARAM_INT);
     $sth->bindValue(':country_id', $new_post['country_id'], PDO::PARAM_INT);
     $sth->bindValue(':image_name', $filename, PDO::PARAM_STR);
     $sth->bindValue(':image_path', $save_path, PDO::PARAM_STR);
     $sth->bindValue(':image_content', $new_post['content'], PDO::PARAM_STR);
     $sth->bindValue(':description', $new_post['content'], PDO::PARAM_STR);
     $result = $sth->execute();
     $dbh->commit();
     // return $result;
     // $dbh = null;
   } catch(\Exception $e) {
     $dbh->rollBack();
     echo $e->getMessage();
     // return $result;
   }


// バリデーション
if(empty($new_post['country_id'])) {
  exit('国を選択してください');
}
if(empty($new_post['content'])) {
  exit('内容を入力してください');
}
if(strlen($new_post['content']) > 140) {
  array_push($err_msgs, '140文字以内で入力してください');
}
if($filesize > 3145728 || $file_err == 2) {
  array_push($err_msgs, 'ファイルサイズは2MB未満にしてください');
}

$allow_ext = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array(mb_strtolower($file_ext), $allow_ext)) {
    array_push($err_msgs, '画像ファイルを添付してください');
  }
if(count($err_msgs) === 0) {
  if(is_uploaded_file($tmp_path)) {
    if(move_uploaded_file($tmp_path, $save_path)) {
      // echo $filename . 'を' . $upload_dir . 'アップしました';
      //DEに保存（ファイル名、ファイルパス、キャプション）
      $fileData = array($filename, $save_path, $new_post['content']);
      // $result = fileSave();
      // if($result) {
      //   echo 'データベースに保存しました';
      // } else {
      //   echo 'データベースへの保存が失敗しました';
      // }
    } else {
      echo 'ファイルが保存できませんでした';
    }
  } else {
      echo 'ファイルが選択されていません';
    }
} else {
  foreach ($err_msgs as $msg) {
    echo $msg;
    echo '<br>';
  }
}

if (count($err_msgs) > 0) {
  $_SESSION = $err;
  header('Location: signup.php');
  return;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザーページ</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
<link rel="stylesheet" type="text/css" href="/css/include.css">
</head>

<body>
  <?php require "include/header.php"; ?>
    <div class="posted">
      <p>投稿しました。</p>
    </div>

    <div id="post">
      <div id="post_top">
        <h2><?php echo $login_user['name'] ?></h2>
        <div class="country">
          <?php echo $country['name']; ?>
        </div>
      </div>
      <div>
        <p>投稿日時：<?= $login_user['created_at']; ?></p>
      </div>
      <div>
        <img src="<?php echo $fileData['1']; ?>" alt="" class="mypg_image"><br>
      </div>
      <div class="content">
        <p><?php echo $new_post['content']; ?></p>
      </div>
    </div>
  <?php require "include/footer.php"; ?>

</body>
</html>
