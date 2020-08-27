<?php

class HomeView
{

  public static function display($content_list)
  {

    HeaderView::display();

    ?>

    <section id="main_body" class="d-flex">

      <?php

        SideMenuView::display();

       ?>

      <section id="main_content" class="col-9 bg-light m-0 p-0" style="min-height: 100vh">

        <?php

          BreadcrumbView::display();

          ContentBoardView::display($content_list);

         ?>

      </section>
    </section>

    <?php
  }

}
