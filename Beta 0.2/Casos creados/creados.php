<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nombre_de_tu_base_de_datos';

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los datos de la tabla
$sql = "SELECT * FROM tabla_donde_se_guardan_los_datos";
$result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Usuario DA</th>
            <th>Activo Fijo Equipo</th>
            <th>Contraseña</th>
            <th>Contacto</th>
            <th>Tarea</th>
            <th>Especificación</th>
            <th>Observaciones</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['cargo']}</td>
                        <td>{$row['usuario_da']}</td>
                        <td>{$row['activo_fijo_equipo']}</td>
                        <td>{$row['contraseña']}</td>
                        <td>{$row['contacto']}</td>
                        <td>{$row['tarea']}</td>
                        <td>{$row['especificacion']}</td>
                        <td>{$row['observaciones']}</td>
                        <td>{$row['fecha']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
?>
