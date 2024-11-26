<?php
header('Content-Type: application/json');
include 'conexion.php';

// Función para registrar errores en un archivo log
function logError($message) {
    error_log($message . "\n", 3, 'error_log.txt');
}

try {
    $stmt = $pdo->query("SELECT * FROM mantenimiento");
    $mantenimiento = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($mantenimiento)) {
        echo json_encode(['message' => 'No hay datos disponibles.']);
    } else {
        echo json_encode($mantenimiento);
    }
} catch (PDOException $e) {
    logError("Error en la base de datos: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}
?>
