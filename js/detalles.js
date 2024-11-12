const idPelicula = document.body.dataset.idPelicula;

function enviarVoto(voto) {
    fetch("../votar.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            id_pelicula: idPelicula,
            voto: voto,
        }),
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("like-contador").textContent = data.likes;
            document.getElementById("dislike-contador").textContent = data.dislikes;
            document.getElementById("mensaje-notificacion").textContent = data.mensaje;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}
