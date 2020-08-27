<?php

class ContentModel extends DataBaseModel
{

  public function __construct()
  {
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
      data MEDIUMBLOB,
      locked CHAR(5) DEFAULT 'false',
      hidden CHAR(5) DEFAULT 'false',
      trash CHAR(5) DEFAULT 'false'
    )";

    $this->connect();

    $this->createDataBase();
    $this->createTable();
  }

  public function new_content($owner, $name, $full_path)
  {
    $creation_date = time();

    $this->connect();

    return $this->query("INSERT INTO $this->table (owner, name, full_path, creation_date, modification_date) VALUES (?,?,?,?,?)", $owner, $name, $full_path, $creation_date, $creation_date);
  }

  public function get_content($name, $full_path)
  {
    $this->connect();

    return $this->query("SELECT * FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path)->fetch_assoc();
  }

  public function delete_content($name, $full_path)
  {
    $this->connect();

    return $this->query("DELETE FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path);
  }

  public function delete_child($path)
  {
    $this->connect();

    return $this->query("DELETE FROM $this->table WHERE full_path LIKE CONCAT(?,'%')", $path);
  }

  public function set_name($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET name = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_full_path($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET full_path = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function transfer_child($old_path, $new_path)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET full_path = REPLACE(full_path, ?, ?) WHERE full_path LIKE CONCAT(?,'%')", $old_path, $new_path, $old_path);
  }

  public function set_type($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET type = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_category($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET category = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_extention($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET extention = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_modification_date($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET modification_date = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_size($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET size = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function increase_size($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET size = size + ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function decrease_size($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET size = size - ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_locked($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET locked = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_hidden($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET hidden = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_trash($name, $full_path, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET trash = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function trash_child($path)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET trash = ? WHERE full_path LIKE CONCAT(?,'%')", "true", $path);
  }

  public function untrash_child($path)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET trash = ? WHERE full_path LIKE CONCAT(?,'%')", "false", $path);
  }

}
