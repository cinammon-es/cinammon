<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../db/connection.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Datos de entrada no válidos.']);
    exit;
}

$email = $data['email'];
$password = $data['password'];

try {
    $query = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];

        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
    } else {
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'El correo electrónico no existe.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
        }
    }
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico ya está en uso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al iniciar sesión.']);
    }
}
?>

