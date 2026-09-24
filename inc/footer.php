<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <img class="footer-logo" src="<?= e(u('assets/img/logo-blanco.svg')) ?>" alt="vapaesa" width="220" height="41" />
      <p class="footer-tag"><?= e(SITE_TAGLINE) ?></p>
      <p><a href="<?= e(INSTAGRAM) ?>" target="_blank" rel="noopener noreferrer">Instagram @vapaesa</a></p>
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
      <p><a href="<?= e(u('contacto')) ?>">Escribir a comercial</a></p>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <p>© <?= date('Y') ?> vapaesa · BQ, CO</p>
    <a href="<?= e(u('privacidad')) ?>">Política de protección de datos</a>
  </div>
</footer>

<a class="wa-float" href="<?= e(wa_cotizar()) ?>" target="_blank" rel="noopener noreferrer" aria-label="Cotizar por WhatsApp" data-quote-open>
  <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path fill="currentColor" d="M20 11.5A8.5 8.5 0 0 1 7.4 19L3 20.5 4.6 16A8.5 8.5 0 1 1 20 11.5zm-8.5 7a7 7 0 1 0-6.1-3.5l-.2.4-1 2.5 2.6-.9.4-.2A7 7 0 0 0 11.5 18.5zm3.9-5.1c-.2-.1-1.2-.6-1.4-.7s-.3-.1-.5.1-.5.7-.6.8-.3.1-.5 0a5.7 5.7 0 0 1-1.7-1 6.3 6.3 0 0 1-1.2-1.5c-.1-.2 0-.3.1-.4l.3-.4.1-.2a.4.4 0 0 0 0-.4l-.7-1.6c-.2-.4-.4-.4-.5-.4h-.4a.8.8 0 0 0-.6.3 2.4 2.4 0 0 0-.8 1.8 4.2 4.2 0 0 0 .9 2.2 9.6 9.6 0 0 0 3.7 3.3 4.3 4.3 0 0 0 2.7.6 2.3 2.3 0 0 0 1.5-1 1.9 1.9 0 0 0 .1-1.1c0-.1-.2-.2-.4-.3z"/></svg>
  <span class="quote-badge quote-badge-float" hidden>0</span>
</a>

<dialog class="quote-dialog" id="quote-dialog" data-wa="<?= e(WA_NUMBER) ?>" aria-labelledby="quote-title">
  <button type="button" class="quote-close" data-quote-close>Cerrar</button>
  <div class="quote-view" data-view="add">
    <h2 id="quote-title">¿Cuántas unidades?</h2>
    <p class="quote-name" data-quote-name></p>
    <p class="quote-meta" data-quote-var></p>
    <p class="quote-meta">Disponibles: <strong data-quote-max></strong></p>
    <label class="quote-qty-label" for="quote-qty">Cantidad a cotizar</label>
    <input id="quote-qty" class="quote-qty" type="number" min="1" step="1" inputmode="numeric" />
    <p class="quote-err" data-quote-err hidden></p>
    <p class="quote-ask">¿Quieres cotizar otro producto?</p>
    <div class="quote-actions">
      <button type="button" class="btn btn-outline" data-quote-more>Sí, agregar otro</button>
      <button type="button" class="btn btn-wa" data-quote-send>Solo cotizar este producto</button>
    </div>
  </div>
  <div class="quote-view" data-view="empty" hidden>
    <h2>Cotización</h2>
    <p class="quote-empty">Para solicitar cotización selecciona los productos que deseas.</p>
    <div class="quote-actions">
      <a class="btn btn-wa" href="<?= e(u('productos')) ?>">Ver productos</a>
    </div>
  </div>
  <div class="quote-view" data-view="cart" hidden>
    <h2>Tu cotización</h2>
    <p class="quote-summary" data-quote-summary></p>
    <ul class="quote-list" data-quote-list></ul>
    <label class="quote-note-label" for="quote-note">Nota para el asesor <span>(opcional)</span></label>
    <textarea id="quote-note" class="quote-note" data-quote-note rows="3" placeholder="Ciudad, marcación, colores, fecha de entrega…"></textarea>
    <p class="quote-hint">Un asesor te confirmará valores, marcación y envío por WhatsApp.</p>
    <div class="quote-actions">
      <a class="btn btn-outline" href="<?= e(u('productos')) ?>">Agregar otro</a>
      <button type="button" class="btn btn-wa" data-quote-send-cart>Enviar por WhatsApp</button>
    </div>
  </div>
  <div class="quote-alert" data-quote-alert hidden>
    <p data-quote-alert-text></p>
    <div class="quote-actions">
      <button type="button" class="btn btn-outline" data-quote-alert-no>Cambiar cantidad</button>
      <button type="button" class="btn btn-wa" data-quote-alert-ok>Confirmar disponibles</button>
    </div>
  </div>
</dialog>

<script>window.VAPAESA_BASE = <?= json_encode(site_base(), JSON_UNESCAPED_SLASHES) ?>;</script>
<script src="<?= e(u('assets/js/main.js')) ?>?v=<?= e(asset_v()) ?>"></script>
</body>
</html>
