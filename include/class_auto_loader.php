<?php


spl_autoload_register('class_auto_loader');

function class_auto_loader($class_name) {
  $sub_folder = "other/";

  if (substr($class_name, -4) === "View") {
    $sub_folder = "view/";
  }
  else if (substr($class_name, -5) === "Model") {
    $sub_folder = "model/";
  }
  else if (substr($class_name, -4) === "Cont") {
    $sub_folder = "controller/";
  }
  else if (substr($class_name, -3) === "INT") {
    $sub_folder = "interface/";
  }
  else if (substr($class_name, -3) === "STG") {
    $sub_folder = "strategy/";
  }
  else if (substr($class_name, -3) === "ABS") {
    $sub_folder = "abstract/";
  }

  $main_folder = "classes/";
  $extention = ".php";
  $full_path = $main_folder . $sub_folder . $class_name . $extention;

  require_once $full_path;
}
