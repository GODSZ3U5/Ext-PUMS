<?php
$testMode = false;  

if ($testMode) {
    $startDate = new DateTime('2024-12-01');
} else {
    $startDate = new DateTime();  
}

$endDate = (clone $startDate)->modify('+2 months'); 

$interval = new DateInterval('P1D');
$dateRange = new DatePeriod($startDate, $interval, $endDate);

include 'conexion.php';

$sql_delete = "DELETE FROM agendamiento";
$connection->query($sql_delete);


foreach ($dateRange as $date) {
    $fecha = $date->format('Y-m-d');

   
    if (in_array($date->format('N'), [6, 7])) {
        $sql_insert = "INSERT INTO agendamiento (fecha, deshabilitado) VALUES ('$fecha', 1)";
        $sql_turnos = "UPDATE agendamiento SET turnos_disponibles = 0 WHERE fecha = '$fecha'";
    } else {
        $sql_insert = "INSERT INTO agendamiento (fecha) VALUES ('$fecha')";
        $sql_turnos = "UPDATE agendamiento SET turnos_disponibles = 4 WHERE fecha = '$fecha'";
    }


    $connection->query($sql_insert);
    $connection->query($sql_turnos);
}

echo "Fechas generadas con éxito.";
$connection->close();
?>
