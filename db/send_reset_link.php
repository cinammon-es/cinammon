<?php
// send_reset_link.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    // Conectar a la base de datos
    $conn = new mysqli('host', 'user', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $expDate = date("Y-m-d H:i:s", strtotime('+1 hour'));
        $conn->query("UPDATE users SET reset_token='$token', token_expiration='$expDate' WHERE email='$email'");

        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
        $subject = "Restablecer su contraseña";
        $message = "Haga clic en el siguiente enlace para restablecer su contraseña: $resetLink";
        $headers = "From: no-reply@yourdomain.com";

        mail($email, $subject, $message, $headers);

        echo "Se ha enviado un enlace de restablecimiento a su correo electrónico.";
    } else {
        echo "No se encontró una cuenta con ese correo electrónico.";
    }

    $conn->close();
}
?>
