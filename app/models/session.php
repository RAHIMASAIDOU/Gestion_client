<?php
require_once __DIR__ . '/../../config/database.php';

class Session {
  
    public static function getUserSessions($user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT login_time, logout_time FROM sessions WHERE user_id = ? ORDER BY login_time DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveLogin($user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO sessions (user_id) VALUES (?)");
        $stmt->execute([$user_id]);
    }

    public static function saveLogout($user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE sessions SET logout_time = NOW() WHERE user_id = ? AND logout_time IS NULL");
        $stmt->execute([$user_id]);
    }
    
}
?>
