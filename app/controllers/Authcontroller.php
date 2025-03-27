<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/../models/RoleModel.php';
require_once __DIR__ . '/../models/Session.php';


class AuthController {
    private $userModel;
    private $roleModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db); // Injecter UserModel dans AuthController
        $this->roleModel = new RoleModel($db); // Injecter RoleModel dans AuthController
    }

    public function register() {
        // Récupérer les rôles
        $roles = $this->roleModel->getAllRoles();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];
    
            // Vérifier que tous les champs sont remplis
            if (empty($username) || empty($email) || empty($password) || empty($role_id)) {
                $errorMessage = "Veuillez remplir tous les champs.";
                require __DIR__ . '/../views/register.php';
                return;
            }
    
            // Vérifier si le nom d'utilisateur existe déjà
            if ($this->userModel->usernameExists($username)) {
                $errorMessage = "Ce nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
                require __DIR__ . '/../views/register.php';
                return;
            } 
    
            // Créer l'utilisateur
            if ($this->userModel->createUser($username, $email, $password, $role_id)) {
                // Récupérer l'utilisateur nouvellement créé
                $user = $this->userModel->getUserByUsername($username);
    
                // Démarrer la session et connecter l'utilisateur
               
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role_name'];
    
                // Rediriger en fonction du rôle
                if ($_SESSION['role'] === 'admin') { // Assurez-vous que la casse correspond
                    header('Location: index.php?action=dashboard');
                } else {
                    header('Location: index.php?action=profile');
                }
                exit();
            } else {
                $errorMessage = "Erreur lors de l'inscription.";
                require __DIR__ . '/../views/register.php';
            }
        }
            require __DIR__ . '/../views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST["username"];
            $password = $_POST["password"];
    
            // Vérifier que tous les champs sont remplis
            if (empty($username) || empty($password)) {
                echo "Veuillez remplir tous les champs.";
                require __DIR__ . '/../views/login.php';
                return;
            }
    
            // Récupérer l'utilisateur par son nom d'utilisateur
            $user = $this->userModel->getUserByUsername($username);
    
            // Vérifier les identifiants
            if ($user && password_verify($password, $user['password'])) {

                // Démarrer la session et enregistrer les informations de l'utilisateur
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
              
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role_name'];


                // Enregistrer la connexion dans sessions
                Session::saveLogin($user["id"]);

                // Rediriger en fonction du rôle
                if ($_SESSION['role'] === 'admin') { // Assurez-vous que la casse correspond
                    header('Location: index.php?action=dashboard');
                } else { 
                    header('Location: index.php?action=profile');
                } 
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
    
        // Afficher le formulaire de connexion
        require __DIR__ . '/../views/login.php';
    }

    public function logout() {
        // Détruire toutes les données de la session
        session_unset();  // Supprime toutes les variables de session
        session_destroy(); // Détruit la session
        
        // Rediriger l'utilisateur vers la page de connexion
        header("Location: index.php?action=login"); // Redirection vers la page de connexion
        exit;
    }
}