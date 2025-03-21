<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function profile() {
        // Démarrer la session
        session_start();
    
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            exit();
        }
    
        // Récupérer l'ID de l'utilisateur connecté
        $userId = $_SESSION['user_id'];
    
        // Récupérer les informations de l'utilisateur depuis la base de données
        $stmt = $this->db->prepare("SELECT username, email, status, created_at FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Passer les données à la vue
        require_once __DIR__ . '/../views/user/profile.php';
    }
}