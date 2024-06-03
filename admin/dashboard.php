<?php
// dashboard.php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header("Location: /admin/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Completo</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/styling/admin/dashboard.js" defer></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <a href="/main/index.php#home">
                <img src="/images/main/favicon.ico" alt="Logo" width="50">
            </a>

        </div>
        <h2>Dashboard</h2>
        <nav>
            <ul>
                <li><a href="#home" class="active">Inicio</a></li>
                <li><a href="#profile">Perfil</a></li>
                <li><a href="#settings">Configuración</a></li>
                <li><a href="#logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <div class="content">
        <div id="home" class="section active">
            <h1>Inicio</h1>
            <div class="card">
                <h2>Información General</h2>
                <p>Detalles de la información general del usuario.</p>
            </div>
            <div class="card">
                <h2>Gráfico de Ejemplo</h2>
                <canvas id="exampleChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div id="settings" class="section">
            <h1>Configuración</h1>
            <div class="card">
                <h2> Actualizar Perfil</h2>
                <p>Actualiza tu información personal.</p>
                <form method="POST">
                    <input type="hidden" id="id" name="id" value="1"> <!-- ID del usuario a actualizar -->
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required><br>
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required><br>
                    <button type="submit">Actualizar perfil</button>
                </form>
            </div>
            <div class="card">
                <h2>Eliminar Cuenta</h2>
                <p style="color: red;">
                    Estás a punto de eliminar tu cuenta. Esta acción no se puede deshacer.
                </p>
                <div class="warning-box" style="color: black;">
                    <strong>WARNING</strong>
                    <p> Esta acción no se puede deshacer. Todos los datos asociados con esta cuenta se eliminarán permanentemente.</p>
                </div>

                <form method='POST'>
                    <button type="submit" id="delete">Eliminar Cuenta</button>
                </form>
            </div>


        </div>

        <div id="profile" class="section">
            <h1>Perfil</h1>
            <div class="card">
                <h2>Detalles de la Cuenta</h2>
                <p>Detalles de la configuración de la cuenta del usuario.</p>
            </div>
        </div>

        <div id="logout" class="section">
            <link rel="stylesheet" href="/styling/admin/logout.js">
            <h1>Cerrar Sesión</h1>
            <div class="card">
                <h2>Salir de la Cuenta</h2>
                <p>¿Estás seguro de que deseas cerrar sesión?</p>
                <form action=" /db/logout.php" method="post">
                    <button id="delete-account">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>

</body>
<footer></footer>

</html>