<?php
// Conexión a la base de datos
$host = 'localhost'; // o el host de tu servidor
$user = 'root'; // tu usuario de MySQL
$password = ''; // tu contraseña de MySQL (deja en blanco si no tienes una)
$dbname = 'nuevos'; // el nombre de la base de datos que creaste

$conn = new mysqli($host, $user, $password, $dbname);

