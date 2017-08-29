<?php

echo $this->textareaid;
$id = $this->textareaid;
$mform = new MForm();
$mform->addFieldset('Text');
$mform->addTextAreaField("$id.0.text", array('label'=>'Text', 'class'=>"redactorEditor2-simple", 'id'=>'redactor_0'.$id));
echo $mform->show();
