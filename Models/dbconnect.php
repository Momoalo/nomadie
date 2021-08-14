<?php
require_once(ROOT_PATH .'database.php');

// function connect() {
//   $host = DB_HOST;
//   $db = DB_NAME;
//   $user = DB_USER;
//   $password = DB_PASSWORD;
//
//   $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
//
//   try {
//     $dbh = new PDO($dsn, $user, $password, [
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]);
//     return $dbh;
//   } catch (PDOException $e) {
//     echo '接続失敗です。'. $e->getMessage();
//     exit();
//   }
// }
//
// function getAllFile() {
//   $sql = 'SELECT * FROM images';
//   $fileData = connect()->query($sql);
//   return $fileData;
// }
//
// function selectUser() {
//   $sql = 'SELECT * FROM users';
//   $userselect = connect()->query($sql);
//   return $userselect;
// }
// function fileSave() {
//   $result = false;
//   $sql = 'INSERT INTO images(country_id, image_name, image_path, image_content,description)
//           VALUES (:country_id, :image_name, :image_path, :image_content ,:description)';
//   try {
//     $sth = connect()->prepare($sql);
//     $sth->bindValue(':country_id', $new_post['country_id'], PDO::PARAM_INT);
//     $sth->bindValue(':image_name', $filename, PDO::PARAM_STR);
//     $sth->bindValue(':image_path', $save_path, PDO::PARAM_STR);
//     $sth->bindValue(':image_content', $new_post['content'], PDO::PARAM_STR);
//     $sth->bindValue(':description', $new_post['content'], PDO::PARAM_STR);
//     $result = $sth->execute();
//     return $result;
//     $dbh = null;
//   } catch(\Exception $e) {
//     echo $e->getMessage();
//     return $result;
//   }
