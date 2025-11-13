<?php
session_start();

// Generar texto aleatorio de 5 caracteres
$captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);

// Guardar en sesión
$_SESSION["captcha_text"] = $captcha_text;

// Crear imagen
$img = imagecreatetruecolor(120, 40);
$bg_color = imagecolorallocate($img, 255, 255, 255); // blanco
$text_color = imagecolorallocate($img, 0, 0, 0);     // negro
$line_color = imagecolorallocate($img, 150, 150, 150); // gris suave
$pixel_color = imagecolorallocate($img, 200, 200, 200); // gris claro

imagefilledrectangle($img, 0, 0, 120, 40, $bg_color);

// Líneas aleatorias
for ($i = 0; $i < 3; $i++) {
    imageline($img, 0, rand() % 50, 120, rand() % 50, $line_color);
}

// Puntos aleatorios
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($img, rand() % 120, rand() % 40, $pixel_color);
}

// Texto
$font = 5;
imagestring($img, $font, 30, 12, $captcha_text, $text_color);

// Salida de imagen
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>