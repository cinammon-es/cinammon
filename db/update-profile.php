<?php
header('Content-Type: application/json');
session_start(); // Asegurarse de que la sesión está iniciada

// Configuración de la base de datos
include '../db/connection.php';

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function updateProfile($id, $username, $email, $password) {
        // Escapar datos para evitar SQL Injection
        $id = mysqli_real_escape_string($this->conn, $id);
        $username = mysqli_real_escape_string($this->conn, $username);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

        // Actualizar el perfil del usuario
        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return ['success' => true, 'message' => 'Perfil actualizado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al actualizar el perfil: ' . $this->conn->error];
        }
    }

    public function getProfile($id) {
        // Escapar datos para evitar SQL Injection
        $id = mysqli_real_escape_string($this->conn, $id);

        // Obtener el perfil del usuario
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return ['success' => true, 'data' => $row];
        } else {
            return ['success' => false, 'message' => 'Usuario no encontrado'];
        }
    }
}

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = isset($data['id']) ? (int)$data['id'] : 0;
    $username = isset($data['username']) ? htmlspecialchars($data['username']) : '';
    $email = isset($data['email']) ? htmlspecialchars($data['email']) : '';
    $password = isset($data['password']) ? password_hash(htmlspecialchars($data['password']), PASSWORD_DEFAULT) : '';

    if ($id && $username && $email && $password) {
        $response = $user->updateProfile($id, $username, $email, $password);
        echo json_encode($response);
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $response = $user->getProfile($id);
        echo json_encode($response);
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
        }
    }
}
?>
