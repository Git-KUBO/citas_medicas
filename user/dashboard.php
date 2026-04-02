<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'paciente') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Paciente</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .menu { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
        .menu a { padding: 15px; background: #007BFF; color: white; text-align: center; border-radius: 5px; font-weight: bold; }
        .menu a:hover { background: #0056b3; }
        .menu .logout { background: #dc3545; }
        .menu .logout:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
        <p>¿Qué deseas hacer hoy?</p>
        
        <div class="menu">
            <a href="crear_cita.php">Agendar Nueva Cita</a>
            <a href="ver_citas.php">Ver y Gestionar mis Citas</a>
            <a href="../logout.php" class="logout">Cerrar Sesión</a>
        </div>
    </div>
    <script src="../js/index.js"></script>
</body>
</html>