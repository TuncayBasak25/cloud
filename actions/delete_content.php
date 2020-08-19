<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";
$content_manager = new Contents();
$data_manager = new Data();

if (isset($_POST['content_name']) === FALSE || empty($_POST['content_name']) === TRUE) {
  echo "Content name is missing or empty";
  exit;
}

if (isset($_POST['content_path']) === FALSE || empty($_POST['content_path']) === TRUE) {
  echo "Content path is missing or empty";
  exit;
}

$content = $content_manager->get_content($_POST['content_name'], $_POST['content_path']);

$content_manager->delete_content($_POST['content_name'], $_POST['content_path']);

if ($content['size'] > 0 && $content['type'] !== 'folder') {
  $data_manager->delete_data($_POST['content_name'], $_POST['content_path']);
}

if ($content['size'] > 0) {
  $parents = explode('/', $_POST['content_path']);
  $parent_path = '';
  foreach ($parents as $index => $parent) {
    if ($parent !== $_SESSION['user']) {
      $content_manager->decrease_size($parent, $parent_path, $content['size']);
    }
    if ($parent_path !== '') {
      $parent_path .= '/';
    }
    $parent_path .= $parent;
  }
}

if ($content['type'] === 'folder') {
  $content_manager->delete_child($_POST['content_path'] . '/' . $_POST['content_name']);
  $data_manager->delete_child($_POST['content_path'] . '/' . $_POST['content_name']);
}

echo "Content deleted successfully";
