<?php
require_once __DIR__ . '/Database.php';

class FamilyModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }
    public function getFinancialYears() {
        $stmt = $this->db->query("SELECT * FROM financial_years");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllFamilies() {
        $stmt = $this->db->query("SELECT * FROM families");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add this new method
    public function create($name, $address) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO families (name, address) 
                VALUES (:name, :address)
            ");
            
            $stmt->execute([
                ':name' => $name,
                ':address' => $address
            ]);
            
            return $this->db->lastInsertId();
            
        } catch(PDOException $e) {
            error_log("Family creation error: " . $e->getMessage());
            return false;
        }
    }
}
?>