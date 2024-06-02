<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "cinammon_db";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" href="/images/main/favicon.ico">
    <link rel="stylesheet" href="/styling/admin/dashboard.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="/images/main/favicon.ico" alt="Logo" width="50">
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
        <div id="home" class="section">
            <h1>Inicio</h1>
            <div class="card">
                <h2>Información General</h2>
                <p>Detalles de la información general del usuario.</p>
            </div>
        </div>

        <div id="profile" class="section">
            <h1>Perfil</h1>
            <div class="card">
                <h2>Información Personal</h2>
                <?php echo "<p><strong>Nombre:</strong> " . $_SESSION['username'] . "</p>"; ?>
                <?php echo "<p><strong>Correo Electrónico:</strong> " . $_SESSION['email'] . "</p>"; ?>
            </div>
            <br>
            <div class="card">
                <h2>Detalles de la Cuenta</h2>
                <p><strong>Nombre de Usuario:</strong> <?php echo $_SESSION['username']; ?></p>
                <?php echo "<p><strong>Fecha de Registro:</strong> " . date('d/m/Y', strtotime($_SESSION['created_at'])) . "</p>"; ?>
                <?php echo "<p><strong>Último Inicio de Sesión:</strong> " . date('d/m/Y', strtotime($_SESSION['last_login'])) . "</p>"; ?>
            </div>
        </div>

        <div id="settings" class="section">
            <h1>Configuración</h1>
            <div class="card">
                <h2>Configuración de la Cuenta</h2>
                <p>Detalles de la configuración de la cuenta del usuario.</p>
            </div>
        </div>

        <div id="logout" class="section">
            <h1>Cerrar Sesión</h1>
            <div class="card">
                <h2>Salir de la Cuenta</h2>
                <p>¿Estás seguro de que deseas cerrar sesión?</p>
                <form action="/conexion/logout.php" method="post">
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.sidebar ul li a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar ul li a').forEach(item => item.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('.section').forEach(section => section.style.display = 'none');
                const sectionToShow = document.querySelector(this.getAttribute('href'));
                if (sectionToShow) sectionToShow.style.display = 'block';
            });
        });

        document.querySelectorAll('.section').forEach(section => section.style.display = 'none');
        document.querySelector('#home').style.display = 'block';
    </script>
</body>

</html>