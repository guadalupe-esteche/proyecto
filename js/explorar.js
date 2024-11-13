function filtrarPeliculas() {
    let input = document.getElementById('buscar').value.toLowerCase();
    let peliculas = document.querySelectorAll('.pelicula h3');
    let secciones = document.querySelectorAll('main > section');
    let mensajeNoEncontrado = document.getElementById('mensaje-no-encontrado');
    let hayPeliculasVisibles = false;

    // Ocultar todas las secciones y películas inicialmente
    secciones.forEach(seccion => {
        seccion.style.display = 'none';  // Ocultar todas las secciones
        seccion.querySelectorAll('.pelicula').forEach(pelicula => pelicula.style.display = 'none'); // Ocultar todas las películas
    });

    // Recorrer todas las películas y mostrar las que coincidan con el input
    peliculas.forEach(pelicula => {
        let titulo = pelicula.innerText.toLowerCase();
        let seccion = pelicula.closest('section');  // Encontrar la sección que contiene esta película

        if (titulo.includes(input)) {
            // Mostrar la película coincidente
            pelicula.parentElement.style.display = 'block';  // O 'flex', dependiendo de tu layout
            // Mostrar la sección del género
            seccion.style.display = 'block';  // Asegúrate de mostrar la sección
            hayPeliculasVisibles = true;
        }
    });

    // Mostrar u ocultar el mensaje de "No encontrado" según corresponda
    mensajeNoEncontrado.style.display = hayPeliculasVisibles ? 'none' : 'block';

    // Si existe una tabla de géneros, ocultarla si hay películas visibles
    let tablaGeneros = document.querySelector('.tabla-generos');
    if (tablaGeneros) {
        tablaGeneros.style.display = hayPeliculasVisibles ? 'none' : 'block';
    }
}



function detenerEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Evita que se ejecute el comportamiento predeterminado al presionar Enter
    }
}


function toggleMenu() {
    const menu = document.getElementById("menuLateral");
    const contenido = document.getElementById("contenidoPelicula");

    menu.classList.toggle("abierto");
    contenido.classList.toggle("menu-abierto", menu.classList.contains("abierto"));
}

// Cerrar menú al hacer clic en enlaces
document.querySelectorAll(".tabla-generos a").forEach(link => {
    link.addEventListener("click", () => {
        document.getElementById("menuLateral").classList.remove("abierto");
    });
});


// Cerrar el menú automáticamente al hacer clic en un enlace de género
document.querySelectorAll(".tabla-generos a").forEach(link => {
    link.addEventListener("click", () => {
        const menu = document.getElementById("menuLateral");

        if (menu.classList.contains("abierto")) {
            menu.classList.remove("abierto");
        }
    });
});



// Ajusta las películas visibles según el tamaño de la ventana
function ajustarPeliculas() {
    const secciones = document.querySelectorAll('main > section');
    
    secciones.forEach(seccion => {
        const peliculas = Array.from(seccion.querySelectorAll('.pelicula'));
        const totalPeliculas = peliculas.length;
        let peliculasVisibles = 1; // Por defecto, 1 película visible en pantallas pequeñas

        // Determinar cuántas películas mostrar según el tamaño de la pantalla
        if (window.innerWidth > 1024) {
            peliculasVisibles = totalPeliculas; // Mostrar todas las películas en pantallas grandes
        } else if (window.innerWidth > 768) {
            peliculasVisibles = 2; // Mostrar 2 películas en pantallas medianas
        }

        // Ocultar todas las películas antes de ajustarlas
        peliculas.forEach((pelicula, index) => {
            pelicula.style.display = 'none';
        });

        // Mostrar las primeras películas visibles según el tamaño de la pantalla
        for (let i = 0; i < peliculasVisibles; i++) {
            peliculas[i].style.display = 'block'; // Mostrar las primeras películas visibles
        }
    });
}

// Desliza las películas a la izquierda o derecha
function deslizarSeccion(direccion, seccionId) {
    const seccion = document.getElementById(seccionId);
    const peliculas = Array.from(seccion.querySelectorAll('.pelicula'));
    const totalPeliculas = peliculas.length;
    let peliculasVisibles = 2; // Por defecto, 2 películas visibles en pantallas medianas

    // Determinar cuántas películas mostrar según el tamaño de la pantalla
    if (window.innerWidth > 1024) {
        peliculasVisibles = totalPeliculas; // Mostrar todas las películas en pantallas grandes
    } else if (window.innerWidth > 768) {
        peliculasVisibles = 2; // Mostrar 2 películas en pantallas medianas
    } else {
        peliculasVisibles = 1; // Mostrar 1 película en pantallas pequeñas
    }

    // Obtener el índice de la primera película visible
    let indexVisible = 0;
    for (let i = 0; i < peliculas.length; i++) {
        if (peliculas[i].style.display === 'block') {
            indexVisible = i;
            break;
        }
    }

    // Calcular el nuevo índice de la primera película visible según la dirección
    if (direccion === 'izquierda') {
        // Mover hacia la izquierda
        indexVisible = Math.max(0, indexVisible - peliculasVisibles);
    } else if (direccion === 'derecha') {
        // Mover hacia la derecha
        indexVisible = Math.min(totalPeliculas - peliculasVisibles, indexVisible + peliculasVisibles);
    }

    // Ocultar todas las películas
    peliculas.forEach((pelicula, index) => {
        pelicula.style.display = 'none';
    });

    // Mostrar las películas nuevas según el índice calculado
    for (let i = indexVisible; i < indexVisible + peliculasVisibles && i < totalPeliculas; i++) {
        peliculas[i].style.display = 'block';
    }
}

// Llamar a `ajustarPeliculas` en la carga de la página y redimensionar la ventana
window.onload = function() {
    ajustarPeliculas(); // Llamamos a la función cuando la página se carga
};

window.onresize = function() {
    ajustarPeliculas(); // Llamamos a la función cada vez que la ventana cambia de tamaño
};
