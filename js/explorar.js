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

    if (window.innerWidth > 768) {
        return; // Si la pantalla es mayor a 768px, no hacer nada
    }

    const seccion = document.getElementById(seccionId);
    const peliculas = seccion.querySelectorAll('.pelicula');
    const totalPeliculas = peliculas.length;
    let peliculaVisible = Array.from(peliculas).findIndex(pelicula => pelicula.style.display === 'block');

    // Determina la nueva película visible
    if (direccion === 'izquierda') {
        peliculaVisible = (peliculaVisible > 0) ? peliculaVisible - 1 : 0;
    } else {
        peliculaVisible = (peliculaVisible < totalPeliculas - 1) ? peliculaVisible + 1 : totalPeliculas - 1;
    }

    // Oculta todas las películas y muestra solo la visible
    peliculas.forEach((pelicula, index) => {
        pelicula.style.display = (index === peliculaVisible) ? 'block' : 'none';
    });
}

// Ajustar películas al cargar y al redimensionar la ventana
function ajustarPeliculas() {
    const secciones = document.querySelectorAll('main > section');
    secciones.forEach(seccion => {
        const peliculas = seccion.querySelectorAll('.pelicula');
        if (window.innerWidth <= 768) {
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

window.onload = ajustarPeliculas;
window.onresize = ajustarPeliculas;
