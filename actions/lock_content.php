<?php
session_start();
chdir("..");
require_once "includes/class_auto_loader.php";
$user_manager = new Users();
$content_manager = new Contents();
$data_manager = new Data();

if ($user_manager->refresh_connection($_SESSION['user'], $_SESSION['log_id']) === FALSE) {
  echo "Your login is timed out please loggin again.";
  exit;
}

if (isset($_POST['content_name']) === FALSE || empty($_POST['content_name']) === TRUE) {
  echo "Content name is missing or empty";
  exit;
}

if (isset($_POST['content_path']) === FALSE || empty($_POST['content_path']) === TRUE) {
  echo "Content path is missing or empty";
  exit;
}

$content_manager->set_locked($_POST['content_name'], $_POST['content_path'], "true");

echo "Content locked successfully";
