<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

// Connexion à la base de données
$db = Database::connect();

// Instanciation des contrôleurs
$authController = new AuthController($db);
$adminController = new AdminController($db);
$userController = new UserController($db);

// Récupération de l'action à partir de l'URL
$action = $_GET['action'] ?? 'login';

// Gestion des routes
switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'dashboard':
        $adminController->dashboard();
        break;
    case 'profile':
        $userController->profile();
        break;
    // case '/logout':
    //     $authController->logout();
    //     break;
    // default:
    //     header('Location: views/auth/login.php');
    //     exit();
}