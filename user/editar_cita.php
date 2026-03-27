<?php
session_start();
include("../includes/db.php");

// Verificar sesion
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

// Obtener ID
$id = $_GET["id"];

// Obtener datos 
$sql = "SELECT * FROM citas WHERE id = '$id'";
$resultado = $conexion->query($sql);
$cita = $resultado->fetch_assoc();

// ACTUALIZAR
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $motivo = $_POST["motivo"];

    $update = "UPDATE citas SET 
        nombre_paciente='$nombre',
        fecha='$fecha',
        hora='$hora',
        motivo='$motivo'
        WHERE id='$id'";

    if ($conexion->query($update)) {
        header("Location: ver_citas.php");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Editar Cita</h2>

<form method="POST">
    <input type="text" name="nombre" value="<?php echo $cita["nombre_paciente"]; ?>" required><br><br>
    <input type="date" name="fecha" value="<?php echo $cita["fecha"]; ?>" required><br><br>
    <input type="time" name="hora" value="<?php echo $cita["hora"]; ?>" required><br><br>
    <textarea name="motivo" required><?php echo $cita["motivo"]; ?></textarea><br><br>

    <button type="submit">Actualizar</button>
</form>
</body>
</html>