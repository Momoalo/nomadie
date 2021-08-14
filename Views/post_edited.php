<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');


$post = $_POST['id'];
$description = $_POST['description'];
$login_user = $_SESSION['login_user'];

$update = new User();
$params_update = $update->editPost();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新規投稿画面</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>

<body>
<?php require "include/header.php"; ?>

<div class="container">
  <p>更新完了しました</p>
  <a href="mypage.php">マイページへ</a><br>
  <a href="index.php">topへ戻る</a>
</div>


<?php require "include/footer.php"; ?>

</body>
</html>
