<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'portafolio';
$titulo = 'Portafolio · vapaesa';
$descripcion = 'Avisos en acero, neonflex, vallas, vinilos y papelería fabricados en Barranquilla.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';

$trabajos = [
  ['img' => 'aviso-acero-inoxidable.jpg', 'titulo' => 'Aviso Terra Mar en acero inoxidable', 'cat' => 'avisos'],
  ['img' => 'avisos-volumetricos.jpg', 'titulo' => 'Avisos volumétricos 3D', 'cat' => 'avisos'],
  ['img' => 'aviso-neonflex.jpg', 'titulo' => 'Aviso OPEN en acrílico y neonflex', 'cat' => 'neonflex'],
  ['img' => 'aviso-tijera.jpg', 'titulo' => 'Aviso tipo tijera en madera', 'cat' => 'avisos'],
  ['img' => 'valla-estructural.jpg', 'titulo' => 'Valla publicitaria estructural', 'cat' => 'gran-formato'],
  ['img' => 'vinilos-fachada.jpg', 'titulo' => 'Vinilos decorativos en fachada', 'cat' => 'gran-formato'],
  ['img' => 'letras-acero.jpg', 'titulo' => 'Letras en acero inoxidable con volumen', 'cat' => 'avisos'],
  ['img' => 'obra-1.jpg', 'titulo' => 'Instalación en sitio', 'cat' => 'gran-formato'],
  ['img' => 'obra-2.jpg', 'titulo' => 'Acabado de aviso', 'cat' => 'avisos'],
  ['img' => 'obra-3.jpg', 'titulo' => 'Montaje de pieza', 'cat' => 'gran-formato'],
  ['img' => 'obra-4.jpg', 'titulo' => 'Detalle de fabricación', 'cat' => 'avisos'],
  ['img' => 'obra-8.jpg', 'titulo' => 'Producción en taller', 'cat' => 'gran-formato'],
];
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Portafolio</p>
      <h1>Anuncios que se instalan, no solo se diseñan</h1>
      <p>Acero, acrílico, lona, vinilo y madera. Cada pieza sale del taller de Barranquilla.</p>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="filters" role="group" aria-label="Filtrar trabajos">
        <button class="filter is-on" type="button" data-filter="todo">Todo</button>
        <button class="filter" type="button" data-filter="avisos">Avisos</button>
        <button class="filter" type="button" data-filter="neonflex">Neonflex</button>
        <button class="filter" type="button" data-filter="gran-formato">Gran formato</button>
      </div>

      <div class="gallery">
        <?php foreach ($trabajos as $t): ?>
          <figure class="shot" data-cat="<?= e($t['cat']) ?>">
            <img src="assets/img/trabajos/<?= e($t['img']) ?>" alt="<?= e($t['titulo']) ?>" />
            <figcaption><?= e($t['titulo']) ?></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section" style="padding-top:0">
    <div class="wrap prose">
      <h2>AVISO · Acero inoxidable cromado</h2>
      <p>Letras en acero inoxidable con acabado tipo espejo, calibre 16 y volumen, con marco en lámina. Pensado para alta durabilidad en exterior e interior, protegiendo la inversión del cliente. Usamos sistemas de sujeción e iluminación según cada necesidad.</p>
      <h2>AVISO · Tipo bastidores</h2>
      <p>Marcos con lona, a escala de empresa. En proyectos grandes la logística de instalación la hace personal capacitado: piezas de varios metros de largo y alto, listas para fachada.</p>
      <h2>AVISOS volumétricos (3D)</h2>
      <p>Los avisos en acrílico son una alternativa resistente y duradera. Transparencia, color y volumen para que el negocio se lea de lejos y de cerca.</p>
      <p><a class="btn btn-wa" href="<?= e(wa_cotizar('Portafolio / un trabajo similar')) ?>" target="_blank" rel="noopener noreferrer">Quiero algo así</a></p>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
