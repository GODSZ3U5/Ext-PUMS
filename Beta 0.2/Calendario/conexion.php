<?php
$servername = "localhost"; 
$username = "root";  
$password = "";  
$database = "calendario";


$connection = new mysqli($servername, $username, $password, $database);


if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}
echo "Conexión exitosa";
?>
