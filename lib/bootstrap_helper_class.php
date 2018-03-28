<?php
/**
 * Bootstrap Helper Addon.
 *
 * @author kreischer[at]concedra[dot]de Oliver Kreischer
 *
 */

class rex_bootstrap_helper {

  ////////////////////////////////////
  //  check Editor
  ////////////////////////////////////
  function check_editor() {
    if ( ! rex_addon::get( 'markitup' )->isAvailable() && ! rex_addon::get( 'redactor2' )->isAvailable() ) {
      echo rex_view::error( 'Dieses Modul ben&ouml;tigt das "MarkItUp" oder das "Redactor 2" Addon!' );
    } else {
      if ( rex_addon::get( 'markitup' )->isAvailable() ) {
        $return = 'markitup';
        if ( ! markitup::profileExists( 'simple' ) ) {
          markitup::insertProfile( 'simple', 'Angelegt durch das Addon Bootstrap Helper', 'textile', 200, 800, 'relative', 'bold,italic,underline,deleted,quote,sub,sup,code,unorderedlist, orderedlist, grouplink[internal|external|mailto]' );
        }
      }
      if ( rex_addon::get( 'redactor2' )->isAvailable() ) {
        $return = 'redactor';
        if ( ! redactor2::profileExists( 'simple' ) ) {
          redactor2::insertProfile('simple', 'Angelegt durch das Addon Bootstrap Helper', '200', '800', 'relative', '0', '0', '0', '1', 'bold, italic, underline, deleted, quote, sub, sup, code, unorderedlist, orderedlist, grouplink[external|internal|email], cleaner','');
        }
      }
      return $return;
    }
  }

  ////////////////////////////////////
  // Container
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


  ////////////////////////////////////
  //  ID / Class
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

/*
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
*/

  ////////////////////////////////////
  //  Media Manager Typ
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

/*
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
*/

////////////////////////////////////
//  Headline
////////////////////////////////////
function headline_input( $id, $mform ) {
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

function headline_output( $headline_text, $headline_size ) {
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

  ////////////////////////////////////
  //  Textarea
  ////////////////////////////////////
  function textarea_input( $id, $mform ) {

    $bsh = NEW rex_bootstrap_helper();
    $texteditor = $bsh->check_editor();

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

  function textarea_output( $textarea ) {
    $bsh = NEW rex_bootstrap_helper();
    $texteditor = $bsh->check_editor();

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


////////////////////////////////////
//  Video (extern)
////////////////////////////////////
function video_input( $id, $mform ) {
  $mform->addFieldset( 'Film (extern) <i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
    'class' => 'video',
    'style' => 'display:none;'
  ) );
  $mform->addHtml( '<div class="module_help_content">
            <p>In dem Eingabefeld "Film-ID" bitte nur die ID des Videos eingeben<br><br>
            Beispiel:</p>
            <ul>
            <li>YouTube: https://www.youtube.com/watch?v=<b>jsbhA64PvwA</b></li>
            <li>Vimeo: https://vimeo.com/<b>142260520</b></li>
            </ul>
          </div>' );

  $mform->addTextField( "$id.0.video_id", array( 'label' => 'Film-ID ' ) );
  $mform->addSelectField( "$id.0.video_service", array(
    '' => 'Bitte wählen',
    1  => 'YouTube',
    2  => 'Vimeo'
  ), array( 'label' => 'Anbieter' ) );
}

function video_output( $video_id, $video_service ) {
  $fe_output = [];
  $be_output = [];

    if ( $video_id == '' OR $video_service == '' ) {
      $be_output[] = '<legend>Video</legend>
              <div class="alert alert-danger">
                <p><strong>Es wird kein Video auf der Webseite angezeigt!</strong></p>
                <p>Bitte füllen Sie alle Felder aus!</p>
              </div>';
    } else {
      if ($video_service == '1') {
        $fe_output[] = '
          <div class="responsive-video">
            <iframe src="https://www.youtube-nocookie.com/embed/'.$video_id.'?rel=0&amp;showinfo=0"
              width="1600" height="900" frameborder="0" webkitAllowFullScreen
              mozallowfullscreen allowFullScreen></iframe>
              </div>'.PHP_EOL;
          $video_service = 'YouTube';
      }
      if ($video_service == '2') {
          $fe_output[] = '
          <div class="responsive-video">
          <iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp
          ;byline=0&amp;portrait=0&amp;autoplay=0"
          width="1600" height="900" frameborder="0" webkitAllowFullScreen
          mozallowfullscreen allowFullScreen></iframe>
          </div>'.PHP_EOL;
        $video_service = "Vimeo";
      }
      $be_output[] = '<legend>Video (extern)</legend>
              <div class="form-group">
                <div class="col-sm-3 label_left">Video ID</div>
                <div class="col-sm-9">' . $video_id . '</div>
                <div class="col-sm-3 label_left">Anbieter</div>
                <div class="col-sm-9">' . $video_service . '</div>
              </div>';
    }
    if ( ! rex::isBackend() ) {
      return implode( $fe_output );
    } else {
      return implode( $be_output );
    }
}


////////////////////////////////////
//  Downloads
////////////////////////////////////
function downloads_input( $id, $mform ) {
  $mform->addFieldset( 'Downloads<i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>', array(
    'class' => 'downloads',
    'style' => 'display:none;'
  ) );
  $mform->addHtml( '<div class="module_help_content">
            <p>Downloads</p>
              </div>' );

  $mform->addTextField("$id.0.downloads_headline", array( 'label' => 'Überschrift' ) );
  $mform->addMedialistField(1, array('label'=>'Dateien'));
}

function downloads_output( $downloads_headline, $REX_MEDIALIST_1 ) {
  $fe_output = [];
  $be_output = [];

    if ( $REX_MEDIALIST_1 == '' ) {
      $be_output[] = '<legend>Downloads</legend>
              <div class="alert alert-danger">
                <p><strong>Es werden keine Downloads auf der Webseite zur Verfügung gestellt.</strong></p>
                <p>Bitte wählen Sie midestens eine Datei au!</p>
              </div>';
    } else {
      if ($downloads_headline != '') {
        $fe_output[] = '
          Download Headline'.PHP_EOL;
      }
      if ($REX_MEDIALIST_1 != '') {


          if (!function_exists('datei_groesse')) {
            function datei_groesse($URL) {
              $groesse = filesize($URL);
              if($groesse<1000) {
                return number_format($groesse, 0, ",", ".")." Bytes";
              } elseif($groesse<1000000) {
                return number_format($groesse/1024, 0, ",", ".")." kB";
              } else {
                return number_format($groesse/1048576, 0, ",", ".")." MB";
              }
            }
          }

          if (!function_exists('parse_icon')) {
            function parse_icon($ext) {
              switch (strtolower($ext)) {
                case 'doc': return '<i class="fa fa-file-word-o"></i>&nbsp;';
                case 'pdf': return '<i class="fa fa-file-pdf-o"></i>&nbsp;';
                case 'zip': return '<i class="fa fa-archive-pdf-o"></i>&nbsp;';
                case 'jpg': return '<i class="fa fa-file-image-o"></i>&nbsp;';
                case 'png': return '<i class="fa fa-file-image-o"></i>&nbsp;';
                case 'gif': return '<i class="fa fa-file-image-o"></i>&nbsp;';
                default:
                return '';
              }
            }
          }


            $arr = explode(",",$REX_MEDIALIST_1);
            $download_be_dateien = '';
            $download_fe_dateien = '';

            foreach ($arr as $value_dl) {
              $extension = substr(strrchr($value_dl, '.'), 1);
              $parsed_icon = parse_icon($extension);
              $downloadmedia = rex_media::get($value_dl);
              $file_desc = $downloadmedia->getValue('med_description');


              $download_fe_dateien .='<li><a href="index.php?rex_media_type=download&rex_media_file='.$value_dl.'">'.$parsed_icon;
              $download_be_dateien .= $value_dl.'<br/>';

              if ($file_desc != "") {
                $download_fe_dateien .= $file_desc;
              } else {
                $download_fe_dateien .= $value_dl;
              }

              $download_fe_dateien .= ' ('.datei_groesse(rex_path::media($value_dl)).')</a></li>';
            }
          $fe_output[] = '<ul class="download" >'.$download_fe_dateien.'</ul>';
      }
      $be_output[] = '<legend>Downloads</legend>
              <div class="form-group">
                <div class="col-sm-3 label_left">Überschrift</div>
                <div class="col-sm-9">' . $downloads_headline . '</div>
                <div class="col-sm-3 label_left">Dateie(n)</div>
                <div class="col-sm-9">'.$download_be_dateien.'</div>
              </div>';
    }
    if ( ! rex::isBackend() ) {
      return implode( $fe_output );
    } else {
      return implode( $be_output );
    }
}




////////////////////////////////////
//  Link
////////////////////////////////////
function link_input( $id, $mform ) {
  $mform->addFieldset(
    'Link (intern / extern)<i class="module_help_link fa fa-exclamation-triangle" aria-hidden="true"></i>',
    array(
      'class' => 'link',
      'style' => 'display:none;'
    )
  );
  $mform->addHtml( '<div class="module_help_content">
      <p>Es kann nur eine interner ODER ein externer Link angegeben werden.</p>
      <p><em>Sollten Sie nicht wissen, was mit "Darstellung" oder "CSS Klasse" gemeint ist fragen Sie Ihren Webentwickler.</em></p>
      </div>' );
  $mform->addTextField("$id.0.link_name", array( 'label' => 'Bezeichnung'));
  $mform->addTextField("$id.0.link_extern", array( 'label' => 'Link extern'));
  $mform->addLinkField(1,array('label'=>'Link intern'));
  $mform->addSelectField(
    "$id.0.link_type",
    array(
      'Normal'  => 'Normal',
      'Button'  => 'Button'
    ),
    array(
      'label' => 'Darstellung'
    )
  );
  $mform->addTextField("$id.0.link_class", array( 'label' => 'CSS Klasse'));
}

function link_output( $link_name, $link_extern, $REX_LINK_1, $link_type, $link_class ) {
  $fe_output = [];
  $be_output = [];

      $be_output[] = '<legend>Link (intern / extern)</legend>';

    if ( $link_name == '' ) {
      $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Bitte geben Sie unbedingt eine Link Bezeichnung an!</strong></p>
              </div>';
     }


    if ( $link_extern == '' AND $REX_LINK_1 == '') {
      $be_output[] = '<div class="alert alert-danger">
                <p><strong>Es wird kein Link ausgegeben. Bitte geben Sie einen Link an!</strong></p>
              </div>';
    } else if ( $link_extern != '' AND $REX_LINK_1 != '') {
      $be_output[] = '
              <div class="alert alert-danger">
                <p><strong>Es wird kein Link ausgegeben. Bitte geben Sie nur einen externen ODER einen internen Link an!</strong></p>
              </div>';

    } else {


      $be_output[] = '<div class="form-group">';

     if($link_name != '')  {
       $be_output[] = '
         <div class="col-sm-3 label_left">Bezeichnung</div>
         <div class="col-sm-9">'.$link_name.'</div>';
     }

     if($link_extern != '')  {
      $be_output[] = '
                <div class="col-sm-3 label_left">extern</div>
                <div class="col-sm-9">'.$link_extern.'</div>';

     }

// NEU !!!

 if ($link_class != '') {
                  if ($link_type == 'Button') {
                    $fe_output[] = '<a class="btn btn-primary '.$link_class.'" href="'.$link_extern.'" role="button" >'.$link_name.'</a>';
                  } else {
                    $fe_output[] = '<a class="'.$link_class.'" href="'.$link_extern.'" >'.$link_name.'</a>';
                  }
                } else {
                  if ($link_type == 'Button') {
                    $fe_output[] = '<a class="btn btn-primary" href="'.$link_extern.'" role="button" >'.$link_name.'</a>';
                  } else {
                    $fe_output[] = '<a href="'.$link_extern.'" >'.$link_name.'</a>';
                  }
                }

     if($REX_LINK_1 != '')  {
       $article=rex_article::get($REX_LINK_1);
       $name=$article->getName();
       $be_output[] = '
          <div class="col-sm-3 label_left">Link intern</div>
          <div class="col-sm-9">   <a href="index.php?page=content&article_id='.$REX_LINK_1.'&mode=edit">'.$name.' (ID = '.$REX_LINK_1.')</a> </div>';
        }
        $be_output[] = '
          <div class="col-sm-3 label_left">Darstellung</div>
          <div class="col-sm-9">'.$link_type.'</div>';

     if($link_class != '')  {
       $be_output[] = '
         <div class="col-sm-3 label_left">CSS Klasse</div>
         <div class="col-sm-9">'.$link_class.'</div>';
     }

     $be_output[] = '
       </div>';
    }
    if ( ! rex::isBackend() ) {
      return implode( $fe_output );
    } else {
      return implode( $be_output );
    }
}



}
