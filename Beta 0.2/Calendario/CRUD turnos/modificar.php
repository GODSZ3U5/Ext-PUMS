<?php
include '..//conexion.php';

$fecha = $_POST['fecha'];
$turnos = (int)$_POST['turnos'];


$sql_update = "UPDATE agendamiento SET turnos_disponibles = $turnos WHERE fecha = '$fecha'";
$connection-> query($sql_update);

echo "Turnos modificados con éxito.";
$connection->close();
?>