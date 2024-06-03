<?php
require '../db/connection.php';

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function userExists($username) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    public function register($username, $email, $password) {
        if ($this->userExists($username)) {
            return ['success' => false, 'error' => 'El usuario ya existe.'];
        }

        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);

        return ['success' => true];
    }
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data
['username']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos.']);
    exit;
} else {
    $data['username'] = htmlspecialchars($data['username']);
    $data['email'] = htmlspecialchars($data['email']);
    $data['password'] = htmlspecialchars($data['password']);

}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$response = $user->register($data['username'], $data['email'], $data['password']);
echo json_encode($response);
?>

