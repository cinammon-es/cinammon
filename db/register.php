<?php
require '../db/connection.php';

/**
 * Clase para la gestión de usuarios.
 */
class User {
    /**
     * @var PDO La instancia de conexión a la base de datos.
     */
    private $db;

    /**
     * Constructor de la clase User.
     *
     * @param PDO $db La instancia de conexión a la base de datos.
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Verifica si un usuario existe en la base de datos.
     *
     * @param string $username El nombre de usuario a verificar.
     * @return bool Devuelve true si el usuario existe, false en caso contrario.
     */
    public function userExists($username) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param string $username El nombre de usuario.
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return array Un array con la clave 'success' indicando si la operación fue exitosa y 'error' si hubo un problema.
     */
    public function register($username, $email, $password) {
        if ($this->userExists($username)) {
            return ['success' => false, 'error' => 'El usuario ya existe.'];
        }
        
        /**
         * @var PDOStatement $stmt Sentencia preparada para insertar un nuevo usuario en la base de datos. https://www.php.net/manual/en/class.pdostatement.php 
         */
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        /**
         * @var array $response Respuesta de la operación.
         */
        return ['success' => true];
    }
}

header('Content-Type: application/json');

// Obtener datos de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos son completos
if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos.']);
    exit;
}

// Limpiar los datos de entrada
$data['username'] = htmlspecialchars($data['username']);
$data['email'] = htmlspecialchars($data['email']);
$data['password'] = htmlspecialchars($data['password']);

// Crear instancia de la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia de la clase User
$user = new User($db);

// Registrar el nuevo usuario
$response = $user->register($data['username'], $data['email'], $data['password']);
echo json_encode($response);
?>
