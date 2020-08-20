<?php
//session_start();
//chdir("..");
require_once "includes/class_auto_loader.php";
$user_manager = new Users();
$content_manager = new Contents();


if (isset($_POST['username']) === FALSE || empty($_POST['username']) === TRUE) {
  echo "Username is missing or empty, init user aborded.";
  exit;
}

$content_manager->new_folder($_POST['username'], "Home", $_POST['username']);
