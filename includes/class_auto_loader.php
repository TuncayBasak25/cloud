<?php


spl_autoload_register('class_auto_loader');

function class_auto_loader($class_name) {

  $folder = "classes/";
  $extention = ".php";
  $full_path = $folder . $class_name . $extention;

  require_once $full_path;
}
