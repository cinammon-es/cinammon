<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../db/connection.php');

header('Content-Type: application/json');

class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        try {
            $query = $this->conn->prepare("SELECT * FROM users WHERE email = :email OR username = :email LIMIT 1");
            $query->bindParam(':email', $email);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];

                return ['success' => true, 'message' => 'Inicio de sesión exitoso.'];
            } else { 
                return ['success' => false, 'message' => $user ? 'La contraseña es incorrecta.' : 'El usuario no existe.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error al iniciar sesión: ' . $e->getMessage()];
        }
    }
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Datos de entrada no válidos.']);
    exit;
}

$email = htmlspecialchars($data['username']);
$password = htmlspecialchars($data['password']);

$database = new Database();
$conn = $database->getConnection();
$auth = new Auth($conn);
$response = $auth->login($email, $password);
echo json_encode($response);
?>
