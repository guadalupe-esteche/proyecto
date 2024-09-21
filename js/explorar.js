function filtrarPeliculas() {
    let input = document.getElementById('buscar').value.toLowerCase();
    let peliculas = document.querySelectorAll('.pelicula h3');
    let hayPeliculasVisibles = false; // Variable para rastrear si hay películas visibles

    // Oculta todas las secciones de películas
    let secciones = document.querySelectorAll('main > section');
    secciones.forEach(seccion => {
        seccion.style.display = 'none'; // Oculta todas las secciones
    });

    peliculas.forEach(pelicula => {
        let titulo = pelicula.innerText.toLowerCase();
        if (titulo.includes(input)) {
            pelicula.parentElement.style.display = '';  // Muestra la película
            hayPeliculasVisibles = true; // Hay al menos una película visible
        
            // Determina a qué sección pertenece la película y la muestra
            seccionVisible = pelicula.closest('section');
            seccionVisible.style.display = ''; // Muestra la sección correspondiente
        } else {
            pelicula.parentElement.style.display = 'none';  // Oculta la película
        }
    });

    // Muestra u oculta la tabla de géneros según la visibilidad de las películas
    let tablaGeneros = document.querySelector('.tabla-generos');
    if (hayPeliculasVisibles) {
        tablaGeneros.style.display = 'none'; // Oculta la tabla si no hay películas
    } else {
        tablaGeneros.style.display = ''; // Muestra la tabla de géneros
    }
}


