<?php
require_once 'models/Article.php';
require_once 'models/Category.php';

class HomeController {
    private $articleModel;
    private $categoryModel;
    
    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        // Get category filter from query parameters if exists
        $categorie_id = isset($_GET['categorie']) ? intval($_GET['categorie']) : null;
        
        // Get data from models
        $categories = $this->categoryModel->getAll();
        $articles = $this->articleModel->getAll($categorie_id);
        
        // Set variables for the view
        $data = [
            'categories' => $categories,
            'articles' => $articles,
            'selected_category' => $categorie_id
        ];
        
        // Load view
        require_once 'views/home.php';
    }
}