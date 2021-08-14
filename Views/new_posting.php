<?php
session_start();
  require_once(ROOT_PATH .'Models/Db.php');
  require_once(ROOT_PATH .'/Controllers/UserController.php');
  require_once(ROOT_PATH .'/Models/UserLogic.php');
  // require_once(ROOT_PATH .'Models/dbconnect.php');
  // require_once(ROOT_PATH .'/Models/Post.php');


$files = UserLogic::getAllFile();

$new_post = $_POST;
$id = $new_post['id'];

$login_user = $_SESSION['login_user'];
// $id = $_SESSION['login_user']['country_id'];

$getCountry = new User();
$country = $getCountry->getCountryId();
// var_dump($login_user);
var_dump($country);


$file =$_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'img/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir. $save_filename;


$caption = filter_input(INPUT_POST, 'caption',
           FILTER_SANITIZE_SPECIAL_CHARS);

 $dsn = 'mysql:host=localhost;dbname=nomadie;charset=utf8';
 $user = 'nomadie_user';
 $pass = 'nomadlife';
 $dbh = new PDO($dsn, $user, $pass, [
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_EMULATE_PREPARES => false,
 ]);

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
   // return $result;
   // $dbh = null;
 } catch(\Exception $e) {
   echo $e->getMessage();
   // return $result;
 }

   // var_dump($new_post);
   // var_dump($save_path);


// バリデーション
if(empty($new_post['country_id'])) {
  exit('国を選択してください');
}
if(empty($new_post['content'])) {
  exit('内容を入力してください');
}
// if(empty($caption)) {
//   echo '内容を入力してください';
// }
if(strlen($caption) > 140) {
  array_push($err_msgs, '140文字以内で入力してください');
}
if($filesize > 2097152 || $file_err == 2) {
  array_push($err_msgs, 'ファイルサイズは1MB未満にしてください');
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

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新規投稿確認</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.5/vue.min.js"></script>
<script type="text/javascript" src="/js/nomadie.js"></script>
</head>

<body>
<?php require "include/header.php"; ?>

  <div id='new_post_container'>
    <h2></h2>
    <p>投稿しました</p>

    <form method='POST' action='user.php'>
      <div class="post_box">
        <img src="<?php echo $fileData['1']; ?>" alt="" class="image">

        <p class="tag">国</p>
        <p class="typed"> <?php echo $country['name']; ?></p>
        <p class="tag">内容</p>
        <p class="typed"> <?php echo $new_post['content']; ?></p>
      </div>


      <div class="btn_box">
        <button id="post" type="submit">　　投稿する　　</button><br>
      </div>
    </form>

    <!-- <?php foreach($files as $img): ?>
      <img src="<?php echo $fileData['1']; ?>" alt="" class="image">
      <p><?php echo $img['description']; ?></p>
    <?php endforeach; ?> -->

  </div>

<?php require "include/footer.php"; ?>

</body>
</html>
