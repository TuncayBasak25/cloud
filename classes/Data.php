<?php

class Data extends MODEL {

  public function __construct() {
    $this->data_base = "tuncayb_cloud";
    $this->table = "data";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      owner VARCHAR(30) NOT NULL,
      name TEXT NOT NULL,
      full_path TEXT NOT NULL,
      data MEDIUMBLOB
    )";
    $this->createDataBase();
    $this->createTable();
  }

  public function new_data($owner, $name, $full_path, $data) {
    $this->query("INSERT INTO $this->table (owner, name, full_path) VALUES (?,?,?)", $owner, $name, $full_path);
    $this->set_data($name, $full_path, $data);
  }

  public function get_data($name, $full_path) {
    return $this->query("SELECT data FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path)->fetch_assoc()['data'];
  }

  public function delete_data($name, $full_path) {
    $this->query("DELETE FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path);
  }

  public function set_name($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET name = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_full_path($name, $full_path, $value) {
    $this->query("UPDATE $this->table SET full_path = ? WHERE name = ? AND full_path = ?", $value, $name, $full_path);
  }

  public function set_data($name, $full_path, $data) {
    $this->queryBlob("UPDATE $this->table SET data = ? WHERE name = ? AND full_path = ?", $data, $name, $full_path);
  }

}
