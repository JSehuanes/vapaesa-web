<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'privacidad';
$titulo = 'Política de protección de datos · vapaesa';
$descripcion = 'Tratamiento de datos personales de vapaesa.';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <h1>Política de protección de datos</h1>
    </div>
  </section>
  <section class="section">
    <div class="wrap prose">
      <p>vapaesa, con domicilio en <?= e(ADDRESS) ?>, <?= e(CITY) ?>, trata los datos que nos envías por el formulario o por WhatsApp para responder cotizaciones, dar atención comercial y hacer seguimiento a pedidos.</p>
      <p>El correo de contacto para este tratamiento es <a href="mailto:<?= e(MAIL_TO) ?>"><?= e(MAIL_TO) ?></a>.</p>
      <p>No vendemos tu información. Puedes pedir consulta, corrección o supresión de tus datos escribiendo a ese correo, de acuerdo con la Ley 1581 de 2012 de Colombia.</p>
      <p>El sitio usa solo lo necesario para funcionar. Los botones de WhatsApp e Instagram abren servicios de terceros con sus propias políticas.</p>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
