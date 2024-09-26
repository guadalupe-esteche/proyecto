document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('registro-form');

    const showRegisterLink = document.getElementById('show-registro');
    const showLoginLink = document.getElementById('show-login');

    // Mostrar el formulario de registro y ocultar el de inicio de sesión
    showRegisterLink.addEventListener('click', (e) => {
        e.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    // Mostrar el formulario de inicio de sesión y ocultar el de registro
    showLoginLink.addEventListener('click', (e) => {
        e.preventDefault();
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    });
});

document.getElementById('registro-form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-mensaje');

    // Expresión regular para validar al menos 1 número o carácter especial
    const regex = /^(?=.*[0-9!@#$%^&*])/;

    // Verificar si la contraseña tiene al menos 8 caracteres y al menos 1 número o carácter especial
    if (password.length < 8 || !regex.test(password)) {
        // Evitar que se envíe el formulario
        event.preventDefault();
        
        // Mostrar mensaje de error
        errorMessage.style.display = 'block';
    } else {
        // Ocultar mensaje de error si todo está bien
        errorMessage.style.display = 'none';
    }
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
