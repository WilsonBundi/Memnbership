<?php
require_once __DIR__ . '/../models/ContributionModel.php';
require_once __DIR__ . '/../models/FamilyModel.php';
require_once __DIR__ . '/../models/MemberModel.php';

class ContributionController {
    public function calculate() {
        // No need for session_start() here, it's already started in index.php

        // Ensure only treasurers can access this
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'treasurer') {
            header("Location: /Membership/public/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ContributionModel();
            $yearId = $_POST['year_id'];
            $_SESSION['contributions'] = $model->calculateContributions($yearId);
            header("Location: /Membership/public/contributions/results");
            exit();
        }

        // Show form with financial years
        $familyModel = new FamilyModel();
        $years = $familyModel->getFinancialYears();
        include __DIR__ . '/../views/contributions/calculate.php';
    }

    public function results() {
        // No need for session_start() here either

        if (empty($_SESSION['contributions'])) {
            header("Location: /Membership/public/contributions/calculate");
            exit();
        }

        $memberModel = new MemberModel();
        foreach ($_SESSION['contributions'] as &$contribution) {
            $member = $memberModel->getMemberById($contribution['member_id']);
            $contribution['member_name'] = $member['name'];
        }

        include __DIR__ . '/../views/contributions/results.php';
        unset($_SESSION['contributions']); // Clear after use
    }
}
?>
