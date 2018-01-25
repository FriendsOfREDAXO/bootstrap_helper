<?php

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
	$texteditor = bs_check_editor();

	$fe_output = [];
	$be_output = [];
	$text      = '';
	if ( $textarea != '' ) {

		if ( $texteditor == 'markitup' ) {
			$text = markitup::parseOutput( 'textile', $textarea );
		} else if ( $texteditor == 'redactor' ) {
			$text = html_entity_decode( $textarea );
		}


		$fe_output[] = $text;
		$be_output[] = '
			    <legend>Text</legend>
			    <div class="form-group">
			      <div class="col-sm-3 label_left">Text</div>
			      <div class="col-sm-9">' . $text . '</div>
			    </div>';
		if ( ! rex::isBackend() ) {
			return implode( $fe_output );
		} else {
			return implode( $be_output );
		}
	}

}