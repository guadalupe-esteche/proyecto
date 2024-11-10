// contadores de like y dislike
let likeContador = 0;
let dislikeContador = 0;

// Seleccionamos los botones y los contadores de la página
const likeButton = document.getElementById('like-btn');
const dislikeButton = document.getElementById('dislike-btn');
const likeContadorDisplay = document.getElementById('like-contador');
const dislikeContadorDisplay = document.getElementById('dislike-contador');
const idUsuario = 1; // Aquí asigna el ID del usuario que esté autenticado
const idPelicula = new URLSearchParams(window.location.search).get("id_pelicula");

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

function reaccionar(reaccion) {
    fetch("../php/reaccionar.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `id_usuario=${idUsuario}&id_pelicula=${idPelicula}&like_dislike=${reaccion}`,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "inserted") {
            document.getElementById("mensaje-notificacion").textContent = `Has dado ${data.reaction === "like" ? "like" : "dislike"} a la película.`;
        } else if (data.status === "deleted") {
            document.getElementById("mensaje-notificacion").textContent = `Reacción eliminada.`;
        }
        document.getElementById("notificacion").style.display = "block";
        setTimeout(() => {
            document.getElementById("notificacion").style.display = "none";
        }, 2000);
    })
    .catch(error => console.error("Error:", error));
}

likeBtn.addEventListener("click", () => reaccionar("like"));
dislikeBtn.addEventListener("click", () => reaccionar("dislike"));
