<?php

/**
 * Clase Database
 * Maneja la conexión a una base de datos MySQL y la creación de una base de datos y una tabla de usuarios.
 */
class Database
{
    /**
     * @var string $servername El nombre del servidor de la base de datos.
     * @var string $username El nombre de usuario para conectarse a la base de datos.
     * @var string $password La contraseña para conectarse a la base de datos.
     * @var string $dbname El nombre de la base de datos.
     * @var PDO $conn La conexión a la base de datos.
     */
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cinammon_db";
    private $conn;

    /**
     * Constructor
     * Establece la conexión a la base de datos y crea la base de datos si no existe.
     */
    public function __construct()
    {
        try {
            // Intenta establecer una conexión con el servidor MySQL
            $this->conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Llama al método para crear la base de datos
            $this->createDatabase();
        } catch (PDOException $e) {
            // Si hay un error en la conexión, muestra el mensaje de error y termina la ejecución
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Crea la base de datos si no existe.
     * @return void
     */
    private function createDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        $this->conn->exec($sql);  // Ejecuta la consulta para crear la base de datos
        $this->conn->exec("USE $this->dbname");  // Selecciona la base de datos recién creada o existente
        $this->createTables();  // Llama al método para crear las tablas
    }

    /**
     * Crea la tabla de usuarios si no existe.
     * @return void
     */
    private function createTables()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        );";
        $this->conn->exec($sql);  // Ejecuta la consulta para crear la tabla de usuarios
    }

    /**
     * Obtiene la conexión a la base de datos.
     * @return PDO La conexión a la base de datos.
     */
    public function getConnection()
    {
        return $this->conn;
    }
}
