<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/esferos.php';

$pagina = 'productos';
$titulo = 'Productos promocionales · vapaesa';
$descripcion = 'Catálogo de promocionales para cotizar: referencia y disponibilidad. Sin precios. Pide cotización por WhatsApp.';

$q = trim((string) ($_GET['q'] ?? ''));
$cat = trim((string) ($_GET['cat'] ?? ''));
$page = max(1, (int) ($_GET['page'] ?? 1));
$porPagina = 30;

$catalogo = esferos_catalogo($cat);
$filtrados = esferos_filtrar($catalogo['productos'], $q, $cat);
if ($cat === '') {
    $filtrados = array_values(array_filter(
        $filtrados,
        static fn(array $p): bool => !empty($p['disponible'])
    ));
    $filtrados = esferos_intercalar($filtrados);
}
$total = count($filtrados);
$paginas = max(1, (int) ceil($total / $porPagina));
$page = min($page, $paginas);
$corte = array_slice($filtrados, ($page - 1) * $porPagina, $porPagina);

function catalogo_url(string $q, string $cat, int $page = 1): string
{
    $params = [];
    if ($q !== '') {
        $params['q'] = $q;
    }
    if ($cat !== '') {
        $params['cat'] = $cat;
    }
    if ($page > 1) {
        $params['page'] = (string) $page;
    }
    return 'productos.php' . ($params !== [] ? '?' . http_build_query($params) : '');
}

require __DIR__ . '/inc/head.php';
require __DIR__ . '/inc/header.php';
?>

<main id="contenido">
  <section class="page-hero">
    <div class="wrap">
      <p class="kicker">Productos promocionales</p>
      <h1>Elige la referencia y te cotizamos</h1>
    </div>
  </section>

  <section class="section section-tight">
    <div class="wrap">
      <form class="catalog-toolbar" method="get" action="productos.php">
        <label class="sr-only" for="q">Buscar</label>
        <input id="q" name="q" type="search" value="<?= e($q) ?>" placeholder="Buscar por nombre o referencia (SKU)" />
        <?php if ($cat !== ''): ?>
          <input type="hidden" name="cat" value="<?= e($cat) ?>" />
        <?php endif; ?>
        <button class="btn btn-dark" type="submit">Buscar</button>
      </form>

      <div class="filters" role="navigation" aria-label="Categorías">
        <a class="filter<?= $cat === '' ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, '')) ?>">Todos</a>
        <a class="filter<?= $cat === 'esferos' ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, 'esferos')) ?>">Esferos</a>
        <?php foreach (esferos_menu()['promocionales']['hijos'] as $handle => $label): ?>
          <a class="filter<?= $cat === $handle ? ' is-on' : '' ?>" href="<?= e(catalogo_url($q, $handle)) ?>"><?= e($label) ?></a>
        <?php endforeach; ?>
      </div>

      <p class="catalog-meta">
        <?= (int) $total ?> referencias
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
          <?php foreach ($corte as $p): ?>
            <a class="catalog-card<?= !empty($p['disponible']) ? '' : ' is-out' ?>" href="<?= e(esferos_local((string) $p['handle'], $cat)) ?>">
              <div class="catalog-shot">
                <?php if ($p['imagen'] !== ''): ?>
                  <img src="<?= e(esferos_imagen($p['imagen'])) ?>" alt="<?= e($p['nombre']) ?>" loading="lazy" width="640" height="640" />
                <?php endif; ?>
              </div>
              <h3><?= e($p['nombre']) ?></h3>
            </a>
          <?php endforeach; ?>
        </div>

        <?php if ($paginas > 1): ?>
          <nav class="pager" aria-label="Páginas del catálogo">
            <?php if ($page > 1): ?>
              <a href="<?= e(catalogo_url($q, $cat, $page - 1)) ?>">Anterior</a>
            <?php endif; ?>
            <span>Página <?= (int) $page ?> de <?= (int) $paginas ?></span>
            <?php if ($page < $paginas): ?>
              <a href="<?= e(catalogo_url($q, $cat, $page + 1)) ?>">Siguiente</a>
            <?php endif; ?>
          </nav>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require __DIR__ . '/inc/footer.php'; ?>
