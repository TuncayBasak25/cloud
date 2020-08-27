<?php

class UserController
{

  public static function signup($username, $email, $password, $password_repeat, $firstname = '', $lastname = '') {
    $userModel = new UserModel();

    if (empty($username) === TRUE) {
      echo "Username is empty.";
      return FALSE;
    }

    if (strlen($username) < 4) {
      echo "Username cannot be less than 4 charachter";
      return FALSE;
    }

    if (strlen($username) > 30) {
      echo "Username cannot contain more than 30 charachter";
      return FALSE;
    }

    if ($username[0] === '_' || $username[0] === '-') {
      echo "Username cannot begin with - or _";
      return FALSE;
    }

    $allowed = ["_", "-"];
    $cache_username = str_replace($allowed, '', $username);
    if (ctype_alnum($cache_username) === FALSE) {
      echo "Username must contain only alphanumerical charachter with _ - allowed.";
    }

    if (empty($userModel->get_user($username)) === FALSE) {
      echo "This username is already taken.";
      return FALSE;
    }

    if (empty($firstname) === FALSE) {
      if (strlen($firstname) > 30) {
        echo "Firstname connot contain more than 30 charachter.";
        return FALSE;
      }
      if (ctype_alpha($firstname) === FALSE) {
        echo "Firstname must contain only alphabetic charachter.";
        return FALSE;
      }
    }

    if (empty($lastname) === FALSE) {
      if (strlen($lastname) > 30) {
        echo "Firstname connot contain more than 30 charachter.";
        return FALSE;
      }
      if (ctype_alpha($lastname) === FALSE) {
        echo "Firstname must contain only alphabetic charachter.";
        return FALSE;
      }
    }

    if (empty($email) === TRUE) {
      echo "Email is empty.";
      return FALSE;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
      echo "This email is unvalid.";
      return FALSE;
    }

    if (empty($userModel->get_user($email)) === FALSE) {
      echo "This email is already taken.";
      return FALSE;
    }

    if (empty($password) === TRUE) {
      echo "Password is empty.";
      return FALSE;
    }

    if (empty($password_repeat) === TRUE) {
      echo "Password repeat is empty.";
      return FALSE;
    }

    if ($password !== $password_repeat) {
      echo "Please enter the same password.";
      return FALSE;
    }

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $userModel->new_user($username, $email, $hashed_pass);

    if (isset($firstname) === TRUE) {
      $userModel->set_user_firstname($username, $firstname);
    }

    if (isset($lastname) === TRUE) {
      $userModel->set_user_lastname($username, $lastname);
    }

    echo "Signup successfull";

    return TRUE;
  }

}
