<?php
$this->setProperty( 'author', 'Friends Of REDAXO' );

if ( rex::isBackend() && rex::getUser() ) {
	rex_perm::register( 'bootstrap[]' );

////////////////////////////////////
//
//  Compile SCSS
//
////////////////////////////////////
	rex_extension::register( 'PACKAGES_INCLUDED', function () {
		$scss_compile = 1;
		if ( rex::getUser() && $scss_compile == 1 ) {

			$compiler = new rex_scss_compiler();

			$scss_files = rex_extension::registerPoint( new rex_extension_point( 'BE_STYLE_SCSS_FILES', [ $this->getPath( 'scss/master.scss' ) ] ) );
			$compiler->setScssFile( $scss_files );
			$compiler->setCssFile( $this->getPath( 'assets/css/styles.css' ) );
			$compiler->compile();
			rex_file::copy( $this->getPath( 'assets/css/styles.css' ), $this->getAssetsPath( 'css/styles.css' ) );
		}
	} );
	rex_view::addCssFile( $this->getAssetsUrl( 'css/styles.css' ) );
}



////////////////////////////////////
//
//  check Editor
//
////////////////////////////////////
if ( ! function_exists( 'bs_check_editor' ) ) {
	function bs_check_editor() {
		if ( ! rex_addon::get( 'markitup' )->isAvailable() && ! rex_addon::get( 'rex_redactor2' )->isAvailable() ) {
			echo rex_view::error( 'Dieses Modul ben&ouml;tigt das "MarkItUp" oder das "Redactor 2" Addon!' );
		} else {
			if ( rex_addon::get( 'markitup' )->isAvailable() ) {
				$return = 'markitup';
				if ( ! markitup::profileExists( 'simple' ) ) {
					markitup::insertProfile( 'simple', 'Angelegt durch das Addon Bootstrap', 'textile', 200, 800, 'relative', 'bold,italic,underline,deleted,quote,sub,sup,code,unorderedlist, orderedlist, grouplink[internal|external|mailto]' );
				}
			}
			if ( rex_addon::get( 'rex_redactor2' )->isAvailable() ) {
				$return = 'redactor';
				if ( ! rex_redactor2::profileExists( 'simple' ) ) {
					rex_redactor2::insertProfile( 'simple', 'Angelegt durch das Addon Bootstrap', '200', '800', 'relative', 'bold, italic, underline, deleted, quote, sub, sup, code, unorderedlist, orderedlist, grouplink[external|internal|email], cleaner' );
				}
			}

			return $return;
		}
	}
}

////////////////////////////////////
//
// Container
//
////////////////////////////////////
function container_input( $id ) {
	$mform = new MForm();
	$mform->addFieldset( 'Breite des Inhaltes <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Hier kann die Breite des Modulinhaltes für die Frontendausgabe angegeben werden.</p>
                      <em>Im Backend wird diese Information nur ausgegeben sofern <i>"volle Browserbreite"</i> ausgewählt ist.</em>
                    </div>' );
	$mform->addSelectField( "$id.0.container", array(
		'container'       => 'so breit wie der Inhalt',
		'container_fluid' => 'volle Browserbreite'
	), array( 'label' => 'Breite' ) );
	echo $mform->show();
}

function container_output( $container ) {
	$fe_output = [];
	$be_output = [];

	$fe_output[] = $container;

	if ( $container == 'container_fluid' ) {

		$be_output[] = '
    <legend>Breite des Inhaltes</legend>
    <div class="form-group">
      <div class="col-sm-4 label_left">Breite</div>
      <div class="col-sm-8">volle Browserbreite</div>
    </div>';
	}
	if ( ! rex::isBackend() ) {
		return implode( $fe_output );
	} else {
		return implode( $be_output );
	}
}

require_once (rex_path::addon('bootstrap','functions/headline.php'));
require_once (rex_path::addon('bootstrap','functions/textarea.php'));



////////////////////////////////////
//
//  Link / Button
//
////////////////////////////////////
function element_link_button_input( $id, $mform ) {
	$mform->addFieldset( 'Link / Button <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
		'class' => 'linkbutton',
		'style' => 'display:none;'
	) );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Folgt</p>
                    </div>' );
	$mform->addTextField( "$id.0.link_designation", array( 'label' => 'Bezeichnung' ) );
	$mform->addCustomLinkField( "$id.0.link", array(
		'label'       => 'Link',
		'data-tel'    => 'disable',
		'data-mailto' => 'disable',
		'data-media'  => 'disable'
	) );


}


function textarea_output( $textarea ) {
	$fe_output = [];
	$be_output = [];

	if ( $textarea != '' ) {
		$fe_output[] = html_entity_decode( $textarea );
		$be_output[] = '
    <legend>Text</legend>
    <div class="form-group">
      <div class="col-sm-3 label_left">Text</div>
      <div class="col-sm-9">' . html_entity_decode( $textarea ) . '</div>
    </div>';
		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}
}


////////////////////////////////////
//
//  ID / Class
//
////////////////////////////////////
function id_class_input( $id ) {
	$mform = new MForm();
	$mform->addFieldset( 'Klasse(n) / ID <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Hier können individuelle IDs und Klassen vergeben werden.</p>
                      <p><em>Sollten Sie nicht sehr genau wissen was damit gemeint ist fragen Sie Ihren Webentwickler.</em></p>
                    </div>' );
	$mform->addHtml( '<div class="col-sm-12">' );
	$mform->addTextField( "$id.0.class", array( 'label' => 'Klasse(n)' ) );
	$mform->addHtml( '</div><div class="col-sm-12">' );
	$mform->addTextField( "$id.0.id_value", array( 'label' => 'ID' ) );
	$mform->addHtml( '</div>' );
	echo $mform->show();
}


function id_class_output( $id_value, $class ) {
	$fe_output = [];
	$be_output = [];

	if ( $id_value != '' OR $class != '' ) {

		if ( $id_value != '' ) {
			$id_value_fe = 'id="' . $id_value . '"';
		}
		$fe_output[] = $id_value_fe;
		$fe_output[] = $class;

		if ( $id_value == '' ) {
			$id_value = '-';
		}
		if ( $class == '' ) {
			$class = '-';
		}

		$be_output[] = '
      <legend>Klasse(n) / ID</legend>
      <div class="form-group">
        <div class="col-sm-3 label_left">Klasse(n) / ID</div>
        <div class="col-sm-9">' . $class . ' / ' . $id_value . '</div>
      </div>';

		if ( ! rex::isBackend() ) {
			return $fe_output;
		} else {
			return implode( $be_output );
		}
	}
}


////////////////////////////////////
//
//  Media Manager Typ
//
////////////////////////////////////
function media_manager_typ_input( $id ) {
	$mform = new MForm();
	$mform->addFieldset( 'Media Manager Typ <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Hier können Sie einen Media Manager Typen angeben.</p>
                      <p><em>Sollten Sie nicht sehr genau wissen was damit gemeint ist fragen Sie Ihren Webentwickler.</em></p>
                    </div>' );
	$mform->addHtml( '<div class="col-sm-12">' );
	$mform->addTextField( "$id.0.mmtyp", array( 'label' => 'Typ' ) );
	$mform->addHtml( '</div>' );
	echo $mform->show();
}

function media_manager_typ_output( $mmtyp ) {
	$fe_output = [];
	$be_output = [];

	if ( $mmtyp != '' ) {

		$fe_output[] = $mmtyp;
		$be_output[] = '
      <legend>Media Manager Typ</legend>
      <div class="form-group">
        <div class="col-sm-3 label_left">Media Manager Typ</div>
        <div class="col-sm-9">' . $mmtyp . '</div>
      </div>';

		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}
}

