<?php
session_start();
chdir("..");
require_once "includes/class_auto_loader.php";
$user_manager = new Users();
$content_manager = new Contents();

if ($user_manager->refresh_connection($_SESSION['user'], $_SESSION['log_id']) === FALSE) {
  echo "Your login is timed out please loggin again.";
  exit;
}

if (isset($_POST['folder_name']) === FALSE || empty($_POST['folder_name']) === TRUE) {
  echo "Folder name is missing or empty.";
  exit;
}
$folder_name = $_POST['folder_name'];

if (isset($_POST['folder_path']) === FALSE || empty($_POST['folder_path']) === TRUE) {
  echo "Folder path is missing or empty.";
  exit;
}
$folder_path = $_POST['folder_path'];

if (empty($content_manager->get_content($folder_name, $folder_path)) === FALSE) {
  echo "This folder already exists.";
  exit;
}

$content_manager->new_folder($_SESSION['user'], $folder_name, $folder_path);

echo "Folder successfully created";
