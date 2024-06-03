document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const errorElement = document.getElementById('error');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = {
            username: document.getElementById('username').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        };

        fetch('/admin/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/admin/login.php'; // Redirige a la página de inicio de sesión
            } else {
                errorElement.textContent = data.error;
            }
        })
        .catch((error) => {
            errorElement.textContent = 'Error al registrar el usuario.';
        });
    });
});
