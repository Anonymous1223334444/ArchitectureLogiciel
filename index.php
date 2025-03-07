<?php
// Configuration de la base de données MySQL
$DB_CONFIG = [
    'host' => 'localhost',
    'user' => 'mglsi_user',
    'password' => 'passer',
    'database' => 'mglsi_news'
];

// Établit une connexion à la base de données MySQL
function get_db_connection() {
    global $DB_CONFIG;
    $conn = new mysqli(
        $DB_CONFIG['host'],
        $DB_CONFIG['user'],
        $DB_CONFIG['password'],
        $DB_CONFIG['database']
    );
    
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }
    
    // Définir l'encodage UTF-8
    $conn->set_charset("utf8");
    
    return $conn;
}

// Récupère toutes les catégories
function get_categories() {
    $conn = get_db_connection();
    $sql = "SELECT * FROM Categorie ORDER BY libelle";
    $result = $conn->query($sql);
    
    $categories = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    $conn->close();
    return $categories;
}

// Récupère les articles, filtré par catégorie si spécifié
function get_articles($categorie_id = null) {
    $conn = get_db_connection();
    
    if ($categorie_id) {
        $stmt = $conn->prepare("
            SELECT a.*, c.libelle as categorie_libelle 
            FROM Article a 
            JOIN Categorie c ON a.categorie = c.id 
            WHERE a.categorie = ? 
            ORDER BY a.dateCreation DESC
        ");
        $stmt->bind_param("i", $categorie_id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "
            SELECT a.*, c.libelle as categorie_libelle 
            FROM Article a 
            JOIN Categorie c ON a.categorie = c.id 
            ORDER BY a.dateCreation DESC
        ";
        $result = $conn->query($sql);
    }
    
    $articles = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
    
    $conn->close();
    return $articles;
}

// Récupérer la catégorie sélectionnée (s'il y en a une)
$categorie_id = isset($_GET['categorie']) ? intval($_GET['categorie']) : null;

// Récupérer les données
$categories = get_categories();
$articles = get_articles($categorie_id);

// Inclure le template HTML
include('view.php');
?>