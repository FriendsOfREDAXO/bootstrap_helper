<?php

$file = rex_file::get(rex_path::addon('bootstrapbootstrap_helper','license.md'));
$Parsedown = new Parsedown();
$content =  "Inhalt folgt"; // $Parsedown->text($file);


$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('bootstrap_helper_snippets'), false);
$fragment->setVar('body', $content, false);
echo '<div id="bootstrap-helper-addon-wrapper">'.$fragment->parse('core/page/section.php').'</div>';
