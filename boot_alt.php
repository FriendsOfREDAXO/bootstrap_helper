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
		$scss_compile = 0;
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
	), array( 'label' => 'Breite', 'class' => 'selectpicker' ) );
	echo $mform->show();
}

function container_output( $conatiner ) {
	$fe_output = [];
	$be_output = [];

	$fe_output[] = $conatiner;

	if ( $conatiner == 'container_fluid' ) {


		$be_output[] = '
    <legend>Breite des Inhaltes</legend>
    <div class="form-group">
      <div class="col-sm-3 label_left">Breite</div>
      <div class="col-sm-9">volle Browserbreite</div>
    </div>';
	}
	if ( ! rex::isBackend() ) {
		return implode( $fe_output );
	} else {
		return implode( $be_output );
	}
}


////////////////////////////////////
//
//  Headline
//
////////////////////////////////////

function element_headline_input( $id, $mform ) {
	$mform->addFieldset( 'Überschrift <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
		'class' => 'headline',
		'style' => 'display:none;'
	) );
	$mform->addHtml( '<div class="module_help_content">
                        <p>H1 wird für die Hauptüberschrift benutzt und darf nur einmal auf jeder Seite (am Anfang) vorkommen. Die anderen Überschriften werden zur Gliederung des Dokumentes (wie bei einem Aufsatz) benutzt und folgen in logischer Reihenfolge.</p>
                          <p>Zum Beispiel können auf eine H2 Überschrift also mehrere H3 Überschriften folgen, nicht aber eine H4. Diese sollen lediglich einen Abatz nach H3 kennzeichen.</p>
                      </div>' );
	$mform->addTextField( "$id.0.headline_text", array( 'label' => 'Überschrift ' ) );
	$mform->addSelectField( "$id.0.headline_size", array(
		'' => 'Bitte wählen',
		1  => 'H1 - Nur einmal pro Seite nutzen!',
		2  => 'H2',
		3  => 'H3',
		4  => 'H4',
		5  => 'H5',
		6  => 'H6'
	), array( 'label' => 'Art', 'class' => 'selectpicker' ) );
}

function element_headline_output( $headline_text, $headline_size ) {
	$fe_output = [];
	$be_output = [];

	if ( $headline_text != '' ) {

		if ( $headline_size == '' ) {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="alert alert-danger">
            <p><strong>Die Überschrift wird auf der Webseite nicht angezeigt!</strong></p>
            <p>Sie haben eine Überschrift aber keine Größe für die Überschrift angegeben.</p>
          </div>';
		} else {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="form-group">
            <div class="col-sm-3 label_left">Überschrift</div>
            <div class="col-sm-9">' . $headline_text . '</div>
            <div class="col-sm-3 label_left">Art</div>
            <div class="col-sm-9">H' . $headline_size . '</div>
          </div>';
			$fe_output[] = '<h' . $headline_size . '>' . $headline_text . '</h' . $headline_size . '>';
		}
		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}

}


////////////////////////////////////
//
//  Textarea
//
////////////////////////////////////
function element_textarea_input( $id, $mform ) {
	$texteditor = bs_check_editor();
	$mform->addFieldset( 'Text <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
		'class' => 'textarea',
		'style' => 'display:none;'
	) );
	$mform->addHtml( '<div class="module_help_content">
                          <p>Ja. Der Text in dem Editor wird nicht wie auf der Webseite dargestellt. Das ist Absicht :-).</p>
                          <p><em>Falls Sie Fragen zur Benutzung des Editors haben wenden Sie sich bitte an Ihren Webentwickler.</em></p>
                        </div>' );
	$mform->setAttribute( 'default-class', false );
	if ( $texteditor == 'markitup' ) {
		$mform->addTextAreaField( "$id.0.textarea_content", array(
			'label' => 'Text',
			'class' => "markitupEditor-simple",
			'id'    => 'value-00' . $id
		) );
	}
	if ( $texteditor == 'redactor' ) {
		$mform->addTextAreaField( "$id.0.textarea_content", array(
			'label' => 'Text',
			'class' => "redactorEditor2-simple",
			'id'    => 'redactor_00' . $id
		) );
	}
}


function element_textarea_output( $textarea ) {
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


////////////////////////////////////
//
//  Textarea // Alt
//
////////////////////////////////////
function element_textarea( $id, $mform, $modus ) {

	switch ( $modus ) {
		case 'input':
			$texteditor = bs_check_editor();
			$mform->addFieldset( 'Text <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
				'class' => 'textarea',
				'style' => 'display:none;'
			) );
			$mform->addHtml( '<div class="module_help_content">
                          <p>Ja. Der Text in dem Editor wird nicht wie auf der Webseite dargestellt. Das ist Absicht :-).</p>
                          <p><em>Falls Sie Fragen zur Benutzung des Editors haben wenden Sie sich bitte an Ihren Webentwickler.</em></p>
                        </div>' );
			$mform->setAttribute( 'default-class', false );
			if ( $texteditor == 'markitup' ) {
				$mform->addTextAreaField( "$id.0.textarea", array(
					'label' => 'Text',
					'class' => "markitupEditor-simple",
					'id'    => 'value-00' . $id
				) );
			}
			if ( $texteditor == 'redactor' ) {
				$mform->addTextAreaField( "$id.0.textarea", array(
					'label' => 'Text',
					'class' => "redactorEditor2-simple",
					'id'    => 'redactor_00' . $id
				) );
			}
			break;
		case 'output':

			break;

		default:
			echo 'Unbekannter Parameter (modus: ' . $modus . ') in <b>element_textarea</b>';
			break;
	}

}


////////////////////////////////////
//
//  Headline // Alt
//
////////////////////////////////////
function headline_input( $id ) {
	$mform = new MForm();
	$mform->addFieldset( 'Überschrift <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>H1 wird für die Hauptüberschrift benutzt und darf nur einmal auf jeder Seite (am Anfang) vorkommen. Die anderen Überschriften werden zur Gliederung des Dokumentes (wie bei einem Aufsatz) benutzt und folgen in logischer Reihenfolge.</p>
                        <p>Zum Beispiel können auf eine H2 Überschrift also mehrere H3 Überschriften folgen, nicht aber eine H4. Diese sollen lediglich einen Abatz nach H3 kennzeichen.</p>
                    </div>' );
	$mform->addHtml( '<div class="col-sm-8">' );
	$mform->addTextField( "$id.0.headline", array( 'label' => 'Überschrift ' ) );
	$mform->addHtml( '</div><div class="col-sm-4">' );
	$mform->addSelectField( "$id.0.size", array(
		'' => 'Bitte wählen',
		1  => 'H1',
		2  => 'H2',
		3  => 'H3',
		4  => 'H4',
		5  => 'H5',
		6  => 'H6'
	), array( 'label' => 'Art', 'class' => 'selectpicker' ) );
	$mform->addHtml( '</div>' );
	echo $mform->show();
}

function headline_output( $headline, $size ) {
	$fe_output = [];
	$be_output = [];

	if ( $headline != '' ) {

		if ( $size == '' ) {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="alert alert-danger">
            <p><strong>Die Überschrift wird auf der Webseite nicht angezeigt!</strong></p>
            <p>Sie haben eine Überschrift aber keine Größe für die Überschrift angegeben.</p>
          </div>';
		} else {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="form-group">
            <div class="col-sm-3 label_left">Überschrift</div>
            <div class="col-sm-9">' . $headline . '</div>
            <div class="col-sm-3 label_left">Art</div>
            <div class="col-sm-9">H' . $size . '</div>
          </div>';
			$fe_output[] = '<h' . $size . '>' . $headline . '</h' . $size . '>';
		}
		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}
}

////////////////////////////////////
//
//  Textarea
//
////////////////////////////////////
function textarea_input( $id ) {
	$texteditor = bs_check_editor();
	$mform      = new MForm();
	$mform->addFieldset( 'Text <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Ja. Der Text in dem Editor wird nicht wie auf der Webseite dargestellt. Das ist Absicht :-).</p>
                      <p><em>Falls Sie Fragen zur Benutzung des Editors haben wenden Sie sich bitte an Ihren Webentwickler.</em></p>
                    </div>' );
	$mform->setAttribute( 'default-class', false );
	if ( $texteditor == 'markitup' ) {
		$mform->addTextAreaField( "$id.0.textarea", array(
			'label' => 'Text',
			'class' => "markitupEditor-simple",
			'id'    => 'value-00' . $id
		) );
	}
	if ( $texteditor == 'redactor' ) {
		$mform->addTextAreaField( "$id.0.textarea", array(
			'label' => 'Text',
			'class' => "redactorEditor2-simple",
			'id'    => 'redactor_00' . $id
		) );
	}
	echo $mform->show();
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
	$mform->addHtml( '<div class="col-sm-8">' );
	$mform->addTextField( "$id.0.class", array( 'label' => 'Klasse(n)' ) );
	$mform->addHtml( '</div><div class="col-sm-4">' );
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
                      <p>Hier können einen MediaManager Typen vergeben.</p>
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


////////////////////////////////////
//
//  Link
//
////////////////////////////////////
function link_input( $id ) {
	$mform = new MForm();
	$mform->addFieldset( 'Link <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>' );
	$mform->addHtml( '<div class="module_help_content">
                      <p>Folgt</p>
                    </div>' );

	$mform->addCustomLinkField( "$id.0.link", array(
		'label'       => 'Link',
		'data-tel'    => 'disable',
		'data-mailto' => 'disable',
		'data-media'  => 'disable'
	) );
	$mform->addTextField( "$id.0.link_bezeichnung", array( 'label' => 'Bezeichnung' ) );
	$mform->addHtml( '<div class="col-sm-6">' );
	$mform->addSelectField( "$id.0.link_headline", array(
		''   => 'Überschrift wird nicht verlinkt',
		'ja' => 'Überschrift wird verlinkt'
	), array( 'label' => 'Überschrift', 'data-width' => '90%', 'class' => 'selectpicker' ) );
	$mform->addHtml( '</div><div class="col-sm-6">' );
	$mform->addSelectField( "$id.0.link_image", array(
		''   => 'Bild wird nicht verlinkt',
		'ja' => 'Bild wird verlinkt'
	), array( 'label' => 'Bild', 'class' => 'selectpicker form-control' ) );
	$mform->addHtml( '</div>' );
	echo $mform->show();
}

function link_output( $headline, $size ) {
	$fe_output = [];
	$be_output = [];

	if ( $headline != '' ) {

		if ( $size == '' ) {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="alert alert-danger">
            <p><strong>Die Überschrift wird auf der Webseite nicht angezeigt!</strong></p>
            <p>Sie haben eine Überschrift aber keine Größe für die Überschrift angegeben.</p>
          </div>';
		} else {
			$be_output[] = '
          <legend>Überschrift</legend>
          <div class="form-group">
            <div class="col-sm-3 label_left">Überschrift</div>
            <div class="col-sm-9">' . $headline . '</div>
            <div class="col-sm-3 label_left">Art</div>
            <div class="col-sm-9">H' . $size . '</div>
          </div>';
			$fe_output[] = '<h' . $size . '>' . $headline . '</h' . $size . '>';
		}
		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}
}
