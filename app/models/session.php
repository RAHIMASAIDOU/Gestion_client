<?php
require_once "../config/database.php";

class Session {
    // Enregistrer une connexion
    public static function saveLogin($user_id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO sessions (user_id, login_time) VALUES (?, NOW())");
        return $stmt->execute([$user_id]);
    }

    // Enregistrer la déconnexion
    public static function saveLogout($user_id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE sessions SET logout_time = NOW() WHERE user_id = ? AND logout_time IS NULL ORDER BY login_time DESC LIMIT 1");
        return $stmt->execute([$user_id]);
    }

    // Récupérer l'historique des connexions d'un utilisateur
    public static function getUserHistory($user_id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT login_time, logout_time FROM sessions WHERE user_id = ? ORDER BY login_time DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
