<?php

$user = $_SESSION['user'];
$current_directory = $_SESSION['current_directory'];
$current_path = $_SESSION['current_path'];

?>

<div div="title" class="d-flex">
  <h1 id="title" class="bg-secondary text-center pt-2 pb-2 m-0 flex-fill">WELCOME TO YOUR CLOUD <?= strtoupper($user) ?></h1>
  <button type="button" name="button" onclick="ajaxRequest('actions/logout.php')">Logout</button>
</div>

<div class="d-flex">
  <div id="side_bar" class="col-3 bg-primary" style="min-height: 100vh">

  </div>

  <div id="main_content" class="col-9 bg-light m-0 p-0" style="min-height: 100vh">
    <div id="breadcrumb" class="bg-dark" style="height: 100px">
      <?php

      $parent_list = explode('/', $current_path);

      foreach ($parent_list as $key => $path) {
        // code...
      }

       ?>
    </div>

    <div id="content" class="bg-info" style="height: 500px">

    </div>
  </div>
</div>
