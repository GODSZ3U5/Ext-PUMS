// Ejemplo para bloquear/desbloquear días 
if (isset($_POST['bloquear_fecha'])) {
    $fecha = $_POST['fecha'];
    $query = "UPDATE disponibilidad SET bloqueado = 1 WHERE fecha = '$fecha'";
    mysqli_query($conexion, $query);
}

// Ejemplo para modificar turnos
if (isset($_POST['modificar_turnos'])) {
    $fecha = $_POST['fecha'];
    $turnos = $_POST['turnos'];
    $query = "UPDATE disponibilidad SET turnos_disponibles = $turnos WHERE fecha = '$fecha'";
    mysqli_query($conexion, $query);
}
<?