<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Article non trouvé - Site d'actualité DIT2</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'views/partials/header.php'; ?>
    
    <div class="container">
        <div class="content">
            <div class="error-message">
                <h2>Article non trouvé</h2>
                <p>L'article que vous recherchez n'existe pas ou a été supprimé.</p>
                <div class="article-actions">
                    <a href="index.php" class="btn">Retour à la liste des articles</a>
                </div>
            </div>
        </div>
        
        <?php include 'views/partials/sidebar.php'; ?>
    </div>
    
    <?php include 'views/partials/footer.php'; ?>
</body>
</html>