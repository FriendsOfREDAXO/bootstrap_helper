<?php

$id = 2;
$mform = new MForm();
$mform->addFieldset('Accordion');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));
$mform->addTextAreaField("$id.0.content", array('label'=>'Text', 'class'=>"redactorEditor2-full", 'id'=>'redactor_0'.$id));
echo MBlock::show($id, $mform->show(), array('min'=>1,'max'=>30));
