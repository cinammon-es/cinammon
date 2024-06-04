<?php
/** 
 * Clase para la conexión a la base de datos y la creación de tablas y vistas
 */
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cinammon_db";
    private $conn;

    /**
     * Constructor de la clase Database
     */
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createDatabase();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    } 
    
    /**
     * Función para obtener la conexión a la base de datos
     * @return PDO
     */
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }

    /**
     * Función para crear la base de datos, tablas y vistas
     */
    private function createDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        $this->conn->exec($sql);
        $this->conn->exec("USE $this->dbname");
        $this->createTables();
        $this->createViews();
    }

    /**
     * Función para crear las tablas de la base de datos
     */
    private function createTables()
    {
        $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        );";
        
        $sqlAfk = "CREATE TABLE IF NOT EXISTS afk (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            status ENUM('active', 'afk') NOT NULL,
            cinacoins INT DEFAULT 0,
            afk_start_time DATETIME,
            afk_end_time DATETIME,
            total_afk_time INT DEFAULT 0,
            UNIQUE(username, email),
            FOREIGN KEY (username) REFERENCES users(username)
        );";

        $sqlAfkUsers = "CREATE TABLE IF NOT EXISTS afk_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'afk',
            afk_start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            afk_end_time TIMESTAMP NULL
        );";
        
        $sqlAfkSummary = "CREATE TABLE IF NOT EXISTS afk_summary (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            total_cinacoins INT DEFAULT 0,
            total_afk_time INT DEFAULT 0,
            last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE(username),
            FOREIGN KEY (username) REFERENCES users(username)
        );";

        
        $sqlTrigger = "CREATE TRIGGER before_afk_update
        BEFORE UPDATE ON afk
        FOR EACH ROW
        BEGIN
            IF NEW.status = 'active' AND OLD.status = 'afk' THEN
                SET NEW.afk_end_time = NOW();
                SET NEW.total_afk_time = TIMESTAMPDIFF(SECOND, OLD.afk_start_time, NEW.afk_end_time) + OLD.total_afk_time;
                INSERT INTO afk_summary (username, total_cinacoins, total_afk_time)
                VALUES (NEW.username, NEW.cinacoins, NEW.total_afk_time)
                ON DUPLICATE KEY UPDATE
                    total_cinacoins = total_cinacoins + NEW.cinacoins,
                    total_afk_time = total_afk_time + TIMESTAMPDIFF(SECOND, OLD.afk_start_time, NEW.afk_end_time);
            ELSEIF NEW.status = 'afk' AND OLD.status = 'active' THEN
                SET NEW.afk_start_time = NOW();
            END IF;
        END;";
        
        $this->conn->exec($sqlUsers); 
        $this->conn->exec($sqlAfk);
        $this->conn->exec($sqlAfkUsers);
        $this->conn->exec($sqlAfkSummary);
        $this->conn->exec("DROP TRIGGER IF EXISTS before_afk_update");
        $this->conn->exec($sqlTrigger);
    }

    /**
     * Función para crear las vistas de la base de datos
     */
    private function createViews()
    {
        $this->conn->exec("DROP VIEW IF EXISTS afk_summary_view");
        $this->conn->exec("DROP VIEW IF EXISTS active_users_view");

        $sqlAfkSummaryView = "CREATE VIEW afk_summary_view AS
            SELECT username, total_cinacoins, total_afk_time, last_updated
            FROM afk_summary;";
        
        $sqlActiveUsersView = "CREATE VIEW active_users_view AS
            SELECT username, email
            FROM afk
            WHERE status = 'active';";
        
        $this->conn->exec($sqlAfkSummaryView);
        $this->conn->exec($sqlActiveUsersView);
    } 
}
/**
 * Crear una instancia de la clase Database
 */
$db = new Database();
?>
