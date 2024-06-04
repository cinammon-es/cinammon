<?php
require_once 'connection.php';

/**
 * Clase para gestionar los usuarios AFK
 */
class AfkManager {
    private $db;
    /**
     * 
     */
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();

        if ($this->db === null) {
            throw new Exception('Error connecting to the database');
        }
    }
    
    public function setAfk($username, $email) {
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);

        $sql = "INSERT INTO afk_users (username, email, status, afk_start_time) 
                VALUES (:username, :email, 'afk', NOW())
                ON DUPLICATE KEY UPDATE 
                    status = 'afk', 
                    afk_start_time = NOW()";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
    /**
     * @param type $email
     * @param type $username
     */
    public function setActive($username, $email) { 

        $sql = "UPDATE afk_users SET status = 'active', afk_end_time = NOW() 
                WHERE username = :username AND email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    /**
     * 
     * @return type array
     */
    public function getAfkSummary() {
        $sql = "SELECT username, email, status, afk_start_time, afk_end_time FROM afk_users";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return type array
     */
    public function getAfkStats() {
        $sql = "SELECT COUNT(*) AS total_afk_users FROM afk_users WHERE status = 'afk'";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
