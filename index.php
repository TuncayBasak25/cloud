<?php

include "include/header.php";



$_SESSION['username'] = 'tuncay';

MainController::execute(array('request' => "first_load"));











include "include/footer.php";
