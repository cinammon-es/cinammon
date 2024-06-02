<?php
header('Content-Type: application/json');

// Configuración de la base de datos
include '../db/connection.php'; 

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

    if ($id) {
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header('Location: ../admin/users.php');
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la cuenta']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    }
} else { 
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    }
}

$conn->close();
?>
