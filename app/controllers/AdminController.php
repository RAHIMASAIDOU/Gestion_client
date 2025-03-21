<?php

require_once __DIR__ . '/../models/UserModel.php';

class AdminController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function dashboard() {
        session_start();
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }

        // Récupère tous les utilisateurs
        $users = $this->userModel->getAllUsers();

        // Passe les utilisateurs à la vue
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }
}