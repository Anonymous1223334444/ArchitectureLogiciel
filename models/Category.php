<?php
require_once 'models/config/Database.php';

class Category {
    // Database connection and table
    private $conn;
    private $table = 'Categorie';
    
    // Category properties
    public $id;
    public $libelle;
    
    // Constructor with database connection
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getAll() {
        $categories = [];
        
        // SQL query to get all categories ordered by name
        $sql = "SELECT * FROM {$this->table} ORDER BY libelle";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        
        return $categories;
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
}