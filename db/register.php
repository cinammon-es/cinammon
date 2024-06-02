<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "cinammon_db";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $input = json_decode(file_get_contents('php://input'), true);

        if ($input === null) {
            throw new Exception('JSON no válido.');
        }

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $inputUsername = $input['username'];
        $inputEmail = $input['email'];
        $inputPassword = $input['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':email', $inputEmail);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'error' => 'El nombre de usuario o el correo electrónico ya están en uso.']);
        } else {
            $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $inputUsername);
            $stmt->bindParam(':email', $inputEmail);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            $_SESSION['username'] = $inputUsername;
            $_SESSION['email'] = $inputEmail;

            echo json_encode(['success' => true]);
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            echo json_encode(['success' => false, 'error' => 'El nombre de usuario o el correo electrónico ya están en uso.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    } catch (Exception $e) {
        if ($e->getMessage() === 'JSON no válido.') {
            echo json_encode(['success' => false, 'error' => 'No se ha proporcionado un JSON válido.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    }

    $conn = null;
} else {
    if (isset($_SESSION['username'])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se ha iniciado sesión.']);
    }
}
?>
