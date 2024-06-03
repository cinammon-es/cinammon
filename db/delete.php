<?php
header('Content-Type: application/json');
session_start(); // Asegurarse de que la sesión está iniciada

// Configuración de la base de datos
include '../db/connection.php';

/**
 * Clase user para la gestión de usuarios.
 */
class User { 
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteAccountByUsername($username) {
        // Escapar datos para evitar SQL Injection
        $username = mysqli_real_escape_string($this->conn, $username); // https://www.php.net/manual/es/mysqli.real-escape-string.php

        $sql = "DELETE FROM users WHERE username='$username'";

        if ($this->conn->query($sql) === TRUE) {
            return ['success' => true, 'message' => 'Cuenta eliminada correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar la cuenta: ' . $this->conn->error];
        }
    }
}

/**
 * Elimina la cuenta de un usuario.
 *
 * @param string $username El nombre de usuario.
 * @return array Un array con el resultado de la operación.
 */
global $conn;
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $response = $user->deleteAccountByUsername($username);

        if ($response['success']) {
            // Cerrar sesión después de eliminar la cuenta
            session_destroy();
        }

        echo json_encode($response);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la solicitud']);
}
?>
