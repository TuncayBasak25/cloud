<?php
session_start();
chdir("..");
include "includes/class_auto_loader.php";
$user_manager = new Users();
