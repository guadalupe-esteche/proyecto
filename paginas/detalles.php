<?php
// Incluir el archivo de conexión
include '../conexion/conexion.php';
// Conectar a la base de datos
$conexion = conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pelicula['titulo'] ?? 'Detalles de la Película'); ?></title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link rel="stylesheet" href="../estilos/responsive.css">
    <script src="../js/detalles.js" defer></script>
</head>
<body>
    <header class="header-detalles">
        <h1>Detalles de la Película</h1>
    </header>

    <nav>
        <ul class="menu-horizontal">
            <li><a href="../index.html">Inicio</a></li>
            <li><a href="explorar.html">Explorar</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
    </nav>

    <main class="pagina-peliculas">
        <div class="pelicula"> 
        <?php
        if ($conexion) {
            // Obtener el ID de la película desde la URL
            $id_pelicula = isset($_GET['id_pelicula']) ? intval($_GET['id_pelicula']) : 0;
        
            // Consulta para obtener los detalles de la película seleccionada, incluyendo el tráiler
            $sql = "SELECT peliculas.id_pelicula, peliculas.titulo, peliculas.imagen, peliculas.descripcion, generos.nombre_genero, peliculas.anio, peliculas.trailer
                    FROM peliculas 
                    JOIN generos ON peliculas.id_genero = generos.id_genero 
                    WHERE peliculas.id_pelicula = ?";
            
            $stmt = $conexion->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("i", $id_pelicula);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $pelicula = $resultado->fetch_assoc();
        
                if ($pelicula) {
                    // Mostrar los detalles de la película
                    echo "<img src='" . htmlspecialchars($pelicula['imagen']) . "' class='pelicula' alt='" . htmlspecialchars($pelicula['titulo']) . "'>";
                    echo "<h2>" . htmlspecialchars($pelicula['titulo']) . "</h2>";
                    echo "<p><strong>Descripción:</strong> " . htmlspecialchars($pelicula['descripcion']) . "<br>";
                    echo "<strong>Año:</strong> " . htmlspecialchars($pelicula['anio']) . "<br>";
                    echo "<strong>Género:</strong> " . htmlspecialchars($pelicula['nombre_genero']) . "</p>";
        
                    // Función para convertir la URL al formato embed
                    function obtenerUrlEmbed($url) {
                        if (preg_match('/watch\?v=([^&]+)/', $url, $matches)) {
                            return "https://www.youtube.com/embed/" . $matches[1];
                        }
                        return $url; // Retornar la URL original si no coincide con el formato esperado
                    }
                    
                    // Mostrar el tráiler
                    if (!empty($pelicula['trailer'])) {
                        $url_trailer_embed = obtenerUrlEmbed($pelicula['trailer']);
                        echo "<h3>Tráiler Oficial</h3>";
                        echo "<div class='trailer'>";  // Div para el tráiler
                        echo "<iframe src='" . htmlspecialchars($url_trailer_embed) . "' title='YouTube video player' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>";
                        echo "</div>";
                    }

                    // Botones de like y dislike
                    echo "<h4>¿Te gustó esta película?</h4>";
                    echo "<button id='like-btn' class='like button'><img src='../imagenes/like.png' title='like'><span id='like-contador'>0</span></button>";
                    echo "<button id='dislike-btn' class='dislike button'><img src='../imagenes/dislike.png' title='dislike'><span id='dislike-contador'>0</span></button>";
                } else {
                    echo "<p>No se encontraron detalles de la película.</p>";
                }
                
            } else {
                echo "Error en la consulta: " . $conexion->error;
            }
            
            // Cerrar la conexión
            desconectar($conexion);
        } else {
            echo "Error al conectar a la base de datos.";
        }
        ?>
        </div>
        <div id="notificacion" class="notificacion">
            <p id="mensaje-notificacion"></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>
</html>
