<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'paciente') {
    header("Location: ../login.php");
    exit();
}
require '../includes/db.php';

$id_usuario = $_SESSION['user_id'];
$sql = "SELECT id, fecha, hora, especialidad, estado FROM citas WHERE id_usuario = '$id_usuario' ORDER BY fecha DESC, hora DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn-edit { color: #007BFF; text-decoration: none; margin-right: 10px; }
        .btn-delete { color: #dc3545; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 800px;">
        <h2>Mis Citas Médicas</h2>
        <nav>
            <a href="dashboard.php">Inicio</a> | 
            <a href="crear_cita.php">Agendar Nueva Cita</a> |
            <a href="../logout.php">Cerrar Sesión</a>
        </nav>
        <?php if(isset($_SESSION['mensaje_exito'])): ?>
            <div class="alerta alerta-exito" style="margin-top: 15px;">
                <strong> ¡Listo!</strong> <?php echo $_SESSION['mensaje_exito']; ?>
            </div>
            <?php unset($_SESSION['mensaje_exito']); // Borramos el mensaje para que no salga al recargar ?>
        <?php endif; ?>

       <?php if(isset($_SESSION['mensaje_exito'])): ?>
            <div class="alerta alerta-exito" style="margin-top: 15px;">
                <strong> ¡Listo!</strong> <?php echo $_SESSION['mensaje_exito']; ?>
            </div>
            <?php unset($_SESSION['mensaje_exito']); ?>
        <?php endif; ?>

        <div class="citas-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="cita-card">
                        
                        <div class="cita-header">
                            <span class="cita-fecha"> <?php echo date("d/m/Y", strtotime($row['fecha'])); ?></span>
                            <span class="cita-hora"> <?php echo date("h:i A", strtotime($row['hora'])); ?></span>
                        </div>
                        
                        <div class="cita-body">
                            <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($row['especialidad']); ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge <?php echo $row['estado']; ?>">
                                    <?php echo ucfirst($row['estado']); ?>
                                </span>
                            </p>
                        </div>
                        
                        <div class="cita-actions">
                            <?php if($row['estado'] == 'pendiente'): ?>
                                <a href="editar_cita.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                                <a href="eliminar_cita.php?id=<?php echo $row['id']; ?>" class="btn-delete">Cancelar</a>
                            <?php else: ?>
                                <span style="flex: 1; text-align: center; padding: 8px; color: #aaa; background: #f4f4f4; border-radius: 5px; font-size: 0.9rem;">No modificable</span>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: white; border-radius: 8px; color: #666;">
                    No tienes citas agendadas en este momento.
                </div>
            <?php endif; ?>
        </div>

    </div>
    <script src="../js/index.js"></script>
</body>
</html>