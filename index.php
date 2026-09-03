<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'inicio';
$titulo = 'vapaesa · Publicidad e impresión en Barranquilla';
$descripcion = 'Avisos, gran formato, papelería y promocionales. Cotiza por WhatsApp o escribe a comercial@vapaesa.com.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="hero" style="background-image: url('assets/img/trabajos/aviso-acero-inoxidable.jpg');">
    <div class="wrap hero-copy">
      <div class="marks" aria-hidden="true"><span class="mark"></span><span class="mark"></span></div>
      <p class="kicker">Publicidad · Impresión · Barranquilla</p>
      <h1>Estás buscando un servicio confiable en publicidad</h1>
      <p class="script">O es mi Impresión!</p>
      <p class="lead">Avisos, gran formato, papelería y piezas que se ven, se tocan y duran. Del taller a la calle, con atención directa de vendedores.</p>
      <div class="hero-actions">
        <a class="btn btn-wa" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">Pedir cotización por WhatsApp</a>
        <a class="btn btn-ghost" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Hablar con un vendedor</a>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <div>
          <p class="eyebrow">Qué hacemos</p>
          <h2>Del aviso en acero a la tarjeta que dejas en la mesa</h2>
        </div>
        <a class="btn btn-outline" href="servicios.php">Ver servicios</a>
      </div>
      <div class="grid-4">
        <article class="card">
          <h3>Avisos</h3>
          <p>Acero inoxidable, acrílico, neonflex, volumétricos y tipo tijera. Piezas con volumen, luz y durabilidad.</p>
          <a class="more" href="servicios.php#avisos">Ver avisos</a>
        </article>
        <article class="card">
          <h3>Gran formato</h3>
          <p>Vallas, banners, vinilos de fachada, señalización y estructuras. Impresión full color a escala de calle.</p>
          <a class="more" href="servicios.php#gran-formato">Ver gran formato</a>
        </article>
        <article class="card">
          <h3>Papelería</h3>
          <p>Tarjetas, carpetas, papelería corporativa y piezas de escritorio con color fiel a tu marca.</p>
          <a class="more" href="servicios.php#papeleria">Ver papelería</a>
        </article>
        <article class="card">
          <h3>Promo</h3>
          <p>Artículos promocionales, bolsas y empaques para que tu marca viaje con el cliente.</p>
          <a class="more" href="servicios.php#promo">Ver promo</a>
        </article>
      </div>
    </div>
  </section>

  <section class="section" style="padding-top:0">
    <div class="wrap">
      <div class="section-head">
        <div>
          <p class="eyebrow">Taller</p>
          <h2>Trabajos que ya están en la calle</h2>
        </div>
        <a class="btn btn-outline" href="portafolio.php">Portafolio completo</a>
      </div>
      <div class="mosaic">
        <a href="portafolio.php"><img src="assets/img/trabajos/aviso-acero-inoxidable.jpg" alt="Aviso Terra Mar en acero inoxidable" /></a>
        <a href="portafolio.php"><img src="assets/img/trabajos/aviso-neonflex.jpg" alt="Aviso OPEN en acrílico y neonflex" /></a>
        <a href="portafolio.php"><img src="assets/img/trabajos/vinilos-fachada.jpg" alt="Vinilos publicitarios en fachada" /></a>
        <a href="portafolio.php"><img src="assets/img/trabajos/valla-estructural.jpg" alt="Valla publicitaria estructural" /></a>
        <a href="portafolio.php"><img src="assets/img/trabajos/aviso-tijera.jpg" alt="Aviso tipo tijera en madera" /></a>
      </div>
    </div>
  </section>

  <section class="section products-band">
    <div class="wrap">
      <p class="eyebrow" style="color:#9ecbff">Productos</p>
      <h2>Colores insuperables. Full impresión.</h2>
      <div class="grid-4" style="margin-top:28px">
        <?php
        $destacados = [
          'Tarjetas de presentación',
          'Papelería corporativa',
          'Publicidad impresa',
          'Bolsas y empaques',
        ];
        foreach ($destacados as $item): ?>
          <article class="product">
            <h3><?= e($item) ?></h3>
            <a class="btn btn-wa btn-sm" href="<?= e(wa_cotizar($item)) ?>" target="_blank" rel="noopener noreferrer">Cotizar</a>
          </article>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:22px"><a class="btn btn-ghost" href="productos.php">Ver todos los productos</a></p>
    </div>
  </section>

  <section class="section clients">
    <div class="wrap">
      <p class="eyebrow">Clientes</p>
      <h2>Marcas que ya nos encargan su imagen</h2>
      <div class="logo-row" style="margin-top:28px">
        <img src="assets/img/clientes/kofta.svg" alt="Kofta" />
        <img src="assets/img/clientes/aduana.svg" alt="Aduana" />
        <img src="assets/img/clientes/kinder-rio.svg" alt="Kinder Río" />
        <img src="assets/img/clientes/issa-saieh.svg" alt="Issa Saieh" />
        <img src="assets/img/clientes/lanapita.svg" alt="La Ñapita" />
        <img src="assets/img/clientes/adama.svg" alt="Adama" />
        <img src="assets/img/clientes/cajacopi.svg" alt="Cajacopi" />
        <img src="assets/img/clientes/steckerl.svg" alt="Steckerl" />
        <img src="assets/img/clientes/chacon.svg" alt="Chacón" />
        <img src="assets/img/clientes/lamerica.svg" alt="Lamerica" />
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap grid-2">
      <div>
        <p class="eyebrow">La marca</p>
        <h2>vapaesa se queda en la calle</h2>
        <p>Somos un taller de publicidad e impresión en Barranquilla. Fabricamos avisos, gran formato y papelería con materiales pensados para el clima de la costa y para que la inversión del cliente dure.</p>
        <p>Compromiso, pertenencia y vocación de servicio: la pieza sale del taller lista para instalarse, entregarse y verse.</p>
      </div>
      <div>
        <img src="assets/img/trabajos/avisos-volumetricos.jpg" alt="Avisos volumétricos en acrílico" style="height:320px;width:100%;object-fit:cover;border-radius:18px" />
      </div>
    </div>
  </section>

  <section class="section cta-band">
    <div class="wrap">
      <div>
        <p class="eyebrow" style="color:#9ecbff">Comercial</p>
        <h2>Cuéntanos qué hay que imprimir o instalar</h2>
        <p>WhatsApp para cotizar o hablar con un vendedor. El formulario llega a <?= e(MAIL_TO) ?>.</p>
      </div>
      <div class="hero-actions">
        <a class="btn btn-wa" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">WhatsApp cotización</a>
        <a class="btn btn-ghost" href="contacto.php">Escribir al correo</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
