<?php

class ContentController
{

  public static function newFile($file_name, $file_path, $data)
  {
    $contentModel = new ContentModel();
    $dataModel = new DataModel();

    if (isset($data) === TRUE) {
      $category_type = explode('/', $data['type']);
      $file_category = $category_type[0];
      $file_type = $category_type[1];

      if (strpos($data['name'], '.') !== FALSE) {
        $tmp = explode('.', $data['name']);
        $file_extention = end($tmp);
      }
    }

    if (empty($contentModel->get_content($file_name, $file_path)) === FALSE) {
      echo "This file already exists.";
      return FALSE;
    }

    $contentModel->new_content($_SESSION['username'], $file_name, $file_path);

    $contentModel->set_type($file_name, $file_path, $file_type);
    $contentModel->set_category($file_name, $file_path, $file_category);
    $contentModel->set_extention($file_name, $file_path, $file_extention);

    if ($data['size'] > 0) {
      $file_data = file_get_contents($data['tmp_name']);
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

      $dataModel->new_data($_SESSION['user'], $file_name, $file_path, $file_data);
    }

    echo "File successfully created";
    return TRUE;
  }

  public static function newFolder($name, $path)
  {
    $contentModel = new ContentModel();
    $dataModel = new DataModel();

    if (empty($contentModel->get_content($name, $path)) === FALSE) {
      echo "This file already exists.";
      return FALSE;
    }

    $contentModel->new_content($_SESSION['username'], $name, $path);

    $contentModel->set_type($name, $path, "folder");

    $content = $contentModel->get_content($name, $path);

    ContentView::display($content);

    return TRUE;
  }

}
