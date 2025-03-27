<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;
    private $db;

    public function __construct($db) {
        $this->userModel = new UserModel($db); // $db est injecté dans UserModel
    }

    public function profile() {
        
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            exit();
        }

        // Récupérer l'ID de l'utilisateur connecté
        $userId = $_SESSION['user_id'];

        // Utiliser UserModel pour récupérer les informations de l'utilisateur
        $user = $this->userModel->getUserById($userId);

        // Passer les données à la vue
        require_once __DIR__ . '/../views/profile.php';
    }

    public function modifierProfil() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    
        // Récupérer l'ID de l'utilisateur connecté
        $userId = $_SESSION['user_id'];
    
        // Récupérer les informations de l'utilisateur
        $user = $this->userModel->getUserById($userId);
    
        // Afficher le formulaire de modification
        require_once __DIR__ . '/../views/modifier-profil.php';
    }

    public function updateProfile() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    
        // Récupérer l'ID de l'utilisateur connecté
        $userId = $_SESSION['user_id'];
    
        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Mettre à jour les informations de l'utilisateur
        if ($this->userModel->updateUser($userId, $username, $email, $password)) {
            $_SESSION['success'] = "Profil mis à jour avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
        }
    
        // Rediriger vers la page de profil
        header('Location: index.php?action=profile');
        exit();
    }

    public function historique() {
        // Vérifie que l'utilisateur est bien connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        // Récupérer l'historique des connexions
        require_once __DIR__ . '/../models/Session.php';
        $session = new Session($this->db);
        $sessions = $session->getUserSessions($_SESSION['user_id']);  
        
        // Afficher l'historique
        require __DIR__ . '/../views/historique.php';
    }
}