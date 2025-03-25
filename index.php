<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/models/UserModel.php';
require_once __DIR__ . '/app/models/RoleModel.php';
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/AdminController.php';
require_once __DIR__ . '/app/controllers/UserController.php';

// Connexion à la base de données
$db = Database::connect();

// Instanciation des contrôleurs
$authController = new AuthController($db);
$adminController = new AdminController($db);
$userController = new UserController($db); 

// Récupération de l'action à partir de l'URL
$action = isset($_GET['action'] ) ? $_GET['action'] :'bonjour' ;

// Gestion des routes
switch ($action) {
    case 'register':
        $authController->register();
        break; 
    case 'login':
        $authController->login();
        break;
    case 'addUser':
        $adminController->addUser();
        break;
    case 'deleteUser':
        $adminController->deleteUser();
        break;        
    case 'dashboard':
        $adminController->dashboard();
        break;
    case 'profile':
        $userController->profile();
        break;
    case 'modifier-profil':
        $userController->modifierProfil(); 
        break;   
    case 'update-profile':
        $userController->updateProfile();      
    case '/logout':
        $authController->logout();
        break;
    default:
        require 'app/views/login.php';
        break ;
}