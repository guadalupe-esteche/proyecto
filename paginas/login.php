<?php
session_start();  // Iniciar la sesión
include '../conexion/conexion.php';
$conexion = conectar();  // Asignar la conexión retornada por la función conectar()


//cerrar sesion
if (isset($_GET['salir'])) {
    // Destruir todas las variables de la sesión
    session_unset();
    // Destruir la sesión
    session_destroy();

    // Verificar si hay una URL de redirección proporcionada
    if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
        $redirect_url = $_GET['redirect'];  // Usar la URL proporcionada
    } else {
        $redirect_url = '../index.php';  // Redirigir a index.php por defecto
    }

    // Redirigir al usuario
    header("Location: $redirect_url");
    exit();  // Terminar el script después de la redirección
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['login_email'];
    $contraseña = $_POST['login_password'];

    // Asegurar de que la conexión fue exitosa antes de continuar
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
                $_SESSION['usuario_id'] = $usuario['id_usuario'];

                // Obtener la URL de redirección si existe, o por defecto redirigir a index.php
                $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '../index.php';

                // Redirigir a la página solicitada
                echo "<script>window.location.href = '$redirect_url';</script>";
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
