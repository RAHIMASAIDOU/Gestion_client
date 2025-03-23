<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    

    public function createUser($username, $email, $password, $role_id) {
        // Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
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

    public function deleteUser($user_id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Méthode pour récupérer un utilisateur par son ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT username, email, status, created_at FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT users.*, role.name as role_name FROM users JOIN role ON users.role_id = role.id WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT users.*, role.name as role_name FROM users JOIN role ON users.role_id = role.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vérifier si un nom d'utilisateur existe déjà
    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

     // Récupérer le nombre de clients
     public function getClientCount() {
        $query = "SELECT COUNT(*) as count FROM users WHERE role = 'client'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    // Récupérer le nombre d'administrateurs
    public function getAdminCount() {
        $query = "SELECT COUNT(*) as count FROM users WHERE role = 'admin'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?>