<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'paciente') {
    header("Location: ../login.php");
    exit();
}
require '../includes/db.php';

$id_usuario = $_SESSION['user_id'];
$id_cita = $_GET['id'] ?? null;

if (!$id_cita) {
    header("Location: ver_citas.php");
    exit();
}

// Obtener datos actuales de la cita
$sql_cita = "SELECT * FROM citas WHERE id = '$id_cita' AND id_usuario = '$id_usuario' AND estado = 'pendiente'";
$result_cita = $conn->query($sql_cita);

if ($result_cita->num_rows == 0) {
    die("Cita no encontrada o ya no puede ser modificada.");
}
$cita = $result_cita->fetch_assoc();

// Procesar la actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];

    $sql_update = "UPDATE citas SET fecha = '$fecha', hora = '$hora', especialidad = '$especialidad' 
                   WHERE id = '$id_cita' AND id_usuario = '$id_usuario'";
    
    if ($conn->query($sql_update) === TRUE) {
        $_SESSION['mensaje_exito'] = "La cita fue actualizada con éxito.";
        header("Location: ver_citas.php");
        exit();
    } else {
        $error = "Error al actualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Cita</h2>
<?php if(isset($error)): ?>
            <div class="alerta alerta-error">
                <strong> Error:</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>        
        <form method="POST" action="">
            <label>Fecha:</label>
            <input type="date" name="fecha" value="<?php echo $cita['fecha']; ?>" required min="<?php echo date('Y-m-d'); ?>">
            
            <label>Hora:</label>
            <input type="time" name="hora" value="<?php echo $cita['hora']; ?>" required>
            
            <label>Especialidad:</label>
            <select name="especialidad" required>
                <option value="Medicina General" <?php if($cita['especialidad'] == 'Medicina General') echo 'selected'; ?>>Medicina General</option>
                <option value="Pediatría" <?php if($cita['especialidad'] == 'Pediatría') echo 'selected'; ?>>Pediatría</option>
                <option value="Ginecología" <?php if($cita['especialidad'] == 'Ginecología') echo 'selected'; ?>>Ginecología</option>
                <option value="Cardiología" <?php if($cita['especialidad'] == 'Cardiología') echo 'selected'; ?>>Cardiología</option>
            </select>
            
            <button type="submit">Actualizar Cita</button>
            <a href="ver_citas.php" style="text-align: center; display: block; margin-top: 10px;">Cancelar</a>
        </form>
    </div>
    <script src="../js/index.js"></script>
</body>
</html>