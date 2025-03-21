<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->createUser($username, $email, $password)) {
                header('Location: public/index.php?action=login');
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }

            if(!empty($_POST['username']) && !empty($_POST['password'])) {
                echo 'Tous les champs sont remplis';
            } else {
                echo "veuillez entrer tous les champs";
            }

        }
        require '../app/views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if(!empty($_POST['username']) && !empty($_POST['password'])) {
                echo 'Tous les champs sont remplis';
            } else {
                echo "veuillez entrer tous les champs";
            }

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role_name'];

                header('Location: public/index.php?action=dashboard');
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }    
        require '../app/views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }
}