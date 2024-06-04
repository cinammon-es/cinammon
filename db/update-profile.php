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
/**
 * Actualizar el perfil de un usuario
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    /**
     * Verificar que los datos no estén vacíos
     */
    if ($id && $username && $email && $password) {
        $sql = "UPDATE users SET username=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Perfil actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil']);
        }
        /**
         * Cerrar la sentencia
         */
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql);
        /**
         * Verificar si el usuario existe
         */
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
        /**
         * Cerrar la conexión  con la base de datos
         */
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    }
}
/**
* Cerrar la conexión
*/
$conn->close();
?>