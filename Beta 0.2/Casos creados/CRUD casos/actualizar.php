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

    // Actualizar el registro
    $sql = "UPDATE mantenimiento SET nombre = :nombre, cargo = :cargo, usuario_da = :usuario_da, activo_fijo_equipo = :activo_fijo_equipo, 
            contrasena = :contrasena, contacto = :contacto, tarea = :tarea, especificacion = :especificacion, 
            observaciones = :observaciones, fecha = :fecha WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_POST['id'],
        ':nombre' => $_POST['nombre'],
        ':cargo' => $_POST['cargo'],
        ':usuario_da' => $_POST['usuario_da'],
        ':activo_fijo_equipo' => $_POST['activo_fijo_equipo'],
        ':contrasena' => $_POST['contrasena'],
        ':contacto' => $_POST['contacto'],
        ':tarea' => $_POST['tarea'],
        ':especificacion' => $_POST['especificacion'],
        ':observaciones' => $_POST['observaciones'],
        ':fecha' => $_POST['fecha'],
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    logError("Error: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}
?>
