
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

// Mostrar un mensaje de confirmación del formulario en lugar de recargar la página
document.addEventListener("DOMContentLoaded", function () {
    // Selecciona el formulario
    var form = document.querySelector("form");

    // Evita que el formulario se envíe y muestra un mensaje
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío del formulario
        alert("Formulario enviado exitosamente."); // Muestra un mensaje
    });
});

