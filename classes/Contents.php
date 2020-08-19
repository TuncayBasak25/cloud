<?php

class Contents extends MODEL {

  public function __construct() {
    $this->data_base = "tuncayb_cloud";
    $this->table = "contents";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      owner VARCHAR(30) NOT NULL,
      name TEXT NOT NULL,
      full_path TEXT NOT NULL,
      type VARCHAR(30) DEFAULT 'folder',
      category VARCHAR(30),
      extention VARCHAR(10),
      creation_date INT NOT NULL,
      modification_date INT,
      size INT NOT NULL DEFAULT 0,
      locked CHAR(5) DEFAULT 'false',
      hidden CHAR(5) DEFAULT 'false',
      trash CHAR(5) DEFAULT 'false'
    )";
    $this->createDataBase();
    $this->createTable();
  }

  public function new_folder($owner, $name, $full_path) {
    $creation_date = time();
    $this->query("INSERT INTO $this->table (owner, name, full_path, creation_date) VALUES (?,?,?,?)", $owner, $name, $full_path, $creation_date);
  }

  public function new_file($owner, $name, $full_path, $type = 'file') {
    $creation_date = time();
    $this->query("INSERT INTO $this->table (owner, name, full_path) VALUES (?,?,?,?)", $owner, $name, $full_path, $type);
  }

  public function get_content($name, $full_path) {
    return $this->query("SELECT * FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path)->fetch_assoc();
  }

  public function delete_content($name, $full_path) {
    $content = $this->get_content($name, $full_path);
    $this->query("DELETE FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path);
    if ($content['size'] > 0) {
      $parent_list = explode('/', $full_path);
      $parents_path = '';
      foreach ($parent_list as $index => $parent) {
        if ($parents_path !== '') $parents_path .= '/';
        $parents_path .= $parent;
        if ($index < count($parent_list)-1) $this->query("UPDATE $this->table SET size = size - ? WHERE name = ? AND full_path = ?", $content['size'], $parent_list[$index+1], $parents_path);
      }
    }
    $full_path .= '/' . $name;
    if ($content['type'] === 'folder') {
      $this->query("DELETE FROM $this->table WHERE full_path LIKE CONCAT(?,'%')", $full_path);
    }
  }

  public function set_name($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET name = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_full_path($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET full_path = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_type($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET type = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_category($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET category = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_extention($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET extention = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_modification_date($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET modification_date = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_size($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET size = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_locked($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET locked = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_hidden($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET hidden = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_trash($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET trash = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

}
