<?php
class Database {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "cinammon_db";
    protected $conn; 

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createDatabase();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        $this->conn->exec($sql);
        $this->conn->exec("USE $this->dbname");
        $this->createTables();
    }

    private function createTables() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        );";
        $this->conn->exec($sql);
    }

    public function getConnection() {
        return $this->conn;
    }  
}
?>
