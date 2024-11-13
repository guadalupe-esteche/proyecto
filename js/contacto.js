$(document).ready(function() {
    // Alternar entre formularios con deslizamiento
    $("#show-registro").click(function(event) {
        event.preventDefault();  // Prevenir comportamiento predeterminado del enlace
        $("#login-form").slideUp();  // Ocultar formulario de inicio de sesión con deslizamiento
        $("#registro-form").slideDown();  // Mostrar formulario de registro con deslizamiento
    });

    $("#show-login").click(function(event) {
        event.preventDefault();  // Prevenir comportamiento predeterminado del enlace
        $("#registro-form").slideUp();  // Ocultar formulario de registro con deslizamiento
        $("#login-form").slideDown();  // Mostrar formulario de inicio de sesión con deslizamiento
    });

    // Validar el formulario de registro
    $("#registro-form").on("submit", function(event) {
        const password = $("#password").val();
        const regex = /^(?=.*[0-9!@#$%^&*])/;

        // Verificar si la contraseña tiene al menos 8 caracteres y al menos 1 número o carácter especial
        if (password.length < 8 || !regex.test(password)) {
            event.preventDefault();  // Evitar el envío del formulario si no es válido
            $("#error-mensaje").show();  // Mostrar mensaje de error
        } else {
            $("#error-mensaje").hide();  // Ocultar mensaje de error si todo está bien
           
        }
    });
});
