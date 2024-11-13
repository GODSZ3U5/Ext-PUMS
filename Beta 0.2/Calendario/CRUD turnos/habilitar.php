<?php
include '..//conexion.php';

$fecha = $_POST['fecha'];

$sql_enable = "UPDATE agendamiento SET deshabilitado = 0, turnos_disponibles = 4 WHERE fecha = '$fecha'";
$connection->query($sql_enable);

echo "Día habilitado con éxito.";
$connection->close();
?>