<?php
session_start();
require_once(ROOT_PATH .'/Controllers/UserController.php');
require_once(ROOT_PATH .'Models/functions.php');
require_once(ROOT_PATH .'/Models/User.php');

$deleteUser = new User();
$d_user = $deleteUser->deleteUser($_GET['id']);

$id = $_GET['id'];
var_dump($d_user);

// $posts = new User();
// $user_edit = $posts->userDetail($_GET['id']);
$login_user = $_SESSION['login_user'];

$get = $_GET['id'];
$id = $login_user['id'];
$country_id = $login_user['country_id'];

?>
