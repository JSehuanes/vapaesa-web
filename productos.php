<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'productos';
$titulo = 'Productos · vapaesa';
$descripcion = 'Tarjetas, papelería, publicidad impresa, empaques, estructuras y promocionales. Cotiza por WhatsApp.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';

$productos = [
  ['nombre' => 'Tarjetas de presentación', 'texto' => 'La pieza que se entrega de mano. Papel, acabado y color alineados a tu marca.'],
  ['nombre' => 'Papelería corporativa', 'texto' => 'Hojas, carpetas, sobres y kits de oficina para que todo el escritorio hable igual.'],
  ['nombre' => 'Publicidad impresa', 'texto' => 'Volantes, afiches, catálogos y piezas de campaña en full color.'],
  ['nombre' => 'Bolsas y empaques', 'texto' => 'El empaque también es aviso. Bolsas y cajas con tu identidad.'],
  ['nombre' => 'Porta pendones y estructuras', 'texto' => 'Soportes, bases y estructuras para que el mensaje se sostenga en punto de venta o evento.'],
  ['nombre' => 'Artículos promocionales', 'texto' => 'Objetos que viajan con el cliente y dejan la marca a la vista.'],
  ['nombre' => 'Páginas web y alojamiento', 'texto' => 'Sitio y hosting para acompañar la presencia impresa con presencia digital.'],
];
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Productos</p>
      <h1>Colores insuperables. Full impresión.</h1>
      <p>Sin tienda en línea por ahora: cada producto se cotiza con un vendedor por WhatsApp o por correo.</p>
    </div>
  </section>

  <section class="section">
    <div class="wrap grid-3">
      <?php foreach ($productos as $p): ?>
        <article class="card">
          <h3><?= e($p['nombre']) ?></h3>
          <p><?= e($p['texto']) ?></p>
          <a class="btn btn-wa btn-sm" href="<?= e(wa_cotizar($p['nombre'])) ?>" target="_blank" rel="noopener noreferrer">Cotizar por WhatsApp</a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
