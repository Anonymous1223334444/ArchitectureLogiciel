<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'actualité DIT2</title>
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
            display: flex;
        }
        header {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }
        .content {
            flex: 3;
            padding-right: 20px;
        }
        .sidebar {
            flex: 1;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .article {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #e8f4e8;
        }
        .article h2 {
            margin-top: 0;
            color: #006600;
        }
        .categories-list {
            list-style-type: none;
            padding: 0;
        }
        .categories-list li {
            margin-bottom: 8px;
        }
        .categories-list li a {
            text-decoration: none;
            color: #0066cc;
        }
        .categories-list li a:hover {
            text-decoration: underline;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>SITE D'ACTUALITÉ DIT2</h1>
    </header>
    
    <div class="container">
        <div class="content">
            <?php if (count($articles) > 0): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article">
                        <h2>
                            <a href="article.php?id=<?php echo $article['id']; ?>">
                                <?php echo htmlspecialchars($article['titre']); ?>
                            </a>
                        </h2>
                        <p><?php echo htmlspecialchars(substr($article['contenu'], 0, 200)); ?>...</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun article disponible dans cette catégorie.</p>
            <?php endif; ?>
        </div>
        
        <div class="sidebar">
            <h3>Catégories</h3>
            <ul class="categories-list">
                <li><a href="index.php">Tous les articles</a></li>
                <?php foreach ($categories as $categorie): ?>
                    <li>
                        <a href="index.php?categorie=<?php echo $categorie['id']; ?>">
                            <?php echo htmlspecialchars($categorie['libelle']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>