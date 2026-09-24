<?php
/** @var string $pagina */
?>
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
      <a class="<?= nav_class('productos', $pagina) ?>" href="productos.php">Productos promocionales</a>
      <a class="<?= nav_class('servicios', $pagina) ?>" href="servicios.php">Servicios</a>
      <a class="<?= nav_class('contacto', $pagina) ?>" href="contacto.php">Contacto</a>
      <button type="button" class="btn btn-wa btn-sm" data-quote-open>Cotizar <span class="quote-badge" hidden>0</span></button>
    </nav>
  </div>
</header>
