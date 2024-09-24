
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