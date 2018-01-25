<?php
$values         = '';
$values         = array();
$values[1]      = array( '1', rex_var::toArray( 'REX_VALUE[1]' ) );
$values[2]      = array( '2', rex_var::toArray( 'REX_VALUE[2]' ) );
$values[3]      = array( '3', rex_var::toArray( 'REX_VALUE[3]' ) );
$values[4]      = array( '4', rex_var::toArray( 'REX_VALUE[4]' ) );
$wrapper[5]     = array( '5', rex_var::toArray( 'REX_VALUE[5]' ) );
$counter        = 0;
$reihenfolgeneu = '';
echo '
<div id="bootstrap_helper_modul_wrapper">
  <input id="anrodnung" type="hidden" name="REX_INPUT_VALUE[19]" value="REX_VALUE[19]" />
    <div id="tabs">
      <ul class="nav nav-tabs">';
if ( 'REX_VALUE[19]' ) {
    $reihenfolgeneu = explode( ',', 'REX_VALUE[19]' );
    for ( $i = 1; $i <= count( $values ); $i ++ ) {
        echo '<li id="' . ( $reihenfolgeneu[ ( $i - 1 ) ] ) . '" ><a data-toggle="tab" id="tab' . ( $reihenfolgeneu[ ( $i - 1 ) ] ) . '" href="#bereich' . ( $reihenfolgeneu[ ( $i - 1 ) ] ) . '"><i>B' . $i . '</i><span>Bereich ' . $i . '</span></a></li>';
    }
} else {
    for ( $i = 1; $i <= count( $values ); $i ++ ) {
        echo '<li id="' . $i . '"><a data-toggle="tab" id="tab' . $i . '" href="#bereich' . $i . '"><i>B' . $i . '</i><span>Bereich ' . $i . '</span></a></li>';
    }
}
echo '  <li class="locked pull-right"><a data-toggle="tab" id="tabweiteres" href="#einstellungen"><i class="rex-icon rex-icon-metafuncs"></i><span>Einstellungen</span></a></li>
      </ul>
  </div>';
echo '<div class="tab-content">';
for ( $i = 1; $i <= count( $values ); $i ++ ) {
    echo '<div id="bereich' . $i . '" class="tab-pane fade in">';
    $id    = $i;
    $mform = new MForm();
    $mform->addFieldset( 'Element', array( 'class' => 'elemente' ) );
    $mform->addSelectField( "$id.0.element", array( 'empty'          => 'Element auswählen',
                                                    'headline'   => 'Überschrift',
                                                    'textarea'   => 'Textfeld',
//                                                  'linkbutton' => 'Link / Button'
    ), array( 'label' => '', 'class' => 'elementSelect' ) );
    element_headline_input( $id, $mform );
    element_textarea_input( $id, $mform );
//  element_link_button_input( $id, $mform );
    echo MBlock::show( $id, $mform->show() );
    echo '<div class="extra_settings">Weitere Einstellungen<i class="fa fa-arrow-down" aria-hidden="true"></i></div>
        <div class="extra_settings_content">';
    id_class_input( $id );
    media_manager_typ_input( $id );
    echo '</div>
  </div>';
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
$grid    = '';
foreach ( $options as $value => $label ) {
    $checked = 'REX_VALUE[20]' == $value ? ' checked="checked"' : '';
    $grid    .= '<label><input name="REX_INPUT_VALUE[20]" value="' . $value . '" type="radio"' . $checked . ' />' . $label . '</label>';
}
echo '
    <div id="einstellungen" class="tab-pane fade in active">
      <div class="mform">
        <fieldset class="form-horizontal">
          <legend>Grid Auswahl <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i></legend>
              <div class="module_help_content">
                <p>Sofern Sie das Raster nachträglich ändern möchten ist es notwendig den Block vor der Änderung einmal zu speichern (ein Klick auf "Block übernehmen" reicht). Dies ist nur wichtig sofern Sie die Anordnung der Tabs vorher geändert haben.</p>
              </div>
          <div class="col-sm-6 col-md-5 col-lg-5">
            <p>Wie soll der Inhalt dargestellt werden?</p>
            <p>Die Auwahl des Rasters kann jederzeit einfach geändert werden. Bitte beachten Sie hierzu den Hinweis!</p>
          </div>
          <div class="col-sm-6 col-md-7 col-lg-7 grid">
            ' . $grid . '
          </div>
        </fieldset>
      </div>';
    container_input( 5 );
    id_class_input( 5 );
    media_manager_typ_input( 5 );
echo '
  </div>
</div>';
?>
<script>
    $(function () {
        $(document).on('change', '.elementSelect', function () {
            //console.log($(this).val());
            //console.log($(this).parents('.sortitem').find('fieldset.' + $(this).val()));
            $($(this).children()).each(function () {
                $(this).parents('.sortitem').find('fieldset.' + $(this).val()).hide();
            });
            $(this).parents('.sortitem').find('fieldset.' + $(this).val()).toggle();
        });

        $(document).on('mblock:add', function (event, container) {
            $('.elementSelect option:selected').each(function (index) {
                // console.log($(this).val());
                if ($(this).val() == 'empty') {



                    $(this).parents('.sortitem').find('.elementSelect option').each(function (index) {
                        $(this).parents('.sortitem').find('fieldset.' + $(this).val()).hide();
                    });
                } else {
                    $(this).val() == 'empty';
                }
            });
        });

        //only show selected elements on edit
        $('.elementSelect option:selected').each(function (index) {
            $(this).parents('.sortitem').find('fieldset.' + $(this).val()).show();
        });

        $(".module_help_link").click(function () {
            $(this).parent().parent().find(".module_help_content").slideToggle(100);
        });
        $(".extra_settings").click(function () {
            $(this).next().slideToggle(200);
        });
        $(function () {
            $("#tabs ul.nav-tabs").sortable({
                axis: "x",
                items: '> li:not(.locked)',
                update: function (e, ui) {
                    var csv = "";
                    $("#tabs > ul > li").each(function (i) {
                        csv += ( csv == "" ? "" : "," ) + this.id;
                    });
                    // alert (csv);
                    $("#anrodnung").val(csv);
                }
            });
        });
        if ('REX_VALUE[20]' == '') {
            $('a#tabweiteres').click();
        } else {
            $('#tabs ul.nav-tabs li a').first().click();
        }

        function grid(str) {
            if (str == '12') {
                $('#tab1').css('display', 'block');
                $('#tab2').css('display', 'none');
                $('#tab3').css('display', 'none');
                $('#tab4').css('display', 'none');
            } else if (str == '6_6' || str == '8_4' || str == '4_8') {
                $('#tab1').css('display', 'block');
                $('#tab2').css('display', 'block');
                $('#tab3').css('display', 'none');
                $('#tab4').css('display', 'none');
            } else if (str == '4_4_4' || str == '6_3_3' || str == '3_6_3' || str == '3_3_6') {
                $('#tab1').css('display', 'block');
                $('#tab2').css('display', 'block');
                $('#tab3').css('display', 'block');
                $('#tab4').css('display', 'none');
            } else {
                $('#tab1').css('display', 'block');
                $('#tab2').css('display', 'block');
                $('#tab3').css('display', 'block');
                $('#tab4').css('display', 'block');
            }
        }

        grid('REX_VALUE[20]');
        $('.grid input[type=radio]').change(function () {
            $('#tab1').click();
            grid(this.value);
        });
    });
</script>
