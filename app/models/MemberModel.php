<?php
require_once __DIR__.'/Database.php';

class MemberModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getMembersByFamily($familyId) {
        $stmt = $this->db->prepare("SELECT * FROM family_members WHERE family_id = ?");
        $stmt->execute([$familyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO family_members 
            (name, date_of_birth, member_type_id, family_id) 
            VALUES (:name, :dob, :type, :family)");
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':dob' => $data['dob'],
            ':type' => $data['member_type'],
            ':family' => $data['family_id']
        ]);
    }
}
?>