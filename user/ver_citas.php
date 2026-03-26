<?php
session_start();
include("../includes/db.php");

// Verificar sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
exit();
}

// Obtener citas
$id_usuario = $_SESSION["id"];
$sql = "SELECT * FROM citas WHERE id_usuario = '$id_usuario'";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver citas</title>
</head>
<body>
<h2>Lista de Citas</h2>

<table border="1">
    <tr>
        <th>Paciente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Motivo</th>
    </tr>

    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $fila["nombre_paciente"]; ?></td>
            <td><?php echo $fila["fecha"]; ?></td>
            <td><?php echo $fila["hora"]; ?></td>
            <td><?php echo $fila["motivo"]; ?></td>
        </tr>
    <?php } ?>

</table>
</body>
</html>