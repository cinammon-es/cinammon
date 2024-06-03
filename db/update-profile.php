<?php
header('Content-Type: application/json');

// Configuración de la base de datos
include  '../db/connection.php'; 

$servername = "localhost";
$username = "root";
$password = "";
$datbase = "cinammon_db";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $datbase);
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
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}

$conn->close();
?>