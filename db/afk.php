<?php
require_once '../db/connection.php';

class AfkManager {
    private $db;

    public function __construct() {
        $database = new Database();

    }

    public function setAfk($username, $email) {
        // Asegúrate de sanear las entradas para evitar inyección SQL
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);

        // Construye la consulta SQL directamente
        $sql = "INSERT INTO afk_users (username, email) VALUES ('$username', '$email')";

        // Ejecuta la consulta
        $this->db->query($sql);
    }

    public function setActive($username, $email) {
        // Asegúrate de sanear las entradas para evitar inyección SQL
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);

        // Construye la consulta SQL directamente
        $sql = "DELETE FROM afk_users WHERE username='$username' AND email='$email'";

        // Ejecuta la consulta
        $this->db->query($sql);
    }

    public function getAfkSummary() {
        // Construye la consulta SQL directamente
        $sql = "SELECT * FROM afk_users";

        // Ejecuta la consulta y devuelve los resultados
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAfkStats() {
        // Construye la consulta SQL directamente
        $sql = "SELECT COUNT(*) AS total_afk_users FROM afk_users";

        // Ejecuta la consulta y devuelve los resultados
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
