<?php
session_start();
require_once "../classes/Usuario.php";

$usuario = new Usuario();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];

    if ($usuario->actualizar($id, $nombre, $correo)) {
        header("Location: inicio.php");
        exit;
    } else {
        echo "Error al actualizar usuario.";
    }
} else {
    $id = $_GET["id"];
    $datos = $usuario->obtenerPorId($id);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
     <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="container">
    <h2>Editar Usuario</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($datos['nombre']); ?>" required>
        <input type="email" name="correo" value="<?php echo htmlspecialchars($datos['correo']); ?>" required>
        <button type="submit">Actualizar</button>
    </form>
    <p><a href="inicio.php">Volver</a></p>
</div>
</body>
</html>