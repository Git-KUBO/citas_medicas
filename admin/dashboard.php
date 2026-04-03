<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
require '../includes/db.php';

// Procesar el cambio de estado
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id_cita = (int)$_GET['id'];
    $accion = $_GET['action'];
    
    $nuevo_estado = '';
    if ($accion == 'confirmar') {
        $nuevo_estado = 'confirmada';
        $_SESSION['mensaje_exito'] = "La cita ha sido confirmada.";
    } elseif ($accion == 'cancelar') {
        $nuevo_estado = 'cancelada';
        $_SESSION['mensaje_exito'] = "La cita ha sido cancelada.";
    }

    if ($nuevo_estado !== '') {
        $sql_update = "UPDATE citas SET estado = '$nuevo_estado' WHERE id = $id_cita";
        if ($conn->query($sql_update)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error al actualizar el estado: " . $conn->error;
        }
    }
}

// Consultar todas las citas con el nombre del paciente
$sql = "SELECT c.id, c.fecha, c.hora, c.especialidad, c.estado, u.nombre AS paciente 
        FROM citas c 
        INNER JOIN usuarios u ON c.id_usuario = u.id 
        ORDER BY c.fecha ASC, c.hora ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrador - NovaCare</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Ajuste específico para el contenedor del admin para que sea más ancho */
        .container-admin {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
        }
        /* Estilos para el nombre del paciente en la tarjeta */
        .paciente-nombre {
            font-size: 1.1rem;
            color: #007BFF;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #eaeaea;
        }
    </style>
</head>
<body style="display: block; background-color: #f4f7f6; padding: 20px;">
    
    <div class="container-admin">
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="margin-top: 0;">Panel de Administración - Citas Médicas</h2>
            <nav>
                <span>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong> (Admin)</span> | 
                <a href="../logout.php" style="color: #dc3545; font-weight: bold;">Cerrar Sesión</a>
            </nav>
        </div>

        <?php if(isset($error)): ?>
            <div class="alerta alerta-error">
                <strong> Error:</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['mensaje_exito'])): ?>
            <div class="alerta alerta-exito">
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
                            <div class="paciente-nombre">
                                <strong> Paciente:</strong> <br>
                                <?php echo htmlspecialchars($row['paciente']); ?>
                            </div>
                            
                            <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($row['especialidad']); ?></p>
                            <p><strong>Estado:</strong> 
                                <span class="badge <?php echo $row['estado']; ?>">
                                    <?php echo ucfirst($row['estado']); ?>
                                </span>
                            </p>
                        </div>
                        
                        <div class="cita-actions">
                            <?php if($row['estado'] == 'pendiente'): ?>
                                <a href="dashboard.php?action=confirmar&id=<?php echo $row['id']; ?>" class="btn-confirm">Confirmar</a>
                                <a href="dashboard.php?action=cancelar&id=<?php echo $row['id']; ?>" class="btn-cancel">Cancelar</a>
                            <?php else: ?>
                                <span style="flex: 1; text-align: center; padding: 8px; color: #aaa; background: #f4f4f4; border-radius: 5px; font-size: 0.9rem;">Cita Procesada</span>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: white; border-radius: 8px; color: #666;">
                    No hay citas registradas en el sistema.
                </div>
            <?php endif; ?>
        </div>
        </div>

    <script src="../js/index.js"></script>
</body>
</html>