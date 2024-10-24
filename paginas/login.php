<?php
session_start();  // Iniciar la sesión
include 'conexion.php';
$conexion = conectar();  // Asignar la conexión retornada por la función conectar()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['login_email'];
    $contraseña = $_POST['login_password'];

    // Asegurarse de que la conexión fue exitosa antes de continuar
    if ($conexion) {
        // Buscar el usuario por correo (con sintaxis MySQLi)
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conexion->prepare($sql);  // Preparar la consulta
        
        // Verificar que se haya preparado correctamente
        if ($stmt) {
            $stmt->bind_param('s', $correo);  // 's' indica que el parámetro es de tipo string
            $stmt->execute();  // Ejecutar la consulta
            $resultado = $stmt->get_result();  // Obtener el resultado

            $usuario = $resultado->fetch_assoc();  // Obtener el registro como un array asociativo

            // Verificar la contraseña
            if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
                // Guardar el nombre del usuario en la sesión
                $_SESSION['nombre'] = $usuario['nombre'];

                // Mostrar un alert de inicio de sesión exitoso
                echo "<script>alert('Inicio de sesión exitoso.');</script>";

                // Redirigir a la página de bienvenida después de mostrar el alert
                echo "<script>window.location.href = '../index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Correo o contraseña incorrectos.');</script>";
            }
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        echo "Error en la conexión a la base de datos.";
    }
}
?>
