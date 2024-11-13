<?php
include 'conexion.php';

$fechaSeleccionada = $_POST['fecha']; // Suponiendo que envías la fecha mediante un formulario POST

// Comprobar la disponibilidad de turnos
$sql = "SELECT turnos_disponibles, turnos_ocupados FROM agendamiento WHERE fecha = '$fechaSeleccionada'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $turnosDisponibles = $row['turnos_disponibles'];
    $turnosOcupados = $row['turnos_ocupados'];

    // Comprobar si hay turnos disponibles
    if ($turnosDisponibles > 0) {
        // Actualizar los turnos
        $turnosDisponibles--;
        $turnosOcupados++;

        $sqlUpdate = "UPDATE agendamiento SET turnos_disponibles = $turnosDisponibles, turnos_ocupados = $turnosOcupados WHERE fecha = '$fechaSeleccionada'";
        
        if ($connection->query($sqlUpdate) === TRUE) {
            echo "Turno reservado con éxito para el $fechaSeleccionada.";
        } else {
            echo "Error al reservar el turno: " . $connection->error;
        }
    } else {
        echo "No hay turnos disponibles para el $fechaSeleccionada.";
    }
} else {
    echo "La fecha seleccionada no es válida.";
}

$connection->close();
?>