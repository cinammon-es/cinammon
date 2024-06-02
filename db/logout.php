<?php
session_start();

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

// Devolver una respuesta JSON indicando que la sesión ha sido cerrada
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
exit;

$conn = null;
?>
