<?php
require_once "app/models/User.php";

class AuthController {
    // Connexion utilisateur
    public function login($email, $password) {
        $user = User::getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            return true;
        }
        return false;
    }

    // Déconnexion
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /public/login.php");
    }
}
?>
