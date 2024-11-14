<?php
session_start();
include '../conexion/conexion.php'; // Conectar a la base de datos

// Verificar que el formulario se haya enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $anio = $_POST['anio'];
    $trailer = $_POST['trailer'];

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_tmp = $imagen['tmp_name']; // Ruta temporal del archivo subido
        $imagen_tipo = mime_content_type($imagen_tmp); // Obtener el tipo MIME del archivo subido
        
        echo "Nombre de la imagen: " . $imagen_nombre;  // Verifica si el nombre es correcto

        // Validar tipo de archivo (solo imágenes)
        $extensiones_validas = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imagen_tipo, $extensiones_validas)) {
            // Subir la imagen al directorio adecuado
            $directorio_imagenes = '../imagenes/';
            $ruta_imagen = $directorio_imagenes . basename($imagen_nombre);
            

            // Mover la imagen desde el archivo temporal a la carpeta de imágenes
            if (move_uploaded_file($imagen_tmp, $ruta_imagen)) {
                echo "La imagen se ha movido correctamente a: " . $ruta_imagen . "<br>";
               
                // Conectar a la base de datos
                $conexion = conectar();

                if ($conexion) {
                    // Preparar la consulta para insertar la película
                    
                    $sql = "INSERT INTO peliculas (titulo, descripcion, imagen, id_genero, anio, trailer) 
                            VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("sssisi", $titulo, $descripcion, $ruta_imagen, $genero, $anio, $trailer);

                    // Ejecutar la consulta
                    if ($stmt->execute()) {
                        header("Location: cargar_pelicula.php?mensaje=exito");
                        exit;
                    } else {
                        echo "Error al cargar la película. Intenta nuevamente.";
                    }

                    // Cerrar la conexión
                    $stmt->close();
                    $conexion->close();
                } else {
                    echo "Error al conectar a la base de datos.";
                }
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            echo "Tipo de archivo no válido. Solo se permiten imágenes.";
        }
    } else {
        echo "Debes subir una imagen.";
    }
}
?>
