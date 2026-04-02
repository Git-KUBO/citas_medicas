<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'paciente') {
    header("Location: ../login.php");
    exit();
}
require '../includes/db.php';

$id_usuario = $_SESSION['user_id'];
$id_cita = $_GET['id'] ?? null;

if ($id_cita) {
    // Solo permitimos eliminar si pertenece al usuario y está pendiente
    $sql = "DELETE FROM citas WHERE id = '$id_cita' AND id_usuario = '$id_usuario' AND estado = 'pendiente'";
    $conn->query($sql);
}

$_SESSION['mensaje_exito'] = "La cita fue cancelada correctamente.";
header("Location: ver_citas.php");
exit();
?>