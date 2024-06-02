<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "cinammon_db";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Crear una conexión
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Configurar el modo de error PDO para excepciones
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->execute();

        // Verificar si el usuario existe
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar la contraseña
            if (password_verify($inputPassword, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                header("Location: /main/index.php");
                exit;
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Nombre de usuario no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/style.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="/images/main/favicon.ico" alt="Login Image">
            <p>cinammon.es</p>
        </div>
        <div class="login">
            <h1>Iniciar Sesión</h1>
            <form method="post">
                <label class="sr-only" for="username">Nombre de Usuario</label> <br>
                <input class="form-control" type="text" id="username" name="username" required placeholder="Nombre de Usuario">
                <label class="sr-only" for="password">Contraseña</label> <br>
                <input class="form-control" type="password" id="password" name="password" required placeholder="Contraseña">
                <button class="btn" type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="/conexion/register.php">Regístrate</a></p>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>

</html>