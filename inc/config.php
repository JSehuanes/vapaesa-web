<?php
declare(strict_types=1);

const SITE_NAME = 'vapaesa';
const SITE_TAGLINE = 'La imaginación es el límite, la creatividad es el poder.';
const MAIL_TO = 'comercial@vapaesa.com';
const MAIL_FROM = 'noreply@vapaesa.com';
const WA_NUMBER = '573007144925';
const PHONE_DISPLAY = '300 714 4925';
const ADDRESS = 'Calle 42 # 41 - 42 Local: 102 - 103';
const CITY = 'Barranquilla, Atlántico';
const INSTAGRAM = 'https://www.instagram.com/vapaesa/';
const MAPS_URL = 'https://www.google.com/maps/search/?api=1&query=Calle+42+%2341-42+Local+102+103+Barranquilla';

function wa_url(string $mensaje): string
{
    return 'https://wa.me/' . WA_NUMBER . '?text=' . rawurlencode($mensaje);
}

function wa_cotizar(string $asunto = ''): string
{
    $base = 'Hola Vapaesa, quiero una cotización.';
    if ($asunto !== '') {
        $base .= ' Interés: ' . $asunto . '.';
    }
    return wa_url($base);
}

function wa_vendedor(): string
{
    return wa_url('Hola Vapaesa, necesito atención con un vendedor.');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function nav_class(string $pagina, string $actual): string
{
    return $pagina === $actual ? 'is-active' : '';
}

/** Lee la raíz del sitio: .env (claves = valor). */
function site_env(): array
{
    static $env = null;
    if (is_array($env)) {
        return $env;
    }
    $env = [];
    $path = dirname(__DIR__) . '/.env';
    if (!is_file($path)) {
        return $env;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        if (!str_contains($line, '=') || str_starts_with(ltrim($line), '#')) {
            continue;
        }
        [$k, $v] = explode('=', $line, 2);
        $env[trim($k)] = trim($v);
    }
    return $env;
}

/** Base del sitio (/vapaesa-web en local, '' en dominio raíz). */
function site_base(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }
    $fromEnv = trim((string) (site_env()['SITE_BASE'] ?? ''));
    if ($fromEnv !== '') {
        $base = $fromEnv === '/' ? '' : rtrim($fromEnv, '/');
        return $base;
    }
    $script = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $dir = dirname($script);
    if ($dir === '/' || $dir === '\\' || $dir === '.' || $dir === '') {
        $base = '';
    } else {
        $base = rtrim($dir, '/');
    }
    return $base;
}

/** Ruta pública del sitio: u('productos'), u('producto/x'), u() = inicio. */
function u(string $path = ''): string
{
    $path = ltrim($path, '/');
    $base = site_base();
    if ($path === '') {
        return $base === '' ? '/' : $base . '/';
    }
    return ($base === '' ? '' : $base) . '/' . $path;
}

/** Versión de assets para romper caché (CSS/JS). Sube el número en .env tras cada deploy. */
function asset_v(): string
{
    $v = site_env()['ASSET_VERSION'] ?? '1';
    return preg_replace('/[^0-9A-Za-z._-]/', '', $v) ?: '1';
}
