<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Completo</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/assets/js/dashboard.js"></script>
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
                <li><a href="#afk">AFK</a></li>
                <li><a href="#profile">Perfil</a></li>
                <li><a href="#settings">Configuración</a></li>
                <li><a href="#logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <div class="content">
        <div id="home" class="section active">
            <h1> Bienvenid@ al Panel de Control</h1>
            <div class="card">
                <h2> ¡Hola, <?php echo $_SESSION['username']; ?>!</h2>
                <p>¡Bienvenid@ al panel de control de cinammon.es! Aquí puedes ver información general sobre tu cuenta y actualizar tu perfil.</p>
            </div>
            <div class="card">
                <h2>Información General</h2>
                <p>Detalles de la información general del usuario.</p>
            </div>
            <div class="card">
                <h2>Gráfico de Ejemplo</h2>
                <canvas id="exampleChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div id="afk" class="section">
            <h1>AFK</h1>
            <div class="card">
                <h2>Estado AFK</h2>
                <p>¡Estás en modo AFK! Esto significa que no estás disponible en este momento.</p>
                <a href="/admin/afk.php"><button> AFK MANAGER </button></a>

                <div class="card">
                    <h2>Lista de Usuarios AFK</h2>
                    <p>Lista de usuarios que están en modo AFK.</p> 
                </div>
            </div>
        </div> 

        <div id="settings" class="section">
            <h1>Configuración</h1>
            <div class="card">
                <h2>Actualizar Perfil</h2>
                <p>Actualiza tu información personal.</p>
                <form method="POST" id="updateProfileForm">
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
                <form method='POST' id="deleteAccountForm">
                    <button type="submit" id="delete">Eliminar Cuenta</button>
                </form>
            </div>
        </div>

        <div id="profile" class="section">
            <h1>Perfil</h1>
            <div class="card">
                <h2>Detalles de la cuenta de <?php echo $_SESSION['username']; ?>. </h2>
                <p>
                    <strong>Nombre de usuario:</strong> <?php echo $_SESSION['username']; ?><br>
                    <strong>Correo electrónico:</strong> <?php echo $_SESSION['email']; ?><br>
                </p>
            </div>
        </div>
        <div id="logout" class="section">
            <h1>Cerrar Sesión</h1>
            <div class="card">
                <h2>¿Estás seguro de que deseas cerrar sesión?</h2>
                <form method="POST" action="/admin/login.php">
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div> 
</body>

</html>