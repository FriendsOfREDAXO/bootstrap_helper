<?php

  $items_textarea   = rex_var::toArray("REX_VALUE[1]");
  $textarea         = new rex_fragment();
  $textarea->setVar('content_textarea', $items_textarea);

  $items_accordion   = rex_var::toArray("REX_VALUE[2]");
  $accordion         = new rex_fragment();
  $accordion->setVar('content_accordion',$items_accordion);

if(!rex::isBackend()) {
  echo '<div class="container">';
    echo '<div class="row">';
      echo '<div class="col-sm-6">';
        echo  $textarea->parse('textarea_output.php');
      echo '</div>';
      echo '<div class="col-sm-6">';
        echo  $accordion->parse('accordion_output.php');
      echo '</div>';
    echo '</div>';
  echo '</div>';
} else {
  echo  $textarea->parse('textarea_output.php');
  echo  $accordion->parse('accordion_output.php');
}

