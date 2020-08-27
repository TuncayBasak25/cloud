<?php

class UserModel extends DataBaseModel
{

  public function __construct()
  {
    $this->data_base = "tuncayb_cloud";
    $this->table = "users";
    $this->table_columns = "(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(30) NOT NULL,
      firstname VARCHAR(30),
      lastname VARCHAR(30),
      email VARCHAR(30) NOT NULL,
      password CHAR(60) NOT NULL,
      signup_date INT NOT NULL,
      login_date INT,
      confirmed CHAR(5) DEFAULT 'false',

      log_id INT,
      current_directory TEXT,

      total_space INT DEFAULT 1000000,
      free_space INT DEFAULT 1000000,
      used_space INT DEFAULT 0
    )";
    $this->createDataBase();
    $this->createTable();
  }

  public function new_user($username, $email, $password)
  {
    $signup_date = time();

    $this->connect();

    return $this->query("INSERT INTO $this->table (username, email, password, signup_date) VALUES (?,?,?,?)", $username, $email, $password, $signup_date);
  }

  public function get_user($username_or_email)
  {
    if (strpos($username_or_email, '@') === FALSE) {
      return $this->query("SELECT * FROM $this->table WHERE username = ?", $username_or_email)->fetch_assoc();
    }
    else {
      return $this->query("SELECT * FROM $this->table WHERE email = ?", $username_or_email)->fetch_assoc();
    }
  }

  public function get_user_by($column_name, $column_value)
  {
    $this->connect();

    return $this->query("SELECT * FROM $this->table WHERE $column_name = ?", $column_value)->fetch_assoc();
  }

  public function delete_user($username_or_email)
  {
    $this->connect();

    if (strpos($username_or_email, '@') === FALSE) {
      return $this->query("DELETE FROM $this->table WHERE username = ?", $username_or_email);
    }
    else {
      return $this->query("DELETE FROM $this->table WHERE email = ?", $username_or_email);
    }
  }

  public function set_user_name($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET username = ? WHERE username = ?", $value, $username);
  }

  public function set_user_firstname($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET firstname = ? WHERE username = ?", $value, $username);
  }

  public function set_user_lastname($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET lastname = ? WHERE username = ?", $value, $username);
  }

  public function set_user_email($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET email = ? WHERE username = ?", $value, $username);
  }

  public function set_user_password($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET password = ? WHERE username = ?", $value, $username);
  }

  public function set_user_login_date($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET login_date = ? WHERE username = ?", $value, $username);
  }

  public function confirm_user($username)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET confirmed = ? WHERE username = ?", 'true', $username);
  }

  public function set_user_log_id($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET log_id = ? WHERE username = ?", $value, $username);
  }

  public function set_user_total_space($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET total_space = ? WHERE username = ?", $value, $username);
  }

  public function set_user_free_space($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET free_space = ? WHERE username = ?", $value, $username);
  }

  public function set_user_used_space($username, $value)
  {
    $this->connect();

    return $this->query("UPDATE $this->table SET used_space = ? WHERE username = ?", $value, $username);
  }

}
