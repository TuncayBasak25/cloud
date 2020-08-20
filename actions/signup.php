<?php
session_start();
chdir("..");
require_once "includes/class_auto_loader.php";
$user_manager = new Users();

if (empty($_POST['username']) === TRUE) {
  echo "Username is empty.";
  exit;
}
$username = $_POST['username'];

if (strlen($username) < 4) {
  echo "Username cannot be less than 4 charachter";
  exit;
}

if (strlen($username) > 30) {
  echo "Username cannot contain more than 30 charachter";
  exit;
}

if ($username[0] === '_' || $username[0] === '-') {
  echo "Username cannot begin with - or _";
  exit;
}

$allowed = ["_", "-"];
$cache_username = str_replace($allowed, '', $username);
if (ctype_alnum($cache_username) === FALSE) {
  echo "Username must contain only alphanumerical charachter with _ - allowed.";
}

if (empty($user_manager->get_user($username)) === FALSE) {
  echo "This username is already taken.";
  exit;
}

if (isset($_POST['firstname']) === TRUE && empty($_POST['firstname']) === FALSE) {
  $firstname = $_POST['firstname'];
  if (strlen($firstname) > 30) {
    echo "Firstname connot contain more than 30 charachter.";
  }
  if (ctype_alpha($firstname) === FALSE) {
    echo "Firstname must contain only alphabetic charachter.";
    exit;
  }
}

if (isset($_POST['lastname']) === TRUE && empty($_POST['lastname']) === FALSE) {
  $lastname = $_POST['lastname'];
  if (strlen($lastname) > 30) {
    echo "Lastname connot contain more than 30 charachter.";
  }
  if (ctype_alpha($lastname) === FALSE) {
    echo "Lastname must contain only alphabetic charachter.";
    exit;
  }
}

if (empty($_POST['email']) === TRUE) {
  echo "Email is empty.";
  exit;
}

$email = $_POST['email'];

if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
  echo "This email is unvalid.";
  exit;
}

if (empty($user_manager->get_user($email)) === FALSE) {
  echo "This email is already taken.";
  exit;
}

if (empty($_POST['password']) === TRUE) {
  echo "Password is empty.";
  exit;
}

if (empty($_POST['password_repeat']) === TRUE) {
  echo "Password repeat is empty.";
  exit;
}

if ($_POST['password'] !== $_POST['password_repeat']) {
  echo "Please enter the same password.";
  exit;
}

$hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$user_manager->new_user($_POST['username'], $_POST['email'], $hashed_pass);


if (isset($firstname) === TRUE) {
  $user_manager->set_user_firstname($username, $firstname);
}

if (isset($lastname) === TRUE) {
  $user_manager->set_user_lastname($username, $lastname);
}

require "actions/init_user_data.php";

echo "Signup successfull";
