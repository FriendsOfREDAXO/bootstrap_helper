<?php

// echo '<img class="img-responsive" src="'.$this->getAssetsUrl("images//bootstrap-solid.svg"). '" width="200px" />';

$file = rex_file::get(rex_path::addon('bootstrap','readme.md'));
$Parsedown = new Parsedown();
$content =  $Parsedown->text($file);


$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('info'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
