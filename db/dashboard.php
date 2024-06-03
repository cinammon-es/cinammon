<?php
/**
 * Configura el tipo de contenido de la respuesta a JSON.
 */
header('Content-Type: application/json');

/**
 * Inicia una nueva sesión o reanuda la existente.
 */
session_start();

/**
 * Incluye el archivo de configuración de la base de datos.
 */
include '../db/connection.php';

/**
 * Clase Auth
 * Maneja la autenticación de usuarios.
 */
class Auth 
{
    /**
     * @var mysqli $conn La conexión a la base de datos.
     */
    private $conn;

    /**
     * Constructor
     * Inicializa la conexión a la base de datos.
     *
     * @param mysqli $db La conexión a la base de datos.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Autentica a un usuario con su nombre de usuario y contraseña.
     *
     * @param string $username El nombre de usuario.
     * @param string $password La contraseña del usuario.
     * @return array Un array con el resultado de la autenticación.
     */
    public function authenticate($username, $password)
    {
        $password = mysqli_real_escape_string($this->conn, $password);

        // Conslto a la base de datos para obtener el usuario
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

    /**
     *  Establezo la sesión del usuario.
     *
     * @param array $user Un array con la información del usuario.
     * @return void
     */
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
    echo json_encode(['success' => false, 'message' => 'No existe ningún dato']);
    exit;
} else {
    echo json_encode(['success' => true, 'message' => 'Datos encontrados']);
}

// Autenticar al usuario
$username = $data['username'];
$password = $data['password'];
$response = $auth->authenticate($username, $password);

if ($response['success']) {
    $auth->setSession($response['user']);
    echo json_encode(['success' => true, 'message' => 'Autenticación exitosa']);
} else {
    echo json_encode(['success' => false, 'message' => $response['message']]);
}
?>
