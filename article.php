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

// Récupère un article par son ID
function get_article_by_id($id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM Article WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $article = null;
    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    }
    
    $conn->close();
    return $article;
}

// Récupérer l'ID de l'article depuis l'URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Récupérer l'article
$article = get_article_by_id($article_id);

if ($article): ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($article['titre']); ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 90%;
                max-width: 1000px;
                margin: 0 auto;
            }
            .article {
                border: 1px solid #ddd;
                padding: 20px;
                background-color: #e8f4e8;
            }
            .article h2 {
                margin-top: 0;
                color: #006600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="article">
                <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
                <p><?php echo htmlspecialchars($article['contenu']); ?></p>
            </div>
        </div>
    </body>
    </html>
<?php else: ?>
    <p>Article non trouvé.</p>
<?php endif; ?>