<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    public function login() {
        // session_start(); already done in index.php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $user = $userModel->getUser($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                $_SESSION['user_role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'secretary') {
                    header("Location: /Membership/public/families");
                } else {
                    header("Location: /Membership/public/contributions/calculate");
                }
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

    public function logout() {
        // Destroy the session and redirect to login page
        session_start(); // Ensure session is started
        session_unset(); // Remove all session variables
        session_destroy(); // Destroy the session
        header("Location: /Membership/public/login"); // Redirect to login
        exit();
    }
}
