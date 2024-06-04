<?php
require_once '../db/connection.php';

class AfkManager
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setAfk($username, $email)
    {
        $query = "UPDATE afk SET status = 'afk', afk_start_time = NOW() WHERE username = :username AND email = :email";
        $statement = $this->conn->prepare($query);
        
        $statement->bindParam(':email', $email);
        return $statement->execute();
    }

    public function setActive($username, $email)
    {
        $query = "UPDATE afk SET status = 'active', afk_end_time = NOW() WHERE username = :username AND email = :email";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        return $statement->execute();
    }

    public function getAfkSummary()
    {
        $query = "SELECT username, total_cinacoins, total_afk_time FROM afk_summary";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAfkStats()
    {
        $query = "
            SELECT 
                AVG(total_cinacoins) AS average_cinacoins,
                AVG(total_afk_time) AS average_afk_time,
                SUM(total_cinacoins) AS total_cinacoins,
                SUM(total_afk_time) AS total_afk_time
            FROM afk_summary";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

// Uso del AfkManager
$afkManager = new AfkManager($db);

// Establecer usuario en modo AFK
$afkManager->setAfk('nombreUsuario', 'correo@example.com');

// Establecer usuario en modo activo
$afkManager->setActive('nombreUsuario', 'correo@example.com');

// Obtener el resumen de AFK
$afkSummary = $afkManager->getAfkSummary();
print_r($afkSummary);

// Obtener estadísticas de AFK
$afkStats = $afkManager->getAfkStats();
print_r($afkStats);
