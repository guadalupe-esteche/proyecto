<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener todas las películas
$sql = "SELECT peliculas.titulo, peliculas.descripcion, generos.nombre_genero 
        FROM peliculas 
        JOIN generos ON peliculas.id_genero = generos.id_genero";

$stmt = $conexion->prepare($sql);
$stmt->execute();

// Mostrar los resultados
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <header class="header-explorar">
        <h1>Explorar películas</h1>
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
        <h1>¿Qué sección deseas explorar?</h1>
        <input type="text" id="buscar" placeholder="Buscar películas..." onkeyup="filtrarPeliculas()"
            onkeydown="detenerEnter(event)">
        <p id="mensaje-no-encontrado">No se encontró ninguna película con ese nombre</p>
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

        <h2>Películas de Acción</h2>
        <section id="accion">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'accion')">&lt;</button>
            <a href="detalles.html">
                <div class="pelicula">
                    <h3>Alerta Roja</h3>
                    <img src="../imagenes/alertaroja.jpg" alt="Alerta roja" class="pelicula-img">
                </div>
            </a>

            <div class="pelicula">
                <h3>Escuadrón 6</h3>
                <img src="../imagenes/escuadron6.jpg" alt="Escuadron 6" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Rápidos y furiosos:<br> Hobbs & Shaw</h3>
                <img src="../imagenes/rapidosyfuriosos.webp" alt="Rapidos y furiosos: Hobbs & Shaw"
                    class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'accion')">&gt;</button>
        </section>

        <h2>Películas de Drama</h2>
        <section id="drama">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'drama')">&lt;</button>
            <div class="pelicula">
                <h3>La sociedad de la Nieve</h3>
                <img src="../imagenes/lasociedad.jpg" alt="La sociedad de la Nieve" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Fractura</h3>
                <img src="../imagenes/fractura.jpg" alt="Fractura" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>El niño que domó el viento</h3>
                <img src="../imagenes/elniño.webp" alt="El niño que domó el viento" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'drama')">&gt;</button>
        </section>

        <h2>Películas de Comedia</h2>
        <section id="comedia">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'comedia')">&lt;</button>
            <div class="pelicula">
                <h3>Son como niños</h3>
                <img src="../imagenes/soncn.jpg" alt="Son como niños" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Jumanji: en la selva</h3>
                <img src="../imagenes/jumanji.jpg" alt="Jumanji" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Una esposa de mentira </h3>
                <img src="../imagenes/unaesposa.webp" alt="Una esposa de mentira" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'comedia')">&gt;</button>
        </section>

        <h2>Películas de Ciencia Ficción</h2>
        <section id="cienciaficcion">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'cienciaficcion')">&lt;</button>
            <div class="pelicula">
                <h3>Godzilla vs Kong:<br> el nuevo imperio</h3>
                <img src="../imagenes/godzillakong.png" alt="Godzilla vs Kong" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Indiana Jones y el reino de <br>la cavalera de
                    cristal</h3>
                <img src="../imagenes/indianajones.jpg" alt="Indiana Jones y el reino de la cavalera de cristal"
                    class="pelicula-img">
            </div>
            <div class="pelicula">
                <h3>Amor y monstruos</h3>
                <img src="../imagenes/amorymonstruos.jpg" alt="Amor y monstruos" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'cienciaficcion')">&gt;</button>
        </section>

        <h2>Películas de Terror</h2>
        <section id="terror">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'terror')">&lt;</button>
            <div class="pelicula">
                <h3>SAW</h3>
                <img src="../imagenes/saw.jpg" alt="SAW" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>La noche del demonio:<br> la última llave</h3>
                <img src="../imagenes/demonio.jpg" alt="La noche del demonio" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Fragmentado</h3>
                <img src="../imagenes/fragmentado.jpeg" alt="Fragmentado" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'terror')">&gt;</button>
        </section>

        <h2>Películas de Romance</h2>
        <section id="romance">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'romance')">&lt;</button>
            <div class="pelicula">
                <h3>Yo antes de ti</h3>
                <img src="../imagenes/yoantesdeti.webp" alt="Yo antes de ti" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Love Rosie</h3>
                <img src="../imagenes/loverosie.jpg" alt="Love Rosie" class="pelicula-img">
            </div>

            <div class="pelicula">
                <h3>Titanic</h3>
                <img src="../imagenes/titanic.webp" alt="Titanic" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'romance')">&gt;</button>
        </section>

        <h2>Películas Basadas en Libros</h2>
        <section id="basadasenlibros">
            <button class="nav-btn izq" onclick="deslizarSeccion('izquierda', 'basadasenlibros')">&lt;</button>
            <div class="pelicula">
                <h3>Las crónicas de Narnia</h3>
                <img src="../imagenes/narnia.jpeg" alt="Las cronicas de Narnia" class="pelicula-img">
            </div>
            <div class="pelicula">
                <h3>Ciudades de Papel</h3>
                <img src="../imagenes/ciudadesdepapel.jpg" alt="Ciudades de Papel" class="pelicula-img">
            </div>
            <div class="pelicula">
                <h3>El niño con el piyama a rayas</h3>
                <img src="../imagenes/elniñorayas.jpg" alt="El niño con el piyama a rayas" class="pelicula-img">
            </div>
            <button class="nav-btn der" onclick="deslizarSeccion('derecha', 'basadasenlibros')">&gt;</button>
        </section>

    </main>
    <footer>
        <p>&copy; 2024 Mi Blog de Películas</p>
    </footer>
</body>

</html>