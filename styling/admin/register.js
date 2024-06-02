document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(' /db/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = '/admin/login.php';
        } else {
            document.getElementById('error').textContent = result.error;
        }
    } catch (error) {
        document.getElementById('error').textContent = 'Error de conexión con el servidor.';
    }
});