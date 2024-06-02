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
    header("Location: /admin/register.php");
    exit;
} catch (PDOException $e) {
    // Mensaje de error
    $errorMessage = $e->getMessage();
}
?>
