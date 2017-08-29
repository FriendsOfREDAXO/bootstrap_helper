<?php

if(!rex_addon::get('markitup')->isAvailable() && !rex_addon::get('rex_redactor2')->isAvailable()) {
    echo rex_view::error('Dieses Modul ben&ouml;tigt das "MarkItUp" oder das "Redactor 2" Addon!');
}

if (rex_addon::get('markitup')->isAvailable() && !markitup::profileExists('simple')) {
  markitup::insertProfile('simple', 'Angelegt durch das Addon Modulsammlung', 'textile', 300, 800, 'relative', 'bold,italic,underline,deleted,quote,sub,sup,code,unorderedlist,grouplink[internal|external|mailto]');
}

if (rex_addon::get('rex_redactor2')->isAvailable() && !rex_redactor2::profileExists('simple')) {
    rex_redactor2::insertProfile('simple', 'Angelegt durch das Addon Modulsammlung', '300', '800', 'relative','bold, italic, underline, deleted, sub, sup,  unorderedlist, orderedlist, grouplink[email|external|internal|media], cleaner');
}

$values = '';
$values = array();
$values[1] = rex_var::toArray('REX_VALUE[1]');
$values[2] = rex_var::toArray('REX_VALUE[2]');
$values[3] = rex_var::toArray('REX_VALUE[3]');
$values[4] = rex_var::toArray('REX_VALUE[4]');

$counter = 0;

echo '
<div id="ews_modul">
<input id="anrodnung" type="hidden" name="REX_INPUT_VALUE[19]" value="REX_VALUE[19]" />

<div id="tabs">
  <ul class="nav nav-tabs">'.PHP_EOL;
    if('REX_VALUE[19]') {
      $reihenfolgeneu = explode(',','REX_VALUE[19]');
      for ($i = 1; $i <= count($values); $i++) {
        echo '<li id="'.($reihenfolgeneu[($i-1)]).'" ><a data-toggle="tab" id="tab'.($reihenfolgeneu[($i-1)]).'" href="#bereich'.($reihenfolgeneu[($i-1)]).'"><i>B'.$i.'</i><span>Bereich '.$i.'</span></a></li>'.PHP_EOL;
      }
    } else {
      for ($i = 1; $i <= count($values); $i++) {
        echo '<li id="'.$i.'"><a data-toggle="tab" id="tab'.$i.'" href="#bereich' . $i . '"><i>B'.$i.'</i><span>Bereich ' . $i . '</span></a></li>'.PHP_EOL;
      }
    }

echo '
    <li class="locked pull-right"><a data-toggle="tab" id="tabanleitung" href="#anleitung"><i class="rex-icon rex-icon-info"></i><span>Anleitung</span></a></li>
    <li class="locked pull-right"><a data-toggle="tab" id="tabweiteres" href="#einstellungen"><i class="rex-icon rex-icon-metafuncs"></i><span>Weitere Einstellungen</span></a></li>
  </ul>
</div>'.PHP_EOL;

echo '<div class="tab-content">'.PHP_EOL;
for ($i = 1; $i <= count($values); $i++) {



echo '
<div id="bereich'.$i.'" class="tab-pane fade in">
  <div class="form-horizontal">'.PHP_EOL;

  $counter ++;
  $taid = $counter;
  $items_textarea = isset($values[$i]['text']) ? $values[$i]['text'] : '';
  $textarea = new rex_fragment();
  $textarea->setVar('content_textarea',$items_textarea);
  $textarea->setVar('textareaid', $taid);
  echo $textarea->parse('textarea_input.php');



echo '
  </div>
</div>'.PHP_EOL;
}

$options = array(
    '12'      => '<div class="img12"></div>',
    '6_6'     => '<div class="img6_6"></div>',
    '4_4_4'   => '<div class="img4_4_4"></div>',
    '3_3_3_3' => '<div class="img3_3_3_3"></div>',
    '6_3_3'   => '<div class="img6_3_3"></div>',
    '3_6_3'   => '<div class="img3_6_3"></div>',
    '3_3_6'   => '<div class="img3_3_6"></div>',
    '8_4'     => '<div class="img8_4"></div>',
    '4_8'     => '<div class="img4_8"></div>'
  );

  $grid = '';
  foreach ($options as $value => $label) {
    $checked = 'REX_VALUE[20]' == $value ? ' checked="checked"' : '';
    $grid .= '<label><input name="REX_INPUT_VALUE[20]" value="' . $value . '" type="radio"' . $checked .' />' . $label . '</label>';
  }

echo '
<div id="einstellungen" class="tab-pane fade in active">
  <div class="form-horizontal">

    <h3>Grid</h3>

    <div class="form-group">
      <label class="col-sm-3 control-label">Raster wählen</label>
        <div class="col-sm-9 grid">
          '.$grid.'
        </div>
    </div>



  </div>


</div>


  <div id="anleitung" class="tab-pane fade in active">
      <div class="form-horizontal">
        <p>Hier kommt die Anleitung für die einzelen Komponenten hin</p>
      </div>
  </div>


</div>'.PHP_EOL;

?>

<script type="text/javascript">
jQuery(document).ready(function($) {

    $(function () {
      $("#tabs ul.nav-tabs").sortable({
        axis : "x",
        items: '> li:not(.locked)',
        update: function (e, ui) {
          var csv = "";
          $("#tabs > ul > li").each(function(i){
            csv+= ( csv == "" ? "" : "," )+this.id;
          });
          // alert(csv);
          $( "#anrodnung" ).val( csv );
        }
      });
    });

    if('REX_VALUE[20]' == '') {
      $('a#tabweiteres').click();
      $('.ueberschriften').val('h3');
    } else {
      $('#tabs ul.nav-tabs li a').first().click();
    }


    function grid(str) {
      if (str == '12') {
        $('#tab1').css('display','block');
        $('#tab2').css('display','none');
        $('#tab3').css('display','none');
        $('#tab4').css('display','none');
      } else if (str == '6_6' || str == '8_4' || str == '4_8') {
        $('#tab1').css('display','block');
        $('#tab2').css('display','block');
        $('#tab3').css('display','none');
        $('#tab4').css('display','none');
      } else if (str == '4_4_4' || str == '6_3_3' || str == '3_6_3' || str == '3_3_6') {
        $('#tab1').css('display','block');
        $('#tab2').css('display','block');
        $('#tab3').css('display','block');
        $('#tab4').css('display','none');
      } else {
        $('#tab1').css('display','block');
        $('#tab2').css('display','block');
        $('#tab3').css('display','block');
        $('#tab4').css('display','block');
      }
    }

    grid('REX_VALUE[20]');

    $( '.grid input[type=radio]').change(function() {
      $('#tab1').click();
      grid(this.value);
    });

});
</script>

<style>
#ews_modul #tabs i {
  display: none;
}

#ews_modul #tabs span {
  display: inline-block;
}

@media (max-width:767px) {
  #ews_modul #tabs i {
    display: inline-block;
    font-style: normal;
    padding: 0 5px 0 5px;
    font-size: 16px;
  }
  #ews_modul #tabs span {
    display: none;
  }
  #ews_modul .control-label {
    margin-left: 10px;
  }

  #ews_modul #anleitung p {
    padding-left: 20px;
  }

  #ews_modul #anleitung .control-label {
    padding-left: 25px;
  }

}

#ews_modul #anleitung .control-label {
  margin-top: -6px;
}


#ews_modul #anleitung {
  margin-top: 20px;
}

#ews_modul #anleitung .panel-heading {
  font-size: 14px !important;
  padding: 10px;
  background: #DFE3E9;
  width: 100%;
  text-align: left;
  margin-bottom: 20px;
  border: none;
}
#ews_modul #anleitung .panel-heading span {
  margin-right: 5px;
}

#ews_modul #anleitung .panel-heading:hover  {
  color: #000;
}

#ews_modul .nav-tabs>li>a {
  color: #31404F;
  background-color: #DFE3E9;
  font-size: 12px;
  border-top: 1px solid #9da6b2;
  border-left: 1px solid #9da6b2;
  border-right: 1px solid #9da6b2;
  padding: 8px;
  margin-bottom: 1px;
  height: 38px;
  top: 1px;
  padding-top: 10px;
}

#ews_modul .nav-tabs>li.active>a, #ews_modul .nav-tabs>li.active>a:hover, #ews_modul .nav-tabs>li.active>a:focus {
  color: #31404F;
  background-color: #f5f5f5;
  height: 39px;
}

#ews_modul .ui-sortable-helper {}

#ews_modul .nav-tabs>li>a:hover {
  background-color: #fafafa;
  border-bottom: none;
}

#ews_modul .markitup {
  min-height: 200px;
}


#ews_modul .tab-content {
  background: #f5f5f5;
  margin-top: -20px;
  padding: 10px 30px 30px 15px;
  border-right: 1px solid #9da6b2;
  border-left: 1px solid #9da6b2;
  border-bottom: 1px solid #9da6b2;
}

#ews_modul .tab-content h3 {
  font-size: 14px !important;
  padding: 10px;
  background: #DFE3E9;
  width: 100%;
  margin-bottom: 20px;
}

#ews_modul .tab-content .control-label {
  font-weight: normal;
  font-size: 12px !important;
}

#ews_modul input.form-control,
#ews_modul select.form-control,
#ews_modul textarea.form-control {
  background: #fff !important;
}
#ews_modul .grid {
  max-width: 350px;
}

#ews_modul .grid input {
  display: none;
}
#ews_modul .grid label {} .grid label div {
  float: left;
  width: 340px;
  height: 60px;
  border: 1px solid #ccc;
}
#ews_modul .grid label:hover div {
  cursor: pointer;
  border: 1px solid #659CCE;
}
#ews_modul .grid :checked + div {
  border: 1px solid #737373 !important;
}
#ews_modul .img12 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQ9JREFUeNrs3TEKgzAYgNFagpuDBxC8/3HcBVcRXAQRQVJPYIcWapr3BpdAhh8+IoikiDE+gPw8jQDED4gfED8gfkD8gPgB8QPiB+4tXC8vy2JGkKiqqpz8gPgB8YP4AfED4gfED4gfED8gfkD8gPgB8QN/Gv84jsMwGCjkFf9xHH3fix8SEj7fYl3Xs/x9300TMoq/67p5ns0Rsou/ruuyLM/X/mmaTBMyir9pmvO5bZv4IS0+9YH4AfED4gfED/yR8J1dQmjb1jQhIUWM8WLZjT2QLjf2AOIHxA/iB8QPiB8QPyB+QPyA+AHxA+IHxA/czpu/+gAnPyB+QPyA+AHxA+IHxA+IHxA/8BMvAQYAX1c3Eu5IAT8AAAAASUVORK5CYII=);
}
#ews_modul .img6_6 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAgxJREFUeNrs3c1LInEYwPFNByl8icyLLMogXjr1L/T/gxcPZaJS3VJ8QaEXLd3f7sCyl929LLjM7/M5xGjQ4Zn5No+UeHI4HL4A8SkYAYgfED8gfkD8gPgB8QPiB8QP/N+SP397s9mYUZ5Uq1Wn2+l25wdrPyB+QPyA+AHxA+IHxA+IHxA/IH5A/ID4gaNJ/tUPen5+fn19TdPUTPPt/f19Pp9vt9tKpVKv1wsF94+44//8/ByPx+GCEH++zWazu7u7/X6fPTw7O7u+vj49PTWZSNf+l5eX29vbUL5p5ttutxsMBqH8TqcTmq/VamHXGw6HJhPpnb/f7y8WC3OMQdj2w4oXVv12u/390kmSXq+3XC5NJtL4Ly4uSqVSuCbCQmia+RbOctjzLy8vs4fZpzyGXwEmE2n8rVYrfH17exN/7n39ITv++PgYjUbhoNFomEyk8ROh1Wp1f38fXvCXy+Xw+t9AxE8UHh4eHh8fw87fbDa73W6xWDQT8ZN/k8nk6ekpBH91dWXhFz8Rbfuh/HCQpmmpVFqv19nztVrNcMRPnk2n0+xgPB7/+vzNzY3hxBt/kiT+ty/3zs/Pww3fHHLjJPtr7e/4CJec8Yk9TvdP3pUBkRI/iB8QPyB+QPyA+AHxA+IHxA+IHxA/IH7guP7yrj7AnR8QPyB+QPyA+AHxA+IHxA+IHziKbwIMAO4pnqqPCpuHAAAAAElFTkSuQmCC);
}
#ews_modul .img4_4_4 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAvdJREFUeNrs3VtLomsYBuDRpJTMNtqOqYgKKhD6C/1/6CQiozRWUtDWon3ZZp7pgw4Wi1mjGTnMdR2En0EHd+/9vc9rG1Ovr6/fgL9PWgSg/IDyA8oPKD+g/IDyA8oPKD/Q3TK//vTV1ZWMftPAwIAkJfkHJWnnB2M/oPyA8gPKDyg/oPyA8gPKDyg/oPyA8gPKD3yBTKe+0NHR0d3d3ezsrEzb9vDwcHZ29vj4mM/nR0ZG0mm35jbd3t6en5+/vLwMDw9HmAL5xPI/Pz/XarVYtcrftpOTk0qlEus1uczlcisrK9lsVjKt2t/fj9X4/m40ExMTS0tLYvmUsT/uspubm9F8abat2WxubW1F8+fm5qLzhUIhxqjt7W3JtOr+/j6aH0PT8vJyuVzu6+s7PDw8PT2VTOd3/vX19UajIccPimk/pqcY9WdmZn5+VzKZtbW1GFwl06pYjbHnx24/Pj4el5eXl/V6/ebmplQqCafD5Y8zVW9vbyzcmFql+ZFzU8z5xWIxuUxG1rgFSKZVY2NjcQ9Noot5KrmBxjOS6Xz5p6enk1lL+T/i+5vk8dPTU7VajQc2q3YW9Jt48M+b5Mz/6/9m5cxPV7i4uIiBP4bV/v7+OP8LpG1DQ0OxM8VYGmf+5C5Ah3d+OijW6N7eXsz8k5OTCwsLPT09MmlVHO+vr6/z+fzQm8HBwY2NjYODAz+HsvN3r93d3Sh/Op0ul8uLi4ua3/boVKlU6vV6cplKpeLj+w9QsfN345JN1mtsUDGpxtifPF8oFITTkmKxWK1Wj4+PI7pcLler1eLJ0dFRySh/l4rFmjxIFuu71dVV4bQkm83Oz89HjDs7O8kzcQTw6sknlj+TyThTfUQcTWPDl0NHTE1NlUqlRqPRbDZj/4+TfzL88y+p99+C/E/eHeX3eZ8ZSf5ZSXrBD/5Syg/KDyg/oPyA8gPKDyg/oPyA8gPKDyg/oPzA1/qfv+oD7PyA8gPKDyg/oPyA8gPKDyg/oPzAl/ghwAAFHxBk8znuiwAAAABJRU5ErkJggg==);
}
#ews_modul .img3_3_3_3 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3FJREFUeNrs3dtLKlEYxuEUcbLMrKzpokIsIkHoJui2P737LgoL6STZCTpoiZnmdLCXWTJ0sWtDBO291u+5kJwg+Fzzzvq+nDLW7/eHALgnzksAEH4AhB8A4QdA+AEQfgCEHwDhB0D4AfzbEl9/++HhwcqyPc9LJpOffTcIgl6vZ2XhY2NjLDfLzc4P0PYDIPwACD8Awg+A8AMg/AAIPwDCD4DwAyD8AAg/AMIP4NckfuoHXV9fd7vdfD7vzmvXaDTa7XYikZiYmBgZGXGk6k6nc39///b2pqrT6bRTaVHV5+fn/X7fjvP8Z8L/+vparVaDIHAk/Kp3d3e32WxGR/Ih6wu/uLjQQkcf9DI7O7uysuJO+E9OThR+s9y0/YOtoFKpKPnunASnp6dKvva91dXVpaWlWCxWq9VarZbdVT89PSn58Xi8WCyWSiXP866urur1uiOLrn7HJJ+2f6BcLt/d3bk2LN3c3OhxeXk5k8mo+9VpoRFAj3pqcdVaaO352u1939dTXezOzs4eHx9zuZz1K/7y8nJwcDA6Oqp6Cf+ATv1kMqk2+Pb21p3wa6tPpVJR1E0brOHf7qpnZmYmJydNmc/Pz7rY6QsdcWHFDw8Pe73e2tra1tYW4R+Yn583DaFT4V9fX//YBWhL1OVgamrK7qoTIX1RC5mZ/+t/FGVNoyeFQkE7v0118Vbf96nfOT4+rlQqSr4m/+HhYUcKz2azuuir49PMb64CFtOGf3R0ND4+bvY5Zn4Mdbvdvb09TYDKvIZ/F7pfFdtut9PpdDakPOgVuLy8tPttjmazqRnHvL8THSyXy3Nzc//7ohP+79CYs7Ozoz1BrX6xWLR+2o9ioD3Q932VbH7xMRS+9e1C7brqfXyqQc/81pPwO2d/f1/J1wS4sLDQ6XTMQS9kcdW60mnM0fSbyWRSqVS1WtXB6elpu9faD0VPNzc39bixsUHb76IgCMztPWqDt7e3o+PW3+ejAWdxcVGZ1/5vjmgEKBQKnBJOh199rzs39n52d6fGYOtr16Cby+XU9GoM1v6vkk3z7w6bzvNYdKvmH/ERLpbhE3tY7ghv9QGOIvwA4QdA+AEQfgCEHwDhB0D4ARB+AIQfAOEHQPgBEH4Av+svf9UHgJ0fAOEHQPgBEH4AhB8A4QdA+AEQfgCEH8CveBdgACF2bQzem2woAAAAAElFTkSuQmCC);
}
#ews_modul .img6_3_3 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAvtJREFUeNrs3W1LIlEYgGE1HdNqQktCF0UlhEAwoh/QT/cH6AcVVERT+xCYmG9TvmtPnV1ZWHI3dsHlzH19GHSDhaNzzzw6xTg3m40DgP24eAkA4gdA/ACIHwDxAyB+AMQPgPgBED+A/5t794/H4zGvkU5OTk5s+HZ7vV7DMD776Xw+n81mNny7OfMDjP0AiB8A8QMgfgDED4D4ARA/AOIHQPwAiB8A8QMgfgB74P5X/1Gn05lMJvF4nNdUb7PZrNfrzefz4+PjYDDoctni/LFer5+fny3L8vv9Z2dnBwcHxP/darVqNBqyQxC/3rrdbqVSkRLUU5/Pl8lkDg8P9V617NiFQuHl5UU9NQwjnU6bpsnY73h9fS2Xy/IC0YbeFotFtVqV8pPJpDQve7/MerVaTfuFN5tNKT8UCl1fX0ciEdnV9Vj13575i8WijEOEYQcy7cuIJ6N+LBZ733Xc7nw+3+/37bBw2aZSKY/HI4e8x8fH7RRg6/gDgYBMQbJPyEBIHnqTd1nmfPnEq56quzzKIUD7hd/c3MhWypft09OTbOUISPyOaDQq2+l0Svza+/ZBPV4ul/V6XR6cn59rv/DtlxrZbFYdBRKJhAbr4lIfvmwwGMjAPxqNjo6O5PO/fRYej8dl8FksFqVSSYMvudzsyviSVqvVbrdl5g+Hw5eXl3pc9Nqt0+nI9uLiQl3MyuVylmXJqLudg4gf+ru/v394eJDgr66u7DDwK/IBR872pmn6fD556nQ6HR9X/hn7YaNpX8pX069hGKMftF+4OsxVq9V+v99sNsfjsfSvwbGPMz/+lPqiWzQajZ///e7uTu+FJxIJOcYNh8NCoaDO/PJ5R00BxP9+vYff7dPe6enpjltfaExWfXt7q369Vx4Hg0Gv16vBupzqau1nuGOPZrhjz6+4Yw8AeyF+gPgBED8A4gdA/ACIHwDxAyB+AMQPgPgBED8A4gewX7/5qz4AnPkBED8A4gdA/ACIHwDxAyB+AMQPgPgB7MWbAAMARkEV6b+++m4AAAAASUVORK5CYII=);
}
#ews_modul .img3_6_3 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAvRJREFUeNrs3WtLIlEcgHFdbbykYl4IkmQEEQRBCaGv7wcQvCIRifpGMPF+Gccw97+eRXpRuxALW2ee34uhLVgY5zxzzmnc1X08Hl0AnOcHLwFA/ACIHwDxAyB+AMQPgPgBED8A4gfwtXn//OPVaqXlaft8PsMwPvrpfr+3bZvBweX+7sLhMDM/AOIHQPwA8QMgfgDED4D4ARA/AOIHQPwAiB8A8QMgfgBfi/df/UWj0ciyLNM0nfPaTSaT9Xrt9Xqvrq6CwSCDSWOvr6/T6VQut1zoeDzu8XiI/7fD4dDtdvf7vUPil/NttVrz+fz8HfOESLQkA7vRaGw2G/VHwzAKhUIkEmHZ79put51OR14g54yGwWAg5YdCoWKxmM1m3W53v99fLpd0oqVeryflJ5PJUql0c3MjQ/3x8ZGZ39VsNmU55LTR8Pz8LMdcLie3f1nzz2Yz2QLIUYPZAO/u79Tlvri4kEs8HA7PqwBHxy9DX1ZBsgwej8fOGQ0y1QcCgXPq6vMOZfNPJ1q6u7uTo5R/vu/HYjHid93e3spxt9s5Kv77+/u3qwBZ+8jtIB6P04mW/H6/+qJSqai7QCaT0eC8eNT3ebLeeXp66nQ6Ur7s/M9DBLoyTVNu8S8vL61WS4NfcrFS/STLstrttuz9pHnZDeqxDsS7RqORHK+vr9UDnWq1ul6vZambSqWI33Fkm1Ov123blnkgn8+z29ebrO9kto9EIoFAwHX6jY/r9OSfZb8TPTw8SPmXl5fpdHq73S5P+N++dZVIJNRFn81mvV5vtVpJ/+qbzPzOIps99fYeWfPXarW3G0Le56OlTCYjN/fFYtFoNNTMn81m1SqA+H895XLOuD8ej++ebDQapRMtGYZRLpfV23vl61gs5vP5NDgvt3pG/RE+sQdc7u+LT+wBQPwAiB8gfgDED4D4ARA/AOIHQPwAiB8A8QMgfgDED+DL+cu/6gPAzA+A+AEQPwDiB0D8AIgfAPEDIH4AxA/gv/gpwAAthiJ8l+WEIQAAAABJRU5ErkJggg==);
}
#ews_modul .img3_3_6 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAwRJREFUeNrs3V9LInEUxvFVBifNzNTMCw2pCAPBG6H3/woUCw1KUCkoK5M0/4ykPTgge9G2Nwu1c76fC9ERgjMzz5zfoakJrVarXwDsCbMLAMIPgPADIPwACD8Awg+A8AMg/AAIP4Cfzfn669FoFMiyXdeNRCJ/+tbzvPl8HsjCd3Z2DB5us74+3HR+gGU/AMIPgPADIPwACD8Awg+A8AMg/AAIPwDCD4DwAyD8AL6B869+0MPDw3Q6LRaLdvbd8/PzeDx2HGdvby8WixmpejKZvLy8LJdLVR2Px4mQ9fC/v7+3223P84yEX/VeXFwMh8PNluJa4Au/vb3Vgd486CWXy5VKJVJkd9mvVtBsNpV8O3ut2+0q+ep7lUrl5OQkFAp1Op3X19dgVz2bzZT8cDh8dnZWLpdd172/v396eiJFRjt/o9EYDAbW9lq/39fr6elpIpHQ6lfLYI0AetXHAFetA62er25/cHCgj7rY9Xq9t7e3TCZDkCyGX6d+JBLRMvjx8dHOXlOrj0ajm6j7y2AN/8GuOpvNplIpv8zFYqGLnd5oCykyGv5CoeAvCE2F//z8/PdVgFqiLgfpdDrg58qa3nTW/Jn/638UhYDP/GZpvXNzc9NsNpV8Tf5bW1tGCk8mk7roa8Wnmd+/CsBi5zdrOp1eXl5q4lXmNfxbWP2q2PF4HI/Hk2u7u7vaA3d3d6Z+v0vnt05jTr1eVxi01K9Wq0bm3uFw2Gq1er2e/1HrHb0ul0vOBzq/IVdXV/P5fHt7+/DwcDKZ+BvdtQBXrSudxpx+v59IJKLRaLvd1sb9/X3OB8Jvhed5/u096vy1Wm2zPfD3+WjAOT4+Vuavr6/9LRoBjo6OOCVMh99xHDuD32q1+rRYjcGBrz2fz2cymcFgsFgs1P9Vsr/4x/8otLlV81M8sSdgeGKPKTyxBwDhB0D4AcIPgPADIPwACD8Awg+A8AMg/AAIPwDCD4DwA/hx/vJXfQDo/AAIPwDCD4DwAyD8AAg/AMIPgPADIPwAvsWHAAMARlAaCQUVROkAAAAASUVORK5CYII=);
}
#ews_modul .img8_4 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAg1JREFUeNrs3c9LInEYwOFNB0k0I+siiyLipVP/Qv8/dPGgJY6oNxVLErS0cr+7c9nL/jiYI/k8BxkVOrzMp3mlZE622+034PhkjADED4gfED8gfkD8gPgB8QPiBw5b9Pe3F4uFGbFnZ2dnzsk9TNKVH6z9gPgB8QPiB8QPiB8QPyB+QPyA+AHxA+IHUhDt6geNx+PValWv182U1L2+vs5ms/V6XSwWy+VyJuMi92nxv7+/x3EcZi1+UjedTjudzsfHR/I0n8/f3Nycnp6azO7X/uVy2W63Q/mmSeo2m839/X0ov9FohOZLpVJYSLvdrsns/srfarUeHx/NkQMRtv2wh4ZVv1ar/Ty/o+ju7u7p6clkdh//xcVFLpcL4w67lmmSunAqhj3/8vIyeZrcijL8CjCZ3cdfrVbD48vLi/g5BN9/SY7f3t56vV44uLq6Mpndxw+HaT6fPzw8hA/8hUIhfP43EPFzFAaDwXA4DDt/pVJpNpvZbNZMxM/X1+/3R6NRCP76+trCL36OaNsP5YeDer2ey+Wen5+T10ulkuGIn69sMpkkB3Ec//767e2t4XxK/FEU+d8+DsH5+Xm44JvD/zhJ/hD6J+6Owv65Y89+JukLD3CkxA/iB8QPiB8QPyB+QPyA+AHxA+IHxA+IH0jXP77VB7jyA+IHxA+IHxA/IH5A/ID4AfEDqfghwAD6BZ6qshTg0AAAAABJRU5ErkJggg==);
}
#ews_modul .img4_8 {
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVQAAAA8CAIAAAC2INVhAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAhBJREFUeNrs3U9LInEcwOFNBzEypfIiizKEl069Bd8/ePFgJY1YtxQ1Evrj3/3tzmUvuxsZ25TPc4jRoMO3+ThfKZm9zWbzDdg9OSMA8QPiB8QPiB8QPyB+QPyA+IFsi/7+7dlsZkavdHh4aJJ8onPSlR+s/YD4AfED4gfED4gfED8gfkD8gPgB8QPiBz5A9F4/6O7u7unpKY5jM32zl5eX8Xg8n89LpdLx8XEu56WZzMe/Wq2SJAlnrfjfbDQaXVxcrNfr9OH+/v75+XmxWDQZsrv2Pz4+drvdUL5pvtlisbi8vAzln56ehubL5XJYo3q9nsmQ3St/p9OZTCbmuKWw7YftKaz6jUbj528litrt9nQ6NRmyG//R0VGhUAgnbthaTXOb901hzz85OUkfpjdQDC8BJkN246/X6+Hr8/Oz+Lfx/Zf0eLlcXl9fh4NqtWoyZDd+3tf9/f3V1VV4w39wcBDe/xsI4t8Jg8Hg5uYm7Py1Wq3ZbObzeTNB/F9fv9+/vb0NwZ+dnVn4Ef8Obfuh/HAQx3GhUHh4eEifL5fLhoP4v7LhcJgeJEny+/OtVstwyHT8URT5375tVCqVcME3B/6nvfRPyn/iPjOv5449fK5z0kdHYEeJH8QPiB8QPyB+QPyA+AHxA+IHxA+IHxA/8LH+8ak+wJUfED8gfkD8gPgB8QPiB8QPiB/4ED8EGADiTZ6qytwGIAAAAABJRU5ErkJggg==);
}
</style>

