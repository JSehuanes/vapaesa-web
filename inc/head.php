<?php
/** @var string $titulo */
/** @var string $descripcion */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= e($titulo) ?></title>
  <meta name="description" content="<?= e($descripcion) ?>" />
  <link rel="icon" type="image/svg+xml" href="<?= e(u('assets/img/favicon.svg')) ?>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= e(u('assets/css/style.css')) ?>?v=<?= e(asset_v()) ?>" />
</head>
<body>
  <a class="skip" href="#contenido">Ir al contenido</a>
