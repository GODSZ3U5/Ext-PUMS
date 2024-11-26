<?php
include 'conexion.php';
header('Content-Type: application/json');

// Recibir la fecha seleccionada desde el frontend
if (isset($_POST['fecha'])) {
    $fechaSeleccionada = $_POST['fecha'];

    // Comprobar la disponibilidad de turnos y el estado de habilitación para esa fecha
    $sql = "SELECT turnos_disponibles, turnos_ocupados, deshabilitado FROM agendamiento WHERE fecha = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        echo json_encode(["error" => "Error en la preparación de la consulta: " . $connection->error]);
        exit;
    }

    $stmt->bind_param('s', $fechaSeleccionada);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $turnosDisponibles = $row['turnos_disponibles'];
        $turnosOcupados = $row['turnos_ocupados'];
        $deshabilitado = $row['deshabilitado'];

        // Validar si el día está disponible
        if ($turnosDisponibles > 0 && $deshabilitado == 0) {
            $turnosDisponibles--;
            $turnosOcupados++;

            // Actualizar base de datos
            $sqlUpdate = "UPDATE agendamiento SET turnos_disponibles = ?, turnos_ocupados = ? WHERE fecha = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);

            if ($stmtUpdate === false) {
                echo json_encode(["error" => "Error en la actualización de la base de datos: " . $connection->error]);
                exit;
            }

            $stmtUpdate->bind_param('iis', $turnosDisponibles, $turnosOcupados, $fechaSeleccionada);
            if ($stmtUpdate->execute()) {
                echo json_encode(["mensaje" => "Turno reservado con éxito para el $fechaSeleccionada."]);
            } else {
                echo json_encode(["error" => "Error al reservar el turno: " . $stmtUpdate->error]);
            }
        } else {
            echo json_encode(["error" => "El día seleccionado no está disponible, Porfavor seleccione otro"]);
        }
    } else {
        echo json_encode(["error" => "La fecha seleccionada no es válida o no está registrada."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Fecha no proporcionada."]);
}

$connection->close();
?>
