<?php
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conectar a la base de datos
    $con = conectar();
    if ($con) {
        // Recibir datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['email'];
        $contraseña = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashear la contraseña

        // Verificar si el correo ya está registrado
        $sql_verificar = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt_verificar = $con->prepare($sql_verificar);
        $stmt_verificar->bind_param("s", $correo);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->get_result();

        if ($resultado_verificar->num_rows > 0) {
            // Si el correo ya está registrado, mostrar el mensaje y redirigir al formulario de inicio de sesión
            echo "<script>
                    alert('Este correo ya está registrado. Por favor, inicia sesión.');
                    window.location.href = 'contacto.php';
                  </script>";
            $stmt_verificar->close();
            desconectar($con);
            exit();  // Asegurarse de detener la ejecución del script
        } else {
            // Si el correo no está registrado, proceder con el registro
            $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $nombre, $correo, $contraseña);

            if ($stmt->execute()) {
                // Mostrar el mensaje de éxito y redirigir
                echo "<script>
                        alert('Usuario registrado exitosamente.');
                        window.location.href = 'login.php';
                      </script>";
            } else {
                echo "<script>alert('Error al registrar el usuario: " . $stmt->error . "');</script>";
            }

            // Cerrar la declaración de inserción si fue creada
            $stmt->close();
        }

        // Cerrar las declaraciones y la conexión
        $stmt_verificar->close();
        desconectar($con);
    } else {
        echo "Error al conectar a la base de datos.";
    }
}

?>
