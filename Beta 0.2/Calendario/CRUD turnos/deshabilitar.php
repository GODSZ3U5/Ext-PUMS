<?php
include '..//conexion.php';

$fecha = $_POST['fecha'];

$sql_check_turnos = "SELECT turnos_ocupados FROM agendamiento WHERE fecha = '$fecha'";
$result = $connection->query($sql_check_turnos);
$row = $result->fetch_assoc();

if ($row['turnos_ocupados']>0) {
echo ('No se puede deshabilitar el día. Hay turnos ocupados.');
}else{
$sql_disable = "UPDATE agendamiento SET deshabilitado = 1, turnos_disponibles = 0 WHERE fecha = '$fecha'";
$connection->query($sql_disable);
echo "Día deshabilitado con éxito.";
}
$connection->close();
?>