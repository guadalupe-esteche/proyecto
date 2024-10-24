<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Conectar a la base de datos
$conexion = conectar();

if ($conexion) {
    // Obtener el ID de la película desde la URL
    $id_pelicula = isset($_GET['id_pelicula']) ? intval($_GET['id_pelicula']) : 0;

    // Consulta para obtener los detalles de la película seleccionada
    $sql = "SELECT peliculas.id_pelicula, peliculas.titulo, peliculas.imagen, generos.nombre_genero
        FROM peliculas 
        JOIN generos ON peliculas.id_genero = generos.id_genero";
    
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_pelicula);
        $stmt->execute();
        $pelicula = $stmt->get_result()->fetch_assoc();

        if ($pelicula) {
            // Mostrar detalles de la película
            echo "<h1>" . htmlspecialchars($pelicula['titulo']) . "</h1>";
            echo "<p>Género: " . htmlspecialchars($pelicula['nombre_genero']) . "</p>";
            echo "<p>Descripción: " . htmlspecialchars($pelicula['descripcion']) . "</p>";
            // Mostrar la imagen desde la base de datos
            foreach ($peliculas as $pelicula) {
                echo "<h2><a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "'>" . htmlspecialchars($pelicula['titulo']) . "</a></h2>";
                echo "<a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "'><img src='ruta_a_imagenes/" . htmlspecialchars($pelicula['imagen']) . "' alt='" . htmlspecialchars($pelicula['titulo']) . "'></a>";
                echo "<p>Género: " . htmlspecialchars($pelicula['nombre_genero']) . "</p>";
}
        } else {
            echo "<p>Película no encontrada.</p>";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta roja</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link rel="stylesheet" href="../estilos/responsive.css">
    <script src="../js/detalles.js" defer></script>
</head>

<body>
    <header class="header-detalles">
        <h1>Alerta Roja</h1>
    </header>

    <nav>
        <ul class="menu-horizontal">
            <li>
                <a href="../index.html">Inicio</a>
            </li>
            <li>
                <a href="explorar.html">Explorar</a>
            </li>
            <li>
                <a href="contacto.html">Contacto</a>
            </li>
        </ul>
    </nav>
    <main class="pagina-peliculas">
        <div class="pelicula">
            <img src="../imagenes/alertaroja.jpg" class="pelicula" alt="Alerta roja">
            <h2>Alerta Roja</h2>
            <p>Descripción: Un agente de la Interpol trata de dar
                caza a uno de los ladrones de arte más buscados del
                mundo.<br>
                Director: Rawson Marshall Thurber<br>
                Reparto: Dwayne Johnson, Ryan Reynolds, Gal
                Gadot<br>
                Año: 2021<br>
                Género: Acción, Comedia<br>
            </p>
            <h3>Tráiler Oficial</h3>
            <div class="trailer">
                <iframe src="https://www.youtube.com/embed/J3oJKMAHaZU" title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <h4>¿Te gustó esta película?</h4>
            <button id="like-btn" class="like button">
                <img src="../imagenes/like.png" title="like">
                <span id="like-contador">0</span>
            </button>
            <button id="dislike-btn" class="dislike button">
                <img src="../imagenes/dislike.png" title="dislike">
                <span id="dislike-contador">0</span>
            </button>
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