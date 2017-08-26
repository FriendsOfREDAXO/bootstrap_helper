<?php

$fe_output    = [];
$be_output    = [];

foreach ($this->content_textarea as $item):
  $fe_output[] = html_entity_decode($item['text']);
  $be_output[] = '
    <div class="form-group">
      <label class="col-sm-3 control-label">Text</label>
        <div class="col-sm-9">
          '.html_entity_decode($item['text']).'
        </div>
    </div>';
endforeach;

if(!rex::isBackend()) {
  echo implode($fe_output);
} else {
  echo implode($be_output);
}
