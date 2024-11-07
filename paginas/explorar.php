<?php
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
    <nav>
        <ul class="menu-horizontal">
            <li>
                <a href="../index.php">Inicio</a>
            </li>
            <li>
                <a href="explorar.php">Explorar</a>
            </li>
            <li>
                <a href="contacto.php">Contacto</a>
            </li>
        </ul>
    </nav>
    
    <div class="contenedor-explorar">
        <aside class="menu-lateral">
        <table class="tabla-generos">
                <thead>
                    <tr>
                        <th>Género</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#accion">
                                <img src="../imagenes/accion.png" alt="accion">Acción
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#drama">
                                <img src="../imagenes/drama.png" alt="drama">Drama
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#comedia">
                                <img src="../imagenes/comedia.png" alt="comedia">Comedia
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#cienciaficcion">
                                <img src="../imagenes/fantasia.png" alt="cienciaficcion">Ciencia
                                Ficción
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#terror">
                                <img src="../imagenes/terror.png" alt="terror">Terror
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#romance">
                                <img src="../imagenes/romance.png" alt="romance">Romance
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#basadasenlibros">
                                <img src="../imagenes/libros.png" alt="basadas en libros">Basadas en
                                libros
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </aside>
        <main class="pagina-peliculas">
            <h1>¿Qué sección deseas explorar?</h1>
            <input type="text" id="buscar" placeholder="Buscar películas..." onkeyup="filtrarPeliculas()"
                onkeydown="detenerEnter(event)">
            <p id="mensaje-no-encontrado">No se encontró ninguna película con ese nombre</p>
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
                    $id_genero = str_replace(' ', '', strtolower(htmlspecialchars($genero['nombre_genero'])));
                    echo "<section id='" . $id_genero . "'>";
                    echo "<button class='nav-btn izq' onclick=\"deslizarSeccion('izquierda', '" . strtolower(htmlspecialchars($genero['nombre_genero'])) . "')\">&lt;</button>";

                    // Consulta para obtener las películas de este género
                    $sql_peliculas = "SELECT id_pelicula, titulo, descripcion, imagen FROM peliculas WHERE id_genero = ?";
                    $stmt_peliculas = $conexion->prepare($sql_peliculas);
                    $stmt_peliculas->bind_param('i', $genero['id_genero']);
                    $stmt_peliculas->execute();
                    $peliculas = $stmt_peliculas->get_result()->fetch_all(MYSQLI_ASSOC);

                    // Mostrar películas
                    foreach ($peliculas as $pelicula) {
                        echo "<div class='pelicula'>";
                        echo "<h3><a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "'>" . htmlspecialchars($pelicula['titulo']) . "</a></h3>";
                        echo "<a href='detalles.php?id_pelicula=" . htmlspecialchars($pelicula['id_pelicula']) . "'><img src='../imagenes/" . htmlspecialchars($pelicula['imagen']) . "' alt='" . htmlspecialchars($pelicula['titulo']) . "' class='pelicula-img'></a>";
                        echo "</div>";
                    }

                    echo "<button class='nav-btn der' onclick=\"deslizarSeccion('derecha', '" . strtolower(htmlspecialchars($genero['nombre_genero'])) . "')\">&gt;</button>";
                    echo "</section>";
                }
            } else {
                echo "Error al conectar a la base de datos.";
            }

            ?>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>

</html>
