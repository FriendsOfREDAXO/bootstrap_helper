<?php

$content = '';


if (rex_post('config-submit', 'boolean')) {
    $this->setConfig(rex_post('config', [
        ['headsupgrid_config', 'string'],
        ['headsupgrid_aktiv', 'string'],
    ]));

    $content .= rex_view::info('Änderung gespeichert');
}

$content .= '
<form action="'.rex_url::currentBackendPage().'" method="post" id="headsupgrid_settings">
    <div class="container-fluid">
      <div class="col-xs-12 col-sm-3">
        <input class="rex-form-text" type="checkbox" id="rex-form-headsupgrid_aktiv" name="config[headsupgrid_aktiv]" value="1" ';

          if($this->getConfig('headsupgrid_aktiv')=="1") $content .= 'checked="checked"';
          $content .= ' />
          <label for="rex-form-headsupgrid_aktiv">'.$this->i18n("headsupgrid_aktiv").'</label>
          <br/><br/>
      </div>
      <div class="col-xs-12 col-sm-3">
          <button class="btn btn-save" type="submit" name="config-submit" value="1" title="'.$this->i18n('com_auth_config_save').'">'.$this->i18n('headsupgrid_save').'</button>
          <br/><br/>
      </div>
      <div class="col-xs-12 col-sm-6">
        <p>Infos zu den Einstellungen finden sich auf der Webseite: <a target="_blank" href="http://bohemianalps.com/tools/grid/">http://bohemianalps.com/tools/grid/</a> </p>

         <textarea id="headsupgrid_config" name="config[headsupgrid_config]">'.$this->getConfig('headsupgrid_config').'</textarea>
      </div>
    </div>
</form>
';

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $this->i18n('headsupgrid_settings'));
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');


?>
<style>

#headsupgrid_settings textarea {
  width: 100%;
  height: 400px;
  margin: 0 0 15px 0;
}

#headsupgrid_settings label {
    font-weight: normal;
}

#headsupgrid_settings input[type=checkbox] {
    display: none;
}

#headsupgrid_settings input[type=checkbox] + label:before {
    font-family: FontAwesome;
    font-size: 20px;
    width: 30px;
    text-align: center;
    border-radius: 3px;
    background: #E9ECF2;
    border: 1px solid #c3c9d4;
    display: inline-block;
    margin-right: 10px;
}

#headsupgrid_settings input[type=checkbox] + label:before {
    padding-left: 2px;
    color: #c3c9d4;
    content: "\f00d";
}

#headsupgrid_settings input[type=checkbox] + label:before {
}

#headsupgrid_settings input[type=checkbox]:checked + label:before {
    padding-left: 2px;
    color: #3CB594;
    content: "\f00c";
}

#headsupgrid_settings input[type=checkbox]:checked + label:before {
}
</style>


