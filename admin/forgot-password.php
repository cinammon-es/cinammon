<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="/images/main/favicon.ico" alt="Login Image">
            <p>cinammon.es</p>
        </div>
        <div class="login">
            <h1>Recuperar Contraseña</h1>
            <form action="send_reset_link.php" method="post">
                <label class="sr-only" for="email">Correo Electrónico</label> <br>
                <input class="form-control" type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                <a href="/admin/dashboard.php"> <button class="btn" type="submit"> Enviar Enlace de Recuperación </button> </a>
            </form>
            <p>¿Recuerdas tu contraseña? <a href="/admin/login.php">Inicia Sesión</a></p>
        </div>
    </div>
</body>

</html>