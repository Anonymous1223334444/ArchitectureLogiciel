<?php

// Load controllers
require_once 'controllers/HomeController.php';
require_once 'controllers/ArticleController.php';

// Simple router based on URL parameters
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Remove route from $_GET to avoid passing it to controllers
if (isset($_GET['route'])) {
    unset($_GET['route']);
}

// Route the request to the appropriate controller
switch ($route) {
    case 'article':
        $controller = new ArticleController();
        $controller->view();
        break;
    
    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}