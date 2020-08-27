<?php

session_start();

if (isset($_POST['request']) === FALSE || empty($_POST['request']) {
  echo "!There is no request.";
  exit;
}

MainController::execute($_POST);
