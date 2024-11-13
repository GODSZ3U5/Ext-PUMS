<?php
include '..//conexion.php';

$sql = "SELECT * FROM agendamiento";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Turnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestión de Turnos</h1>
    
    <form action="modificar.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>
        <label for="turnos">Turnos disponibles:</label>
        <input type="number" name="turnos" min="0" max="8" required>
        <button class="btn btn-success" color="#563d7c" type="submit">Modificar Turnos</button>
    </form>
    <div class="table-sm table-bordered .custom_bordered">
    <h2>Lista de Días y Turnos</h2>
    <table>
        <tr class="table-dark">
            <th>Fecha</th>
            <th>Turnos Disponibles</th>
            <th>Turnos Ocupados</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['turnos_disponibles']; ?></td>
                <td><?php echo $row['turnos_ocupados']; ?></td>
                <td class="d-flex justify-content-between">
                    <form action="deshabilitar.php" method="post">
                        <input type="hidden" name="fecha" value="<?php echo $row['fecha']; ?>">
                        <button class="btn btn-warning mr-3" type="submit">Deshabilitar</button>
                    </form>
                <form action="habilitar.php" method="post">
                        <input type="hidden" name="fecha" value="<?php echo $row['fecha']; ?>">
                        <button class="btn btn-danger" type="submit">Habilitar</button>
                    </form>
                </td>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    </div>
    
    <?php $connection->close(); ?>
</body>
</html>