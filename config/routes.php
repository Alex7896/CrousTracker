<?php
use App\Controller;

// Récupérer les paramètres de l'URL
$page = $_GET['page'] ?? null; // Page active

// Initialisation du contrôleur
$controller = 'Controller';
$method = 'Connexion';

switch ($page) {
    case 'Connexion':
        $controller = 'Controle';
        $method = 'Connexion';
        break;

    default:
        $controller = 'Controle';
        $method = 'Connexion';
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'App\\Controller\\' . $controller;
    $controllerObject = new $controllerClass($pdo);

    //si methode need id d'utilsateur de la base de donne alors retour aussi l'id
    if ($page == 'Connexion') {
        $controllerObject->$method($id);
    }else{
        $controllerObject->$method();$controllerObject->$method();
    }
    
} else {
    echo "404 Not Found"; // Faire une page plus jolie pour le not found
}
