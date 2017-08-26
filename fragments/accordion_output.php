<?php

$counter      = 0;

$fe_output        = [];
$fe_output_items  = [];
$be_output        = [];
$fe_output_items  = [];

foreach ($this->content_accordion as $item):
  $fe_output_items[] = '
    <div class="card">
      <div class="card-header" role="tab" id="heading'.$counter.'">
        <h5 class="mb-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$counter.'"  aria-expanded="true" aria-controls="collapse'.$counter.'">
              '.html_entity_decode($item['title']).'
          </a>
        </h5>
      </div>

      <div id="collapse'.$counter.'" class="collapse" role="tabpanel" aria-labelledby="heading'.$counter.'">
        <div class="card-block">
           '.html_entity_decode($item['content']).'
        </div>
      </div>

    </div>
    ';

  $be_output_items[] = '
    <div class="form-group">
      <label class="col-sm-3 control-label">Titel</label>
        <div class="col-sm-9">
          <b>'.html_entity_decode($item['title']).'</b>
        </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Text</label>
        <div class="col-sm-9">
          '.html_entity_decode($item['content']).'
        </div>
    </div>
    <hr/>
    ';
  $counter ++;
endforeach;

$fe_output[] = '<div id="accordion" role="tablist" aria-multiselectable="false">';
$fe_output[] = implode($fe_output_items);
$fe_output[] = '</div>';

$be_output[] = '
  <div id="accordion" class="bereichswrapper">
    <div class="form-horizontal output">
      <h2>Accordion</h2>';
$be_output[] = implode($be_output_items);
$be_output[] = '</div></div>

<style>
#accordion .bereichswrapper {
  margin: 5px 0 5px 0;
  background: #f5f5f5;
  padding: 5px 15px 5px 15px;
  border: 1px solid #9da6b2;
}

#accordion .control-label {
  font-weight: normal;
  font-size: 12px;
  margin-top: -6px;
}

#accordion  h2 {
  font-size: 12px !important;
  padding: 0 10px 10px 10px;
  margin-bottom: 15px;
  width: 100%;
  font-weight: bold;
  border-bottom: 1px solid #31404F;
}


</style>

';

if(!rex::isBackend()) {
  echo implode($fe_output);
} else {
  echo implode($be_output);
}

