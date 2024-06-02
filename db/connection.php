<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$datbase = "cinammon_db";
try {
    // Crear una conexión
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Configurar el modo de error PDO para excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos
    $sql = "CREATE DATABASE IF NOT EXISTS cinammon_db";
    $conn->exec($sql);

    // Usar la base de datos creada
    $conn->exec("USE cinammon_db");

    // Crear la tabla users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    );";
    $conn->exec($sql);

    // Redirigir a la página de registro
    header("Location: register.php");
    exit;

} catch (PDOException $e) {
    // Mensaje de error
    $errorMessage = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de la Base de Datos</title>
</head>
<body>
<h1>
    <?php 
    if (isset($errorMessage)) {
        echo "Error al crear la base de datos o la tabla: " . htmlspecialchars($errorMessage);
    } else {
        echo "¡La base de datos y la tabla fueron creadas exitosamente!";
    }
    ?>
</h1>
<?php if (!isset($errorMessage)) { ?>
    <p>Redirigiendo a la página de registro...</p>
<?php } ?>
</body>
</html>
