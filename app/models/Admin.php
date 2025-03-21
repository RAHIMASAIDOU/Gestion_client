<?php
 
 class Admin { 
    private $db; 
 
    public function __construct($db) { 
        $this->db = $db; 
    } 
 
    public function getAllUsers() { 
        $stmt = $this->db->query("SELECT * FROM users"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } 
}
?>