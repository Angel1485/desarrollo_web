
<?php
session_start();
require_once "../classes/Usuario.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$usuario = new Usuario();
$stmt = $usuario->listarUsuarios();

$usuarios = [];
if ($stmt) {
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="containerOne">
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 👋</h2>
    <p>Has iniciado sesión correctamente.</p>

     <h3>Lista de Usuarios Registrados</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?php echo htmlspecialchars($u['id']); ?></td>
            <td><?php echo htmlspecialchars($u['nombre']); ?></td>
            <td><?php echo htmlspecialchars($u['correo']); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $u['id']; ?>">✏️ Editar</a> |
                <a href="eliminar.php?id=<?php echo $u['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">🗑️ Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><br>
    <a href="logout.php">👉 Cerrar sesión </a>
</div>
</body>
</html>