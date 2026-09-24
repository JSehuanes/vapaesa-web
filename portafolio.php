<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'portafolio';
$titulo = 'Portafolio · vapaesa';
$descripcion = 'Avisos en acero, bastidores y volumétricos fabricados en Barranquilla.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';

$carousel = ['car-1.jpg', 'car-2.jpg', 'car-3.jpg', 'car-4.jpg'];
$letras = ['letra-1.jpg', 'letra-2.jpg', 'letra-3.jpg'];
$bastidores = ['letra-4.jpg', 'bas-1.jpg', 'bas-2.jpg', 'bas-3.jpg', 'bas-4.jpg', 'bas-5.jpg', 'bas-6.jpg', 'bas-7.jpg', 'bas-8.jpg', 'bas-9.jpg'];
?>

<main id="contenido">
  <section class="porta">
    <div class="wrap">
      <h1 class="porta-title">Anuncios publicitarios.</h1>

      <div class="porta-split">
        <div class="porta-carousel" data-carousel>
          <?php foreach ($carousel as $i => $img): ?>
            <figure class="porta-slide" data-slide<?= $i === 0 ? '' : ' hidden' ?>>
              <img src="assets/img/portafolio/<?= e($img) ?>" alt="Aviso en acero inoxidable" />
            </figure>
          <?php endforeach; ?>
          <div class="porta-dots">
            <?php foreach ($carousel as $i => $_): ?>
              <button type="button" class="porta-dot<?= $i === 0 ? ' is-on' : '' ?>" data-dot aria-label="Foto <?= (int) $i + 1 ?>"></button>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="porta-copy">
          <h2>AVISO - Realizado en acero inoxidable cromado.</h2>
          <p>Este proyecto lo realizamos para uno de los condominios más exclusivos de la costa. Letras fabricadas en acero inoxidable con un acabado tipo espejo, calibre 16 con 10 cm de volumen, con un marco en lámina galvanizada.</p>
          <p>Este aviso se definió de esta manera pensando en su alta durabilidad, protegiendo la inversión de nuestro cliente.</p>
        </div>
      </div>

      <div class="porta-letras">
        <?php foreach ($letras as $img): ?>
          <img src="assets/img/portafolio/<?= e($img) ?>" alt="Letra en acero inoxidable" />
        <?php endforeach; ?>
      </div>
      <p class="porta-nota">Este tipo de materiales son altamente utilizados en la publicidad en exteriores e interiores. Con nuestras capacidades logramos darles acabados especiales según cada tipo de necesidad: sistemas de iluminación integrada o de proyección indirecta, acabado texturizado, pintado o efectos especiales como el oro.</p>

      <div class="porta-split porta-split-rev">
        <div class="porta-copy">
          <h2>AVISO - Tipo bastidores.</h2>
          <p>Un proyecto a gran escala realizado para una empresa de gran escala. Los avisos tipo bastidores no son más que unos marcos decorados con lona, muy similar a un cuadro artístico pero con materiales más resistentes pensados para la intemperie.</p>
        </div>
        <div class="porta-thumbs">
          <?php foreach ($bastidores as $img): ?>
            <img src="assets/img/portafolio/<?= e($img) ?>" alt="Aviso tipo bastidor" />
          <?php endforeach; ?>
        </div>
      </div>
      <p class="porta-nota">Las dimensiones totales de los bastidores suman 36 metros de largo por 4 metros de alto, por lo que la logística para la instalación se realiza con personal altamente capacitado. Estructura realizada en aluminio para hacerla más ligera pero resistente, impresión digital en banner de 13 oz. Gracias a nuestros equipos de gran formato podemos llevar a cabo este tipo de proyectos de una manera más eficiente y accesible para nuestros clientes.</p>

      <div class="porta-vol">
        <img class="porta-vol-tall" src="assets/img/portafolio/vol-1.jpg" alt="Aviso volumétrico en acrílico" />
        <div class="porta-copy">
          <h2>AVISOS Volumétricos (3D)</h2>
          <p>En este tipo de aviso nos quedamos cortos en mencionar que son los más utilizados para imagen de toda empresa o negocio que desea ser vista de una manera más profesional y llegar a sus clientes con seguridad.</p>
        </div>
        <div class="porta-vol-stack">
          <img src="assets/img/portafolio/vol-2.jpg" alt="Fabricación de aviso volumétrico" />
          <p>Los avisos en acrílico son piezas publicitarias o informativas fabricadas en acrílico. Este material es una alternativa más resistente y duradera que el vidrio y se caracteriza por su transparencia, colores y brillo. Son ideales para interiores y exteriores, resistentes a la intemperie y a los rayos UV. Pueden personalizarse con impresiones digitales de alta calidad, son fáciles de instalar y mantener, y se usan en tiendas, hoteles, oficinas y centros comerciales.</p>
          <img src="assets/img/portafolio/vol-3.jpg" alt="Aviso volumétrico KOFTA" />
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
