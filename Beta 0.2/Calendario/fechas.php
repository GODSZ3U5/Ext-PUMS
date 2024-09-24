<?php
$startDate = new DateTime();  // Fecha actual
$endDate = (clone $startDate)->modify('+2 months');  // 2 meses después

$interval = new DateInterval('P1D');  // Intervalo de un día
$dateRange = new DatePeriod($startDate, $interval, $endDate);

// Conexión a la base de datos
$servername = "172.0.0.1";
$username = "root";
$password = "";
$database = "calendario";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

foreach ($dateRange as $date) {
    $fecha = $date->format('Y-m-d');
    // Bloquear automáticamente sábados y domingos
    if (in_array($date->format('N'), [6, 7])) {
        $sql = "INSERT INTO disponibilidad (fecha, bloqueado) VALUES ('$fecha', 1)";
    } else {
        $sql = "INSERT INTO disponibilidad (fecha) VALUES ('$fecha')";
    }
    $conn->query($sql);
}

echo "Fechas generadas con éxito.";
$conn->close();
?>
