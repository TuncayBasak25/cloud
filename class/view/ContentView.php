<?php

class ContentView
{

  public static function display($content)
  {
    ?>

    <div class="content_icon col-1">
      <?= $content['name'] ?>
    </div>

    <?php
  }

}
