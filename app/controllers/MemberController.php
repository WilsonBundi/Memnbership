<?php
require_once __DIR__ . '/../models/MemberModel.php';
require_once __DIR__ . '/../models/ContributionModel.php';

class MemberController {
    // Only ONE index() method
    public function index() {
        session_start();
        if (!isset($_SESSION['user_role'])) {
            header("Location: /login");
            exit();
        }

        $familyId = $_GET['family_id'] ?? null;
        if (!$familyId) {
            $_SESSION['error'] = "Family ID required";
            header("Location: /families");
            exit();
        }

        $model = new MemberModel();
        $members = $model->getMembersByFamily($familyId);
        
        include __DIR__ . '/../views/members/index.php';
    }

    // Other methods (create/store/calculateContributions) remain here
    public function create() { /* ... */ }
    public function store() { /* ... */ }
    public function calculateContributions() { /* ... */ }
}
?>