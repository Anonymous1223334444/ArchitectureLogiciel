<div class="sidebar">
    <h3>Catégories</h3>
    <ul class="categories-list">
        <li><a href="index.php" <?php echo !isset($data['selected_category']) ? 'class="active"' : ''; ?>>
            Tous les articles
        </a></li>
        <?php foreach ($data['categories'] as $categorie): ?>
            <li>
                <a href="index.php?categorie=<?php echo $categorie['id']; ?>" 
                   <?php echo (isset($data['selected_category']) && $data['selected_category'] == $categorie['id']) ? 'class="active"' : ''; ?>>
                    <?php echo htmlspecialchars($categorie['libelle']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>