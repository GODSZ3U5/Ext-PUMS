<?php
header('Content-Type: application/json');
include 'conexion.php';

try {
    // Verificar si se ha pasado el ID
    if (empty($_GET['id'])) {
        throw new Exception('El ID del caso es obligatorio.');
    }

    // Consultar los datos del caso
    $stmt = $pdo->prepare("SELECT * FROM mantenimiento WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $caso = $stmt->fetch();

    if ($caso) {
        echo json_encode($caso);  // Devuelve los datos del caso en formato JSON
    } else {
        throw new Exception('Caso no encontrado.');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
