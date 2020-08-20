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

if (isset($_POST['folder_name']) === FALSE || empty($_POST['folder_name']) === TRUE) {
  echo "Folder name is missing or empty.";
  exit;
}

if (isset($_POST['folder_path']) === FALSE || empty($_POST['folder_path']) === TRUE) {
  echo "Folder path is missing or empty.";
  exit;
}

if (isset($_POST['new_path']) === FALSE || empty($_POST['new_path']) === TRUE) {
  echo "New path is missing or empty.";
}

$folder = $content_manager->get_content($_POST['folder_name'], $_POST['folder_path']);

if ($folder['size'] > 0) {
  $parents = explode('/', $_POST['folder_path']);
  $parent_path = '';
  foreach ($parents as $index => $parent) {
    if ($parent !== $_SESSION['user']) {
      $content_manager->decrease_size($parent, $parent_path, $folder['size']);
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
      $content_manager->increase_size($parent, $parent_path, $folder['size']);
    }
    if ($parent_path !== '') {
      $parent_path .= '/';
    }
    $parent_path .= $parent;
  }
}

$content_manager->set_full_path($_POST['folder_name'], $_POST['folder_path'], $_POST['new_path']);

$content_manager->transfer_child($_POST['folder_path'] . '/' . $_POST['folder_name'], $_POST['new_path'] . '/' . $_POST['folder_name']);
$data_manager->transfer_child($_POST['folder_path'] . '/' . $_POST['folder_name'], $_POST['new_path'] . '/' . $_POST['folder_name']);


echo "Folder transfered succesfully";
