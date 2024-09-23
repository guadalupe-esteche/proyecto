function filtrarPeliculas() {
    let input = document.getElementById('buscar').value.toLowerCase();
    let peliculas = document.querySelectorAll('.pelicula h3');
    let secciones = document.querySelectorAll('main > section');
    let hayPeliculasVisibles = false;

    // Oculta todas las películas y secciones al inicio
    secciones.forEach(seccion => {
        seccion.style.display = 'none';
    });

    peliculas.forEach(pelicula => {
        let titulo = pelicula.innerText.toLowerCase();
        let seccion = pelicula.closest('section');

        if (titulo.includes(input)) {
            // Mostrar la película y su sección
            pelicula.parentElement.style.display = ''; // Muestra la película
            seccion.style.display = ''; // Muestra la sección a la que pertenece
            hayPeliculasVisibles = true;
        } else {
            // Oculta la película si no coincide
            pelicula.parentElement.style.display = 'none';
        }
    });

    // Muestra la tabla de géneros si no hay películas visibles
    let tablaGeneros = document.querySelector('.tabla-generos');
    if (hayPeliculasVisibles) {
        tablaGeneros.style.display = 'none'; // Oculta la tabla si hay coincidencias
    } else {
        tablaGeneros.style.display = ''; // Muestra la tabla si no hay coincidencias
    }
}

function detenerEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Evita que se ejecute el comportamiento predeterminado al presionar Enter
    }
}

function deslizarSeccion(direccion, seccionId) {
    const seccion = document.getElementById(seccionId);
    const desplazamiento = seccion.clientWidth / 2; // Ajusta la cantidad de desplazamiento si es necesario
    if (direccion === 'izquierda') {
        seccion.scrollLeft -= desplazamiento;
        console.log(`Desplazado a la izquierda: ${seccion.scrollLeft}`)
    } else {
        seccion.scrollLeft += desplazamiento;
    }
}

// Lógica para ocultar películas en función del tamaño de la ventana
function ajustarPeliculas() {
    const secciones = document.querySelectorAll('main > section');
    secciones.forEach(seccion => {
        const peliculas = seccion.querySelectorAll('.pelicula');
        if (window.innerWidth <= 768) { // Cambia el límite de ancho según sea necesario
            peliculas.forEach((pelicula, index) => {
                pelicula.style.display = index === 0 ? 'block' : 'none'; // Muestra solo la primera película
            });
        } else {
            peliculas.forEach(pelicula => {
                pelicula.style.display = 'block'; // Muestra todas las películas
            });
        }
    });
}

// Ajustar películas al cargar y al redimensionar la ventana
window.onload = ajustarPeliculas;
window.onresize = ajustarPeliculas;