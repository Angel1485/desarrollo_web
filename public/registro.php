<?php
session_start();
require_once "../classes/usuario.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario();
    $usuario->nombre = $_POST['nombre'];
    $usuario->correo = $_POST['correo'];
    $usuario->contrasena = $_POST['contrasena'];

    if ($usuario->registrar()) {
        $mensaje = "Registro exitoso. <a href='index.php'>Inicia sesión aquí</a>";
    } else {
        $mensaje = "Error al registrar el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="container">
    <h2>Registro de Usuario</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
    <p><?php echo $mensaje; ?></p>
    <a href="index.php">Volver al login</a>
</div>
</body>
</html>