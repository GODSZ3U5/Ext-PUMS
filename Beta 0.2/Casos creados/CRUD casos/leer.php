<?php
header('Content-Type: application/json');
include 'conexion.php';

try {
    // Consultar los datos de los casos ordenados por fecha (descendente)
    $stmt = $pdo->prepare("SELECT * FROM mantenimiento ORDER BY fecha DESC");
    $stmt->execute();
    $casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($casos);  // Devolver los datos de los casos en formato JSON
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
