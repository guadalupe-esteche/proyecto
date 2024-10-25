<?php
// Incluir el archivo de conexión
include 'conexion.php';
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
    <?php
    if ($conexion) {
        // Obtener el ID de la película desde la URL
        $id_pelicula = isset($_GET['id_pelicula']) ? intval($_GET['id_pelicula']) : 0;
    
        // Consulta para obtener los detalles de la película seleccionada
        $sql = "SELECT peliculas.id_pelicula, peliculas.titulo, peliculas.imagen, peliculas.descripcion, generos.nombre_genero, peliculas.anio
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
                echo "<h1>" . htmlspecialchars($pelicula['titulo']) . "</h1>";
                echo "<div class='imagen-container'>"; // Agrega un contenedor para la imagen
                echo "<img src='" . htmlspecialchars($pelicula['imagen']) . "' alt='" . htmlspecialchars($pelicula['titulo']) . "'>";
                echo "</div>"; // Cierra el contenedor
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($pelicula['descripcion']) . "</p>";
                echo "<p><strong>Año:</strong> " . htmlspecialchars($pelicula['anio']) . "</p>";
                echo "<p><strong>Género:</strong> " . htmlspecialchars($pelicula['nombre_genero']) . "</p>";
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
    </main>

    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>
</html>
