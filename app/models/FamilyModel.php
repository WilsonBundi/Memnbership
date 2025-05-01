<?php
require_once __DIR__ . '/Database.php';

class FamilyModel {
    private $db;

    public function __construct() {
        try {
            $database = new Database();
            $this->db = $database->connect();
            
            // Verify connection
            if (!$this->db) {
                throw new Exception("Database connection failed");
            }
        } catch(Exception $e) {
            die("Model initialization error: " . $e->getMessage());
        }
    }

    public function getAllFamilies() {
        try {
            $stmt = $this->db->query("SELECT * FROM families");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
}
?>