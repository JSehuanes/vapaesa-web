<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacto.php');
    exit;
}

if (trim((string) ($_POST['empresa_web'] ?? '')) !== '') {
    header('Location: contacto.php?ok=1');
    exit;
}

$nombre = trim((string) ($_POST['nombre'] ?? ''));
$correo = trim((string) ($_POST['correo'] ?? ''));
$telefono = trim((string) ($_POST['telefono'] ?? ''));
$interes = trim((string) ($_POST['interes'] ?? ''));
$mensaje = trim((string) ($_POST['mensaje'] ?? ''));

if ($nombre === '' || $mensaje === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: contacto.php?error=1');
    exit;
}

$cuerpo = "Nombre: {$nombre}\nCorreo: {$correo}\nTeléfono: {$telefono}\nInterés: {$interes}\n\n{$mensaje}\n";
$asunto = 'Consulta web vapaesa · ' . $interes;
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: vapaesa web <' . MAIL_FROM . '>',
    'Reply-To: ' . $nombre . ' <' . $correo . '>',
];

$ok = @mail(MAIL_TO, '=?UTF-8?B?' . base64_encode($asunto) . '?=', $cuerpo, implode("\r\n", $headers));

header('Location: contacto.php?' . ($ok ? 'ok=1' : 'error=1'));
exit;
