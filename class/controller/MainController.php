<?php
//Recive an order and inputs by ajax request, and call other controller to perform actions
class MainController
{

  public static function execute($inputs, $data = FALSE) {
    $request = $inputs['request'];


    if ($request === "first_load" && isset($_SESSION['username']) === TRUE) {
      ?>
      <script type="text/javascript">
        let connectedAs = '<?= $_SESSION['username'] ?>';
      </script>
      <?php
    }
    else if ($request === "refresh") {
      SessionController::refresh();
    }
    else if ($request === "login") {
      SessionController::login($inputs['user_id'], $inputs['password']);
    }
    else if ($request === "logout") {
      SessionController::logout();
    }
    else if ($request === "signup") {
      UserController::signup($inputs['username'], $inputs['email'], $inputs['password'], $inputs['password_repeat']);
    }
    else if ($request === "new_folder") {
      ContentController::newFolder($inputs['name'], $inputs['path']);
    }
    else {
      echo "Request $request is not implemented";
    }
  }

}
