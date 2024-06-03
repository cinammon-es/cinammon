<?php
session_start();

// Configuración de la base de datos
include '../db/connection.php';

class SessionManager {
    public function destroySession() {
        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, también se debe destruir la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión
        session_destroy();
    }
}

// Crear una instancia del manejador de sesiones
$sessionManager = new SessionManager();
$sessionManager->destroySession();

// Redirigir al usuario a la página de login
header('Location: /admin/login.php');
exit;

$conn = null; // Cerrar la conexión si es necesario
?>
