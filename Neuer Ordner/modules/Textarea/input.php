<?php
/*
$id = 1;
$mform = new MForm();
$mform->addFieldset('Modal (nur Text)');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));
$mform->addTextAreaField("$id.0.content", array('label'=>'Text'));
echo $mform->show();
*/
  $items = rex_var::toArray("REX_VALUE[1]");
  $fragment = new rex_fragment();
  $fragment->setVar('content',$items);
  echo $fragment->parse('select_grid.php');


