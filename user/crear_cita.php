<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'paciente') {
    header("Location: ../login.php");
    exit();
}
require '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['user_id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];

    $sql = "INSERT INTO citas (id_usuario, fecha, hora, especialidad) VALUES ('$id_usuario', '$fecha', '$hora', '$especialidad')";
    
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cita agendada correctamente.";
    } else {
        $error = "Error al agendar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Agendar Nueva Cita</h2>
        <nav>
            <a href="dashboard.php">Inicio</a> | 
            <a href="../logout.php">Cerrar Sesión</a>
        </nav>
        <br>
        <?php 
            if(isset($mensaje)) echo "<p style='color:green;'>$mensaje</p>";
            if(isset($error)) echo "<p style='color:red;'>$error</p>"; 
        ?>
        <form method="POST" action="">
            <label>Fecha:</label>
            <input type="date" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
            
            <label>Hora:</label>
            <input type="time" name="hora" required>
            
            <label>Especialidad:</label>
            <select name="especialidad" required>
                <option value="Medicina General">Medicina General</option>
                <option value="Pediatría">Pediatría</option>
                <option value="Ginecología">Ginecología</option>
                <option value="Cardiología">Cardiología</option>
            </select>
            
            <button type="submit">Agendar</button>
        </form>
    </div>
    <script src="../js/index.js"></script>
    
</body>
</html>