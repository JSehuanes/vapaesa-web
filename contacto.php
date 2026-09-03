<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'contacto';
$titulo = 'Contacto · vapaesa';
$descripcion = 'Cotiza por WhatsApp, habla con un vendedor o escribe a comercial@vapaesa.com.';

$ok = isset($_GET['ok']);
$error = isset($_GET['error']);

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Contacto</p>
      <h1>Un WhatsApp o un correo y arrancamos</h1>
      <p>Oficina en Barranquilla. Comercial atiende cotizaciones en <?= e(MAIL_TO) ?>.</p>
    </div>
  </section>

  <section class="section">
    <div class="wrap contact-grid">
      <div>
        <h2>Taller</h2>
        <p><?= e(ADDRESS) ?><br><?= e(CITY) ?></p>
        <p><a href="tel:+<?= e(WA_NUMBER) ?>"><?= e(PHONE_DISPLAY) ?></a><br>
          <a href="mailto:<?= e(MAIL_TO) ?>"><?= e(MAIL_TO) ?></a></p>
        <p><a href="<?= e(MAPS_URL) ?>" target="_blank" rel="noopener noreferrer">Ver en Google Maps</a></p>

        <div class="wa-cards" style="margin-top:20px">
          <a class="wa-card" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">
            <strong>Pedir cotización</strong>
            <p>Abre WhatsApp con un mensaje listo para describir el trabajo.</p>
          </a>
          <a class="wa-card" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">
            <strong>Atención con un vendedor</strong>
            <p>Para seguimiento, visitas o dudas de un pedido en curso.</p>
          </a>
        </div>
        <p style="margin-top:18px">¿Quieres ser parte del equipo comercial? Envía tu hoja de vida a <a href="mailto:ceo@vapaesa.com">ceo@vapaesa.com</a>.</p>
      </div>

      <div>
        <h2>Escribir a comercial</h2>
        <?php if ($ok): ?>
          <p class="alert alert-ok">Mensaje enviado. Te respondemos al correo que dejaste.</p>
        <?php elseif ($error): ?>
          <p class="alert alert-err">No se pudo enviar. Usa WhatsApp o escribe directo a <?= e(MAIL_TO) ?>.</p>
        <?php endif; ?>

        <form class="form" action="enviar.php" method="post">
          <div class="hp" aria-hidden="true">
            <label>No llenar <input type="text" name="empresa_web" tabindex="-1" autocomplete="off"></label>
          </div>
          <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" required maxlength="120" />
          </div>
          <div>
            <label for="correo">Correo</label>
            <input id="correo" name="correo" type="email" required maxlength="160" />
          </div>
          <div>
            <label for="telefono">Teléfono / WhatsApp</label>
            <input id="telefono" name="telefono" type="tel" maxlength="40" />
          </div>
          <div>
            <label for="interes">¿Qué necesitas?</label>
            <select id="interes" name="interes">
              <option>Cotización general</option>
              <option>Avisos</option>
              <option>Gran formato</option>
              <option>Papelería</option>
              <option>Promocionales</option>
              <option>Página web</option>
              <option>Hablar con un vendedor</option>
            </select>
          </div>
          <div>
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" required maxlength="2000" placeholder="Medidas, cantidad, fecha o fotos que puedas describir."></textarea>
          </div>
          <button class="btn btn-dark" type="submit">Enviar a comercial@vapaesa.com</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
