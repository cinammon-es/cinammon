<?php
header('Content-Type: application/json');

// Configuración de la base de datos
include 'connection.php';
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

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
            echo json_encode(['success' => true, 'message' => 'Cuenta eliminada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la cuenta']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conn->close();
?>
