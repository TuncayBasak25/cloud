<?php

class Data extends DataBaseModel
{

  public function __construct()
  {
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

    $this->connect();
    
    $this->createTable();
  }

  public function new_data($owner, $name, $full_path, $data)
  {
    $this->connect();

    $this->query("INSERT INTO $this->table (owner, name, full_path) VALUES (?,?,?)", $owner, $name, $full_path);

    return $this->set_data($name, $full_path, $data);
  }

  public function get_data($name, $full_path)
  {
    $this->connect();

    return $this->query("SELECT data FROM $this->table WHERE name = ? AND full_path = ?", $name, $full_path)->fetch_assoc()['data'];
  }

  public function delete_data($name, $full_path)
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

  public function set_data($name, $full_path, $data)
  {
    $this->connect();

    return $this->queryBlob("UPDATE $this->table SET data = ? WHERE name = ? AND full_path = ?", $data, $name, $full_path);
  }

}
