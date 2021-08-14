<?php
session_start();
require_once(ROOT_PATH .'Models/UserLogic.php');
require_once(ROOT_PATH .'Models/functions.php');
require_once(ROOT_PATH .'Controllers/UserController.php');

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err']:NULL;
unset($_SESSION['login_err']);
$err = $_SESSION;
$_SESSION = array();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザー新規登録画面</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<body>
  <?php require "include/header.php"; ?>

  <div id="signup">
    <h3>新規登録</h3>
      <?php if (isset($err['msg'])) : ?>
        <p class="error"><?php echo $err['msg']; ?></p>
      <?php endif; ?>

    <form action="register.php" method="POST">
      <p>
        <label for="username">ユーザー名</label>
        <?php if (isset($err['username'])) : ?>
          <p class="error"><?php echo $err['username']; ?></p>
        <?php endif; ?>
        <input type="text" name="username">
      </p>
      <p>
        <label>滞在国</label>
        <select name='country_id' type="text"  class="select_country">
          <option value='1'>オーストラリア</option>
          <option value='2'>ニュージーランド</option>
          <option value='3'>カナダ</option>
          <option value='4'>韓国</option>
          <option value='5'>フランス</option>
          <option value='6'>ドイツ</option>
          <option value='7'>イギリス</option>
          <option value='8'>アイルランド</option>
          <option value='9'>デンマーク</option>
          <option value='10'>台湾</option>
          <option value='11'>香港</option>
          <option value='12'>ノルウェー</option>
          <option value='13'>ポーランド</option>
          <option value='14'>ポルトガル</option>
          <option value='15'>スロバキア</option>
          <option value='16'>オーストリア</option>
          <option value='17'>ハンガリー</option>
          <option value='18'>スペイン</option>
          <option value='19'>アルゼンチン</option>
          <option value='20'>チリ</option>
          <option value='21'>チェコ</option>
          <option value='22'>アイスランド</option>
          <option value='23'>リトアニア</option>
          <option value='24'>スウェーデン</option>
          <option value='25'>エストニア</option>
        </select>
      </p>
      <p>
        <label for="mail">メールアドレス</label>
        <?php if (isset($err['mail'])) : ?>
          <p class="error"><?php echo $err['mail']; ?></p>
        <?php endif; ?>
        <input type="email" name="email">
      </p>
      <p>
        <label for="password">パスワード</label>
        <?php if (isset($err['password'])) : ?>
          <p class="error"><?php echo $err['password']; ?></p>
        <?php endif; ?>
        <input type="password" name="password">
      </p>
      <p>
        <label for="password_conf">パスワード確認</label>
        <?php if (isset($err['password_conf'])) : ?>
          <p class="error"><?php echo $err['password_conf']; ?></p>
        <?php endif; ?>
        <input type="password" name="password_conf">
      </p>
      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
      <button type="submit" value="">新規登録</button>
      <a href="login.php" class="toLogin"><button>ログインする</button></a>

    </form>
    <!-- <a href="login.php" class="toLogin"><button>ログインする</button></a> -->
  </div>

  <?php require "include/footer.php"; ?>

</body>
</html>
