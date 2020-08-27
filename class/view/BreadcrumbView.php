<?php

class BreadcrumbView
{

  public static function display()
  {
    $current_directory = $_SESSION['current_directory'];

    ?>
    <section id="breadcrumb" class="bg-dark" style="height: 100px">
      <?php

      $parent_list = explode('/', $current_directory);

      foreach ($parent_list as $key => $path) {
        // code...
      }

       ?>
    </section>
    <?php
  }

}
