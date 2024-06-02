<?php
// login.php
session_start();

// Supongamos que el usuario se autentica correctamente
$username = 'usuario'; 
$password = 'contraseña';

// Configurar las variables de sesión
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

// Redirigir al dashboard
header("Location: /admin/login.php");