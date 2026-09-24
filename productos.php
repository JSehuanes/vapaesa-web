<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/esferos.php';

$pagina = 'productos';
$titulo = 'Productos promocionales · vapaesa';
$descripcion = 'Catálogo de promocionales para cotizar: referencia y disponibilidad. Sin precios. Pide cotización por WhatsApp.';

$q = trim((string) ($_GET['q'] ?? ''));
$cat = trim((string) ($_GET['cat'] ?? ''));
$stock = ($_GET['stock'] ?? '') === '1';
$orden = trim((string) ($_GET['orden'] ?? 'nombre'));
if (!in_array($orden, ['nombre', 'za', 'stock'], true)) {
    $orden = 'nombre';
}
$page = max(1, (int) ($_GET['page'] ?? 1));
$porPagina = 30;

$menu = esferos_menu();
$promoHijos = $menu['promocionales']['hijos'];
$esPromo = $cat === 'promocionales' || isset($promoHijos[$cat]);
$ambito = $cat !== '' ? $cat : '';

$catalogo = esferos_catalogo($ambito);
$filtrados = esferos_filtrar($catalogo['productos'], $q, $cat);
if ($stock) {
    $filtrados = array_values(array_filter(
        $filtrados,
        static fn(array $p): bool => !empty($p['disponible'])
    ));
}
if ($cat === '' && $orden === 'nombre' && $q === '' && !$stock) {
    $filtrados = esferos_intercalar($filtrados);
} else {
    $filtrados = esferos_ordenar($filtrados, $orden);
}

$total = count($filtrados);
$paginas = max(1, (int) ceil($total / $porPagina));
$page = min($page, $paginas);
$desde = $total === 0 ? 0 : (($page - 1) * $porPagina) + 1;
$hasta = min($total, $page * $porPagina);
$corte = array_slice($filtrados, ($page - 1) * $porPagina, $porPagina);
$corte = esferos_con_stock($corte);

function catalogo_url(string $q, string $cat, int $page = 1, bool $stock = false, string $orden = 'nombre'): string
{
    $params = [];
    if ($q !== '') {
        $params['q'] = $q;
    }
    if ($cat !== '') {
        $params['cat'] = $cat;
    }
    if ($stock) {
        $params['stock'] = '1';
    }
    if ($orden !== 'nombre') {
        $params['orden'] = $orden;
    }
    if ($page > 1) {
        $params['page'] = (string) $page;
    }
    return u('productos') . ($params !== [] ? '?' . http_build_query($params) : '');
}

/**
 * @return list<int|null>
 */
function catalogo_paginas(int $actual, int $total): array
{
    if ($total <= 9) {
        return range(1, $total);
    }
    $out = [1];
    $ini = max(2, $actual - 2);
    $fin = min($total - 1, $actual + 2);
    if ($ini > 2) {
        $out[] = null;
    }
    for ($i = $ini; $i <= $fin; $i++) {
        $out[] = $i;
    }
    if ($fin < $total - 1) {
        $out[] = null;
    }
    $out[] = $total;
    return $out;
}

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Productos promocionales</p>
      <h1>Elige la referencia y te cotizamos</h1>
      <p class="lede">Busca, filtra por categoría o stock y agrega al carrito de cotización. Un asesor te confirma detalles por WhatsApp.</p>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <form class="catalog-toolbar" method="get" action="<?= e(u('productos')) ?>">
        <label class="sr-only" for="q">Buscar</label>
        <input id="q" name="q" type="search" value="<?= e($q) ?>" placeholder="Buscar por nombre o referencia (SKU)" />
        <?php if ($cat !== ''): ?>
          <input type="hidden" name="cat" value="<?= e($cat) ?>" />
        <?php endif; ?>
        <?php if ($stock): ?>
          <input type="hidden" name="stock" value="1" />
        <?php endif; ?>
        <?php if ($orden !== 'nombre'): ?>
          <input type="hidden" name="orden" value="<?= e($orden) ?>" />
        <?php endif; ?>
        <button class="btn btn-dark" type="submit">Buscar</button>
      </form>

      <nav class="catalog-nav" aria-label="Categorías">
        <div class="filters">
          <a class="filter<?= $cat === '' ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, '', 1, $stock, $orden)) ?>">Todos</a>
          <a class="filter<?= $cat === 'esferos' ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, 'esferos', 1, $stock, $orden)) ?>">Esferos</a>
          <a class="filter<?= $cat === 'promocionales' ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, 'promocionales', 1, $stock, $orden)) ?>">Promocionales</a>
        </div>
        <?php if ($esPromo || $cat === ''): ?>
          <div class="filters filters-sub" aria-label="Tipos de promocional">
            <?php foreach ($promoHijos as $handle => $label): ?>
              <a class="filter<?= $cat === $handle ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, $handle, 1, $stock, $orden)) ?>"><?= e($label) ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </nav>

      <div class="catalog-controls">
        <div class="catalog-toggles">
          <?php
            $stockUrl = catalogo_url($q, $cat, 1, !$stock, $orden);
          ?>
          <a class="catalog-toggle<?= $stock ? ' is-on' : '' ?>" href="<?= e($stockUrl) ?>"<?= $stock ? ' aria-pressed="true"' : ' aria-pressed="false"' ?>>
            Solo en stock
          </a>
        </div>
        <form class="catalog-sort" method="get" action="<?= e(u('productos')) ?>">
          <?php if ($q !== ''): ?><input type="hidden" name="q" value="<?= e($q) ?>" /><?php endif; ?>
          <?php if ($cat !== ''): ?><input type="hidden" name="cat" value="<?= e($cat) ?>" /><?php endif; ?>
          <?php if ($stock): ?><input type="hidden" name="stock" value="1" /><?php endif; ?>
          <label for="orden">Orden</label>
          <select id="orden" name="orden" onchange="this.form.submit()">
            <option value="nombre"<?= $orden === 'nombre' ? ' selected' : '' ?>>Nombre A–Z</option>
            <option value="za"<?= $orden === 'za' ? ' selected' : '' ?>>Nombre Z–A</option>
            <option value="stock"<?= $orden === 'stock' ? ' selected' : '' ?>>Con stock primero</option>
          </select>
        </form>
      </div>

      <p class="catalog-meta">
        <?php if ($total > 0): ?>
          Mostrando <?= (int) $desde ?>–<?= (int) $hasta ?> de <?= (int) $total ?> referencias
        <?php else: ?>
          0 referencias
        <?php endif; ?>
        · en vivo desde Esferos
        · <?= e(date('H:i', (int) $catalogo['actualizado'])) ?>
        <?php if (!empty($catalogo['error'])): ?>
          · <span class="catalog-warn"><?= e((string) $catalogo['error']) ?></span>
        <?php endif; ?>
      </p>

      <?php if ($corte === []): ?>
        <p>No hay productos con ese filtro. Prueba otra búsqueda o categoría.</p>
      <?php else: ?>
        <div class="catalog-grid">
          <?php foreach ($corte as $p):
            $varsOk = esferos_vars_disponibles($p);
            $nVars = count($varsOk);
            $enStock = !empty($p['disponible']);
            $ficha = esferos_local((string) $p['handle'], $cat);
            $v0 = $varsOk[0] ?? ($p['variantes'][0] ?? ['sku' => $p['sku'], 'titulo' => '', 'disponible' => false]);
            $max0 = isset($v0['cantidad']) ? (int) $v0['cantidad'] : null;
          ?>
            <article class="catalog-card<?= $enStock ? '' : ' is-out' ?>">
              <a class="catalog-card-link" href="<?= e($ficha) ?>">
                <div class="catalog-shot">
                  <?php if ($p['imagen'] !== ''): ?>
                    <img src="<?= e(esferos_imagen($p['imagen'])) ?>" alt="<?= e($p['nombre']) ?>" loading="lazy" width="640" height="640" />
                  <?php endif; ?>
                </div>
                <p class="catalog-card-stock<?= $enStock ? ' is-in' : '' ?>"><?= $enStock ? 'En stock' : 'Agotado' ?></p>
                <h3><?= e($p['nombre']) ?></h3>
              </a>
              <?php if ($enStock && $nVars === 1): ?>
                <form class="catalog-card-actions" data-quote-add>
                  <input type="hidden" name="handle" value="<?= e((string) $p['handle']) ?>" />
                  <input type="hidden" name="nombre" value="<?= e((string) $p['nombre']) ?>" />
                  <input type="hidden" name="etiqueta" value="<?= e(esferos_etiqueta($p, $cat)) ?>" />
                  <input type="hidden" name="sku" value="<?= e((string) ($v0['sku'] !== '' ? $v0['sku'] : $p['sku'])) ?>" />
                  <input type="hidden" name="titulo" value="<?= e((string) ($v0['titulo'] ?? '')) ?>" />
                  <input type="hidden" name="max" value="<?= $max0 !== null ? (int) $max0 : '' ?>" />
                  <button class="btn btn-wa btn-sm" type="submit">Cotizar</button>
                </form>
              <?php elseif ($enStock && $nVars > 1): ?>
                <div class="catalog-card-actions">
                  <a class="btn btn-outline btn-sm" href="<?= e($ficha) ?>">Elegir opción</a>
                </div>
              <?php else: ?>
                <div class="catalog-card-actions">
                  <span class="btn btn-ghost btn-sm" aria-disabled="true">Agotado</span>
                </div>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>

        <?php if ($paginas > 1): ?>
          <nav class="pager" aria-label="Páginas del catálogo">
            <?php if ($page > 1): ?>
              <a class="pager-nav" href="<?= e(catalogo_url($q, $cat, $page - 1, $stock, $orden)) ?>">Anterior</a>
            <?php endif; ?>
            <div class="pager-pages">
              <?php foreach (catalogo_paginas($page, $paginas) as $n): ?>
                <?php if ($n === null): ?>
                  <span class="pager-gap">…</span>
                <?php elseif ($n === $page): ?>
                  <span class="pager-page is-on" aria-current="page"><?= (int) $n ?></span>
                <?php else: ?>
                  <a class="pager-page" href="<?= e(catalogo_url($q, $cat, $n, $stock, $orden)) ?>"><?= (int) $n ?></a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
            <?php if ($page < $paginas): ?>
              <a class="pager-nav" href="<?= e(catalogo_url($q, $cat, $page + 1, $stock, $orden)) ?>">Siguiente</a>
            <?php endif; ?>
          </nav>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
