// contadores de like y dislike
let likeContador = 0;
let dislikeContador = 0;

// Seleccionamos los botones y los contadores de la página
const likeButton = document.getElementById('like-btn');
const dislikeButton = document.getElementById('dislike-btn');
const likeContadorDisplay = document.getElementById('like-contador');
const dislikeContadorDisplay = document.getElementById('dislike-contador');

// Añadimos un evento 'click' al botón de Like
likeButton.addEventListener('click', () => {
    if (likeButton.classList.contains('liked')) {
        // Si ya está en "like", revertimos el "like"
        likeButton.classList.remove('liked');
        likeContador--;
    } else {
        // Si se da "like", se incrementa el contador
        likeButton.classList.add('liked');
        likeContador++;
        // Si se había hecho "dislike", lo quitamos
        if (dislikeButton.classList.contains('disliked')) {
            dislikeButton.classList.remove('disliked');
            dislikeContador--;
        }
    }
    // Actualizamos la visualización del contador
    updateCounts();
    mostrarNotificacion('¡Te ha gustado esta pelicula!')
});

// Añadimos un evento 'click' al botón de Dislike
dislikeButton.addEventListener('click', () => {
    if (dislikeButton.classList.contains('disliked')) {
        // Si ya está en "dislike", revertimos el "dislike"
        dislikeButton.classList.remove('disliked');
        dislikeContador--;
    } else {
        // Si se da "dislike", se incrementa el contador
        dislikeButton.classList.add('disliked');
        dislikeContador++;
        // Si se había hecho "like", lo quitamos
        if (likeButton.classList.contains('liked')) {
            likeButton.classList.remove('liked');
            likeContador--;
        }
    }
    // Actualizamos la visualización del contador
    updateCounts();
    mostrarNotificacion('No te ha gustado esta pelicula')
});

// Función para actualizar los contadores en la página
function updateCounts() {
    likeContadorDisplay.textContent = likeContador;
    dislikeContadorDisplay.textContent = dislikeContador;
}

// Función para mostrar la notificación emergente
function mostrarNotificacion(mensaje) {
    const notificacion = document.getElementById('notificacion');
    const mensajeNotificacion = document.getElementById('mensaje-notificacion');

    // Establecer el mensaje de la notificación
    mensajeNotificacion.textContent = mensaje;

    // Mostrar la notificación
    notificacion.style.display = 'block';
    notificacion.classList.remove('ocultar');

    // Ocultar la notificación después de 3 segundos
    setTimeout(() => {
        notificacion.classList.add('ocultar');

        // Después de 500ms (tiempo de la transición), ocultamos completamente el elemento
        notificacion.addEventListener('transitionend', () => {
            notificacion.style.display = 'none';
        }, { once: true });  // Asegura que solo se ejecute una vez
    }, 3000);  // Tiempo visible de la notificación (3 segundos)
}
