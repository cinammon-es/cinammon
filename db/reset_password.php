<?php
// reset_password.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Conectar a la base de datos
    $conn = new mysqli('host', 'user', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM users WHERE reset_token='$token' AND token_expiration > NOW()");

    if ($result->num_rows > 0) {
        $conn->query("UPDATE users SET password='$newPassword', reset_token=NULL, token_expiration=NULL WHERE reset_token='$token'");
        echo "Su contraseña ha sido restablecida con éxito.";
    } else {
        echo "El enlace de restablecimiento es inválido o ha expirado.";
    } 
    $conn->close();
}
?>
