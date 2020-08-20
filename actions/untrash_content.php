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

$content = $content_manager->get_content($_POST['content_name'], $_POST['content_path']);

if ($content['type'] === 'folder') {
  $content_manager->untrash_child($_POST['content_path'] . '/' . $_POST['content_name']);
}

$content_manager->set_trash($_POST['content_name'], $_POST['content_path'], "false");

echo "Content trashed successfully";
