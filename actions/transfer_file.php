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

if (isset($_POST['file_name']) === FALSE || empty($_POST['file_name']) === TRUE) {
  echo "File name is missing or empty.";
  exit;
}

if (isset($_POST['file_path']) === FALSE || empty($_POST['file_path']) === TRUE) {
  echo "File path is missing or empty.";
  exit;
}

if (isset($_POST['new_path']) === FALSE || empty($_POST['new_path']) === TRUE) {
  echo "New path is missing or empty.";
}

$file = $content_manager->get_content($_POST['file_name'], $_POST['file_path']);

if ($file['size'] > 0) {
  $parents = explode('/', $_POST['file_path']);
  $parent_path = '';
  foreach ($parents as $index => $parent) {
    if ($parent !== $_SESSION['user']) {
      $content_manager->decrease_size($parent, $parent_path, $file['size']);
    }
    if ($parent_path !== '') {
      $parent_path .= '/';
    }
    $parent_path .= $parent;
  }

  $parents = explode('/', $_POST['new_path']);
  $parent_path = '';
  foreach ($parents as $index => $parent) {
    if ($parent !== $_SESSION['user']) {
      $content_manager->increase_size($parent, $parent_path, $file['size']);
    }
    if ($parent_path !== '') {
      $parent_path .= '/';
    }
    $parent_path .= $parent;
  }
}

$content_manager->set_full_path($_POST['file_name'], $_POST['file_path'], $_POST['new_path']);
$data_manager->set_full_path($_POST['file_name'], $_POST['file_path'], $_POST['new_path']);




echo "File transfered succesfully";
