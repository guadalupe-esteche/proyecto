function filtrarPeliculas() {
    let input = document.getElementById('buscar').value.toLowerCase();
    let peliculas = document.querySelectorAll('.pelicula h3');
    let secciones = document.querySelectorAll('main > section');
    let mensajeNoEncontrado = document.getElementById('mensaje-no-encontrado');
    let hayPeliculasVisibles = false;

    // Ocultar todas las películas y secciones al inicio
    peliculas.forEach(pelicula => {
        pelicula.parentElement.style.display = 'none'; // Oculta las películas
    });
    secciones.forEach(seccion => {
        seccion.style.display = 'none'; // Oculta las secciones
    });

    peliculas.forEach(pelicula => {
        let titulo = pelicula.innerText.toLowerCase();
        let seccion = pelicula.closest('section');

        if (titulo.includes(input)) {
            pelicula.parentElement.style.display = ''; // Mostrar la película
            seccion.style.display = ''; // Mostrar la sección del género
            hayPeliculasVisibles = true;
        }
    });

    // Si no se encuentran películas, mostrar todas las secciones y películas
    if (!hayPeliculasVisibles) {
        mensajeNoEncontrado.style.display = 'block'; // Mostrar mensaje
        secciones.forEach(seccion => {
            seccion.style.display = ''; // Mostrar todas las secciones si no hay coincidencias
        });
    } else {
        mensajeNoEncontrado.style.display = 'none'; // Ocultar el mensaje si hay coincidencias
    }

    // Mostrar la tabla de géneros si no se encuentran películas
    let tablaGeneros = document.querySelector('.tabla-generos');
    tablaGeneros.style.display = !hayPeliculasVisibles ? '' : 'none'; // Mostrar tabla si no hay películas
}


function detenerEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Evita que se ejecute el comportamiento predeterminado al presionar Enter
    }
}

function deslizarSeccion(direccion, seccionId) {
    const seccion = document.getElementById(seccionId);
    const peliculas = seccion.querySelectorAll('.pelicula');
    const totalPeliculas = peliculas.length;
    let peliculasVisibles = 1; // Por defecto, mostrar 1 película en pantallas pequeñas

    // Determinar cuántas películas mostrar según el tamaño de la pantalla
    if (window.innerWidth > 768 && window.innerWidth <= 1023) {
        peliculasVisibles = 2; // Mostrar 2 películas en tablets
    } else if (window.innerWidth > 1024) {
        return; // En pantallas grandes, no deslizamos, mostramos todas las películas
    }

    // Obtener el índice de la primera película visible
    let peliculaVisible = Array.from(peliculas).findIndex(pelicula => pelicula.style.display === 'block');

    // Determina las nuevas películas visibles según la dirección
    if (direccion === 'izquierda') {
        peliculaVisible = (peliculaVisible > 0) ? peliculaVisible - peliculasVisibles : 0;
    } else {
        peliculaVisible = (peliculaVisible < totalPeliculas - peliculasVisibles) ? peliculaVisible + peliculasVisibles : totalPeliculas - peliculasVisibles;
    }

    // Ocultar todas las películas y mostrar las visibles
    peliculas.forEach((pelicula, index) => {
        pelicula.style.display = (index >= peliculaVisible && index < peliculaVisible + peliculasVisibles) ? 'block' : 'none';
    });
}

// Ajustar películas al cargar y redimensionar la ventana
function ajustarPeliculas() {
    const secciones = document.querySelectorAll('main > section');
    secciones.forEach(seccion => {
        const peliculas = seccion.querySelectorAll('.pelicula');
        let peliculasVisibles = 1; // Por defecto, mostrar 1 película en pantallas pequeñas

        if (window.innerWidth > 768 && window.innerWidth <= 1024) {
            peliculasVisibles = 2; // Mostrar 2 películas en tablets
        } else if (window.innerWidth > 1024) {
            peliculasVisibles = peliculas.length; // Mostrar todas las películas en pantallas grandes
        }

        // Mostrar las películas iniciales según el tamaño de la pantalla
        peliculas.forEach((pelicula, index) => {
            pelicula.style.display = (index < peliculasVisibles) ? 'block' : 'none';
        });
    });
}

window.onload = ajustarPeliculas;
window.onresize = ajustarPeliculas;
