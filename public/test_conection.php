<?php
    require_once __DIR__ . '/../config/database.php';

    $db = new Database();
    $conn = $db->conectar();

    if ($conn) {
        echo "<h2>✅ Conexión exitosa con la base de datos 'desarrollo_web'</h2>";
        $stmt = $conn->query("SELECT COUNT(*) as total FROM usuarios");
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>Total de usuarios registrados: " . htmlspecialchars($r['total']) . "</p>";
    } else {
        echo "<h2>❌ Error: No se pudo conectar a la base de datos.</h2>";
    }
?>



