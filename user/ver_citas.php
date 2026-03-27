<?php
session_start();
include("../includes/db.php");

// Verificar sesion
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

// Obtener citas segun rol del usuario
if ($_SESSION["rol"] == "admin") {
    $sql = "SELECT * FROM citas";
} else {
    $id_usuario = $_SESSION["id"];
    $sql = "SELECT * FROM citas WHERE id_usuario = '$id_usuario'";
}

$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver citas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <table class="table table-bordered">

</head>

<body>

<div style="margin-bottom:20px;">
    <a href="crear_cita.php">Crear Cita</a> |
    <a href="ver_citas.php">Ver Citas</a> |
    <a href="../logout.php">Cerrar sesión</a>
</div>

<h2>Lista de Citas</h2>

<table border="1">
    <tr>
        <th>Paciente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Motivo</th>
        <th>Acciones</th>
    </tr>

    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
    <td><?php echo $fila["nombre_paciente"]; ?></td>
    <td><?php echo $fila["fecha"]; ?></td>
    <td><?php echo $fila["hora"]; ?></td>
    <td><?php echo $fila["motivo"]; ?></td>
    <td>
        <a href="editar_cita.php?id=<?php echo $fila["id"]; ?>">Editar</a>
        <a href="eliminar_cita.php?id=<?php echo $fila["id"]; ?>" 
        onclick="return confirm('¿Seguro que quieres eliminar esta cita?');">
        Eliminar
        </a>
    </td>
</tr>
    <?php } ?>

</table>
</body>
</html>