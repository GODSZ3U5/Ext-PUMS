<?php
header('Content-Type: application/json');
include 'conexion.php';
function logError($message) {
    error_log($message . "\n", 3, 'error_log.txt');
}
try {
    if (empty($_POST['id'])) {
        throw new Exception("El ID es obligatorio.");
    }

    // Validar si el registro existe
    $stmt = $pdo->prepare("SELECT * FROM mantenimiento WHERE id = :id");
    $stmt->execute([':id' => $_POST['id']]);
    $caso = $stmt->fetch();

    if (!$caso) {
        throw new Exception("El registro con ID {$_POST['id']} no existe.");
    }

    // Eliminar el registro
    $sql = "DELETE FROM mantenimiento WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_POST['id']]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
