<?php
use App\Controller;

// Récupérer les paramètres de l'URL
$page = $_GET['page'] ?? null; // Page active
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

// Initialisation du contrôleur
$controller = null;
$method = null;
switch ($page) {
    case 'connexion':
        $controller = 'ConnexionController';
        switch ($action) {
            case 'deconnexion':
                $method = 'deconnexion';
                break;
            case 'inscription':
                $method = 'inscription';
                break;
            default:
                $method = 'index';
                break;
        }
        break;
    case 'classement':
        $controller = 'ClassementController';
        $method = 'index';
        break;
    case 'actualiser':
        $controller = 'ActualiserController';
        $method = 'index';
        break;
    case 'details':
        $controller = 'InfoCrousController';
        $method = 'afficherDetails';
        break;
    case 'menu':
        $controller = 'InfoCrousController';
        $method = 'afficherMenu';
        break;
    case 'avis':
        $controller = 'InfoCrousController';
        switch ($action) {
            case 'ajouter':
                $method = 'ajouterAvis';
                break;
            default:
                $method = 'afficherAvis';
                break;
        }
        break;
    default:
        $controller = 'AccueilMapController';
        $method = 'index';
        break;
}
// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'App\\Controller\\' . $controller;
    $controllerObject = new $controllerClass($pdo);
    if(isset($id)) {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}