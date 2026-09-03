<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'servicios';
$titulo = 'Servicios · vapaesa';
$descripcion = 'Avisos, gran formato, papelería y promocionales en Barranquilla.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Servicios</p>
      <h1>Fabricación e instalación, no solo diseño</h1>
      <p>Cuatro líneas de taller. Elige una y pide cotización o habla con un vendedor.</p>
    </div>
  </section>

  <section class="section" style="padding-top:24px">
    <div class="wrap">
      <article class="service-block" id="avisos">
        <img src="assets/img/trabajos/aviso-acero-inoxidable.jpg" alt="Aviso en acero inoxidable" />
        <div>
          <p class="eyebrow">01</p>
          <h2>Avisos</h2>
          <p>Acero inoxidable cromado, acrílico volumétrico, neonflex, letras 3D y avisos tipo tijera en madera. Materiales para interior y exterior, con iluminación cuando el proyecto lo pide.</p>
          <div class="hero-actions">
            <a class="btn btn-wa" href="<?= e(wa_cotizar('Avisos')) ?>" target="_blank" rel="noopener noreferrer">Cotizar avisos</a>
            <a class="btn btn-outline" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Hablar con un vendedor</a>
          </div>
        </div>
      </article>

      <article class="service-block" id="gran-formato">
        <img src="assets/img/trabajos/valla-estructural.jpg" alt="Valla estructural" />
        <div>
          <p class="eyebrow">02</p>
          <h2>Gran formato</h2>
          <p>Vallas, banners, vinilos de fachada, señalización y bastidores de gran escala. Impresión full color e instalación con personal capacitado cuando la pieza es de varios metros.</p>
          <div class="hero-actions">
            <a class="btn btn-wa" href="<?= e(wa_cotizar('Gran formato')) ?>" target="_blank" rel="noopener noreferrer">Cotizar gran formato</a>
            <a class="btn btn-outline" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Hablar con un vendedor</a>
          </div>
        </div>
      </article>

      <article class="service-block" id="papeleria">
        <img src="assets/img/trabajos/obra-7.jpg" alt="Producción de papelería e impresión" />
        <div>
          <p class="eyebrow">03</p>
          <h2>Papelería</h2>
          <p>Tarjetas de presentación, papelería corporativa y publicidad impresa. Color fiel, tirajes para oficina, evento o campaña.</p>
          <div class="hero-actions">
            <a class="btn btn-wa" href="<?= e(wa_cotizar('Papelería')) ?>" target="_blank" rel="noopener noreferrer">Cotizar papelería</a>
            <a class="btn btn-outline" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Hablar con un vendedor</a>
          </div>
        </div>
      </article>

      <article class="service-block" id="promo">
        <img src="assets/img/trabajos/vinilos-fachada.jpg" alt="Aplicación de vinilo y marca en punto de venta" />
        <div>
          <p class="eyebrow">04</p>
          <h2>Promo</h2>
          <p>Artículos promocionales, bolsas y empaques. La marca sale del local y sigue trabajando en la mano del cliente.</p>
          <div class="hero-actions">
            <a class="btn btn-wa" href="<?= e(wa_cotizar('Promocionales')) ?>" target="_blank" rel="noopener noreferrer">Cotizar promo</a>
            <a class="btn btn-outline" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Hablar con un vendedor</a>
          </div>
        </div>
      </article>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
