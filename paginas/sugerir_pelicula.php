<?php
session_start();  // Iniciar la sesión
var_dump($_SESSION);  // Esto mostrará todas las variables de sesión disponibles
include '../conexion/conexion.php';
$conexion = conectar(); 

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para sugerir una película.";
    exit;
}

// Verificar si el comentario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comentarios'])) {
    $comentarios = htmlspecialchars($_POST['comentarios']);  // Sanitizar el comentario
    $usuario_id = $_SESSION['usuario_id'];

    // Preparar y ejecutar la consulta SQL
    $stmt = $conexion->prepare("INSERT INTO sugerencias (comentarios, usuario_id) VALUES (?, ?)");
    $stmt->bind_param("si", $comentarios, $usuario_id);

    if ($stmt->execute()) {
        echo "Sugerencia enviada exitosamente.";
    } else {
        echo "Error al enviar la sugerencia.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Formulario incompleto o no válido.";
}
?>
