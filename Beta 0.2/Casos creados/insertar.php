<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Obtener los datos enviados por AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Extraer los valores del JSON
$usuario = $data['usuario'];
$descripcion = $data['descripcion'];
$fecha = $data['fecha'];

// Crear la consulta SQL para insertar los datos
$sql = "INSERT INTO casos (usuario, descripcion, fecha) VALUES (?, ?, ?)";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Vincular los parámetros
$stmt->bind_param("sss", $usuario, $descripcion, $fecha);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Caso creado correctamente."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al crear el caso."]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>