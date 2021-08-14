<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');

$posts = new User();
$result = $posts->postDetail($_GET['id']);

$id = $_GET['id'];
$user_id = $result['user_id'];
$country_id = $result['country_id'];
$image_name = $result['image_name'];
$image_path = $result['image_path'];
$image_content = $result['image_content'];
$description = $result['description'];
$created_at = $result['created_at'];
$name = $result['name'];
$username = $result['username'];
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

    <form action="post_edited.php" method="POST">
      <input type="hidden" name="id" value="<?= $id?>">
      <textarea name="description"><?= $description ?></textarea>
      <button type="submit">確認画面へ</button><br>
    </form>

  </div>

<?php require "include/footer.php"; ?>

</body>
</html>
