    <?php
    header('Content-Type: application/json');
    // Incluir la conexión a la base de datos
    include 'conexion.php';

    // Consultar los datos de la tabla
    $sql = "SELECT * FROM mantenimiento";
    $result = $conn->query($sql);

    $formData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $formData[] = $row;
        }
    }

    // Enviar los datos como JSON
    header('Content-Type: application/json');
    echo json_encode($formData);

    $conn->close();
    ?>
