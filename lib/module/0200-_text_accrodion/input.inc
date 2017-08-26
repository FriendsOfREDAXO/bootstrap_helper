<?php

  // Textarea
  $textarea = new rex_fragment();
  $textarea->setVar('content_textarea','REX_VALUE[1]');

  // Accordion
  $items_accordion = rex_var::toArray("REX_VALUE[2]");
  $accordion = new rex_fragment();
  $accordion->setVar('content_accordion',$items_accordion);


if(rex_addon::get('mform')->isAvailable() && rex_addon::get('mblock')->isAvailable() && rex::isBackend()) {

  echo '<ul class="nav nav-tabs">';
  echo '<li><a data-toggle="tab" href="#bereich1">Text</a></li>';
  echo '<li><a data-toggle="tab" href="#bereich2">Accordion</a></li>';

  echo '</ul>';

  echo '<div class="tab-content">';
  echo '<div id="bereich1" class="tab-pane fade in active">';
  echo $textarea->parse('textarea_input.php');
  echo '</div>';
  echo '<div id="bereich2" class="tab-pane fade ">';
  echo $accordion->parse('accordion_input.php');
  echo '</div>';
  echo '</div>';

} else {
    echo '<div style="padding:15px; color: #fff;" class="bg-danger">Diese Modul benötigt zwingend die AddOns <strong>mForm</strong> und <strong>mBlock</strong>!</div>';
}




