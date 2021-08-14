<?php
session_start();
require_once(ROOT_PATH .'database.php');
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');
require_once(ROOT_PATH .'/Models/UserLogic.php');

// ログインしているか判定
$result = UserLogic::checkLogin();

//リロード時二重投稿を防ぐ為マイページへ
if(!$result) {
  $_SESSION['login_err'] = 'ユーザーを登録しログインしてください';
  header('Location: signup.php');
  return;
}

$login_user = $_SESSION['login_user'];
$id = $login_user['id'];

$posts = new User();
$userDetail = $posts->userDetail($id);

  $dbh = connect();
  $dbh->beginTransaction();
  try {
      $sql = 'SELECT i.id, i.user_id, i.country_id, i.image_name, i.image_path, i.image_content, i.description, c.id AS c_id, c.name, u.id AS user_id, u.name AS username
              FROM images AS i
              JOIN countries AS c
              ON i.country_id = c.id
              JOIN users AS u
              ON i.user_id = u.id
              WHERE u.id = :id';
      $sth = $dbh->prepare($sql);
      $sth->bindParam(':id', $login_user['id'], PDO::PARAM_INT);
      $sth->execute();
      $getID = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh->commit();
  } catch(PDOException $e) {
    $dbh->rollBack();
    exit($e);
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

<div id="user_container">
  <div id="user_top">    <div id="user_topright">
      <div class="user_top_box">
        <h4>ユーザー名：</h4><h2>　</h2>
        <h5><?php echo h($userDetail['username']) ?></h5>
      </div>
      <div class="user_top_box">
        <p>滞在国： <?php echo $userDetail['name'] ?></p>
      </div>
      <div class="user_box">
        <a href="user_edit.php?id=<?= $login_user['id'] ?>"><button>アカウント編集</button></a>
      </div>
    </div>
  </div>

  <div id="users_post">
    <?php foreach($getID as $post => $value): ?>
    <div class="box">
      <img src="<?= $value['image_path']; ?>" alt="" class="mypg_image"><br>
      <a href="post.php?id=<?= $value['id'] ?>">詳細</a>|
      <a href="post_edit.php?id=<?= $value['id'] ?>">編集</a>|
      <a href="post_delete.php?id=<?= $value['id'] ?>"　onClick="return disp();">削除</a>
    </div>
    <?php endforeach; ?>
  </div>

  <form action="logout.php" method="POST">
    <input type="submit" id="logout_btn" name="logout" value="ログアウト">
  </form>
</div>
<?php require "include/footer.php"; ?>

</body>
</html>
