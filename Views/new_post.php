<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');

$login_user = $_SESSION['login_user'];
$token = uniqid('', true);;
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新規投稿画面</title>
<link rel="stylesheet" type="text/css" href="/css/nomadie.css">
</head>

<body>
  <?php require "include/header.php"; ?>

  <div id='new_post'>
    <form method='POST' action='new_posted.php' enctype="multipart/form-data">
      <h2>新規投稿</h2>
      <input type="hidden" name="id" value="<?= $login_user['id']?>">
      <div class="post_box">
        <label>国選択</label>
          <select name='country_id'>
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
            <option value='26'>オランダ</option>
          </select>
      </div>

      <div class="post_box">
        <label>投稿画像</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
        <input type="file" name="img" accept="img/*" />
      </div>

      <div class="post_box">
        <label for="content">内容</label>
        <textarea name="content" cols="62" rows="20"></textarea><br>
      </div>
      <input type="hidden" name="token" value="<?php echo $token;?>">
      <button type="submit">投　稿</button><br>
    </form>
  </div>

  <?php require "include/footer.php"; ?>
</body>
</html>
