<?php
session_start();
include("../includes/db.php");

// Verificar sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

// Obtener ID
$id = $_GET["id"];

// SEGURIDAD (opcional pero recomendado)
if ($_SESSION["rol"] != "admin") {
    $id_usuario = $_SESSION["id"];

    // Verificar que la cita pertenece al usuario
    $verificar = "SELECT * FROM citas WHERE id='$id' AND id_usuario='$id_usuario'";
    $resultado = $conexion->query($verificar);

    if ($resultado->num_rows == 0) {
        echo "No tienes permiso para eliminar esta cita";
        exit();
    }
}

// Eliminar cita
$sql = "DELETE FROM citas WHERE id='$id'";

if ($conexion->query($sql)) {
    header("Location: ver_citas.php");
    exit();
} else {
    echo "Error: " . $conexion->error;
}
?>