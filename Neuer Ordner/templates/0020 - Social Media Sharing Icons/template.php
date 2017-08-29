<?php

$textwhatsapp         = htmlspecialchars($this->getValue("art_text_whatsapp"));
$beschreibung         = htmlspecialchars($this->getValue("art_individuelle_beschreibung"));
$beschreibung_twitter = htmlspecialchars($this->getValue('art_text_twitter'));
$bild                 = htmlspecialchars($this->getValue("art_social_image"));

$home = new rex_article_content(rex_article::getSiteStartArticleId());;

if ($textwhatsapp        == '' ) {$textwhatsapp       = htmlspecialchars($home->getValue('art_text_whatsapp'));         };
if ($beschreibung_twitter  == '' ) {$beschreibung_twitter = htmlspecialchars($home->getValue('art_text_twitter'));        };
if ($beschreibung        == '' ) {$beschreibung       = htmlspecialchars($home->getValue('art_individuelle_beschreibung')); };
if ($bild            == '' ) {$bild           = htmlspecialchars($home->getValue('art_social_image'));        };

$mobileclass = '';

// $ua = new UserAgent();
// if($ua->mobile) {
  $mobileclass = 'mobile';
// }

$sharingicons[] = '<div class="socialsharing_template '.$mobileclass.' ">';

// Facebook
$sharingicons[] = '<a class="sharefacebook extern" href="https://www.facebook.com/sharer/sharer.php?u='.$seo->getCanonicalUrl().'" title="{{ Share on Facebook }}"></a>';

// Twitter
$sharingicons[] = '<a class="sharetwitter extern" href="https://twitter.com/share?url='.$seo->getCanonicalUrl().'&text='.$beschreibung_twitter.'" title="{{ Share on Twitter }}"></a>';

// WhatsApp
// if ($ua->mobile) {
$sharingicons[] = '<a class="sharewhatsapp extern" href="whatsapp://send?text='.$textwhatsapp.' '.$seo->getCanonicalUrl().'" data-action="share/whatsapp/share" title="{{ Share on WhatsApp }}"></a>';
// }

// Google
$sharingicons[] = '<a class="sharegoogle extern" href="https://plus.google.com/share?url='.$seo->getCanonicalUrl().'" title="{{ Share on Google + }}"></a>';

// XING
$sharingicons[] = '<a class="sharexing extern" href="https://www.xing.com/app/user?op=share;url='.$seo->getCanonicalUrl().'" title="{{ Share on XING }}"></a>';

// LinkedIn
// $sharingicons[] = '<a class="sharelinkedin extern" href="https://www.linkedin.com/shareArticle?mini=true&url='.$seo->getCanonicalUrl().'" title="{{ Share on LinkedIn }}"></a>';

// E-Mail
$sharingicons[] = '<a class="sharemail" href="mailto:?subject={{ Empfehlung E-Mail subject Text }}&body={{ E-Mail empfehlen Text {{ '.$seo->getCanonicalUrl().'" title="{{ Send sharing Email }}"></a>';
$sharingicons[] = '</div>';

?>

<meta property="og:url"          content="<?php echo $seo->getCanonicalUrl(); ?>" />
<meta property="og:type"         content="website" />
<meta property="og:title"        content="<?php echo $seo->getTitleTag(); ?>" />
<meta property="og:image"        content="/index.php?rex_img_type=socialsharing_1200x630&rex_img_file=<?php echo $bild; ?>" />
<meta property="og:description"  content="<?php echo $beschreibung; ?>" />
<meta property="og:site_name"    content="Site Name" />
<meta property="og:locale"       content="de_DE" />
<meta property="article:author"  content="" />

<meta name="twitter:card"        content="summary_large_image" />
<meta name="twitter:site"        content="" /> <!-- @site_account -->
<meta name="twitter:creator"     content="" /> <!-- @individual_account -->
<meta name="twitter:url"         content="<?php echo $seo->getCanonicalUrl(); ?>" />
<meta name="twitter:title"       content="<?php echo $seo->getTitleTag(); ?>" />
<meta name="twitter:description" content="<?php echo $beschreibung_twitter; ?>" />
<meta name="twitter:image"       content="/index.php?rex_img_type=socialsharing_1200x630&rex_img_file=<?php echo $bild; ?>" />

<meta itemprop="name"            content="<?php echo $seo->getTitleTag(); ?>" />
<meta itemprop="description"     content="<?php echo $beschreibung; ?>" />
<meta itemprop="image"           content="/index.php?rex_img_type=socialsharing_1200x630&rex_img_file=<?php echo $bild; ?>" />

<?php
if ($this->getValue("art_show_social_sharing") == '1') {
  echo implode($sharingicons, "\n");
};
?>
