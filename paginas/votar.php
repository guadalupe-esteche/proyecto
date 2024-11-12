<?php
session_start();
include '../conexion/conexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['mensaje' => 'Debe iniciar sesión para votar.']);
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$data = json_decode(file_get_contents("php://input"), true);
$id_pelicula = intval($data['id_pelicula']);
$voto = $data['voto'];

// Verificar si el voto es "like" o "dislike"
if (!in_array($voto, ['like', 'dislike'])) {
    echo json_encode(['mensaje' => 'Voto no válido.']);
    exit();
}

$conexion = conectar();

if ($conexion) {
    // Verificar si el usuario ya votó por esta película
    $sql_check = "SELECT voto FROM votos WHERE id_usuario = ? AND id_pelicula = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("ii", $id_usuario, $id_pelicula);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo json_encode(['mensaje' => 'Ya ha votado por esta película.']);
    } else {
        // Insertar el voto en la base de datos
        $sql_insert = "INSERT INTO votos (id_usuario, id_pelicula, voto) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("iis", $id_usuario, $id_pelicula, $voto);

        if ($stmt_insert->execute()) {
            // Obtener los nuevos contadores de votos
            $sql_contador = "SELECT 
                                SUM(voto = 'like') AS likes, 
                                SUM(voto = 'dislike') AS dislikes 
                             FROM votos WHERE id_pelicula = ?";
            $stmt_contador = $conexion->prepare($sql_contador);
            $stmt_contador->bind_param("i", $id_pelicula);
            $stmt_contador->execute();
            $result_contador = $stmt_contador->get_result();
            $contadores = $result_contador->fetch_assoc();

            echo json_encode([
                'mensaje' => 'Voto registrado correctamente.',
                'likes' => $contadores['likes'],
                'dislikes' => $contadores['dislikes']
            ]);
        } else {
            echo json_encode(['mensaje' => 'Error al registrar el voto.']);
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    desconectar($conexion);
} else {
    echo json_encode(['mensaje' => 'Error al conectar a la base de datos.']);
}
?>
