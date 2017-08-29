REX_TEMPLATE[2]



<header>
  <div class="container-fluid">
    <div class="row">
      <div id="headernavi">
        <div class="container">
          <a href="javascript:void(0);" id="navopenclose" class="closed"><span>{{ Menü }}</span></a>
          <div class="logo"><a href="/" title="{{ link auf dem logo }}">{{ link auf dem logo }}</a></div>
          <div id="metanavigation_header">
            <?php
              // $nav = rex_ycom_navigation::factory();
              $nav = rex_navigation::factory();
              $nav->addFilter("cat_navigationstyp","/\|header\|/","regex");
              $nav_header = $nav->get(0,2,TRUE,TRUE);
              unset($nav);
              echo $nav_header;
            ?>
          </div>
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
      </div>
    </div>
  </div>
</header>
<section id="mainnavigation_small" >
  <div class="container">
  <?php
    // $nav = rex_ycom_navigation::factory();
    $nav = rex_navigation::factory();
    $nav->addFilter("cat_navigationstyp","/\|main\|/","regex");
    $nav_mobile = $nav->get(0,-1,TRUE,TRUE);
    unset($nav);
    echo $nav_mobile;
  ?>
  </div>
</section>



<section id="content" class="section">
    REX_ARTICLE[]



</section>
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
      <div class="col-md-4">
        sdfgdfgf
      </div>
      <div class="col-md-4">
        dsvfsdfdsf
      </div>
    </div>
  </div>
</footer>



<div id="scrollup"><span>{{ TOP }}</span></div>
REX_TEMPLATE[4]
