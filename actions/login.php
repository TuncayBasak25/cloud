<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";

if (isset($_POST['user_id']) === FALSE) {
  echo "User ID is empty.";
  exit;
}

if (isset($_POST['password']) === FALSE) {
  echo "Password is empty.";
  exit;
}

$user_manager = new Users();

if (strpos('@', $_POST['user_id']) === TRUE) { //If this is an email
  $email = $_POST['user_id'];
  $user = $user_manager->get_user($email);
  if (empty($user) === TRUE) {
    echo "There is no user with that email.";
    exit;
  }
}
else {
  $username = $_POST['user_id'];
  $user = $user_manager->get_user($username);
  if (empty($user) === TRUE) {
    echo "There is no user whith that username.";
    exit;
  }
}


if (password_verify($_POST['password'], $user['password']) === FALSE) {
  echo "The password is wrong.";
  exit;
}

$time = time();
$_SESSION['user'] = $time;
$user_manager->set_user_log_id($user['username'], $time);
$user_manager->set_user_login_date($user['username'], $time);

echo "Loggin successfull";
