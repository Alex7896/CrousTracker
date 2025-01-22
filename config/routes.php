<?php
//use App\Controller;

// Récupérer les paramètres de l'URL
$page = $_GET['page'] ?? null; // Page active

// Initialisation du contrôleur
$controller = null;
$method = null;

switch ($page) {
    default:
        $controller = '';
        $method = '';
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'App\\Controller\\' . $controller;
    $controllerObject = new $controllerClass($pdo);
    $controllerObject->$method();
} else {
    echo "404 Not Found"; // Faire une page plus jolie pour le not found
}
