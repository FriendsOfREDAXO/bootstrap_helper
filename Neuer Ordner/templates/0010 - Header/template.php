<?php
header('Content-Type: text/html; charset=utf-8');
// $ycom_user = rex_ycom_auth::getUser();
// dump($ycom_user);

// error_reporting(0);
error_reporting(E_ALL);


// Artikel IDs
$siteStartArticle  = rex_article::getSiteStartArticleId();
$currentArtikelId  = rex_article::getCurrentId();
$notfoundArticleId = rex_article::getNotfoundArticleId();
$artikelStatus     = rex_article::getCurrent()->getValue('status');
$currentUrl        = rex_yrewrite::getFullUrlByArticleId($currentArtikelId);


if (!rex_backend_login::hasSession()) {
  if ($this->getValue('status') == 0) {
    header ('HTTP/1.1 301 Moved Permanently');
    header('Location: '.rex_getUrl(rex_article::getNotFoundArticleId(), rex_clang::getCurrentId()));
    die();
  }
}
// 404er Header senden
if ($currentArtikelId == $notfoundArticleId) {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
}
?>
<!DOCTYPE html>
<html lang="<?php echo rex_clang::getCurrent()->getCode(); ?>">

<head>
  <meta charset="utf-8" />
  <?php
    $seo = new rex_yrewrite_seo();
    echo $seo->getTitleTag().PHP_EOL;
    echo $seo->getDescriptionTag().PHP_EOL;
    echo $seo->getRobotsTag().PHP_EOL;
    echo $seo->getHreflangTags().PHP_EOL;
    echo $seo->getCanonicalUrlTag().PHP_EOL;
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">

  <?php // http://www.geo-tag.de/generator/de.html ?>
  <meta name="geo.region" content="DE-DE" />
  <meta name="geo.placename" content="" />
  <meta name="geo.position" content="" />
  <meta name="ICBM" content="" />

  <meta name="format-detection" content="telephone=no">
  <meta name="format-detection" content="date=no">
  <meta name="format-detection" content="address=no">
  <meta name="format-detection" content="email=no">


  <link rel="icon" href="<?php echo rex_url::base('favicon.ico') ?>" type="image/x-icon" />

  <?php // if($ua->mobile || $ua->tablet) {?>
  <link rel="apple-touch-icon" href="<?php echo rex_url::base('apple-touch-icon-precomposed.png') ?>">
  <meta name="apple-mobile-web-app-title" content="REX5 BASE">
  <meta name="msapplication-TileImage" content="<?php echo rex_url::base('apple-touch-icon-precomposed.png') ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <?php // }?>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo theme_url::assets('frontend/css/styles.min.css') ?>" type="text/css" media="screen,print" />
  <link rel="stylesheet" href="<?php echo theme_url::assets('frontend/css/print.min.css') ?>" type="text/css" media="print" />

  <script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js"></script>

</head>

<?php if ($siteStartArticle  == $currentArtikelId) {
    echo '<body id="home">'.PHP_EOL;
  } else {
    echo '<body>'.PHP_EOL;
  }
?>

