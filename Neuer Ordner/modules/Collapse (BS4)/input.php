<?php
$id = 1;
$mform = new MForm();
$mform->addFieldset('FAQ');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));
$mform->addTextAreaField("$id.0.content", array('label'=>'Text'));
echo MBlock::show($id, $mform->show(), array('min'=>1,'max'=>50));
?>
