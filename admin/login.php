
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/login.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="/images/main/favicon.ico" alt="Login Image">
            <p>cinammon.es</p>
        </div>
        <div class="login">
            <h1>Iniciar Sesión</h1>
            <form id="loginForm">
                <label for="username" class="sr-only">Nombre de Usuario</label> <br>
                <input class="form-control" type="text" id="username" name="username" required placeholder="Nombre de Usuario">
                <input class="form-control" type="password" id="password" name="password" required placeholder="Contraseña">
                <button class="btn" name="login" value="login">Iniciar Sesión</button>
                <p>¿Olvidaste tu contraseña? <a href="/admin/forgot-password.php">Recupérala</a></p>
            </form>
            <p>¿No tienes una cuenta? <a href="/admin/register.php">Regístrate</a></p>
            <p class="error" style="color:red;"></p>
        </div>
    </div>
    <script src="/styling/admin/login.js"></script>
</body>

</html>
