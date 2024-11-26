<?php
header('Content-Type: application/json');
include 'conexion.php';

// Función para registrar errores en un archivo log
function logError($message) {
    error_log($message . "\n", 3, 'error_log.txt');
}

try {
    // Registrar los datos recibidos para depuración
    file_put_contents('request_log.txt', print_r($_POST, true), FILE_APPEND);

    // Verificar datos recibidos
    $requiredFields = ['nombre', 'cargo', 'usuario_da', 'activo_fijo_equipo', 'contrasena', 'contacto', 'tarea', 'especificacion', 'observaciones', 'fecha'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("El campo $field es obligatorio.");
        }
    }

    // Preparar e insertar los datos
    $sql = "INSERT INTO mantenimiento (nombre, cargo, usuario_da, activo_fijo_equipo, contrasena, contacto, tarea, especificacion, observaciones, fecha) 
            VALUES (:nombre, :cargo, :usuario_da, :activo_fijo_equipo, :contrasena, :contacto, :tarea, :especificacion, :observaciones, :fecha)";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la inserción
    $stmt->execute([
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

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    // Log del error de base de datos
    logError("Error en la base de datos: " . $e->getMessage());
    echo json_encode(['error' => "Error en la base de datos: " . $e->getMessage()]);
} catch (Exception $e) {
    // Log del error general
    logError("Error: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}

?>
