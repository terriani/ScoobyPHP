<!DOCTYPE html>
<html lang="<?= SITE_LANG ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="imagem/x-icon" href="<?= SITE_ICON ?>" />
  <link rel="icon" type="imagem/png" href="<?= SITE_ICON ?>" />
  <link rel="shortcut icon" type="imagem/x-icon" href="<?= SITE_ICON ?>" />
  <?php
  \Scooby\Html\Seo::keywordsLoad();
  $op = new \CoffeeCode\Optimizer\Optimizer();
  define('OPTIMIZE', $op->optimize(
    $_SESSION['pageTitle'],
    SITE_DESCRIPTION,
    BASE_URL,
    SITE_ICON
  )->render());
  echo OPTIMIZE;
  unset($_SESSION['pageTitle']);
  use Scooby\Html\Assets;
  Assets::headerLoad();
  ?>
</head>
<body>
  <?php
  Assets::bodyTopLoad();
