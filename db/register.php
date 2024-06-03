<?php 
session_start();

header('Content-Type: application/json');

require_once '../db/connection.php'; 

class User {
    private $conn;
    private $table_name = "users";

    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function userExists() {
        // Construir la consulta SQL
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($query);

        // Vincular los parámetros
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar true si hay filas encontradas, de lo contrario false
        return $stmt->rowCount() > 0;
    }

    public function createUser() {
        // Construir la consulta SQL
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        // Vincular los parámetros
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        // Ejecutar la consulta
        return $stmt->execute();
    }
}

try { 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = json_decode(file_get_contents('php://input'), true);

        if ($input === null) {
            throw new Exception('JSON no válido.');
        }

        $user = new User($db);
        $user->username = htmlspecialchars(strip_tags($input['username']));
        $user->email = htmlspecialchars(strip_tags($input['email']));
        $user->password = htmlspecialchars(strip_tags($input['password']));

        if (empty($user->username) || empty($user->email) || empty($user->password)) {
            echo json_encode(['success' => false, 'error' => 'Todos los campos son obligatorios.']);
            exit();
        }

        if ($user->userExists()) {
            echo json_encode(['success' => false, 'error' => 'El nombre de usuario o el correo electrónico ya están en uso.']);
        } else {
            if ($user->createUser()) {
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al crear el usuario.']);
            }
        }
    } else {
        if (isset($_SESSION['username'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se ha iniciado sesión.']);
        }
    }
} catch (PDOException $e) {
    if ($e->errorInfo[1] === 1062) {
        echo json_encode(['success' => false, 'error' => 'El nombre de usuario o el correo electrónico ya están en uso.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>
