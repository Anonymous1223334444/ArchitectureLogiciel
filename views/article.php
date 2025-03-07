<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($data['article']['titre']); ?> - Site d'actualité DIT2</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'views/partials/header.php'; ?>
    
    <div class="container">
        <div class="content">
            <div class="article full-article">
                <h2><?php echo htmlspecialchars($data['article']['titre']); ?></h2>
                <div class="article-meta">
                    <span class="category">Catégorie: <?php echo htmlspecialchars($data['article']['categorie_libelle']); ?></span>
                    <span class="date">Publié le: <?php echo date('d/m/Y', strtotime($data['article']['dateCreation'])); ?></span>
                </div>
                <div class="article-content">
                    <p><?php echo htmlspecialchars($data['article']['contenu']); ?></p>
                </div>
                <div class="article-actions">
                    <a href="index.php" class="btn">Retour à la liste</a>
                </div>
            </div>
        </div>
        
        <?php include 'views/partials/sidebar.php'; ?>
    </div>
    
    <?php include 'views/partials/footer.php'; ?>
</body>
</html>