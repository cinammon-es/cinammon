<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Registrados</title>

    <link rel="icon" href="/images/main/favicon.ico">
    <!-- Importar fuentes -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    <!-- Estilos globales -->
    <link rel="stylesheet" href="/styling/admin/users.css">
</head>

<body>

    <div class="container">
        <h2>Lista de Usuarios Registrados</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cinammon_db";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para seleccionar todos los usuarios
        $sql = "SELECT id, username AS nombre_usuario, email FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Crear una tabla HTML para mostrar los resultados
            echo "<table><tr><th>ID</th><th>Nombre de Usuario</th><th>Email</th></tr>";

            // Salida de cada fila de datos
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre_usuario"] . "</td><td>" . $row["email"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }
        $conn->close();
        ?>

    </div>

</body>

</html>