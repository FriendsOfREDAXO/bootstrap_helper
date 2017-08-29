<?php

  $items = rex_var::toArray("REX_VALUE[1]");
  $fragment = new rex_fragment();
  $fragment->setVar('content_accordion',$items);
  echo $fragment->parse('accordion_output.php');




