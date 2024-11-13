<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Película</title>
    <link rel="stylesheet" href="../estilos/estiloCargar.css">
    <script>
        // Verificar si la URL contiene el parámetro 'mensaje=exito'
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('mensaje') && urlParams.get('mensaje') === 'exito') {
                alert("¡La película ha sido cargada exitosamente!");
            }
        }
    </script>
</head>
<body>
    <nav>
        <a href="../index.php">Luz, Cámara, Blog</a>
        <a href="explorar.php">Explorar</a>
    </nav>

    <h1>Cargar nueva película</h1>

    <!-- Formulario para cargar película -->
    <form action="procesar_carga.php" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="genero">Género:</label>
        <select id="genero" name="genero" required>
            <?php
            // Conectar a la base de datos para obtener los géneros
            include '../conexion/conexion.php';
            $conexion = conectar();
            if ($conexion) {
                $sql_generos = "SELECT id_genero, nombre_genero FROM generos";
                $resultado = $conexion->query($sql_generos);
                while ($genero = $resultado->fetch_assoc()) {
                    echo "<option value='" . $genero['id_genero'] . "'>" . $genero['nombre_genero'] . "</option>";
                }
            }
            ?>
        </select>

        <label for="anio">Año:</label>
        <input type="number" id="anio" name="anio" required>

        <label for="trailer">Enlace del Trailer:</label>
        <input type="url" id="trailer" name="trailer" required>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>

        <button type="submit">Cargar Película</button>
    </form>
</body>
</html>
