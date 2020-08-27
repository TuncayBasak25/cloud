<?php

class ContentView
{

  public static function display($content)
  {
    ?>

    <div class="content_icon col-1" style="outline: 3px solid black; outline-offset: -3px; background-color: yellow">
      <?= $content['name'] ?>
    </div>

    <?php
  }

}
