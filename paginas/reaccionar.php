<?php
include '../conexion/conexion.php';
$conexion = conectar();

// Verificar si se envían los datos necesarios
if (isset($_POST['id_pelicula']) && isset($_POST['like_dislike']) && isset($_POST['id_usuario'])) {
    $id_pelicula = intval($_POST['id_pelicula']);
    $like_dislike = filter_var($_POST['like_dislike'], FILTER_VALIDATE_BOOLEAN); // Convierte el valor a booleano
    $id_usuario = intval($_POST['id_usuario']);
    
    // Comprobar si la reacción ya existe
    $sql_check = "SELECT * FROM reacciones WHERE id_pelicula = ? AND id_usuario = ?";
    $stmt = $conexion->prepare($sql_check);
    $stmt->bind_param("ii", $id_pelicula, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si la reacción ya existe, eliminarla
        $sql_delete = "DELETE FROM reacciones WHERE id_pelicula = ? AND id_usuario = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $id_pelicula, $id_usuario);
        $stmt_delete->execute();
        echo json_encode(['status' => 'deleted']);
    } else {
        // Insertar nueva reacción
        $sql_insert = "INSERT INTO reacciones (id_pelicula, id_usuario, like_dislike) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $id_pelicula, $id_usuario, $like_dislike);
        $stmt_insert->execute();
        echo json_encode(['status' => 'added', 'like_dislike' => $like_dislike]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
}
?>
