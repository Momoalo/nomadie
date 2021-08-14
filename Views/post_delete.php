<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');

$posts = new User();
$delete = $posts->postDetail($_GET['id']);

$id = $_GET['id'];
$user_id = $delete['user_id'];
$country_id = $delete['country_id'];
$image_name = $delete['image_name'];
$image_path = $delete['image_path'];
$image_content = $delete['image_content'];
$description = $delete['description'];
$created_at = $delete['created_at'];
$name = $delete['name'];
$username = $delete['username'];
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
      <h2><?php echo $username ?></h2>
      <div class="country">
        <?php echo $name ?>
      </div>
    </div>

    <div>
      <p>投稿日時：<?= $created_at; ?></p>
    </div>

    <div id="img">
      <img src="<?= $image_path; ?>" alt="" class="mypg_image"><br>
    </div>

    <form action="post_delete_comp.php?id=<?= $delete['id'] ?>" method="POST">
      <input type="hidden" name="id" value="<?= $id?>">
      <p name="description" class="content"><?= $description ?></p>
      <button type="submit">削　除</button><br>
    </form>
  </div>

<?php require "include/footer.php"; ?>

</body>
</html>
