
// Selecciona todos los elementos con la clase 'toggle'
var toggles = document.querySelectorAll('.toggle');

// Añade un evento 'click' a cada pregunta
toggles.forEach(function (toggle) {
    toggle.addEventListener('click', function () {
        var respuesta = this.nextElementSibling;

        // Verifica si la respuesta está visible y alterna su visibilidad
        if (respuesta.style.display === 'block') {
            respuesta.style.display = 'none';
        } else {
            respuesta.style.display = 'block';
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío tradicional

        // Recoge los datos del formulario
        var formData = new FormData(form);

        // Enviar los datos a sugerir_pelicula.php usando fetch
        fetch('paginas/sugerir_pelicula.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Obtiene la respuesta del servidor
        .then(data => {
            alert("Formulario enviado exitosamente."); // Muestra mensaje de éxito
            console.log(data); // Muestra la respuesta en consola si es necesario
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Hubo un error al enviar el formulario.");
        });
    });
});
