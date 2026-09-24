<?php
/** @var string $pagina */
?>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="<?= e(u()) ?>" aria-label="vapaesa inicio">
      <img src="<?= e(u('assets/img/logo.svg')) ?>" alt="vapaesa" width="219" height="33" />
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="menu-principal">
      <span class="sr-only">Menú</span>
      <span></span><span></span><span></span>
    </button>

    <nav id="menu-principal" class="nav">
      <a class="<?= nav_class('inicio', $pagina) ?>" href="<?= e(u()) ?>">Inicio</a>
      <a class="<?= nav_class('portafolio', $pagina) ?>" href="<?= e(u('portafolio')) ?>">Portafolio</a>
      <a class="<?= nav_class('productos', $pagina) ?>" href="<?= e(u('productos')) ?>">Productos promocionales</a>
      <a class="<?= nav_class('servicios', $pagina) ?>" href="<?= e(u('servicios')) ?>">Servicios</a>
      <a class="<?= nav_class('contacto', $pagina) ?>" href="<?= e(u('contacto')) ?>">Contacto</a>
      <button type="button" class="btn btn-wa btn-sm" data-quote-open>Cotizar <span class="quote-badge" hidden>0</span></button>
    </nav>
  </div>
</header>
