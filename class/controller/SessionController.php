<?php

class SessionController
{

  public static function login($user_id, $password)
  {
    $userModel = new UserModel();
    $contentModel = new ContentModel();

    $userData = $userModel->get_user($user_id);
    if (empty($userData) === TRUE) {
      echo "!User id is wrong.";
      return FALSE;
    }

    if (password_verify($password, $userData['password']) === FALSE) {
      echo "!Wrong Password.";
      return FALSE;
    }

    $time = time();
    $_SESSION['username'] = $userData['username'];
    $_SESSION['current_directory'] = $userData['current_directory'];
    $_SESSION['log_id'] = $time;
    $userModel->set_user_log_id($userData['username'], $time);
    $userModel->set_user_login_date($userData['username'], $time);

    $content_list = $contentModel->get_folder_content($userData['username']);

    HomeView::display($content_list);
  }

  public static function logout()
  {
    $userModel = new UserModel();

    $userModel->set_user_log_id($_SESSION['username'], 0);
    session_destroy();

    LoginView::display();
  }

  public static function refresh()
  {
    $userModel = new UserModel();

    $userData = $userModel->get_user($_SESSION['username']);
    $time = time();

    if ($time - $user['login_date'] > 1800) { //If no connection established since 30 minute
      $userModel->set_user_log_id($username, 0);
      session_destroy();

      LoginView::display();
      return FALSE;
    }
    else {
      $userModel->set_user_login_date($username, $time); //Refresh user login date stay connected
      return TRUE;
    }
  }
}
