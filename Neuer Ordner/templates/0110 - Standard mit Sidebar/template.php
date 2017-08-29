REX_TEMPLATE[2]
   <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
          <div id="mainnavigation_medium">
            <?php
              // $nav = rex_ycom_navigation::factory();
              $nav = rex_navigation::factory();
              $nav->addFilter("cat_navigationstyp","/\|main\|/","regex");
              $nav_main = $nav->get(0,2,TRUE,TRUE);
              unset($nav);
              echo $nav_main;
            ?>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

<            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                             <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>

              REX_ARTICLE[]


<footer id="footer" class="footer">
  <div class="container">

    <div class="row">
      <div class="col-md-4">
        <p><strong>{{ Footer Navi }}</strong></p>
        <?php
          // $nav = rex_ycom_navigation::factory();
          $nav = rex_navigation::factory();
          $nav->addFilter("cat_navigationstyp","/\|footer\|/","regex");
          $nav_footer = $nav->get(0,2,TRUE,TRUE);
          unset($nav);
          echo $nav_footer;
        ?>
      </div>

    </div>
  </div>
</footer>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
     <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>







<div id="scrollup"><span>{{ TOP }}</span></div>
REX_TEMPLATE[4]
