<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

$pagina = 'contacto';
$titulo = 'Contacto · vapaesa';
$descripcion = 'Oficina en Barranquilla. Escríbenos o visita el taller en la Calle 42.';

$ok = isset($_GET['ok']);
$error = isset($_GET['error']);
$mapa = 'https://maps.google.com/maps?q=' . rawurlencode(ADDRESS . ' ' . CITY) . '&t=m&z=16&output=embed&iwloc=near';

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="contacto-top">
    <div class="wrap contacto-oficina">
      <div class="contacto-mapa">
        <iframe
          src="<?= e($mapa) ?>"
          title="Taller vapaesa en Barranquilla"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen
        ></iframe>
      </div>
      <div>
        <h2 class="contacto-kicker">Oficina</h2>
        <h1>Barranquilla</h1>
        <ul class="contacto-datos">
          <li>
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z"/></svg>
            <span><?= e(ADDRESS) ?></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.5.6 3.6.1.4 0 .7-.2 1L6.6 10.8z"/></svg>
            <a href="tel:+<?= e(WA_NUMBER) ?>"><?= e(PHONE_DISPLAY) ?></a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm10 2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm-5 3.2A3.8 3.8 0 1 1 8.2 12 3.8 3.8 0 0 1 12 8.2zm0 1.6A2.2 2.2 0 1 0 14.2 12 2.2 2.2 0 0 0 12 9.8zM17 7.4a.8.8 0 1 1-.8.8.8.8 0 0 1 .8-.8z"/></svg>
            <a href="<?= e(INSTAGRAM) ?>" target="_blank" rel="noopener noreferrer">@vapaesa</a>
          </li>
        </ul>
        <img class="contacto-foto" src="assets/img/contacto-taller.jpg" alt="Espacio de trabajo vapaesa" width="1024" height="683" />
      </div>
    </div>
  </section>

  <section class="contacto-form-band">
    <div class="wrap contacto-form-grid">
      <h2>Si quieres saber más de nosotros, lo que hacemos y cómo lo hacemos, contáctanos.</h2>
      <div>
        <?php if ($ok): ?>
          <p class="alert alert-ok">Mensaje enviado. Te respondemos al correo que dejaste.</p>
        <?php elseif ($error): ?>
          <p class="alert alert-err">No se pudo enviar. Escribe directo a <?= e(MAIL_TO) ?>.</p>
        <?php endif; ?>
        <form class="form form-contacto" action="<?= e(u('enviar')) ?>" method="post">
          <div class="hp" aria-hidden="true">
            <label>No llenar <input type="text" name="empresa_web" tabindex="-1" autocomplete="off"></label>
          </div>
          <div>
            <label for="nombre">Nombre <span aria-hidden="true">*</span></label>
            <input id="nombre" name="nombre" type="text" required maxlength="120" />
          </div>
          <div>
            <label for="correo">Correo electrónico <span aria-hidden="true">*</span></label>
            <input id="correo" name="correo" type="email" required maxlength="160" />
          </div>
          <div>
            <label for="mensaje">Mensaje <span aria-hidden="true">*</span></label>
            <textarea id="mensaje" name="mensaje" required maxlength="2000"></textarea>
          </div>
          <button class="btn btn-dark" type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </section>

  <section class="contacto-cv">
    <div class="wrap">
      <p>¿Quieres ser parte de nuestro equipo de vendedores?<br>
        Envía tu Hoja de Vida a:<br>
        <a href="mailto:<?= e(MAIL_TO) ?>"><?= e(MAIL_TO) ?></a></p>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
