<?php



$file = rex_file::get(rex_path::addon('bootstrap','readme.md'));
$Parsedown = new Parsedown();
$content =  $Parsedown->text($file);


$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('body', $content, false);
echo '<div style="width: 100%; background: #563D7C; text-align: left;"><img src="../assets/addons/bootstrap/images/bootstrap_logo.jpg" style="max-width: 120px" /></div>';
echo $fragment->parse('core/page/section.php');
