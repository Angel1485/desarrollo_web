<?php
session_start();
require_once "../classes/usuario.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captcha_input = trim($_POST['captcha']);
    $captcha_session = $_SESSION['captcha_text'] ?? '';

    if (strcasecmp($captcha_input, $captcha_session) != 0) {
        $mensaje = "Captcha incorrecto. Inténtalo nuevamente.";
    } else {
        $usuario = new Usuario();
        $usuario->correo = $_POST['correo'];
        $usuario->contrasena = md5($_POST['contrasena']);

        $stmt = $usuario->login();
        $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

        if ($row) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nombre'] = $row['nombre'];
            header("Location: inicio.php");
            exit;
        } else {
            $mensaje = "Credenciales incorrectas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form method="POST">
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>

        <div class="captcha-container">
            <img src="captcha.php" alt="Captcha" id="captcha-img">
            <button type="button" class="refresh" onclick="document.getElementById('captcha-img').src='captcha.php?'+Math.random();">↻</button>
        </div>

        <input type="text" name="captcha" placeholder="Ingrese el texto de la imagen" required>

        <button type="submit">Ingresar</button>
    </form>
    <p><?php echo $mensaje; ?></p>
    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
</div>
</body>
</html>