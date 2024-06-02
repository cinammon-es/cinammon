<?php
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
        $inputEmail = $_POST['email'];
        $inputPassword = $_POST['password'];

        // Verificar si el nombre de usuario o el correo electrónico ya existen
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':email', $inputEmail);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = "El nombre de usuario o el correo electrónico ya están en uso.";
        } else {
            // Insertar nuevo usuario en la base de datos
            $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $inputUsername);
            $stmt->bindParam(':email', $inputEmail);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            // Guardar la información del usuario en la sesión
            $_SESSION['username'] = $inputUsername;
            $_SESSION['email'] = $inputEmail;

            // Redirigir al usuario a la página principal
            header("Location: /conexion/login.php");
            exit;
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
    <title>Registro de Usuario</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/signup.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="/images/main/favicon.ico" alt="Login Image">
            <p>cinammon.es</p>
        </div>
        <div class="register">
            <h1>Registro de Usuario</h1>
            <form method="post">
                <label class="sr-only" for="username">Nombre de Usuario</label> <br>
                <input class="form-control" type="text" name="username" id="username" placeholder="Nombre de Usuario" required>
                <label class="sr-only" for="email">Correo Electrónico</label> <br>
                <input class="form-control" type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                <label class="sr-only" for="password">Contraseña</label> <br>
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required>
                <button class="btn" type="submit">Registrarse</button> 
            </form>
            <p>¿Ya tienes una cuenta? <a href="/conexion/login.php">Inicia Sesión</a></p>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>

</html>