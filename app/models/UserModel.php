<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($username, $email, $password, $role_id = 2) {
        // Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Préparation de la requête SQL
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)");

        // Liaison des paramètres
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $role_id);

        // Exécution de la requête
        return $stmt->execute();
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT users.*, roles.name as role_name FROM users JOIN roles ON users.role_id = roles.id WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT users.*, roles.name as role_name FROM users JOIN roles ON users.role_id = roles.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>