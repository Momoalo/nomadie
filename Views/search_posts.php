<?php
session_start();
require_once(ROOT_PATH .'Models/Search.php');

$post = $_POST;
$login_user = $_SESSION['login_user'];
$id = $login_user['id'];
$postID = $_POST['country_id'];

//ポスト詳細 USER.PHP
   if(empty($id)) { //IDが不正の場合の処理
     exit('IDが不正です');
   }

 $search_posts = new Search;
 $results = $search_posts->searchByCountry();

?>
<!DOCTYPE html>

<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Nomadie</title>
<link rel="stylesheet" type="text/css" href="/css/include.css">
</head>
<body>
  <?php require "include/header.php"; ?>

  <div id="search">
    <h1><?= $results[0]['name'];?></h1>

    <div id="posts">
        <?php foreach ($results as $value):?>
          <div id="search_box">
          <!-- <?php var_dump($value);?> -->
            <p><?= $value['username']?></p>
            <img src="<?= $value['image_path']; ?>" alt="" class="mypg_image"><br>
            <a href="post.php?id=<?= $value['image_id'] ?>"><button>詳細</button></a>
          </div>
        <?php endforeach; ?>
    </div>
  </div>

  <?php require "include/footer.php"; ?>
</body>
</html>
