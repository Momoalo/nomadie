<?php
session_start();
require_once(ROOT_PATH .'Models/UserLogic.php');

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン画面</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<?php require "include/index_header.php"; ?>

<header>

    <h1>Find the place to go.</h1>
    <div id='login'>
      <?php if (isset($err['msg'])) : ?>
        <p class="error"><?php echo $err['msg']; ?></p>
      <?php endif; ?>

      <form action="login_comp.php" method="POST">
        <div class="login_box">
          <label for="mail">メールアドレス</label>
            <input type="text" name="email">
        </div>
            <?php if (isset($err['email'])) : ?>
              <p class="error"><?php echo $err['email']; ?></p>
            <?php endif; ?>
        <div class="login_box">
          <label for="password">　パスワード　</label>
            <input type="password" name="password">
        </div>
            <?php if (isset($err['password'])) : ?>
              <p class="error"><?php echo $err['password']; ?></p>
            <?php endif; ?>
        <button type="submit">ログイン</button><br>
      </form>

      <a href="forget_pass.php" class="reset_pass">パスワードを忘れた方はこちら</a><br>
      <a href="signup.php"><button>新規登録</button></a>
    </div>
</header>
<input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>"/>

</html>
