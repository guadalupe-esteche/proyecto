<?php
include '../conexion/conexion.php';

$conexion = conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_pelicula = $_POST['id_pelicula'];
    $like_dislike = $_POST['like_dislike'] === 'like' ? 1 : 0;

    // Primero, verifica si el usuario ya reaccionó a esta película
    $sql_check = "SELECT * FROM reacciones WHERE id_usuario = ? AND id_pelicula = ?";
    $stmt = $conexion->prepare($sql_check);
    $stmt->bind_param("ii", $id_usuario, $id_pelicula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si ya existe una reacción, elimínala
        $sql_delete = "DELETE FROM reacciones WHERE id_usuario = ? AND id_pelicula = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $id_usuario, $id_pelicula);
        $stmt_delete->execute();
        echo json_encode(["status" => "deleted"]);
    } else {
        // Si no existe, inserta una nueva reacción
        $sql_insert = "INSERT INTO reacciones (id_usuario, id_pelicula, like_dislike) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $id_usuario, $id_pelicula, $like_dislike);
        $stmt_insert->execute();
        echo json_encode(["status" => "inserted", "reaction" => $like_dislike ? "like" : "dislike"]);
    }
}

desconectar($conexion);
?>
