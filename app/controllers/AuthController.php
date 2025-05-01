<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $user = $userModel->getUser($_POST['username']);

            // In AuthController->login()
if ($user && password_verify($_POST['password'], $user['password_hash']))  {
                $_SESSION['user_role'] = $user['role'];
                header("Location: /Membership/public/families");
                exit();
            } else {
                $_SESSION['error'] = "Invalid credentials!";
                header("Location: /Membership/public/login");
                exit();
            }
        }

        // Load the login view
        require_once __DIR__ . '/../views/auth/login.php';
    }
}
