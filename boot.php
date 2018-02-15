<?php
$this->setProperty( 'author', 'Friends Of REDAXO' );

if ( rex::isBackend() && rex::getUser() ) {
	rex_perm::register( 'bootstrap_helper[]' );

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
//  Link / Button
////////////////////////////////////
function bsh_element_link_button_input( $id, $mform ) {
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





