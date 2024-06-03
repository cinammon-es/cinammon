document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    const errorElement = document.getElementById('error');

    if (!form || !errorElement) {
        console.error('No se encontraron los elementos del formulario o de error.');
        return;
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const username = document.getElementById('username');
        const password = document.getElementById('password');

        if (!username || !password) {
            console.error('No se encontraron los campos de formulario necesarios.');
            errorElement.textContent = 'No se encontraron los campos de formulario necesarios.';
            return;
        }

        const formData = {
            username: username.value,
            password: password.value
        };

        fetch('../db/login.php', {
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
                window.location.href = '../admin/dashboard.php'; // Redirige a la página de administración
            } else {
                errorElement.textContent = data.message || 'Error desconocido.';
            }
        })
        .catch((error) => {
            console.error('Hubo un problema con la operación fetch:', error);
            errorElement.textContent = 'Error al iniciar sesión. Verifica la respuesta del servidor.';
        });
    });
});
