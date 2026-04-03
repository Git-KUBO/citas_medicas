<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db.php';

echo "<h2>Prueba de Conexión a la Base de Datos</h2>";

if ($conn) {
    echo "<div style='color: green; padding: 15px; border: 1px solid green; border-radius: 5px;'>";
    echo "<strong>¡Éxito!</strong> La conexión a la base de datos <code>citas_medicas</code> se ha establecido correctamente.";
    echo "</div>";
    
    // Opcional: Mostrar información del servidor
    echo "<p>Información del host: " . $conn->host_info . "</p>";
} else {
    echo "<div style='color: red; padding: 15px; border: 1px solid red; border-radius: 5px;'>";
    echo "<strong>Error:</strong> No se pudo conectar a la base de datos.";
    echo "</div>";
}
?>