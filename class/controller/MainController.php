<?php
//Recive an order and inputs by ajax request, and call other controller to perform actions
class MainController
{

  public static function execute($inputs, $datas) {
    $request = $inputs['request'];

    if ($request === "login") {
      SessionController::login($inputs['user_id'], $inputs['password']);
    }
    else if ($request === "signup") {
      UserController::signup($inputs['username'], $inputs['email'], $inputs['password'], $inputs['password_repeat']);
    }
  }

}
