<?php
header('Content-Type: application/json');
session_start();

// Configuración de la base de datos
include '../db/connection.php';

class Auth 
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function authenticate($username, $password)
    {
        $password = mysqli_real_escape_string($this->conn, $password);

        // Consultar la base de datos
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return ['success' => true, 'user' => $user];
            } else {
                return ['success' => false, 'message' => 'Contraseña incorrecta'];
            }
        } else {
            return ['success' => false, 'message' => 'Nombre de usuario no encontrado'];
        }
    }

    public function setSession($user)
    {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
    }
}

// Instanciar la conexión existente
global $conn;
$auth = new Auth($conn);

// Obtener los datos del formulario

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'No exite ningun dato']);
    exit;
} else {  
    echo json_encode(['success' => true, 'message' => 'Datos encontrados']);
}

// Autenticar al usuario
$response = $auth->authenticate($username, $password);

if ($response['success']) {
    $auth->setSession($response['user']);
    echo json_encode(['success' => true, 'message' => 'Autenticación exitosa']);
} else {
    echo json_encode(['success' => false, 'message' => $response['message']]);
}
