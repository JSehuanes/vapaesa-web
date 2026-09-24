<?php
declare(strict_types=1);

const ESFEROS_BASE = 'https://esferos.com';
const ESFEROS_TTL = 1800;
const ESFEROS_STALE = 21600;
const ESFEROS_STOCK_TTL = 180;
const ESFEROS_LOGIN_TTL = 1200;

/**
 * @return array<string, array{label: string, hijos: array<string,string>}>
 */
function esferos_menu(): array
{
    return [
        'esferos' => [
            'label' => 'Bolígrafos',
            'hijos' => [],
        ],
        'promocionales' => [
            'label' => 'Promocionales',
            'hijos' => [
                'agendas' => 'Agendas',
                'alcancias' => 'Alcancías',
                'bolsas' => 'Bolsas',
                'botilitos' => 'Botilitos',
                'cuidado-personal' => 'Cuidado personal',
                'ecologicos' => 'Ecológicos',
                'escolar-oficina' => 'Escolar y oficina',
                'estuches-kits' => 'Estuches y kits',
                'hogar' => 'Hogar',
                'juguetes' => 'Juguetes',
                'llaveros' => 'Llaveros',
                'morrales' => 'Morrales',
                'mugs' => 'Mugs',
                'sombrillas' => 'Sombrillas',
                'tecnologia-y-gadgets' => 'Tecnología',
                'usb' => 'USB',
            ],
        ],
    ];
}

/** @return array<string,string> */
function esferos_categorias(): array
{
    $out = [];
    foreach (esferos_menu() as $handle => $item) {
        $out[$handle] = $item['label'];
        foreach ($item['hijos'] as $hijo => $label) {
            $out[$hijo] = $label;
        }
    }
    return $out;
}

function esferos_es_promo(string $cat): bool
{
    if ($cat === 'promocionales') {
        return true;
    }
    return isset(esferos_menu()['promocionales']['hijos'][$cat]);
}

/** @param array<string,mixed> $p */
function esferos_etiqueta(array $p, string $cat = ''): string
{
    $cats = esferos_categorias();
    if ($cat === 'esferos') {
        return 'Bolígrafos';
    }
    if ($cat !== '' && $cat !== 'promocionales' && isset($cats[$cat])) {
        return $cats[$cat];
    }
    $handles = $p['categorias'] ?? [];
    if (!is_array($handles)) {
        $handles = [];
    }
    if (in_array('esferos', $handles, true)) {
        return 'Bolígrafos';
    }
    foreach (esferos_menu()['promocionales']['hijos'] as $handle => $label) {
        if (in_array($handle, $handles, true)) {
            return $label;
        }
    }
    return 'Promocionales';
}

function esferos_ficha(string $handle): string
{
    return ESFEROS_BASE . '/products/' . rawurlencode($handle);
}

function esferos_local(string $handle, string $cat = ''): string
{
    $url = u('producto/' . rawurlencode($handle));
    if ($cat !== '') {
        $url .= '?cat=' . rawurlencode($cat);
    }
    return $url;
}

/** @return array<string,mixed>|null */
function esferos_por_handle(string $handle): ?array
{
    if ($handle === '') {
        return null;
    }
    $p = esferos_buscar_cache($handle);
    if ($p === null || !array_key_exists('descripcion', $p)) {
        $json = esferos_get_json('/products/' . rawurlencode($handle) . '.json');
        $item = is_array($json['product'] ?? null) ? $json['product'] : null;
        $p = $item !== null ? esferos_normalizar($item) : $p;
    }
    if ($p === null) {
        return null;
    }
    $con = esferos_con_stock([$p]);
    return $con[0] ?? $p;
}

/** @return array<string,mixed>|null */
function esferos_buscar_cache(string $handle): ?array
{
    foreach (['all', 'esferos', 'promocionales'] as $ambito) {
        $cached = esferos_tmp_leer('catalog-' . $ambito);
        foreach ($cached['productos'] ?? [] as $p) {
            if (($p['handle'] ?? '') === $handle) {
                return $p;
            }
        }
    }
    return null;
}

function esferos_imagen(string $src, int $width = 640): string
{
    if ($src === '') {
        return '';
    }
    if (str_starts_with($src, '//')) {
        $src = 'https:' . $src;
    }
    $sep = str_contains($src, '?') ? '&' : '?';
    return $src . $sep . 'width=' . $width;
}

function esferos_fmt_cantidad(int $n): string
{
    return number_format($n, 0, ',', '.');
}

function esferos_lower(string $value): string
{
    $value = function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
    return strtr($value, [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
        'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
    ]);
}

/** @return array{productos: list<array<string,mixed>>, actualizado: int, error?: string} */
function esferos_catalogo(string $ambito = ''): array
{
    $key = 'catalog-' . ($ambito !== '' ? $ambito : 'all');
    $cached = esferos_tmp_leer($key);
    $age = is_array($cached) ? time() - (int) ($cached['actualizado'] ?? 0) : PHP_INT_MAX;
    if (is_array($cached) && !empty($cached['productos']) && $age < ESFEROS_TTL) {
        return $cached;
    }

    $fresco = esferos_descargar($ambito);
    if ($fresco['productos'] !== []) {
        esferos_tmp_guardar($key, $fresco);
        return $fresco;
    }
    if (is_array($cached) && !empty($cached['productos'])) {
        $cached['error'] = $fresco['error'] ?? 'Esferos no respondió.';
        return $cached;
    }
    return $fresco;
}

/**
 * @param list<array<string,mixed>> $productos
 * @return list<array<string,mixed>>
 */
function esferos_con_stock(array $productos): array
{
    $handles = [];
    foreach ($productos as $p) {
        $h = trim((string) ($p['handle'] ?? ''));
        if ($h !== '') {
            $handles[] = $h;
        }
    }
    if ($handles === []) {
        return $productos;
    }
    return esferos_aplicar_inventario($productos, esferos_stock_vivo($handles));
}

/**
 * @param list<array<string,mixed>> $productos
 * @return list<array<string,mixed>>
 */
function esferos_filtrar(array $productos, string $q, string $cat): array
{
    $q = esferos_lower(trim($q));
    $cats = esferos_categorias();
    return array_values(array_filter($productos, static function (array $p) use ($q, $cat, $cats): bool {
        if ($cat !== '' && isset($cats[$cat]) && !in_array($cat, $p['categorias'], true)) {
            return false;
        }
        if ($q === '') {
            return true;
        }
        $hay = esferos_lower($p['nombre'] . ' ' . $p['sku'] . ' ' . implode(' ', $p['skus']));
        return str_contains($hay, $q);
    }));
}

/**
 * Mezcla el listado “Todos”: un producto de cada categoría por turno.
 *
 * @param list<array<string,mixed>> $productos
 * @return list<array<string,mixed>>
 */
function esferos_intercalar(array $productos): array
{
    $orden = array_merge(['esferos'], array_keys(esferos_menu()['promocionales']['hijos']));
    $colas = array_fill_keys($orden, []);
    $otros = [];
    foreach ($productos as $p) {
        $handles = is_array($p['categorias'] ?? null) ? $p['categorias'] : [];
        $puesto = false;
        foreach ($orden as $h) {
            if (in_array($h, $handles, true)) {
                $colas[$h][] = $p;
                $puesto = true;
                break;
            }
        }
        if (!$puesto) {
            $otros[] = $p;
        }
    }
    $orden[] = '__otros';
    $colas['__otros'] = $otros;
    $cursor = array_fill_keys($orden, 0);
    $out = [];
    $seguir = true;
    while ($seguir) {
        $seguir = false;
        foreach ($orden as $h) {
            if ($cursor[$h] < count($colas[$h])) {
                $out[] = $colas[$h][$cursor[$h]];
                $cursor[$h]++;
                $seguir = true;
            }
        }
    }
    return $out;
}

/** @return array{productos: list<array<string,mixed>>, actualizado: int, error?: string} */
function esferos_descargar(string $ambito = ''): array
{
    if ($ambito !== '' && isset(esferos_categorias()[$ambito])) {
        $handles = $ambito === 'promocionales'
            ? array_merge(['promocionales'], array_keys(esferos_menu()['promocionales']['hijos']))
            : [$ambito];
        $lista = esferos_bajar_colecciones($handles);
        if ($ambito === 'promocionales') {
            foreach ($lista as &$p) {
                if (!in_array('promocionales', $p['categorias'], true)) {
                    $p['categorias'][] = 'promocionales';
                }
            }
            unset($p);
        }
    } else {
        $lista = esferos_bajar_listado('/products.json');
        if ($lista !== []) {
            $lista = esferos_etiquetar($lista);
        }
    }
    if ($lista === []) {
        return ['productos' => [], 'actualizado' => time(), 'error' => 'Esferos no respondió el listado.'];
    }
    usort($lista, static fn(array $a, array $b): int => strcasecmp($a['nombre'], $b['nombre']));
    return ['productos' => $lista, 'actualizado' => time()];
}

/**
 * @param list<string> $handles
 * @return list<array<string,mixed>>
 */
function esferos_bajar_colecciones(array $handles): array
{
    $urls = [];
    foreach ($handles as $h) {
        $urls[$h . ':1'] = ESFEROS_BASE . '/collections/' . rawurlencode($h) . '/products.json?limit=250&page=1';
    }
    $porId = esferos_mezclar_listados($urls);
    $mas = [];
    foreach ($handles as $h) {
        $n = 0;
        foreach ($porId as $p) {
            if (in_array($h, $p['categorias'], true)) {
                $n++;
            }
        }
        if ($n >= 250) {
            $mas[] = $h;
        }
    }
    if ($mas !== []) {
        $urls2 = [];
        foreach ($mas as $h) {
            for ($page = 2; $page <= 6; $page++) {
                $urls2[$h . ':' . $page] = ESFEROS_BASE . '/collections/' . rawurlencode($h) . '/products.json?limit=250&page=' . $page;
            }
        }
        $porId = esferos_mezclar_listados($urls2, $porId);
    }
    return array_values($porId);
}

/**
 * @return list<array<string,mixed>>
 */
function esferos_bajar_listado(string $path): array
{
    $sep = str_contains($path, '?') ? '&' : '?';
    $first = esferos_get_json($path . $sep . 'limit=250&page=1');
    if ($first === null) {
        return [];
    }
    $porId = [];
    foreach ($first['products'] ?? [] as $item) {
        if (!is_array($item)) {
            continue;
        }
        $normal = esferos_normalizar($item);
        if ($normal !== null) {
            $porId[$normal['id']] = $normal;
        }
    }
    if (count($first['products'] ?? []) < 250) {
        return array_values($porId);
    }
    $urls = [];
    for ($page = 2; $page <= 8; $page++) {
        $urls['p' . $page] = ESFEROS_BASE . $path . $sep . 'limit=250&page=' . $page;
    }
    return array_values(esferos_mezclar_listados($urls, $porId));
}

/**
 * @param array<string,string> $urls
 * @param array<string,array<string,mixed>> $porId
 * @return array<string,array<string,mixed>>
 */
function esferos_mezclar_listados(array $urls, array $porId = []): array
{
    foreach (esferos_http_multi($urls) as $key => $body) {
        if (!is_string($body) || $body === '') {
            continue;
        }
        $data = json_decode($body, true);
        $cat = str_contains($key, ':') ? explode(':', $key, 2)[0] : '';
        foreach ($data['products'] ?? [] as $item) {
            if (!is_array($item)) {
                continue;
            }
            $id = (string) ($item['id'] ?? '');
            if ($id !== '' && isset($porId[$id])) {
                if ($cat !== '' && !in_array($cat, $porId[$id]['categorias'], true)) {
                    $porId[$id]['categorias'][] = $cat;
                }
                continue;
            }
            $normal = esferos_normalizar($item);
            if ($normal === null) {
                continue;
            }
            if ($cat !== '') {
                $normal['categorias'][] = $cat;
            }
            $porId[$normal['id']] = $normal;
        }
    }
    return $porId;
}

/**
 * @param list<array<string,mixed>> $lista
 * @return list<array<string,mixed>>
 */
function esferos_etiquetar(array $lista): array
{
    $porId = [];
    foreach ($lista as $p) {
        $porId[$p['id']] = $p;
    }
    $urls = [];
    foreach (array_keys(esferos_categorias()) as $h) {
        $urls[$h . ':1'] = ESFEROS_BASE . '/collections/' . rawurlencode($h) . '/products.json?limit=250&page=1';
    }
    return array_values(esferos_mezclar_listados($urls, $porId));
}

/** @param array<string,mixed> $item */
function esferos_normalizar(array $item): ?array
{
    $id = (string) ($item['id'] ?? '');
    $nombre = trim((string) ($item['title'] ?? ''));
    if ($id === '' || $nombre === '') {
        return null;
    }

    $variantes = [];
    $disponible = false;
    foreach (($item['variants'] ?? []) as $variant) {
        if (!is_array($variant)) {
            continue;
        }
        $ok = !empty($variant['available']);
        $disponible = $disponible || $ok;
        $tituloVar = (string) ($variant['title'] ?? '');
        if ($tituloVar === 'Default Title') {
            $tituloVar = '';
        }
        $variantes[] = [
            'sku' => trim((string) ($variant['sku'] ?? '')),
            'titulo' => $tituloVar,
            'disponible' => $ok,
        ];
    }

    $galeria = [];
    foreach (($item['images'] ?? []) as $img) {
        $src = is_array($img) ? (string) ($img['src'] ?? '') : '';
        if ($src !== '') {
            $galeria[] = $src;
        }
    }

    $skus = array_values(array_filter(array_map(static fn(array $v): string => $v['sku'], $variantes)));
    $desc = esferos_limpiar_html((string) ($item['body_html'] ?? ''));

    return [
        'id' => $id,
        'nombre' => $nombre,
        'handle' => (string) ($item['handle'] ?? ''),
        'sku' => $skus[0] ?? '',
        'skus' => $skus,
        'disponible' => $disponible,
        'imagen' => $galeria[0] ?? '',
        'galeria' => $galeria,
        'variantes' => $variantes,
        'descripcion' => $desc,
        'categorias' => [],
    ];
}

function esferos_limpiar_html(string $html): string
{
    $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $html = strip_tags($html, '<p><br><ul><ol><li><strong><b><em><i>');
    $html = preg_replace('/\s+/u', ' ', $html) ?? $html;
    return trim($html);
}

/**
 * @param list<array<string,mixed>> $productos
 * @return list<array<string,mixed>>
 */
function esferos_ordenar(array $productos, string $orden): array
{
    $lista = $productos;
    if ($orden === 'za') {
        usort($lista, static fn(array $a, array $b): int => strcasecmp((string) $b['nombre'], (string) $a['nombre']));
    } elseif ($orden === 'stock') {
        usort($lista, static function (array $a, array $b): int {
            $da = !empty($a['disponible']) ? 0 : 1;
            $db = !empty($b['disponible']) ? 0 : 1;
            if ($da !== $db) {
                return $da <=> $db;
            }
            return strcasecmp((string) $a['nombre'], (string) $b['nombre']);
        });
    } else {
        usort($lista, static fn(array $a, array $b): int => strcasecmp((string) $a['nombre'], (string) $b['nombre']));
    }
    return $lista;
}

/**
 * @param array<string,mixed> $p
 * @return list<array<string,mixed>>
 */
function esferos_vars_disponibles(array $p): array
{
    $vars = is_array($p['variantes'] ?? null) ? $p['variantes'] : [];
    return array_values(array_filter($vars, static fn(array $v): bool => !empty($v['disponible'])));
}

/**
 * @param list<array<string,mixed>> $productos
 * @param array<string,mixed> $actual
 * @return list<array<string,mixed>>
 */
function esferos_relacionados(array $productos, array $actual, int $limite = 8): array
{
    $handle = (string) ($actual['handle'] ?? '');
    $cats = is_array($actual['categorias'] ?? null) ? $actual['categorias'] : [];
    $hijos = array_keys(esferos_menu()['promocionales']['hijos']);
    $prio = [];
    foreach ($cats as $c) {
        if ($c === 'esferos' || in_array($c, $hijos, true)) {
            $prio[] = $c;
        }
    }
    $out = [];
    foreach ($productos as $p) {
        if ((string) ($p['handle'] ?? '') === $handle) {
            continue;
        }
        if (empty($p['disponible'])) {
            continue;
        }
        $pc = is_array($p['categorias'] ?? null) ? $p['categorias'] : [];
        $ok = $prio === [] || array_intersect($prio, $pc) !== [];
        if ($ok) {
            $out[] = $p;
        }
        if (count($out) >= $limite) {
            break;
        }
    }
    if (count($out) < $limite) {
        foreach ($productos as $p) {
            if ((string) ($p['handle'] ?? '') === $handle) {
                continue;
            }
            if (empty($p['disponible'])) {
                continue;
            }
            $ya = false;
            foreach ($out as $o) {
                if ($o['handle'] === $p['handle']) {
                    $ya = true;
                    break;
                }
            }
            if (!$ya) {
                $out[] = $p;
            }
            if (count($out) >= $limite) {
                break;
            }
        }
    }
    return $out;
}

/** @return array<string,mixed>|null */
function esferos_get_json(string $path): ?array
{
    $body = esferos_http(ESFEROS_BASE . $path);
    if ($body === null) {
        return null;
    }
    $data = json_decode($body, true);
    return is_array($data) ? $data : null;
}

/** @return array<int,mixed> */
function esferos_curl_opts(): array
{
    return [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 12,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => 'vapaesa-web/1.0',
        CURLOPT_HTTPHEADER => ['Accept: application/json'],
    ];
}

function esferos_http(string $url): ?string
{
    if (!function_exists('curl_init')) {
        return null;
    }
    $ch = curl_init($url);
    curl_setopt_array($ch, esferos_curl_opts());
    $body = curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (!is_string($body) || $code >= 400) {
        return null;
    }
    return $body;
}

/**
 * @param array<string,string> $urls
 * @return array<string,string|null>
 */
function esferos_http_multi(array $urls): array
{
    if ($urls === [] || !function_exists('curl_multi_init')) {
        return [];
    }
    $mh = curl_multi_init();
    $chs = [];
    foreach ($urls as $key => $url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, esferos_curl_opts());
        curl_multi_add_handle($mh, $ch);
        $chs[$key] = $ch;
    }
    $running = 0;
    do {
        curl_multi_exec($mh, $running);
        curl_multi_select($mh, 0.5);
    } while ($running > 0);
    $out = [];
    foreach ($chs as $key => $ch) {
        $body = curl_multi_getcontent($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $out[$key] = (is_string($body) && $code < 400) ? $body : null;
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);
    return $out;
}

/**
 * @param list<string> $handles
 * @return array<string, array<string,int>>
 */
function esferos_stock_vivo(array $handles): array
{
    $cache = esferos_tmp_leer('stock') ?? ['actualizado' => 0, 'items' => []];
    if ((time() - (int) ($cache['actualizado'] ?? 0)) >= ESFEROS_STOCK_TTL) {
        $cache = ['actualizado' => time(), 'items' => []];
    }
    $items = is_array($cache['items'] ?? null) ? $cache['items'] : [];
    $faltan = [];
    foreach ($handles as $h) {
        if (!isset($items[$h])) {
            $faltan[] = $h;
        }
    }
    if ($faltan !== [] && esferos_login()) {
        foreach (esferos_bajar_inventario($faltan) as $h => $mapa) {
            $items[$h] = $mapa;
        }
        foreach ($faltan as $h) {
            if (!isset($items[$h])) {
                $items[$h] = [];
            }
        }
        esferos_tmp_guardar('stock', ['actualizado' => (int) ($cache['actualizado'] ?: time()), 'items' => $items]);
    }
    $out = [];
    foreach ($handles as $h) {
        $out[$h] = $items[$h] ?? [];
    }
    return $out;
}

/**
 * @param list<string> $handles
 * @return array<string, array<string,int>>
 */
function esferos_bajar_inventario(array $handles): array
{
    $cookie = esferos_cookie_path();
    $out = [];
    foreach (array_chunk($handles, 8) as $chunk) {
        $mh = curl_multi_init();
        $chs = [];
        foreach ($chunk as $i => $handle) {
            $ch = curl_init(esferos_ficha($handle));
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_COOKIEFILE => $cookie,
                CURLOPT_COOKIEJAR => $cookie,
                CURLOPT_USERAGENT => 'vapaesa-web/1.0',
            ]);
            curl_multi_add_handle($mh, $ch);
            $chs[$i] = [$ch, $handle];
        }
        $running = 0;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh, 1.0);
        } while ($running > 0);
        foreach ($chs as [$ch, $handle]) {
            $body = curl_multi_getcontent($ch);
            if (is_string($body) && $body !== '') {
                $out[$handle] = esferos_parse_inventario($body);
            }
            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
        }
        curl_multi_close($mh);
    }
    return $out;
}

/** @return array<string,int> etiqueta de color => unidades */
function esferos_parse_inventario(string $html): array
{
    $out = [];
    if (preg_match('/<summary>\s*Inventario Disponible\s*<\/summary>\s*<div class="divDetails">(.*?)<\/div>/is', $html, $block)) {
        if (preg_match_all('/<p>\s*(.+?)\s*-\s*\((\d+)\s*:\s*Articulos\)\s*<\/p>/i', $block[1], $m, PREG_SET_ORDER)) {
            foreach ($m as $row) {
                $label = trim(html_entity_decode(strip_tags($row[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                if ($label !== '') {
                    $out[$label] = (int) $row[2];
                }
            }
        }
    }
    if ($out === [] && preg_match_all('/data-sku="([^"]+)"[^>]*>[^<]*\(Stock:\s*(\d+)\)/i', $html, $m, PREG_SET_ORDER)) {
        foreach ($m as $row) {
            $sku = trim(html_entity_decode($row[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            if ($sku !== '') {
                $out['sku:' . $sku] = (int) $row[2];
            }
        }
    }
    return $out;
}

/**
 * @param list<array<string,mixed>> $productos
 * @param array<string, array<string,int>> $porHandle
 * @return list<array<string,mixed>>
 */
function esferos_aplicar_inventario(array $productos, array $porHandle): array
{
    foreach ($productos as &$p) {
        $map = $porHandle[$p['handle'] ?? ''] ?? [];
        if ($map === []) {
            continue;
        }
        $mapLower = [];
        foreach ($map as $k => $n) {
            $mapLower[esferos_lower($k)] = $n;
        }
        $unico = count($map) === 1 ? (int) array_values($map)[0] : null;
        $disp = false;
        foreach ($p['variantes'] as &$v) {
            $sku = (string) ($v['sku'] ?? '');
            $titulo = $v['titulo'] !== '' ? (string) $v['titulo'] : 'Default Title';
            $qty = null;
            if (isset($map[$titulo])) {
                $qty = $map[$titulo];
            } elseif (isset($mapLower[esferos_lower($titulo)])) {
                $qty = $mapLower[esferos_lower($titulo)];
            } elseif ($sku !== '' && isset($map['sku:' . $sku])) {
                $qty = $map['sku:' . $sku];
            } elseif ($unico !== null && count($p['variantes']) === 1) {
                $qty = $unico;
            }
            if ($qty !== null) {
                $v['cantidad'] = $qty;
                $v['disponible'] = $qty > 0;
            }
            $disp = $disp || !empty($v['disponible']);
        }
        unset($v);
        $p['disponible'] = $disp;
    }
    unset($p);
    return $productos;
}

/** @return array<string,string> */
function esferos_env(): array
{
    return function_exists('site_env') ? site_env() : [];
}

function esferos_cookie_path(): string
{
    return rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'vapaesa-esferos-cookie.txt';
}

function esferos_login(): bool
{
    $env = esferos_env();
    $email = $env['ESFEROS_EMAIL'] ?? '';
    $password = $env['ESFEROS_PASSWORD'] ?? '';
    if ($email === '' || $password === '' || !function_exists('curl_init')) {
        return false;
    }
    $cookie = esferos_cookie_path();
    $stamp = esferos_tmp_leer('login');
    if (is_file($cookie) && is_array($stamp) && (time() - (int) ($stamp['actualizado'] ?? 0)) < ESFEROS_LOGIN_TTL) {
        return true;
    }
    $boot = curl_init(ESFEROS_BASE . '/account/login');
    curl_setopt_array($boot, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_COOKIEJAR => $cookie,
        CURLOPT_COOKIEFILE => $cookie,
        CURLOPT_USERAGENT => 'vapaesa-web/1.0',
    ]);
    curl_exec($boot);
    curl_close($boot);

    $ch = curl_init(ESFEROS_BASE . '/account/login');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_COOKIEJAR => $cookie,
        CURLOPT_COOKIEFILE => $cookie,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'form_type' => 'customer_login',
            'utf8' => '✓',
            'customer[email]' => $email,
            'customer[password]' => $password,
        ]),
        CURLOPT_USERAGENT => 'vapaesa-web/1.0',
    ]);
    curl_exec($ch);
    $final = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    $ok = !str_contains($final, '/account/login');
    if ($ok) {
        esferos_tmp_guardar('login', ['actualizado' => time()]);
    }
    return $ok;
}

function esferos_tmp_path(string $name): string
{
    return rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'vapaesa-esferos-' . $name . '.json';
}

function esferos_tmp_leer(string $name): ?array
{
    $path = esferos_tmp_path($name);
    if (!is_file($path)) {
        return null;
    }
    $data = json_decode((string) file_get_contents($path), true);
    return is_array($data) ? $data : null;
}

function esferos_tmp_guardar(string $name, array $data): void
{
    file_put_contents(esferos_tmp_path($name), json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
