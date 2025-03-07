<?php
require_once 'models/Article.php';
require_once 'models/Category.php';

class ArticleController {
    private $articleModel;
    private $categoryModel;
    
    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function view() {
        // Get article ID from query parameters
        $article_id = isset($_GET['id']) ? intval($_GET['id']) : null;
        
        if (!$article_id) {
            // Redirect to homepage if no ID provided
            header('Location: index.php');
            exit;
        }
        
        // Get article data
        $article = $this->articleModel->getById($article_id);
        
        if (!$article) {
            // If article not found, show error view
            require_once 'views/not_found.php';
            return;
        }
        
        // Get categories for sidebar
        $categories = $this->categoryModel->getAll();
        
        // Set variables for the view
        $data = [
            'article' => $article,
            'categories' => $categories
        ];
        
        // Load view
        require_once 'views/article.php';
    }
}