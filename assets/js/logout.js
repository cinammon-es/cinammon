/**
 * Añade un evento al botón de cierre de sesión.
 */
document.getElementById('logoutButton').addEventListener('click', async function() {
    try {
        /**
         * Envía una solicitud POST al servidor para cerrar la sesión del usuario.
         * 
         * @returns {Promise} Una promesa que se resuelve con la respuesta del servidor.
         */
        const response = await fetch('/db/logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();

        // Verifica si la respuesta del servidor indica éxito
        if (result.success) {
            // Redirige a la página de inicio de sesión
            window.location.href = '/admin/login.php';
        } else {
            // Muestra un mensaje de error si no se pudo cerrar sesión
            alert('Error al cerrar sesión: ' + result.message);
        }
    } catch (error) {
        // Muestra un mensaje de error si hay un problema de conexión
        alert('Error de conexión con el servidor.');
    }
});