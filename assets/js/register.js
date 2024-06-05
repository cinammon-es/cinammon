document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const errorElement = document.getElementById('error');
    const successElement = document.getElementById('success');

    // Verifica si los elementos del formulario y de mensajes existen
    if (!form || !errorElement || !successElement) {
        console.error('No se encontraron los elementos del formulario o de mensajes.');
        return;
    }

    /**
     * Evento que se ejecuta cuando se envía el formulario.
     * 
     * @param {Event} event El evento de envío del formulario.
     */
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        // Verifica si los campos necesarios existen
        if (!username || !email || !password || !confirmPassword) {
            console.error('No se encontraron los campos de formulario necesarios.');
            errorElement.textContent = 'No se encontraron los campos de formulario necesarios.';
            return;
        }

        // Validar contraseñas
        if (password.value !== confirmPassword.value) {
            errorElement.textContent = 'Las contraseñas no coinciden.';
            return;
        }

        const formData = {
            username: username.value.trim(),
            email: email.value.trim(),
            password: password.value.trim()
        };

        // Validar el formato del correo electrónico
        if (!validateEmail(formData.email)) {
            errorElement.textContent = 'El formato del correo electrónico no es válido.';
            return;
        }

        /**
         * Envía una solicitud POST al servidor para registrar al usuario.
         * 
         * @param {string} url La URL a la que se envía la solicitud.
         * @param {Object} options Las opciones de la solicitud fetch.
         * @returns {Promise} Una promesa que se resuelve con la respuesta del servidor.
         */
        fetch('../db/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                successElement.textContent = 'Registro exitoso. Redirigiendo...';
                setTimeout(() => {
                    window.location.href = '/admin/login.php'; // Redirige a la página de inicio de sesión
                }, 2000);
            } else {
                errorElement.textContent = data.error || 'Error desconocido.';
            }
        })
        .catch((error) => {
            console.error('Hubo un problema con la operación fetch:', error);
            errorElement.textContent = 'Error al registrar el usuario. Verifica la respuesta del servidor.';
        });
    });

    /**
     * Valida el formato de un correo electrónico.
     * 
     * @param {string} email El correo electrónico a validar.
     * @returns {boolean} Devuelve true si el formato es válido, false en caso contrario.
     */
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});