<?php
require_once __DIR__ . '/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Add this method
    public function getUser($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>