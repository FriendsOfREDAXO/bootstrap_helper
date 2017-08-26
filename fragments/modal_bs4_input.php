<?php

$id = 1;
$mform = new MForm();
$mform->addTab('Bereich 1');
$mform->addFieldset('Modal');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));
$mform->addTextAreaField("$id.0.content", array('label'=>'Text'));
$mform->addTab('Bereich 2');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));

$mform->addTab('Bereich 3');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));

$mform->addTab('Bereich 4');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));



$mform->addTab('Weitere Einstellungen');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));


$mform->addTab('Anleitung');
$mform->addTextField("$id.0.title", array('label'=>'Titel'));



echo $mform->show();


