<?php
/** @var string $pagina */
?>
<div class="topbar">
  <p><?= e(SITE_TAGLINE) ?></p>
  <a href="<?= e(INSTAGRAM) ?>" target="_blank" rel="noopener noreferrer">Instagram @vapaesa</a>
</div>

<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="index.php" aria-label="vapaesa inicio">
      <img src="assets/img/logo.svg" alt="vapaesa" width="219" height="33" />
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="menu-principal">
      <span class="sr-only">Menú</span>
      <span></span><span></span><span></span>
    </button>

    <nav id="menu-principal" class="nav">
      <a class="<?= nav_class('inicio', $pagina) ?>" href="index.php">Inicio</a>
      <a class="<?= nav_class('portafolio', $pagina) ?>" href="portafolio.php">Portafolio</a>
      <a class="<?= nav_class('productos', $pagina) ?>" href="productos.php">Productos</a>
      <a class="<?= nav_class('servicios', $pagina) ?>" href="servicios.php">Servicios</a>
      <a class="<?= nav_class('contacto', $pagina) ?>" href="contacto.php">Contacto</a>
      <a class="btn btn-wa btn-sm" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">Cotizar</a>
    </nav>
  </div>
</header>
