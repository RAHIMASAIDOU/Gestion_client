<?php
class RoleModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer tous les rôles
    public function getAllRoles() {
        $stmt = $this->db->query("SELECT * FROM role");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>