<?php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        $error = "Error al registrar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Pacientes</h2>
<?php if(isset($mensaje)): ?>
    <div class="alerta alerta-exito">
        <strong> ¡Excelente!</strong> <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
        <form method="POST" action="">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" required>
            <label>Correo Electrónico:</label>
            <input type="email" name="email" required>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
    
</body>
</html>