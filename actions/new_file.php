<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";
$user_manager = new Users();
$content_manager = new Contents();
$data_manager = new Data();

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

if (isset($_FILES['file']) === TRUE) {
  $category_type = explode('/', $_FILES['file']['type']);
  $file_category = $category_type[0];
  $file_type = $category_type[1];

  if (strpos($_FILES['file']['name'], '.') !== FALSE) {
    $tmp = explode('.', $_FILES['file']['name']);
    $file_extention = end($tmp);
  }

  if ($_FILES['file']['size'] > 0) {
    $file_size = $_FILES['file']['size'];
    $file_data = file_get_contents($_FILES['file']['tmp_name']);
  }
}

if (isset($_POST['file_type']) === TRUE && empty($_POST['file_type']) === FALSE) {
  $file_type = $_POST['file_type'];
}

if (isset($_POST['file_category']) === TRUE && empty($_POST['file_category']) === FALSE) {
  $file_category = $_POST['file_category'];
}

if (isset($_POST['file_extention']) === TRUE && empty($_POST['file_extention']) === FALSE) {
  $file_extention = $_POST['file_extention'];
}


if (empty($content_manager->get_content($file_name, $file_path)) === FALSE) {
  echo "This file already exists.";
  exit;
}


$content_manager->new_file($_SESSION['user'], $file_name, $file_path);

if (isset($file_type) === TRUE) $content_manager->set_type($file_name, $file_path, $file_type);
if (isset($file_category) === TRUE) $content_manager->set_category($file_name, $file_path, $file_category);
if (isset($file_extention) === TRUE) $content_manager->set_extention($file_name, $file_path, $file_extention);
if (isset($file_size) === TRUE) {
  $content_manager->set_size($file_name, $file_path, $file_size);
  $parents = explode('/', $file_path);
  $parent_path = '';
  foreach ($parents as $index => $parent) {
    if ($parent !== $_SESSION['user']) {
      $content_manager->increase_size($parent, $parent_path, $file_size);
    }
    if ($parent_path !== '') {
      $parent_path .= '/';
    }
    $parent_path .= $parent;
  }
  $data_manager->new_data($_SESSION['user'], $file_name, $file_path, $file_data);
}

echo "File successfully created";
