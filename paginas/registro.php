<?php
include 'conexion.php';
echo "Archivo registro.php cargado.";  // Depuración

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conectar a la base de datos
    $con = conectar();
    if ($con) {
        // Recibir datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['email'];
        $contraseña = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashear la contraseña

        // Preparar la consulta SQL
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $nombre, $correo, $contraseña);

        if ($stmt->execute()) {
    echo "<script>alert('Usuario registrado exitosamente.');</script>";
} else {
    echo "<script>alert('Error al registrar el usuario: " . $stmt->error . "');</script>";
}

        // Cerrar la conexión
        desconectar($con);
    } else {
        echo "Error al conectar a la base de datos.";
    }
}
?>
