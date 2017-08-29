<?php

  $items = rex_var::toArray("REX_VALUE[1]");
  $fragment = new rex_fragment();
  $fragment->setVar('content',$items);
  echo '<div class="container">'.$fragment->parse('modal_bs4.php').'</div>';



