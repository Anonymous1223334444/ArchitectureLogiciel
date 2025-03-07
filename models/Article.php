<?php
require_once 'models/config/Database.php';

class Article {
    // Database connection and table
    private $conn;
    private $table = 'Article';
    
    // Article properties
    public $id;
    public $titre;
    public $contenu;
    public $dateCreation;
    public $categorie;
    public $categorie_libelle;
    
    // Constructor with database connection
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getAll($categorie_id = null) {
        $articles = [];
        
        // SQL query with category join
        $sql = "SELECT a.*, c.libelle as categorie_libelle 
                FROM {$this->table} a 
                JOIN Categorie c ON a.categorie = c.id ";
                
        // Add category filter if specified
        if ($categorie_id) {
            $stmt = $this->conn->prepare($sql . "WHERE a.categorie = ? ORDER BY a.dateCreation DESC");
            $stmt->bind_param("i", $categorie_id);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql .= "ORDER BY a.dateCreation DESC";
            $result = $this->conn->query($sql);
        }
        
        // Process result
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
        }
        
        return $articles;
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT a.*, c.libelle as categorie_libelle 
                                      FROM {$this->table} a 
                                      JOIN Categorie c ON a.categorie = c.id 
                                      WHERE a.id = ?");
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
}