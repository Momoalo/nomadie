<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');

$id = $_GET['id'];

$postD = new User();
$r_post = $postD->postDetail($id);
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

  <div id="post">
    <div id="post_top">
      <h2><?php echo $r_post['username'] ?></h2>
      <div class="country">
        <?php echo $r_post['name'] ?>
      </div>
    </div>

    <div>
      <p>投稿日時：<?= $r_post['created_at']; ?></p>
    </div>

    <div id="img">
      <img src="<?= $r_post['image_path']; ?>" alt="" class="mypg_image"><br>
    </div>

    <div class="content">
      <p><?php echo $r_post['description'] ?></p>
    </div>
  </div>

<?php require "include/footer.php"; ?>

</body>
</html>
