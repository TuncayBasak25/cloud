<?php

class ContentBoardView
{

  public static function display($content_list)
  {
    ?>
    <section id="content_board" onmousedown="contentBoardMouseDown(this)" onmouseup="contentBoardMouseUp(this)" onmousemove="mouseMoveOnMainBoard()" class="bg-info" style="height: 500px">
      <div id="rc_menu" class="" style="display: none; position: absolute; background-Color: purple;">
            <p class="rc_menu_item" onclick="newFolder('<?= $_SESSION['username'] ?>', 'board_view')">New Folder</p>
            <p class="rc_menu_item">New File</p>
            <p class="rc_menu_item">Select All</p>
      </div>
      <div id="board_view" class="content_folder row" style="width: 100%; height: 100%">
        <?php
        if (empty($content_list) === FALSE) {
          foreach ($content_list as $key => $content) {

            ContentView::display($content);

          }
        }
         ?>
      </div>
    </section>
    <?php
  }

}
