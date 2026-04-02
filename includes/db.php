<?php
$host = "localhost";
$user = "root"; // Usuario por defecto en XAMPP
$password = ""; // Contraseña por defecto vacía en XAMPP
$dbname = "citas_medicas";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>