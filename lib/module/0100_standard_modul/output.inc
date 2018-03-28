<?php

/*
MM TYpen werden noch nicht berücksichtigt...
*/

$grid                       = 'REX_VALUE[20]';
$zaehler                    = '1';
$nummer                     = '';

$wrapper_id                 = '';
$wrapper_class              = '';

$values                     = array();
$out                        = '';
$outback                    = array();
$html_block                 = array();

$html_block[1]              = '';
$html_block[2]              = '';
$html_block[3]              = '';
$html_block[4]              = '';

$individuelle_css_klasse[1] = '';
$individuelle_css_klasse[2] = '';
$individuelle_css_klasse[3] = '';
$individuelle_css_klasse[4] = '';

$individuelle_css_id[1]     = '';
$individuelle_css_id[2]     = '';
$individuelle_css_id[3]     = '';
$individuelle_css_id[4]     = '';

$values[1]                  = rex_var::toArray( 'REX_VALUE[1]' );
$values[2]                  = rex_var::toArray( 'REX_VALUE[2]' );
$values[3]                  = rex_var::toArray( 'REX_VALUE[3]' );
$values[4]                  = rex_var::toArray( 'REX_VALUE[4]' );
$values[5]                  = rex_var::toArray( 'REX_VALUE[5]' );

$bsh_output                 = NEW rex_bootstrap_helper();

$debug                      = false;

if ( rex::isBackend() ) {
	$coreVersion = rex_config::get( 'core', 'version' );
	if ( $debug ) {
		if ( $coreVersion < '5.3.0' ) {
			echo '<pre>';
			print_r( rex_var::toArray( "REX_VALUE[1]" ) );
			print_r( rex_var::toArray( "REX_VALUE[20]" ) );
			echo '</pre>';
		} else {
			echo '<pre>';
			dump( rex_var::toArray( "REX_VALUE[1]" ) );
			dump( rex_var::toArray( "REX_VALUE[2]" ) );
			dump( rex_var::toArray( "REX_VALUE[3]" ) );
			dump( rex_var::toArray( "REX_VALUE[4]" ) );
			dump( rex_var::toArray( "REX_VALUE[20]" ) );
			echo '</pre>';
		}
	}
}

if ( $grid == '12' ) {
	unset( $values[2] );
	unset( $values[3] );
	unset( $values[4] );
}

if ( $grid == '6_6' || $grid == '8_4' || $grid == '4_8' ) {
	unset( $values[3] );
	unset( $values[4] );
}

if ( $grid == '4_4_4' || $grid == '6_3_3' || $grid == '3_6_3' || $grid == '3_3_6' ) {
	unset( $values[4] );
}

if ( $grid == '3_3_3_3' ) {
}

if ( 'REX_VALUE[19]' ) {
	$reihenfolge = explode( ',', 'REX_VALUE[19]' );
} else {
	$reihenfolge = array( '1', '2', '3', '4' );
}

foreach ( $reihenfolge as $nummer ) {
	if ( isset( $values[ $nummer ]) ) {
		$value = $values[ $nummer ];

		if ( $debug ) {
			dump($value);
		}

		$outback[] = '
      <div class=" mblock_wrapper outback">
        <legend>Bereich ' . $zaehler . '</legend>
        <fieldset class="form-horizontal">';
		foreach ( $value as $val ) {
			switch ( $val['element'] ) {
				case 'headline':
					$html_block[$zaehler] .= $bsh_output->headline_output( $val['headline_text'], $val['headline_size'] );
					$outback[]             = $bsh_output->headline_output( $val['headline_text'], $val['headline_size'] );
					break;
				case 'textarea':
					$html_block[$zaehler] .= $bsh_output->textarea_output( $val['textarea_content'] );
					$outback[]             = $bsh_output->textarea_output( $val['textarea_content'] );
					break;
				case 'downloads':
					$html_block[$zaehler] .= $bsh_output->downloads_output( $val['downloads_headline'],$val['REX_MEDIALIST_1'] );
					$outback[]             = $bsh_output->downloads_output( $val['downloads_headline'],$val['REX_MEDIALIST_1'] );
					break;
				case 'link':
					$html_block[$zaehler] .= $bsh_output->link_output( $val['link_name'],$val['link_extern'],$val['REX_LINK_1'],$val['link_type'],$val['link_class'] );
					$outback[]             = $bsh_output->link_output( $val['link_name'],$val['link_extern'],$val['REX_LINK_1'],$val['link_type'],$val['link_class'] );
					break;
				case 'video':
					$html_block[$zaehler] .= $bsh_output->video_output( $val['video_id'],$val['video_service'] );
					$outback[]             = $bsh_output->video_output( $val['video_id'],$val['video_service'] );
					break;
			}
		}
		foreach ( $value as $val ) {
			if ( isset($val['class'])) {
				$individuelle_css_klasse[$zaehler] = ' '.$val['class'];
			} else {
				$individuelle_css_klasse[$zaehler] = '';
			}
			if ( isset($val['id_value'])) {
				$individuelle_css_id[$zaehler] = ' id="'.$val['id_value'].'"';
			} else {
				$individuelle_css_id[$zaehler] = '';
			}
			if ( isset($val['mmtyp'])) {
				$individueller_mmtyp[$zaehler] = $val['mmtyp'];
			} else {
				$individueller_mmtyp[$zaehler] = '';
			}

			if ( isset( $val['id_value'], $val['class'], $val['mmtyp'] ) ) {
				if ( $val['id_value'] != '' OR $val['class'] != '' OR $val['mmtyp'] != '' ) {
					$outback[] = '<legend>Individuelle Einstellungen</legend>';
				}
				if ( $val['id_value'] != '' ) {
					$outback[] = '
                <div class="form-group">
                  <label class="col-sm-3 label_left">ID</label>
                  <div class="col-sm-9">
                    ' . $val['id_value'] . '
                  </div>
                </div>
              ';
				}
				if ( $val['class'] != '' ) {
					$outback[] = '
                <div class="form-group">
                  <label class="col-sm-3 label_left">Klasse</label>
                  <div class="col-sm-9">
                    ' . $val['class'] . '
                  </div>
                </div>
              ';
				}
				if ( $val['mmtyp'] != '' ) {
					$outback[] = '
                <div class="form-group">
                <label class="col-sm-3 label_left">Media Manager Typ</label>
                  <div class="col-sm-9">
                    ' . $val['mmtyp'] . '
                  </div>
                </div>
              ';
				}
			}
		}
		$outback[] = '
        </fieldset>
      </div>';
		$zaehler ++;
	}
}

$outback[] = '
  <div class="mblock_wrapper outback more_settings">
    <legend>Weitere Modul Einstellungen</legend>
    <fieldset class="form-horizontal">';
foreach ( $values[5] as $val ) {
	if ( $val['container'] != 'container' ) {
		$outback[] = '
          <div class="form-group">
            <label class="col-sm-3 label_left">Breite des Inhaltes</label>
            <div class="col-sm-9">
              Volle Browserbreite
            </div>
          </div>
        ';
	}
	if ( $val['id_value'] != '' ) {
		$wrapper_id = 'id="'.$val['id_value'].'"';
		$outback[] = '
          <div class="form-group">
            <label class="col-sm-3 label_left">Container ID</label>
            <div class="col-sm-9">
              ' . $val['id_value'] . '
            </div>
          </div>
        ';
	}
	if ( $val['class'] != '' ) {
		$wrapper_class = ' '.$val['class'];
		$outback[] = '
         <div class="form-group">
         <label class="col-sm-3 label_left">Container Klasse</label>
           <div class="col-sm-9">
             ' . $val['class'] . '
           </div>
         </div>
       ';
	}
	if ( $val['mmtyp'] != '' ) {
		$outback[] = '
          <div class="form-group">
            <label class="col-sm-3 label_left">Media Manager Typ</label>
              <div class="col-sm-9">
                ' . $val['mmtyp'] . '
              </div>
          </div>
        ';
	}
}

$outback[] = '
    <div class="form-group" >
      <label class="col-sm-3 label_left">Raster</label>
      <div class="col-sm-9" id="bootstrap_helper_modul_grid">
        <div class="gridimage img' . $grid . '"></div>
      </div>
    </div>
  </fieldset>
</div>
';

switch ($grid) {
	case '12':
		$out .= '
      <div class="col'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>'.PHP_EOL;
		break;
	case '6_6':
		$out .= '
      <div class="col-md'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-md'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
		break;
	case '4_4_4':
		$out .= '
      <div class="col-md'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-md'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-md'.$individuelle_css_klasse[3].'"'.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
		break;
	case '3_3_3_3':
		$out .= '
      <div class="col col-md-6 col-lg-3'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col col-md-6 col-lg-3'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col col-md-6 col-lg-3'.$individuelle_css_klasse[3].'"'.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>
      <div class="col col-md-6 col-lg-3'.$individuelle_css_klasse[4].'"'.$individuelle_css_id[4].'>
        '.$html_block[4].'
      </div>'.PHP_EOL;
		break;

	case '6_3_3':
		$out .= '
      <div class="col-12 col-md-12 col-lg-6'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-12 col-md-6 col-lg-3'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-12 col-md-6 col-lg-3'.$individuelle_css_klasse[3].'"'.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
		break;


	case '3_6_3':
		$out .= '
      <div class="col-12 col-lg-3'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-12 col-lg-6'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-12 col-lg-3'.$individuelle_css_klasse[3].'"'.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
		break;

	case '3_3_6':
		$out .= '
      <div class="col-12 col-md-6 col-lg-3'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-12 col-md-6 col-lg-3'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>
      <div class="col-12 col-md-12 col-lg-6'.$individuelle_css_klasse[3].'"'.$individuelle_css_id[3].'>
        '.$html_block[3].'
      </div>'.PHP_EOL;
		break;
	case '8_4':
		$out .= '
      <div class="col-12 col-md-8'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-12 col-md-4'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
		break;
	case '4_8':
		$out .= '
      <div class="col-12 col-md-4'.$individuelle_css_klasse[1].'"'.$individuelle_css_id[1].'>
        '.$html_block[1].'
      </div>
      <div class="col-12 col-md-8'.$individuelle_css_klasse[2].'"'.$individuelle_css_id[2].'>
        '.$html_block[2].'
      </div>'.PHP_EOL;
		break;
}
if ( rex::isBackend() ) {
	echo implode( $outback );
} else {
	echo '<div '.$wrapper_id.' class="'.$val['container'].$wrapper_class.'"><div class="row">'.$out.'</div></div>';
}

