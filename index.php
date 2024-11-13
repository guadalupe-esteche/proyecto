<?php
session_start();  // Inicia la sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['nombre'])) {
    $nombreUsuario = htmlspecialchars($_SESSION['nombre']);
    $usuarioLogueado = true;
} else {
    // Valor por defecto cuando no hay sesión iniciada
    $nombreUsuario = "Invitado";
    $usuarioLogueado = false;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luz, Cámara, Blog</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <link rel="stylesheet" href="estilos/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    <script src="js/index.js" defer></script>
</head>

<body>

    <nav class="nav-index">
        <div class="nav-container"> 
            <div class="nav-left">
                <a href="index.php">Luz, Cámara, Blog</a>
            </div>
            <div class="nav-right">
                <a href="paginas/explorar.php">Explorar</a>
                <a href="paginas/contacto.php">Contacto</a>
            </div>
        </div>
    </nav>
    <header class="header-index">
        <div class="header-contenido">
            <h1>Luz, Cámara, Blog</h1>
            <h2>Bienvenido, <?php echo $nombreUsuario; ?>!</h2>
            <p>Explora y descubre las mejores recomendaciones de películas en todos los géneros</p>
        </div>
        <?php
            if (!empty($_SESSION['nombre'])) {
                ?>
                 <a href="paginas/login.php?salir=ok&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">CERRAR SESIÓN</a>
                <?php
            }
        ?>
    </header>

    <main>
        <section id="portada">
            <h2>Bienvenido a Luz, Cámara, Blog</h2>
            <h3>Un blog en donde podrás explorar diferentes géneros de películas y descubrir las mejores recomendaciones</h3>
        </section>

        <div class="carrusel">
            <ul>
                <li><img src="imagenes/drstrange.jpg" alt="Dr. Strange"></li>
                <li><img src="imagenes/forrest.jpg" alt="Forrest Gump"></li>
                <li><img src="imagenes/misionimposible.jpg" alt="Misión Imposible"></li>
                <li><img src="imagenes/marley.jpg" alt="Marley y Yo"></li>
                <li><img src="imagenes/it.jpg" alt="It"></li>
            </ul>
        </div>

        <section id="preguntas-frecuentes">
            <h2>Preguntas Frecuentes</h2>
            <div class="pregunta">
                <h3 class="toggle">¿Cómo me registro en el blog?</h3>
                <p class="respuesta">Para registrarte, ve a la sección de contacto y llena el <a href="paginas/contacto.php">formulario de registro</a></p>
            </div>
            <div class="pregunta">
                <h3 class="toggle">¿Cómo puedo sugerir una película?</h3>
                <p class="respuesta">Puedes sugerir películas en la siguiente sección</p>
            </div>

            <form method="post" action="paginas/sugerir_pelicula.php">
                Sugerir películas:<br>
                <textarea name="comentarios" rows="3" cols="60" required placeholder="Sugiere una película..."></textarea>
                <br>
                <?php if ($usuarioLogueado): ?>
                    <button type="submit">Enviar</button>
                <?php else: ?>
                    <p>Para sugerir una película, <a href="paginas/contacto.php">regístrate o inicia sesión</a>.</p>
                <?php endif; ?>
            </form>
        </section>
        
    </main>
    <footer>
        <p>&copy; 2024 Luz, Cámara, Blog</p>
    </footer>
</body>
</html>
