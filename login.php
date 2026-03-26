<?php
session_start();
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$correo = $_POST["correo"];
    $password = $_POST["password"];

    // Buscar usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $usuario["password"])) {

            // Guardar sesión
            $_SESSION["usuario"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];

            echo "Login exitoso";

            // Redirigir según rol
            if ($usuario["rol"] == "admin") {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/dashboard.php");
            }

        } else {
            echo "Contraseña incorrecta";
        }

    } else {
        echo "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<form method="POST">
    <input type="email" name="correo" placeholder="Correo" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>

    <button type="submit">Entrar</button>
</form>

    
</body>
</html>