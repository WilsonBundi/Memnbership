<?php
require_once __DIR__.'/Database.php';

class ContributionModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function calculateForYear($yearId) {
        // Get base member data
        $stmt = $this->db->prepare("
            SELECT fm.*, YEAR(CURDATE()) - YEAR(fm.date_of_birth) AS age 
            FROM family_members fm
            JOIN financial_years fy ON fy.id = ?
        ");
        $stmt->execute([$yearId]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate fees
        $results = [];
        foreach ($members as $member) {
            $results[] = [
                'member_id' => $member['id'],
                'amount' => $this->calculateFee($member['age']),
                'year_id' => $yearId
            ];
        }

        return $results;
    }

    private function calculateFee($age) {
        $base = 100;
        if ($age < 8)       return $base * 0.5;
        elseif ($age < 13) return $base * 0.6;
        elseif ($age < 18) return $base * 0.75;
        elseif ($age < 51) return $base;
        else               return $base * 0.55;
    }
}
?>