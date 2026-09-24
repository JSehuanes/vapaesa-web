<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'servicios';
$titulo = 'Servicios · vapaesa';
$descripcion = 'Avisos, gran formato, exhibición y papelería corporativa en Barranquilla.';

$tipos = [
    [
        'id' => 'cajas-de-luz',
        'titulo' => 'Cajas de luz',
        'img' => 'assets/img/trabajos/avisos-volumetricos.jpg',
        'alt' => 'Aviso iluminado',
        'txt' => 'Avisos luminosos con estructura en aluminio o metal, frente en lona backlit o panaflex e iluminación LED. Alta visibilidad de día y de noche, simple o doble cara, a medida para fachadas y vitrinas.',
    ],
    [
        'id' => 'acrilico',
        'titulo' => 'Avisos en acrílico 2D y 3D',
        'img' => 'assets/img/trabajos/obra-6.jpg',
        'alt' => 'Letras en acrílico',
        'txt' => 'Letras y logos en acrílico con impresión, corte 2D o volumen 3D. Distintos espesores, relieves y LED retroiluminado para interiores y fachadas.',
    ],
    [
        'id' => 'colombina',
        'titulo' => 'Avisos tipo colombina',
        'img' => 'assets/img/trabajos/vinilos-fachada.jpg',
        'alt' => 'Fachada comercial',
        'txt' => 'Banderola perpendicular a la fachada, normalmente de doble cara, para verse desde ambos sentidos de la vía. Cuerpo en acrílico, metal o panaflex, con LED opcional.',
    ],
    [
        'id' => 'neonflex',
        'titulo' => 'Neón flex',
        'img' => 'assets/img/trabajos/aviso-neonflex.jpg',
        'alt' => 'Aviso OPEN en neonflex',
        'txt' => 'Letreros luminosos con tira LED encapsulada: el efecto del neón, sin vidrio ni gases. Colores, tipografías y siluetas a medida para vitrinas, bares y locales.',
    ],
    [
        'id' => 'metalicos',
        'titulo' => 'Avisos metálicos',
        'img' => 'assets/img/trabajos/aviso-acero-inoxidable.jpg',
        'alt' => 'Aviso en acero inoxidable',
        'txt' => 'Acero inoxidable, cold roll o lámina galvanizada. Resistentes al clima de la costa, con pintura electrostática o acabado espejo, relieve y LED si el proyecto lo pide.',
    ],
    [
        'id' => 'bastidores',
        'titulo' => 'Avisos tipo bastidor',
        'img' => 'assets/img/portafolio/bas-1.jpg',
        'alt' => 'Bastidor de gran formato',
        'txt' => 'Marco en aluminio o tubo galvanizado con lona tensada. Ideal para fachadas grandes y campañas. Se puede cambiar la lona cuando actualices la gráfica.',
    ],
];

$gran = [
    [
        'id' => 'gigantografias',
        'titulo' => 'Gigantografías',
        'img' => 'assets/img/servicios/gran-formato/gigantografias.png',
        'alt' => 'Gigantografía impresa',
        'txt' => 'Impresión digital de alta resolución para ferias, eventos, campañas y decoración de espacios grandes. Tamaño y diseño a medida, en materiales para interior o exterior.',
    ],
    [
        'id' => 'backings',
        'titulo' => 'Backings',
        'img' => 'assets/img/servicios/gran-formato/backings.png',
        'alt' => 'Backing publicitario',
        'txt' => 'Fondos de marca para eventos, exhibiciones y punto de venta. Bastidor en madera o metal, reutilizable, con lona o banner tensado e impresión a full color.',
    ],
    [
        'id' => 'pendones',
        'titulo' => 'Pendones',
        'img' => 'assets/img/servicios/gran-formato/pendones.png',
        'alt' => 'Pendones impresos',
        'txt' => 'Pendones en distintas medidas para ferias, locales y calle. Impresión nítida y materiales resistentes para interior o exterior.',
    ],
    [
        'id' => 'tropezones',
        'titulo' => 'Tropezones',
        'img' => 'assets/img/servicios/gran-formato/tropezones.png',
        'alt' => 'Tropezón de piso',
        'txt' => 'Piezas de piso para detener la mirada en pasillos, tiendas y exhibiciones. Varios tamaños y acabados, con impresión de alta resolución.',
    ],
    [
        'id' => 'puntas-gondola',
        'titulo' => 'Puntas de góndola',
        'img' => 'assets/img/servicios/gran-formato/gondolas.png',
        'alt' => 'Punta de góndola',
        'txt' => 'Gráfica para el extremo de la góndola en punto de venta. Destaca promociones y productos; se fabrica al tamaño de la estantería.',
    ],
    [
        'id' => 'habladores',
        'titulo' => 'Habladores',
        'img' => 'assets/img/servicios/gran-formato/habladores.png',
        'alt' => 'Habladores publicitarios',
        'txt' => 'Piezas de comunicación visual para tienda, evento o campaña. Distintos tamaños y soportes, con color fiel y buena lectura a distancia.',
    ],
];

$exhibicion = [
    [
        'id' => 'exh-backlight',
        'titulo' => 'Cajas de luz backlight',
        'img' => 'assets/img/servicios/exhibicion/cajas-luz.png',
        'alt' => 'Caja de luz backlight',
        'txt' => 'Iluminación LED y gráfica en tela tensada o acrílico para vitrinas y centros comerciales. También en formato slim o gran formato, intercambiable para campañas.',
    ],
    [
        'id' => 'exh-puentes',
        'titulo' => 'Puentes',
        'img' => 'assets/img/servicios/exhibicion/puentes.png',
        'alt' => 'Puente publicitario',
        'txt' => 'Estructuras colgantes para pasillos de supermercado, tienda o centro comercial. Cartón rígido, acrílico o gran formato, con LED si se necesita más alcance.',
    ],
    [
        'id' => 'exh-glorificadores',
        'titulo' => 'Glorificadores',
        'img' => 'assets/img/servicios/exhibicion/glorificadores.png',
        'alt' => 'Glorificador de producto',
        'txt' => 'Exhibidores para resaltar un producto en góndola, estante o mostrador. Acrílico, PVC o cartón; con LED cuando el producto estrella lo pide.',
    ],
    [
        'id' => 'exh-tropezones',
        'titulo' => 'Tropezones',
        'img' => 'assets/img/servicios/exhibicion/tropezones.png',
        'alt' => 'Tropezón o rompetráfico',
        'txt' => 'Rompetráfico de pasillo para guiar al cliente a una promoción. Colgantes en cartón o PVC, de piso o con forma personalizada.',
    ],
    [
        'id' => 'exh-gondolas',
        'titulo' => 'Puntas de góndola',
        'img' => 'assets/img/servicios/exhibicion/gondolas.png',
        'alt' => 'Punta de góndola',
        'txt' => 'Cierres de pasillo en supermercado y autoservicio. Cartón, MDF o estructura reutilizable, con LED opcional para impulsar la compra.',
    ],
    [
        'id' => 'exh-floor-stand',
        'titulo' => 'Floor stand',
        'img' => 'assets/img/servicios/exhibicion/floor-stand.png',
        'alt' => 'Floor stand exhibitorial',
        'txt' => 'Exhibidor autoportante para pasillos y zonas de tráfico. Cartón corrugado, metal o acrílico; modular y fácil de mover en lanzamientos.',
    ],
];

$papel = [
    [
        'id' => 'pap-tarjetas',
        'titulo' => 'Tarjetas de presentación',
        'img' => 'assets/img/servicios/papeleria/tarjetas.webp',
        'alt' => 'Tarjetas de presentación',
        'txt' => 'Tarjetas con tu marca en cartulina mate, barnizada o laminada. Impresión full color y acabados para que el primer contacto se vea bien.',
    ],
    [
        'id' => 'pap-agendas',
        'titulo' => 'Agendas corporativas',
        'img' => 'assets/img/servicios/papeleria/agendas.webp',
        'alt' => 'Agenda corporativa',
        'txt' => 'Agendas personalizadas para el año, el equipo o el cliente. Tapa dura, anillado o permanente, con logo y estuche si el kit lo pide.',
    ],
    [
        'id' => 'pap-cuadernos',
        'titulo' => 'Cuadernos y libretas',
        'img' => 'assets/img/servicios/papeleria/cuadernos.webp',
        'alt' => 'Cuaderno empresarial',
        'txt' => 'Cuadernos para eventos, reuniones y kits de marca. Cosido, tapa blanda o dura, insertos y opciones ecológicas.',
    ],
    [
        'id' => 'pap-folletos',
        'titulo' => 'Folletos plegables',
        'img' => 'assets/img/servicios/papeleria/folletos.webp',
        'alt' => 'Folletos plegables',
        'txt' => 'Plegables full color para productos, servicios y campañas. Formato y acabado a la medida de la pieza comercial.',
    ],
    [
        'id' => 'pap-calendarios',
        'titulo' => 'Calendarios y almanaques',
        'img' => 'assets/img/servicios/papeleria/calendarios.webp',
        'alt' => 'Calendario de escritorio',
        'txt' => 'Calendarios de escritorio, mural o portalápices. Adaptamos tu diseño al formato; ideales para clientes, equipos y punto de venta.',
    ],
    [
        'id' => 'pap-maletin',
        'titulo' => 'Caja tipo maletín',
        'img' => 'assets/img/servicios/papeleria/caja-maletin.webp',
        'alt' => 'Caja tipo maletín personalizada',
        'txt' => 'Caja con asas para llevar alimentos, refrigerios o producto. Cartulina blanca o kraft, plastificado, UV o repujado; medidas a cotizar.',
    ],
];

$pasos = [
    ['titulo' => 'Diseño y asesoría', 'txt' => 'Definimos materiales, medidas, acabados e iluminación según la fachada, el clima y la imagen de la marca.'],
    ['titulo' => 'Fabricación', 'txt' => 'Producimos en el taller: acrílico, metal, lona, alucobond y sistemas LED, según cada aviso.'],
    ['titulo' => 'Instalación', 'txt' => 'Montaje en sitio con anclajes, nivelación y sellos. Buscamos una instalación limpia y segura.'],
    ['titulo' => 'Mantenimiento', 'txt' => 'Revisión de iluminación, estructura y acabados. Reparación o actualización cuando el aviso ya está en calle.'],
];

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero" id="avisos">
    <div class="wrap">
      <p class="kicker">Servicios · Avisos</p>
      <h1>Diseñamos, fabricamos e instalamos avisos</h1>
      <p>Desde la idea hasta el montaje en fachada. Acrílico 3D, cajas de luz, metálicos, neonflex y bastidores para negocios y empresas en Barranquilla.</p>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <p class="svc-lead">Explora las opciones más solicitadas. Materiales, iluminación y usos se definen en cotización, según fachada y presupuesto.</p>
      <div class="svc-tipos">
        <?php foreach ($tipos as $tipo): ?>
          <article class="svc-tipo" id="<?= e($tipo['id']) ?>">
            <img src="<?= e($tipo['img']) ?>" alt="<?= e($tipo['alt']) ?>" />
            <div>
              <h3><?= e($tipo['titulo']) ?></h3>
              <p><?= e($tipo['txt']) ?></p>
              <a class="more" href="<?= e(wa_cotizar($tipo['titulo'])) ?>" target="_blank" rel="noopener noreferrer">Asesoría por WhatsApp</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="page-hero" id="gran-formato">
    <div class="wrap">
      <p class="kicker">Servicios · Digital y gran formato</p>
      <h1>Impresión digital y gran formato</h1>
      <p>Imprime sobre materiales rígidos y flexibles: vallas, gigantografías, backings, pendones y más. Full color, a la medida del espacio, para interior o exterior.</p>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <p class="svc-lead">Las más solicitadas para calle, evento y punto de venta. Medidas, material y acabado se definen en cotización.</p>
      <div class="svc-tipos">
        <?php foreach ($gran as $tipo): ?>
          <article class="svc-tipo" id="<?= e($tipo['id']) ?>">
            <img class="svc-cutout" src="<?= e($tipo['img']) ?>" alt="<?= e($tipo['alt']) ?>" />
            <div>
              <h3><?= e($tipo['titulo']) ?></h3>
              <p><?= e($tipo['txt']) ?></p>
              <a class="more" href="<?= e(wa_cotizar($tipo['titulo'])) ?>" target="_blank" rel="noopener noreferrer">Asesoría por WhatsApp</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="page-hero" id="exhibiciones">
    <div class="wrap">
      <p class="kicker">Servicios · Exhibiciones</p>
      <h1>Exhibición para retail y punto de venta</h1>
      <p>Material POP para supermercados, tiendas y centros comerciales: cajas de luz, puentes, glorificadores, tropezones, puntas de góndola y floor stands. Diseño, producción e instalación en sitio.</p>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <p class="svc-lead">Las más usadas para destacar producto y marca en el punto de venta. Medidas y material se definen en cotización.</p>
      <div class="svc-tipos">
        <?php foreach ($exhibicion as $tipo): ?>
          <article class="svc-tipo" id="<?= e($tipo['id']) ?>">
            <img class="svc-cutout" src="<?= e($tipo['img']) ?>" alt="<?= e($tipo['alt']) ?>" />
            <div>
              <h3><?= e($tipo['titulo']) ?></h3>
              <p><?= e($tipo['txt']) ?></p>
              <a class="more" href="<?= e(wa_cotizar($tipo['titulo'])) ?>" target="_blank" rel="noopener noreferrer">Asesoría por WhatsApp</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="page-hero" id="papeleria">
    <div class="wrap">
      <p class="kicker">Servicios · Papelería y corporativo</p>
      <h1>Papelería y corporativo</h1>
      <p>Tarjetas, agendas, cuadernos, folletos, calendarios y empaques con la imagen de la marca. Color fiel y acabados para oficina, evento o kit comercial.</p>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <p class="svc-lead">Las más pedidas para oficina, evento y kit de marca. Material, tiraje y acabado se definen en cotización.</p>
      <div class="svc-tipos">
        <?php foreach ($papel as $tipo): ?>
          <article class="svc-tipo" id="<?= e($tipo['id']) ?>">
            <img class="svc-cutout" src="<?= e($tipo['img']) ?>" alt="<?= e($tipo['alt']) ?>" />
            <div>
              <h3><?= e($tipo['titulo']) ?></h3>
              <p><?= e($tipo['txt']) ?></p>
              <a class="more" href="<?= e(wa_cotizar($tipo['titulo'])) ?>" target="_blank" rel="noopener noreferrer">Asesoría por WhatsApp</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section svc-pasos-band">
    <div class="wrap">
      <div class="section-head">
        <div>
          <p class="eyebrow">El taller</p>
          <h2>Cómo lo hacemos</h2>
        </div>
      </div>
      <p class="svc-lead">Diseño, fabricación e instalación de piezas para fachadas, locales y oficinas.</p>
      <div class="svc-pasos">
        <?php foreach ($pasos as $i => $paso): ?>
          <article class="svc-paso">
            <p class="eyebrow"><?= sprintf('%02d', $i + 1) ?></p>
            <h3><?= e($paso['titulo']) ?></h3>
            <p><?= e($paso['txt']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
