<?php
header('Content-Type: application/json');
session_start(); // Asegurarse de que la sesión está iniciada

// Configuración de la base de datos
include '../db/connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "cinammon_db";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    if ($id && $username && $email && $password) {
        $sql = "UPDATE users SET username=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Perfil actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }

        $stmt->close();
    } else {
        // Redirigir a la página de registro si el usuario no está autenticado
        header('Location: /admin/register.php');
        exit(); // Asegurar que el script se detenga después de la redirección
    }
}

$conn->close();
?>
