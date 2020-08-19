<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";
$user_manager = new Users();
$content_manager = new Contents();

foreach ($_FILES['file'] as $key => $value) {
  echo $key . ' : ' . $value . '<br>';
}

if ($user_manager->refresh_connection($_SESSION['user'], $_SESSION['log_id']) === FALSE) {
  echo "Your login is timed out please loggin again.";
  exit;
}

if (isset($_POST['file_name']) === FALSE || empty($_POST['file_name']) === TRUE) {
  echo "File name is missing or empty.";
  exit;
}
$file_name = $_POST['file_name'];

if (isset($_POST['file_path']) === FALSE || empty($_POST['file_path']) === TRUE) {
  echo "File path is missing or empty.";
  exit;
}
$file_path = $_POST['file_path'];

if (empty($content_manager->get_content($file_name, $file_path)) === FALSE) {
  echo "This file already exists.";
  exit;
}

$content_manager->new_file($_SESSION['user'], $file_name, $file_path);

echo "File successfully created";
