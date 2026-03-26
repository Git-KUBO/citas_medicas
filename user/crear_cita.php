<?php
session_start();
include("../includes/db.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $motivo = $_POST["motivo"];

    // Evitar citas duplicadas
    $verificar = "SELECT * FROM citas WHERE fecha='$fecha' AND hora='$hora'";
    $resultado = $conexion->query($verificar);

    if ($resultado->num_rows > 0) {
        echo "Ya existe una cita en esa fecha y hora";
    } else {

        $sql = "INSERT INTO citas (nombre_paciente, fecha, hora, motivo) 
                VALUES ('$nombre', '$fecha', '$hora', '$motivo')";

        if ($conexion->query($sql) === TRUE) {
            echo "Cita creada correctamente";
        } else {
            echo "Error: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREAR CITA</title>
</head>
<body>

<h2>crear citas medicas</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre del paciente" required><br><br>
    <input type="date" name="fecha" required><br><br>
    <input type="time" name="hora" required><br><br>
    <textarea name="motivo" placeholder="Motivo de la consulta" required></textarea><br><br>

    <button type="submit">Crear Cita</button>
</form>

    
</body>
</html>