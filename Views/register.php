<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');
require_once(ROOT_PATH .'/Models/UserLogic.php');

// エラーメッセージ
$token = filter_input(INPUT_POST, 'csrf_token');
if(!isset($_SESSION['csrf_token']) || !$token == $_SESSION['csrf_token']) {
  exit('不正なリクエスト');
}
unset($_SESSION['csrf_token']);

// var_dump($_SESSION['csrf_token']);
  // バリデーション
$err =[];
if(!$username = filter_input(INPUT_POST, 'username')) {
  $err['username'] = 'ユーザー名を記入してください';
}
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['mail'] = 'メールアドレスを記入してください';
}
$password = filter_input(INPUT_POST, 'password');
// 正規表現
if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
  $err['password'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !==$password_conf) {
  $err['password_conf'] = '確認用パスワードと異なっています。';
}

if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: signup.php');
  return;
}


  if (count($err) === 0) {
    // ユーザーを登録
    $user = new UserLogic();
    $created = $user->createUser($_POST);

    $users = new UserLogic();
    $result = $users->login($email,$password);

    if(!$created) {
      $err[] = '登録に失敗しました';
    }
  }


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザー新規登録確認画面</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<body>
  <?php require "include/header.php"; ?>

  <div class="container">
    <?php if (count($err) > 0): ?>
    <?php foreach($err as $e): ?>
      <p class="error"><?= $e?></p>
    <?php endforeach ?>
    <?php else : ?>
      <p>ユーザー登録が完了しました。</p>
    <?php endif ?>

    <a href="mypage.php">マイページ</a><br>
    <a href="./signup.php">戻る</a>
  </div>

  <?php require "include/footer.php"; ?>

</body>
</html>
