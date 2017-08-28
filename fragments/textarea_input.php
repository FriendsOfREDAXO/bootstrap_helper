<?php

$id = 1;
$mform = new MForm();
$mform->addFieldset('Text');
$mform->addTextAreaField("$id.0.text", array('label'=>'Text', 'class'=>"redactorEditor2-full", 'id'=>'redactor_0'.$id));
echo $mform->show();
