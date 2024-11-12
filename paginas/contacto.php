<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (incluye tu archivo conexion.php)
    include 'conexion.php';

    // Obtener datos del formulario
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    // Comprobar si el email ya existe en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el resultado contiene alguna fila, el usuario ya está registrado
    if ($result->num_rows > 0) {
        // Cerrar la declaración y la conexión
        $stmt->close();
        $conexion->close();

        // Redirigir al formulario de login
        header("Location: login.php?error=usuario_existe");
        exit();  // Asegurarse de detener la ejecución del script
    } else {
        // Si el usuario no está registrado, proceder a registrarlo
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, password_hash($password, PASSWORD_DEFAULT));

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conexion->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Registro/Iniciar Sesión</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link rel="stylesheet" href="../estilos/responsive.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../js/contacto.js" ></script>
</head>

<body>
    

<nav class="nav-index">
    <div class="nav-left">
        <a href="../index.php">Luz, cámara, blog</a>
    </div>
    <div class="nav-right">
        <a href="explorar.php">Explorar</a>
        <a href="contacto.php">Contacto</a>
    </div>
</nav>

    
<main class="contenedor-principal">
    <section id="formulario">
        <h2>Regístrate o Inicia Sesión</h2>
        <div class="contenido-formulario">
            <!-- Formulario de Inicio de Sesión y Registro -->
            <div id="login-form">
                <h3>Iniciar Sesión</h3>
                <form method="post" action="login.php">
                    <label for="login_email">Correo Electrónico:</label>
                    <input type="email" id="login_email" name="login_email" required placeholder="E-mail">

                    <label for="login_password">Contraseña:</label>
                    <input type="password" id="login_password" name="login_password" required placeholder="Contraseña">

                    <button type="submit">Iniciar Sesión</button>
                    <input type="hidden" name="redirect_url" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : '../index.php'; ?>">
                    <p>¿No tienes cuenta? <a href="#" id="show-registro">Regístrate aquí</a></p>
                </form>
            </div>
            
            <div id="registro-form" style="display: none;">
                <h3>Regístrate</h3>
                <form method="post" action="registro.php">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Nombre">

                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required placeholder="E-mail">

                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="password" name="password" required placeholder="Contraseña">

                    <button type="submit">Registrarse</button>
                </form>
                <p id="error-mensaje" style="display: none;">La contraseña debe tener al menos 8 caracteres y contener
                    al menos un número o un carácter especial /^(?=.*[0-9!@#$%^&*])/</p>
                <p>¿Ya tienes cuenta? <a href="#" id="show-login">Inicia Sesión aquí</a></p>
            </div>
        </div>
    </section>

    <!-- Imagen en la derecha -->
    <div class="imagen-lateral">
        <img src="../imagenes/fondo1.jpg" alt="Imagen Lateral">
    </div>
</main>

    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>

</html>