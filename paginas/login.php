<?php
include 'conexion.php';
conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['login_email'];
    $contraseña = $_POST['login_password'];

    // Buscar el usuario por correo
    $sql = "SELECT * FROM usuarios WHERE correo = :correo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña
    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        echo "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($usuario['nombre']) . "!";
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
