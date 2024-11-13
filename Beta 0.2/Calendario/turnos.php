<?php
include 'conexion.php';
header('Content-Type: application/json');

// Recibir la fecha seleccionada desde el frontend (en el caso de reservar un turno)
if (isset($_POST['fecha'])) {
    $fechaSeleccionada = $_POST['fecha'];

    // Comprobar la disponibilidad de turnos para esa fecha utilizando sentencias preparadas
    $sql = "SELECT turnos_disponibles, turnos_ocupados FROM agendamiento WHERE fecha = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $fechaSeleccionada);  // 's' indica que el parámetro es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $turnosDisponibles = $row['turnos_disponibles'];
        $turnosOcupados = $row['turnos_ocupados'];

        // Comprobar si hay turnos disponibles
        if ($turnosDisponibles > 0) {
            // Actualizar los turnos
            $turnosDisponibles--;
            $turnosOcupados++;

            $sqlUpdate = "UPDATE agendamiento SET turnos_disponibles = ?, turnos_ocupados = ? WHERE fecha = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);
            $stmtUpdate->bind_param('iis', $turnosDisponibles, $turnosOcupados, $fechaSeleccionada);

            if ($stmtUpdate->execute()) {
                echo json_encode(["mensaje" => "Turno reservado con éxito para el $fechaSeleccionada."]);
            } else {
                // Si la actualización falla, devolvemos el error
                echo json_encode(["error" => "Error al reservar el turno: " . $stmtUpdate->error]);
            }
        } else {
            // Si no hay turnos disponibles
            echo json_encode(["error" => "No hay turnos disponibles para el $fechaSeleccionada."]);
        }
    } else {
        // Si la fecha no es válida
        echo json_encode(["error" => "La fecha seleccionada no es válida."]);
    }
    
    // Cerramos las declaraciones
    $stmt->close();
    $stmtUpdate->close();
} else {
    // Si no se recibe una fecha, devolver todas las fechas con turnos disponibles
    $sql = "SELECT fecha FROM agendamiento WHERE turnos_disponibles > 0";
    $result = $connection->query($sql);

    $fechasDisponibles = [];

    while ($row = $result->fetch_assoc()) {
        $fechasDisponibles[] = $row['fecha'];  // Guardamos las fechas disponibles
    }

    // Devolvemos las fechas disponibles en formato JSON
    echo json_encode($fechasDisponibles);
}

// Cerramos la conexión a la base de datos
$connection->close();
?>
