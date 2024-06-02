document.getElementById('logoutButton').addEventListener('click', async function() {
    try {
        const response = await fetch(' /db/logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = '/admin/login.php';
        } else {
            alert('Error al cerrar sesión: ' + result.message);
        }
    } catch (error) {
        alert('Error de conexión con el servidor.');
    }
});