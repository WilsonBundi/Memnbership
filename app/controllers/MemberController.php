<?php
require_once __DIR__ . '/../models/MemberModel.php';
require_once __DIR__ . '/../models/ContributionModel.php';

class MemberController {

    public function index() {
        session_start();
        if (!isset($_SESSION['user_role'])) {
            header("Location: /Membership/public/login");
            exit();
        }

        $familyId = $_GET['family_id'] ?? null;
        if (!$familyId) {
            $_SESSION['error'] = "Family ID required";
            header("Location: /Membership/public/families");
            exit();
        }

        $model = new MemberModel();
        $members = $model->getMembersByFamily($familyId);
        
        include __DIR__ . '/../views/members/index.php';
    }

    public function create() {
        session_start();
        if ($_SESSION['user_role'] !== 'secretary') {
            header("Location: /Membership/public/login");
            exit();
        }

        // Load necessary data (e.g., families and member types)
        $model = new MemberModel();
        $families = $model->getAllFamilies(); // Ensure this method exists
        $memberTypes = $model->getAllMemberTypes(); // Ensure this method exists

        include __DIR__ . '/../views/members/create.php';
    }

    public function store() {
        session_start();
        if ($_SESSION['user_role'] !== 'secretary') {
            header("Location: /Membership/public/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new MemberModel();
            $success = $model->create($_POST);
            
            if ($success) {
                $_SESSION['success'] = "Member added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add member.";
            }

            header("Location: /Membership/public/members?family_id=" . $_POST['family_id']);
            exit();
        }
    }

    public function calculateContributions() {
        session_start();
        if ($_SESSION['user_role'] !== 'treasurer') {
            header("Location: /Membership/public/login");
            exit();
        }

        $model = new ContributionModel();
        $contributions = $model->calculateContributions($_POST['year_id']);

        $_SESSION['contributions'] = $contributions;
        header("Location: /Membership/public/contributions/results");
        exit();
    }
}
?>
