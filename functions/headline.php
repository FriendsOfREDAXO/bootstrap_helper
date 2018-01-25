<?php

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
						<p>H1 wird für die Hauptüberschrift benutzt und darf nur einmal auf jeder Seite (am besten am Anfang) vorkommen. Die anderen Überschriften werden zur Gliederung des Dokumentes (wie bei einem Aufsatz) benutzt und folgen in logischer Reihenfolge.</p>
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
	), array( 'label' => 'Art' ) );
}

function element_headline_output( $headline_text, $headline_size ) {
	$fe_output = [];
	$be_output = [];

		if ( $headline_text == '' OR $headline_size == '' ) {
			$be_output[] = '<legend>Überschrift</legend>
							<div class="alert alert-danger">
								<p><strong>Die Überschrift wird auf der Webseite nicht angezeigt!</strong></p>
								<p>Bitte füllen Sie alle Felder aus!</p>
							</div>';
		} else {
			$be_output[] = '<legend>Überschrift</legend>
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
