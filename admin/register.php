<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/singup.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="/images/main/favicon.ico" alt="Login Image">
            <p>cinammon.es</p>
        </div>
        <div class="register">
            <h1>Registro</h1>
            <form id="registerForm">
                <label class="sr-only" for="username">Nombre de Usuario</label> <br>
                <input class="form-control" type="text" name="username" id="username" placeholder="Nombre de Usuario" required>
                <label class="sr-only" for="email">Correo Electrónico</label> <br>
                <input class="form-control" type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                <label class="sr-only" for="password">Contraseña</label> <br>
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required>
                <label class="sr-only" for="confirmPassword">Confirmar Contraseña</label> <br>
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmar Contraseña" required>
                <button class="btn" type="submit">Registrarse</button>
            </form>
            <p>¿Ya tienes una cuenta? <a href="/admin/login.php">Inicia Sesión</a></p>
            <p id="error" class="error"></p>
            <p id="success" class="success"></p>
        </div>
    </div>

    <script src="/styling/admin/register.js"></script>
</body>

</html>