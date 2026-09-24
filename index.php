<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'inicio';
$titulo = 'vapaesa · Publicidad e impresión en Barranquilla';
$descripcion = 'Avisos, gran formato, papelería y promocionales. Cotiza por WhatsApp o escribe a comercial@vapaesa.com.';

$obras = [
    ['img' => 'aviso-acero-inoxidable.jpg', 'alt' => 'Aviso acero inoxidable', 'cat' => 'avisos'],
    ['img' => 'valla-estructural.jpg', 'alt' => 'Valla publicitaria', 'cat' => 'estructuras'],
    ['img' => 'avisos-volumetricos.jpg', 'alt' => 'Aviso acrílico volumétrico', 'cat' => 'avisos'],
    ['img' => 'vinilos-fachada.jpg', 'alt' => 'Vinilos decorativos publicitarios', 'cat' => 'vinilos'],
    ['img' => 'aviso-neonflex.jpg', 'alt' => 'Aviso OPEN en acrílico y neonflex', 'cat' => 'neonflex'],
    ['img' => 'aviso-tijera.jpg', 'alt' => 'Aviso tipo tijera en madera', 'cat' => 'avisos'],
];

$servicios = [
    ['id' => 'avisos', 'n' => '01', 'titulo' => 'Avisos', 'txt' => 'Acero, acrílico, neonflex, volumétricos y tipo tijera.'],
    ['id' => 'gran-formato', 'n' => '02', 'titulo' => 'Gran formato', 'txt' => 'Vallas, banners, vinilos de fachada y señalización.'],
    ['id' => 'exhibiciones', 'n' => '03', 'titulo' => 'Exhibiciones', 'txt' => 'POP para retail: cajas de luz, glorificadores y góndola.'],
    ['id' => 'papeleria', 'n' => '04', 'titulo' => 'Papelería y corporativo', 'txt' => 'Tarjetas, agendas, calendarios y empaques de marca.'],
];

$ciclo = [
    ['titulo' => 'Avisos', 'img' => 'avisos-volumetricos.jpg', 'alt' => 'Aviso acrílico volumétrico'],
    ['titulo' => 'Vallas', 'img' => 'valla-estructural.jpg', 'alt' => 'Valla publicitaria'],
    ['titulo' => 'Plotter', 'img' => 'vinilos-fachada.jpg', 'alt' => 'Vinilos de fachada'],
    ['titulo' => 'Neonflex', 'img' => 'aviso-neonflex.jpg', 'alt' => 'Aviso en neonflex'],
];

$clientes = [
    ['kofta.svg', 'Kofta'],
    ['aduana.svg', 'Aduana'],
    ['kinder-rio.svg', 'Kinder Río'],
    ['issa-saieh.svg', 'Issa Saieh'],
    ['lanapita.svg', 'La Ñapita'],
    ['adama.svg', 'Adama'],
    ['cajacopi.svg', 'Cajacopi'],
    ['steckerl.svg', 'Steckerl'],
    ['chacon.svg', 'Chacón'],
    ['lamerica.svg', 'Lamerica'],
];

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="home-hero">
    <div class="wrap home-hero-grid">
      <div class="home-hero-copy">
        <p class="kicker">Taller en Barranquilla</p>
        <h1>Diseñamos, fabricamos e instalamos <span data-cycle-word>Avisos</span>.</h1>
        <p>Estás buscando un servicio confiable en publicidad. Avisos, vallas, plotter y papelería — a la medida del local y de la marca.</p>
        <div class="hero-actions home-hero-actions">
          <a class="btn btn-wa" href="<?= e(u('contacto')) ?>">Contáctanos por correo</a>
          <a class="btn btn-outline" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">Asesoría por WhatsApp</a>
        </div>
      </div>
      <div class="home-hero-shot" data-cycle>
        <div class="home-hero-mask">
          <?php foreach ($ciclo as $i => $pieza): ?>
            <img src="assets/img/trabajos/<?= e($pieza['img']) ?>" alt="<?= e($pieza['alt']) ?>"<?= $i === 0 ? ' class="is-on"' : '' ?> />
          <?php endforeach; ?>
        </div>
        <span class="home-hero-trazo" aria-hidden="true"></span>
      </div>
    </div>
  </section>

  <section class="home-stats" data-reveal>
    <div class="wrap home-stats-grid">
      <article class="home-stat">
        <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3 10h18M8 3v4M16 3v4" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
        <p class="home-stat-n">+<span data-count="2920">0</span></p>
        <p>Días de experiencia</p>
      </article>
      <article class="home-stat">
        <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path d="M8 13h8M7 17h10M6 9V6.5A2.5 2.5 0 0 1 8.5 4h7A2.5 2.5 0 0 1 18 6.5V9" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M4 9h16v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9z" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
        <p class="home-stat-n">+<span data-count="198000">0</span></p>
        <p>Proyectos realizados</p>
      </article>
      <article class="home-stat">
        <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><circle cx="9" cy="8" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="9" r="2.4" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 19c.6-3.2 3-5 5.5-5s4.9 1.8 5.5 5M14 14.2c1.7 0 3.7 1.2 4.5 3.8" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
        <p class="home-stat-n">+<span data-count="872">0</span></p>
        <p>Clientes satisfechos</p>
      </article>
      <article class="home-stat">
        <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path d="M4 10h12v8a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3v-8z" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8 10V7a4 4 0 0 1 8 0" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 12h3.2A1.8 1.8 0 0 1 21 13.8V16a3 3 0 0 1-3 3h-2" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
        <p class="home-stat-n">+<span data-count="2890">0</span></p>
        <p>Tazas de café</p>
      </article>
      <article class="home-stat">
        <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8 9h8M8 12h8M8 15h5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
        <p class="home-stat-n">+<span data-count="1560890">0</span></p>
        <p>Impresiones</p>
      </article>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="wrap">
      <div class="section-head">
        <div>
          <p class="eyebrow">Servicios</p>
          <h2>Qué hacemos en el taller.</h2>
        </div>
        <a class="btn btn-outline" href="<?= e(u('servicios')) ?>">Ver servicios</a>
      </div>
      <div class="home-serv">
        <?php foreach ($servicios as $s): ?>
          <a class="home-serv-card" href="<?= e(u('servicios')) ?>#<?= e($s['id']) ?>">
            <p class="eyebrow"><?= e($s['n']) ?></p>
            <h3><?= e($s['titulo']) ?></h3>
            <p><?= e($s['txt']) ?></p>
            <span class="more">Ver <?= e(strtolower($s['titulo'])) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section section-tight" data-reveal>
    <div class="wrap">
      <div class="section-head">
        <div>
          <p class="eyebrow">Portafolio</p>
          <h2>Conoce un poco de lo que hemos realizado.</h2>
        </div>
        <a class="btn btn-outline" href="<?= e(u('portafolio')) ?>">Portafolio completo</a>
      </div>
      <div class="filters" role="tablist">
        <button type="button" class="filter is-on" data-filter="todo">Todo</button>
        <button type="button" class="filter" data-filter="avisos">Avisos</button>
        <button type="button" class="filter" data-filter="neonflex">Neonflex</button>
        <button type="button" class="filter" data-filter="estructuras">Estructuras</button>
        <button type="button" class="filter" data-filter="vinilos">Vinilos</button>
      </div>
      <div class="home-obras">
        <?php foreach ($obras as $obra): ?>
          <figure class="shot" data-cat="<?= e($obra['cat']) ?>">
            <a href="<?= e(u('portafolio')) ?>">
              <img src="assets/img/trabajos/<?= e($obra['img']) ?>" alt="<?= e($obra['alt']) ?>" />
            </a>
            <figcaption><?= e($obra['alt']) ?></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="home-marca">
    <div class="wrap home-marca-inner">
      <img src="assets/img/logo-blanco.svg" alt="vapaesa" width="180" height="34" />
      <p>«vapaesa» se establece como una solución estratégica para satisfacer la demanda de productos y servicios de alta calidad en el ámbito de medios impresos y publicidad.</p>
      <p>Nuestra marca promueve una identidad autóctona que enfatiza los valores de compromiso, sentido de pertenencia, respeto y vocación de servicio.</p>
      <p>Un saludo distintivo y universal simboliza nuestra imagen, acompañado de una frase que refleja la determinación de nuestra marca.</p>
    </div>
  </section>

  <section class="section clients">
    <div class="wrap">
      <p class="eyebrow">Clientes</p>
      <h2>Algunos de nuestros clientes.</h2>
      <p class="home-clients-lead">Son nuestra razón de ser, por lo que estamos comprometidos a brindarles lo mejor de nuestras capacidades.</p>
      <div class="clients-carousel" aria-label="Logos de clientes">
        <div class="clients-track">
          <?php for ($vuelta = 0; $vuelta < 2; $vuelta++): ?>
            <div class="clients-set"<?= $vuelta === 1 ? ' aria-hidden="true"' : '' ?>>
              <?php foreach ($clientes as [$logo, $nombre]): ?>
                <img src="assets/img/clientes/<?= e($logo) ?>" alt="<?= $vuelta === 0 ? e($nombre) : '' ?>" />
              <?php endforeach; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section cta-band">
    <div class="wrap">
      <div>
        <p class="eyebrow eyebrow-light">Comercial</p>
        <h2>Cuéntanos qué hay que imprimir o instalar</h2>
        <p>WhatsApp para cotizar o hablar con un vendedor. El formulario llega a <?= e(MAIL_TO) ?>.</p>
      </div>
      <div class="hero-actions">
        <a class="btn btn-wa" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">WhatsApp cotización</a>
        <a class="btn btn-ghost" href="<?= e(u('contacto')) ?>">Escribir al correo</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
