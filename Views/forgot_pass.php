<?php
require_once(ROOT_PATH .'database.php');
require_once(ROOT_PATH .'Models/UserLogic.php');
require_once(ROOT_PATH .'Models/ForgetPass.php');
// print_r($_SERVER);

$email = filter_input(INPUT_POST, 'email');
var_dump($email);
// $email = $_POST['email'];
// $forgot_pass = new ForgetPass;
// $f_pass = $forgot_pass->forgetPassword($email);

// var_dump($f_pass);



// $to = 'eofthew2147@docomo.ne.jp';
$to = 's13202001515@toyo.jp';
$title = "TEST";
$message = "This is TEST.\r\nHow are you?";
$headers = "From: from@example.com";
if(mb_send_mail($to, $title, $message, $headers))
{
  echo "メール送信成功です";
}
else
{
  echo "メール送信失敗です";
}

// $error = [];
// if(!$email = filter_input(INPUT_POST, 'email')){
// 	$error['email'] = 'メールアドレスを入力してください';
// }

// $dbh = connect();
//
// $sql = 'SELECT count(*) from users where email = '.$_POST['email'].'';


// $sql = sprintf('SELECT COUNT(*) AS cnt FROM users
//         -- WHERE email = .$email.
//         WHERE email = "%s"',
//         mysqli_real_escape_string($db, $_POST['email']))
//         ;
// $arr = [];
// $arr[] = $email;
// try {
//   $sth = connect()->prepare($sql);
//   $sth->execute();
//   $fgt_pass = $sth->fetch();
//   // return $fgt_pass;
// } catch(\Exception $e){
//   // return false;
// }




// var_dump($forget_pass);
// if($_POST) {
//   $host = $_SERVER['HTTP_HOST'];
//   $uri = $rtrim(dirname($_SEVER['PHP_SELF']), )
//   header('Location: //$host$uri/mypage.php');
//   exit;
// } else {
//   }
  // $userfile = '/userfile.txt';
  // if(file_exists($userfile)) {
  //   $users = file_get_contents($userfile);
  //   $users = explode("\n",$users);
  //   foreach ($users as $k => $v) {
  //     $v_ary = str_getcsv($v);
  //     if($v_ary[0] == $_POST['email']) {
  //       $pass = bin2hex(random_bytes(6));
  //       $message = 'パスワードを変更しました。\r\n' . $pass . "\r\n";
  //       mail($_POST['email'], 'パスワード変更しました', $message);
  //     }
  //   }
  //   var_dump($user);
  //
  // } else {
  //   $err[] = 'not fouda';
  // }
  // var_dump($user);


// $result = UserLogic::checkLogin();
// if($result) {
//   header('Location: mypage.php');
//   return;
// }
//
// var_dump($_POST);
//
// $error = [];
// if(!$email = filter_input(INPUT_POST, 'email')){
// 	$error['email'] = 'メールアドレスを入力してください';
// }

// if(file_exists($userfile)) {
//   $users = file_get_contents($userfile);
//   $users = explode("\n", $users);
//   foreach ($users as $k => $v);
//   if($v_ary[0] == $_POST['email']) {
//     // パスワード生成
//   $pass = bin2hex(random_bytes(6));
//   $message = 'パスワードを変更しました。\r\n' . $pass . "\r\n";
//   mail($_POST['email'], 'パスワード変更しました', $message);
//
//   }
// }

// $ph = password_hash( $pass, PASSWORD_DEFAULT);
// $line = '"' . $_POST['e'] . '", "' . $ph . '"';
// $users[$k] = $line;
// $userinfo = implode("\n", $users);
// $ret = file_put_contents( $userfile, $user);
//
// // $complete
//
// ?>

<!-- <?php if($complete) { ?>
  パスワードを再発行しました
<?php } else { ?>
<?php } ?> -->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>パスワード再発行　</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>
<?php require "include/header.php"; ?>

<body>
    <div class="container">
      <?php if (isset($err['msg'])) : ?>
        <p class="error"><?php echo $err['msg']; ?></p>
      <?php endif; ?>

      <form action="forgot_pass.php" method="POST">
        <div class="forgot_box">
          <label for="mail">メールアドレス</label>
            <input type="text" name="email">
        </div>
            <?php if (isset($err['email'])) : ?>
              <p class="error"><?php echo $err['email']; ?></p>
            <?php endif; ?>
        <button type="submit">再発行</button><br>
      </form>

      <a href="signup.php"><button>新規登録</button></a>
    </div>

  <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>"/>

  <?php require "include/header.php"; ?>
</body>
</html>
