<?php
session_start();
require_once(ROOT_PATH .'/Models/UserLogic.php');

if(!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです');
}

// ログインしているか判定,セッションが切れていたらログインしてくださいとメッセージを出す
$logout = UserLogic::checkLogin();
if(!$logout) {
  exit('セッションが切れましたので、ログインし直してください');
}
UserLogic::logout();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログアウト</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<body>
  <?php require "include/header.php"; ?>

  <div class="container">
    <p>ログアウトしました</p>
    <a href="login.php"><button>ログイン画面へ</button></a>
  </div>
  <?php require "include/footer.php"; ?>

</body>
</html>
