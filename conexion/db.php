<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente

try {
    // Crear una conexión
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Configurar el modo de error PDO para excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear la base de datos
    $sql = "CREATE DATABASE IF NOT EXISTS cinammon_db";
    $conn->exec($sql);
    echo "Base de datos creada exitosamente<br>";

    // Usar la base de datos creada
    $conn->exec("USE cinammon_db");

    // Crear la tabla users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $conn->exec($sql);
    echo "Tabla 'users' creada exitosamente<br>";

    // Mensaje de éxito
    echo "La base de datos y la tabla fueron creadas exitosamente.<br>";
    
    // Redirigir a la página de inicio de sesión
    header("Location: register.php");
    exit;

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <h1>¡La base de datos y la tabla fueron creadas exitosamente!</h1>
    <p>Redirigiendo a la página de registro...</p>
</body>
</html>