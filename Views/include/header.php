<?php
require(ROOT_PATH .'/Models/dbconnect.php');
$dsn = 'mysql:host=localhost;dbname=nomadie;charset=utf8';
$user = 'nomadie_user';
$pass = 'nomadlife';

$dbh = new PDO($dsn, $user, $pass, [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false,
]);

// if(@$_POST['id'] != ""  OR !$_POST['username'] != "" ) {
  $sql = 'SELECT name
          FROM countries
          ';
  $sth = $dbh->query($sql);
  $result = $sth->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Nomadie</title>
<link rel="stylesheet" type="text/css" href="/css/include.css">
</head>
<body>
  <div class="include_container">
    <div id="header">
      <a href="index.php"><h1>Nomadie</h1></a>

      <form action="search_posts.php" method="post">
        <select name='country_id'>
            <option disabled selected value>国名から探す</option>
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
          </select>        <!-- <input type="test" name="search"> -->
        <input type="submit" name="submit" value="検索">
      </form>

      <div class="header_box">
        <a href="mypage.php"><button>マイページ</button></a>
        <a>　</a>
        <a href="new_post.php"><button>　投 稿　</button></a>
      </div>
    </div>
  </div>

</body>
</html>
