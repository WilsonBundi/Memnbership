<?php
require_once __DIR__ . '/Database.php';

class ContributionModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function calculateContributions($yearId) {
        try {
            // Get financial year start date
            $stmt = $this->db->prepare("SELECT year FROM financial_years WHERE id = ?");
            $stmt->execute([$yearId]);
            $year = $stmt->fetchColumn();
            
            // Calculate age and fees for all members
            $stmt = $this->db->prepare("
                SELECT fm.id, 
                       TIMESTAMPDIFF(YEAR, fm.date_of_birth, CONCAT(?, '-01-01')) AS age,
                       mt.discount
                FROM family_members fm
                JOIN member_types mt ON fm.member_type_id = mt.id
            ");
            $stmt->execute([$year]);
            
            $contributions = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $baseAmount = 100.00;
                $finalAmount = $baseAmount * (1 - ($row['discount'] / 100));
                
                $contributions[] = [
                    'member_id' => $row['id'],
                    'financial_year_id' => $yearId,
                    'base_amount' => $baseAmount,
                    'discount' => $row['discount'],
                    'final_amount' => $finalAmount
                ];
            }
            
            // Save to database
            $this->saveContributions($contributions);
            
            return $contributions;

        } catch(PDOException $e) {
            error_log("Contribution calculation error: " . $e->getMessage());
            return false;
        }
    }

    private function saveContributions($contributions) {
        $stmt = $this->db->prepare("
            INSERT INTO contributions 
            (member_id, financial_year_id, base_amount, discount, final_amount)
            VALUES (:member_id, :financial_year_id, :base_amount, :discount, :final_amount)
        ");

        foreach($contributions as $contribution) {
            $stmt->execute($contribution);
        }
    }
}
?>