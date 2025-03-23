<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db); // $db est injecté dans UserModel
    }

    public function profile() {
        // Démarrer la session
        

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
}