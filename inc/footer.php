<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <img class="footer-logo" src="assets/img/logo-blanco.svg" alt="vapaesa" width="220" height="41" />
      <p class="footer-tag"><?= e(SITE_TAGLINE) ?></p>
    </div>
    <div>
      <h2>Taller</h2>
      <p><?= e(ADDRESS) ?><br><?= e(CITY) ?></p>
      <p><a href="tel:+<?= e(WA_NUMBER) ?>"><?= e(PHONE_DISPLAY) ?></a></p>
      <p><a href="mailto:<?= e(MAIL_TO) ?>"><?= e(MAIL_TO) ?></a></p>
      <p><a href="<?= e(MAPS_URL) ?>" target="_blank" rel="noopener noreferrer">Cómo llegar</a></p>
    </div>
    <div>
      <h2>Habla con nosotros</h2>
      <p><a class="footer-wa" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer">Pedir cotización por WhatsApp</a></p>
      <p><a class="footer-wa" href="<?= e(wa_vendedor()) ?>" target="_blank" rel="noopener noreferrer">Atención con un vendedor</a></p>
      <p><a href="contacto.php">Escribir a comercial</a></p>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <p>© <?= date('Y') ?> vapaesa · BQ, CO</p>
    <a href="privacidad.php">Política de protección de datos</a>
  </div>
</footer>

<a class="wa-float" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer" aria-label="Cotizar por WhatsApp">
  <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path fill="currentColor" d="M20 11.5A8.5 8.5 0 0 1 7.4 19L3 20.5 4.6 16A8.5 8.5 0 1 1 20 11.5zm-8.5 7a7 7 0 1 0-6.1-3.5l-.2.4-1 2.5 2.6-.9.4-.2A7 7 0 0 0 11.5 18.5zm3.9-5.1c-.2-.1-1.2-.6-1.4-.7s-.3-.1-.5.1-.5.7-.6.8-.3.1-.5 0a5.7 5.7 0 0 1-1.7-1 6.3 6.3 0 0 1-1.2-1.5c-.1-.2 0-.3.1-.4l.3-.4.1-.2a.4.4 0 0 0 0-.4l-.7-1.6c-.2-.4-.4-.4-.5-.4h-.4a.8.8 0 0 0-.6.3 2.4 2.4 0 0 0-.8 1.8 4.2 4.2 0 0 0 .9 2.2 9.6 9.6 0 0 0 3.7 3.3 4.3 4.3 0 0 0 2.7.6 2.3 2.3 0 0 0 1.5-1 1.9 1.9 0 0 0 .1-1.1c0-.1-.2-.2-.4-.3z"/></svg>
</a>

<script src="assets/js/main.js"></script>
</body>
</html>
