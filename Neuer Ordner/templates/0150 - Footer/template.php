<!-- /Footer -->
<?php

$path_jquery = '.'.theme_url::base('private/jquery/');
$path_js = theme_url::assets('frontend/js/');

 if (!file_exists($path_js.'combinied.min.js')) {
  $str = file_get_contents($path_jquery.'popper.min.js');
  $str = $str.file_get_contents($path_jquery.'bootstrap.min.js');
  $str = $str.file_get_contents($path_jquery.'jquery.cookiebar.js');
  $str = $str.file_get_contents($path_jquery.'domscript.js');


  if (rex::getProperty('minify_js') == '1') {
    file_put_contents('.'.$path_js.'combinied.min.js',minify_js($str));
  } else {
    file_put_contents('.'.$path_js.'combinied.min.js',$str);
  }
}
?>

<script type="text/javascript" src="<?php echo $path_js.'combinied.min.js'; ?>" ></script>
<script type="text/javascript">

$(document).ready(function(){
  $.cookieBar({
    // forceShow: true,
    message: '{{ Cookie Hinweistext }}',
    acceptText: '{{ Cookie Hinweistext - Button }}'
  });
});

var $buoop = { // Testen mit /#test-bu
  c:2,
  text: "{{ Browser Info }} <span>{{ Browser aktualisieren }}</span></a>"
  };
function $buo_f(){
 var e = document.createElement("script");
 e.src = "//browser-update.org/update.min.js";
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false);}
catch(e){window.attachEvent("onload", $buo_f);}

</script>


</body>
</html>
