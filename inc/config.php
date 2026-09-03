<?php
declare(strict_types=1);

const SITE_NAME = 'vapaesa';
const SITE_TAGLINE = 'La imaginación es el límite, la creatividad es el poder.';
const MAIL_TO = 'comercial@vapaesa.com';
const MAIL_FROM = 'noreply@vapaesa.com';
const WA_NUMBER = '573007144925';
const PHONE_DISPLAY = '300 714 4925';
const ADDRESS = 'Calle 42 # 41 - 72 Local 1';
const CITY = 'Barranquilla, Atlántico';
const INSTAGRAM = 'https://www.instagram.com/vapaesa/';
const MAPS_URL = 'https://www.google.com/maps/search/?api=1&query=Calle+42+%2341-72+Local+1+Barranquilla';

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
