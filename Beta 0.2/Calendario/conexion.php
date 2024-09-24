<?php
$servername = "127.0.0.1"; 
$username = "root";  
$password = "";  
$database = "calendario";

// Crear la conexión
$connection = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}
echo "Conexión exitosa";
?>
