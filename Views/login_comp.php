<?php
session_start();
require_once(ROOT_PATH .'Models/UserLogic.php');

//バリデーション
$error = [];
if(!$email = filter_input(INPUT_POST, 'email')){
	$error['email'] = 'メールアドレスを入力してください';
}
if(!$password = filter_input(INPUT_POST, 'password')){
	$error['password'] = 'パスワードを入力してください';
}
if(count($error) > 0){
	$_SESSION = $error;
	header('Location: login.php');
	return;
}
// ログイン成功時の処理
$user = new UserLogic();
$result = $user->login($email,$password);
// ログイン失敗時の処理
if (!$result) {
	header('Location: login.php');
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ログイン完了画面</title>
  <link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>

<body>
  <?php require "include/header.php"; ?>

	<?php if(count($error) > 0): ?>
	<?php foreach($error as $e): ?>
	<p><?php echo $e ?></p>
    <?php endforeach ?>
    <?php else : ?>
      <div id="logged_in">
        <p>ログイン完了しました</p>
				<a href="mypage.php">マイページへ</a><br>
        <a href="index.php">topへ戻る</a>
      </div>
    <?php endif ?>

  <?php require "include/footer.php"; ?>
</body>
</html>
