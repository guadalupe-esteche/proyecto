<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Intentar conectar a la base de datos
$con = conectar();

// Verificar si la conexión fue exitosa
if ($con) {
    echo "Conexión exitosa a la base de datos.";
    // Cerrar la conexión
    desconectar($con);
} else {
    echo "Error al conectar a la base de datos.";
}
?>
