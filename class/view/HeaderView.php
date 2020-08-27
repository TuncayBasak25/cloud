<?php

class HeaderView
{

  public static function display()
  {
    $username = $_SESSION['username'];

    ?>
    <header id="header" class="d-flex">
      <h1 id="main_title" class="bg-secondary text-center pt-2 pb-2 m-0 flex-fill">WELCOME TO YOUR CLOUD <?= strtoupper($username) ?></h1>
      <button id="logout_button" type="button" name="request" value="logout" onclick="ajaxRequest('action/ajaxRequest.php', 'logout')">Logout</button>
    </header>
    <?php
  }

}
