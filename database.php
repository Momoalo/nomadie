<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'nomadie_user');
define('DB_PASSWORD', 'nomadlife');
define('DB_NAME', 'nomadie');

function connect() {
  $host = DB_HOST;
  $db = DB_NAME;
  $user = DB_USER;
  $password = DB_PASSWORD;

  $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

  try {
    $dbh = new PDO($dsn, $user, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $dbh;
  } catch (PDOException $e) {
    echo '接続失敗です。'. $e->getMessage();
    exit();
  }
}
