<?php
$id=1;
$mform = new MForm();
$mform->addFieldset('Akkordeon für Textelemente');
$mform->addTextField("$id.0.titel", array('label'=>'Überschrift / Titel'));
$mform->addTextAreaField("$id.0.text", array('label'=>'Texteingabe', 'class'=>"redactorEditor2-full", 'id'=>'redactor_0'.$id));
echo MBlock::show($id, $mform->show(), array('min'=>1,'max'=>40)); 