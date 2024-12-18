<?php
session_start();
include '../conexion/conexion.php'; // Conectar a la base de datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link rel="stylesheet" href="../estilos/responsive.css">
    <script src="../js/explorar.js" defer></script>
</head>

<body>
<nav class="nav-explorar">
        <div class="nav-container"> 
            <div class="nav-left">
                <a href="../index.php">Luz, Cámara, Blog</a>
            </div>
            <div class="nav-right">
                <a href="explorar.php">Explorar</a>
                <a href="contacto.php">Contacto</a>
            </div>
        </div>
    </nav>
    <div class="menu-hamburguesa" onclick="toggleMenu()">
        ☰
    </div>
    
    <div class="contenedor-explorar">
        <nav id="menuLateral" class="menu-lateral">
            <ul class="tabla-generos">
                <li><a href="#accion">Acción</a></li>
                <li><a href="#drama">Drama</a></li>
                <li><a href="#comedia">Comedia</a></li>
                <li><a href="#ciencia_ficcion">Ciencia Ficción</a></li>
                <li><a href="#terror">Terror</a></li>
                <li><a href="#romance">Romance</a></li>
                <li><a href="#basadas_en_libros">Basadas en libros</a></li>
            </ul>
        </nav>

        <?php
        if (!empty($_SESSION['nombre'])) {
            ?>
                <a href="login.php?salir=ok&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn-salir">CERRAR SESIÓN</a>
            <?php
        }
        ?>

        <main class="pagina-peliculas">
            <div id="contenidoPelicula" class="contenido-pelicula centrado">
                <?php
                $conexion = conectar();
                if ($conexion) {
                    // Consulta para obtener los géneros
                    $sql_generos = "SELECT id_genero, nombre_genero FROM generos";
                    $stmt_generos = $conexion->prepare($sql_generos);
                    $stmt_generos->execute();
                    $generos = $stmt_generos->get_result()->fetch_all(MYSQLI_ASSOC);

                    // Iterar sobre cada género y mostrar sus películas
                    foreach ($generos as $genero) {
                        echo "<h2>Películas de " . htmlspecialchars($genero['nombre_genero']) . "</h2>";
                        $id_genero = strtolower(str_replace(' ', '_', htmlspecialchars($genero['nombre_genero'])));
                        echo "<section id='" . $id_genero . "'>";
                        echo "<button class='nav-btn izq' onclick=\"deslizarSeccion('izquierda', '$id_genero')\">&gt;</button>";
                        // Consulta para obtener las películas de este género
                        $sql_peliculas = "SELECT id_pelicula, titulo, descripcion, imagen FROM peliculas WHERE id_genero = ?";
                        $stmt_peliculas = $conexion->prepare($sql_peliculas);
                        $stmt_peliculas->bind_param('i', $genero['id_genero']);
                        $stmt_peliculas->execute();
                        $peliculas = $stmt_peliculas->get_result()->fetch_all(MYSQLI_ASSOC);

                        // Mostrar películas
                        foreach ($peliculas as $pelicula) {
                            echo "<div class='pelicula'>";
                            echo "<h3><a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "' class='pelicula-titulo'>" . htmlspecialchars($pelicula['titulo']) . "</a></h3>";
                            echo "<a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "'><img src='../imagenes/" . htmlspecialchars($pelicula['imagen']) . "' alt='" . htmlspecialchars($pelicula['titulo']) . "' class='pelicula-img'></a>";
                            echo "</div>";
                        }

                        echo "<button class='nav-btn der' onclick=\"deslizarSeccion('derecha', '$id_genero')\">&gt;</button>";
                        echo "</section>";
                    }
                } else {
                    echo "Error al conectar a la base de datos.";
                }

                ?>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>

</html>
