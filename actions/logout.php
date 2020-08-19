<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";
$user_manager = new Users();

$user_manager->set_user_log_id($_SESSION{'user'}, 0);

session_destroy();
