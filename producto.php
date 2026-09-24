<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/esferos.php';

$handle = trim((string) ($_GET['p'] ?? ''));
$cat = trim((string) ($_GET['cat'] ?? ''));
$p = esferos_por_handle($handle);

if ($p === null) {
    header('Location: ' . u('productos'), true, 302);
    exit;
}

$pagina = 'productos';
$titulo = $p['nombre'] . ' · vapaesa';
$descripcion = 'Cotiza ' . $p['nombre'] . '. Referencia y unidades disponibles. Sin precios.';
$ref = $p['sku'] !== '' ? $p['sku'] : $p['nombre'];
$volver = u('productos') . ($cat !== '' ? '?cat=' . rawurlencode($cat) : '');
$vars = $p['variantes'];

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="section">
    <div class="wrap">
      <p class="ficha-back"><a href="<?= e($volver) ?>">← Volver al catálogo</a></p>
      <article class="ficha">
        <div class="ficha-galeria" data-gallery>
          <div class="ficha-media">
            <?php if ($p['imagen'] !== ''): ?>
              <button type="button" class="catalog-media" data-open aria-label="Ampliar galería de <?= e($p['nombre']) ?>">
                <img src="<?= e(esferos_imagen($p['imagen'], 900)) ?>" data-full="<?= e(esferos_imagen($p['imagen'], 1400)) ?>" alt="<?= e($p['nombre']) ?>" width="900" height="900" />
              </button>
            <?php else: ?>
              <div class="catalog-ph" aria-hidden="true"></div>
            <?php endif; ?>
          </div>
          <?php if (count($p['galeria']) > 1): ?>
            <div class="catalog-thumbs" role="list">
              <?php foreach ($p['galeria'] as $i => $g): ?>
                <button type="button" class="catalog-thumb<?= $i === 0 ? ' is-on' : '' ?>" data-src="<?= e(esferos_imagen($g, 900)) ?>" data-full="<?= e(esferos_imagen($g, 1400)) ?>" aria-label="Foto <?= (int) $i + 1 ?>">
                  <img src="<?= e(esferos_imagen($g, 120)) ?>" alt="" loading="lazy" width="48" height="48" />
                </button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="ficha-info">
          <p class="catalog-stock<?= !empty($p['disponible']) ? ' is-in' : '' ?>">
            <?= !empty($p['disponible']) ? 'En stock' : 'Agotado' ?>
          </p>
          <h1><?= e($p['nombre']) ?></h1>
          <form class="ficha-quote" data-quote-add>
            <input type="hidden" name="handle" value="<?= e((string) $p['handle']) ?>" />
            <input type="hidden" name="nombre" value="<?= e((string) $p['nombre']) ?>" />
            <input type="hidden" name="etiqueta" value="<?= e(esferos_etiqueta($p, $cat)) ?>" />
            <?php if (count($vars) <= 1): ?>
              <?php
                $v0 = $vars[0] ?? ['sku' => $ref, 'titulo' => '', 'disponible' => !empty($p['disponible'])];
                $max0 = isset($v0['cantidad']) ? (int) $v0['cantidad'] : null;
                $ok0 = $max0 !== null ? $max0 > 0 : !empty($v0['disponible']);
              ?>
              <p class="catalog-sku">
                Ref. <?= e($v0['sku'] !== '' ? $v0['sku'] : $ref) ?>
                <?php if ($max0 !== null): ?>
                  · <?= e(esferos_fmt_cantidad($max0)) ?> und
                <?php endif; ?>
              </p>
              <input type="hidden" name="sku" value="<?= e((string) ($v0['sku'] !== '' ? $v0['sku'] : $ref)) ?>" />
              <input type="hidden" name="titulo" value="<?= e((string) ($v0['titulo'] ?? '')) ?>" />
              <input type="hidden" name="max" value="<?= $max0 !== null ? (int) $max0 : '' ?>" />
            <?php else: ?>
              <fieldset class="ficha-vars">
                <legend class="ficha-label">Elige color o referencia</legend>
                <?php
                  $primera = true;
                  foreach ($vars as $i => $v):
                    $label = trim(($v['sku'] !== '' ? $v['sku'] : $ref) . ($v['titulo'] !== '' ? ' · ' . $v['titulo'] : ''));
                    $max = isset($v['cantidad']) ? (int) $v['cantidad'] : null;
                    $qtyIn = $max !== null ? $max > 0 : !empty($v['disponible']);
                    $qtyTxt = $max !== null
                      ? esferos_fmt_cantidad($max) . ' und'
                      : ($qtyIn ? 'disponible' : 'agotado');
                ?>
                  <label class="ficha-var<?= $qtyIn ? '' : ' is-out' ?>">
                    <input
                      type="radio"
                      name="var"
                      value="<?= (int) $i ?>"
                      <?= $qtyIn && $primera ? 'checked' : '' ?>
                      <?= $qtyIn ? '' : 'disabled' ?>
                      data-sku="<?= e((string) ($v['sku'] !== '' ? $v['sku'] : $ref)) ?>"
                      data-titulo="<?= e((string) ($v['titulo'] ?? '')) ?>"
                      data-max="<?= $max !== null ? (int) $max : '' ?>"
                    />
                    <span><?= e($label) ?></span>
                    <span class="catalog-var-stock<?= $qtyIn ? ' is-in' : '' ?>"><?= e($qtyTxt) ?></span>
                  </label>
                <?php
                    if ($qtyIn) {
                        $primera = false;
                    }
                  endforeach;
                ?>
              </fieldset>
            <?php endif; ?>
            <button class="btn btn-wa" type="submit"<?= empty($p['disponible']) ? ' disabled' : '' ?>>
              Cotizar esta referencia
            </button>
          </form>
        </div>
      </article>
    </div>
  </section>
</main>

<dialog class="catalog-lightbox" id="catalog-lightbox" aria-label="Galería del producto">
  <button type="button" class="catalog-lightbox-close" data-close>Cerrar</button>
  <button type="button" class="catalog-lightbox-nav is-prev" data-prev aria-label="Foto anterior">‹</button>
  <img alt="" />
  <button type="button" class="catalog-lightbox-nav is-next" data-next aria-label="Foto siguiente">›</button>
</dialog>

<?php require __DIR__ . '/inc/footer.php'; ?>
