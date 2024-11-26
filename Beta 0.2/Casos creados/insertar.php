<?php
header('Content-Type: application/json');
include('conexion.php');

$formData = json_decode(file_get_contents("php://input"), true);

if (!$formData) {
    echo json_encode(["success" => false, "error" => "No se recibieron datos válidos."]);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO mantenimiento (nombre, cargo, usuario_da, activo_fijo_equipo, contrasena, contacto, tarea, especificacion, observaciones, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssss",
        $formData['nombre'],
        $formData['cargo'],
        $formData['usuario_da'],
        $formData['activo_fijo'],
        $formData['contrasena'],
        $formData['contacto'],
        $formData['tarea'],
        $formData['especificacion'],
        $formData['observaciones'],
        $formData['fecha']
    );

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

$conn->close();
exit;
?>
