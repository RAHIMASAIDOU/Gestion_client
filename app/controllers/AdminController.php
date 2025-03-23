<?php

require_once __DIR__ . '/../models/UserModel.php';

class AdminController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function dashboard() {
    

        // Vérifier si l'utilisateur est un administrateur
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        // Récupérer tous les utilisateurs
        $users = $this->userModel->getAllUsers();

        // Passer les utilisateurs à la vue
        require __DIR__ . '/../views/dashboard.php';
    }

    public function addUser() {
        session_start();

        // Vérifier si l'utilisateur est un administrateur
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];

            // Vérifier si le nom d'utilisateur existe déjà
            if ($this->userModel->usernameExists($username)) {
                $_SESSION['error'] = "Ce nom d'utilisateur est déjà pris.";
                header('Location: index.php?action=dashboard');
                exit();
            }

            // Créer l'utilisateur
            if ($this->userModel->createUser($username, $email, $password, $role_id)) {
                $_SESSION['success'] = "Utilisateur ajouté avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
            }

            header('Location: index.php?action=dashboard');
            exit();
        }
    }

    public function deleteUser() {
        session_start();

        // Vérifier si l'utilisateur est un administrateur
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];

            // Supprimer l'utilisateur
            if ($this->userModel->deleteUser($user_id)) {
                $_SESSION['success'] = "Utilisateur supprimé avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression de l'utilisateur.";
            }

            header('Location: index.php?action=dashboard');
            exit();
        }
    }

    public function index() {
        // Récupérer les données
        $clientCount = $this->userModel->getClientCount();
        $adminCount = $this->userModel->getAdminCount();

        // Passer les données à la vue
        require_once __DIR__ . '/../views/dashboard.php';
    }
}