<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'actualité DIT2</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'views/partials/header.php'; ?>
    
    <div class="container">
        <div class="content">
            <?php if (count($data['articles']) > 0): ?>
                <?php foreach ($data['articles'] as $article): ?>
                    <div class="article">
                        <h2>
                            <a href="index.php?route=article&id=<?php echo $article['id']; ?>">
                                <?php echo htmlspecialchars($article['titre']); ?>
                            </a>
                        </h2>
                        <p><?php echo htmlspecialchars(substr($article['contenu'], 0, 200)); ?>...</p>
                        <div class="article-meta">
                            <span class="category">Catégorie: <?php echo htmlspecialchars($article['categorie_libelle']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun article disponible dans cette catégorie.</p>
            <?php endif; ?>
        </div>
        
        <?php include 'views/partials/sidebar.php'; ?>
    </div>
    
    <?php include 'views/partials/footer.php'; ?>
</body>
</html>