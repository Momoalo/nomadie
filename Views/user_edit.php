<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');
require_once(ROOT_PATH .'/Models/UserLogic.php');

$posts = new User();
$user_edit = $posts->userDetail($_GET['id']);
$login_user = $_SESSION['login_user'];

$get = $_GET['id'];
$id = $login_user['id'];
$country_id = $login_user['country_id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザー編集ページ</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
<link rel="stylesheet" type="text/css" href="/css/include.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.5/vue.min.js"></script>
<script type="text/javascript" src="/js/nomadie.js"></script>
</head>

<body>
  <?php require "include/header.php"; ?>

  <div id="user_edit">
    <h3>アカウント情報変更</h3>

    <form action="user_edited.php" method="POST">
      <input type="hidden" name="id" value="<?= $id?>">
      <input type="hidden" name="country_id" value="<?= $country_id?>">

      <div class="type_space">
        <label for="user_name" value="<?= $id?>">ユーザー名<span class="required">*</span></label><br>
          <!-- <span class="error" style="color:red"><></span></label> -->
          <input class="input" type="text" name="user_name" size="30"  value="<?= $user_edit['username']?>" placeholder="">
      </div>
      <div class="type_space">
        <label for="mail">メールアドレス<span class="required">*</span></label><br>
          <!-- <span class="error" style="color:red"><></span></label> -->
          <input class="input" type="text" name="email" size="30" value="<?= $user_edit['email']?>" placeholder="">
      </div>
      <div class="type_space">
        <label for="password">パスワード<span class="required">*</span></label><br>
          <!-- <span class="error" style="color:red"><></span></label> -->
          <input class="input" type="text" name="password" size="30" value="" placeholder="">
      </div>
      <button id="update" type="submit">更新する</button><br>
      <div class="delete">
        <!-- <a href="user_delete.php?id=<?= $id ?>" type="">アカウント削除</a> -->
      </div>
  </div>

  <?php require "include/footer.php"; ?>
</body>
</html>
