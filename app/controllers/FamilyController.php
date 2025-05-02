<?php
require_once __DIR__.'/../models/FamilyModel.php';

class FamilyController {

    public function index() {
        if (!isset($_SESSION['user_role'])) {
            header("Location: /Membership/public/login");
            exit();
        }

        $model = new FamilyModel();
        $families = $model->getAllFamilies();
        include __DIR__.'/../views/families/index.php';
    }

    public function create() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'secretary') {
            header("Location: /Membership/public/login");
            exit();
        }

        include __DIR__.'/../views/families/create.php';
    }

    public function store() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'secretary') {
            header("Location: /Membership/public/login");
            exit();
        }

        $model = new FamilyModel();
        if ($model->create($_POST['name'], $_POST['address'])) {
            $_SESSION['success'] = "Family added successfully!";
        }

        header("Location: /Membership/public/families");
    }

}
?>
