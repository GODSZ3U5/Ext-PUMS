<?php

// Conexión a la base de datos usando PDO
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nuevos';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
