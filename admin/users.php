<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Registrados</title>

    <link rel="icon" href="/images/main/favicon.ico">
    <!-- Importar fuentes -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    <style>
        /* Estilos Globales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            border: none;
            outline: none;
            scroll-behavior: smooth;
            font-family: 'Poppins', sans-serif;
        }

        /* Variables de raíz */
        :root {
            --bg-color: #1f242d;
            --second-bg-color: #323946;
            --text-color: #fff;
            --main-color: #fcf0b6;
            --primary: lightseagreen;
            --secondary: #080808;
            --dark-1: #202225;
            --dark-2: #36393f;
            --dark-3: rgba(255, 255, 255, 0.08);
            --blue: #00c3f987;
            --red: #ed4245;
            --green: #57f279a5;
        }

        /* Estilos del cuerpo */
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        /* Estilos del contenedor */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--second-bg-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
            width: 80%;
            max-width: 800px;
            padding: 2rem;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: var(--main-color);
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid var(--dark-3);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: var(--dark-2);
        }

        tbody tr:nth-child(odd) {
            background-color: var(--dark-1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nombre_usuario"]. "</td><td>" . $row["email"]. "</td></tr>";
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
