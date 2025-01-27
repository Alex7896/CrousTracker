<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'crous_tracker';
$username = 'root'; // Remplace par ton utilisateur MySQL
$password = '';     // Remplace par ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer et exécuter la requête pour récupérer les restaurants
    $stmt = $pdo->prepare("
        SELECT IdRestaurant, nom, ville, latitude, longitude, moyenneAvis
        FROM restaurant
    ");
    $stmt->execute();

    // Récupérer les résultats sous forme de tableau associatif
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats en JSON
    header('Content-Type: application/json');
    echo json_encode($locations);

} catch (PDOException $e) {
    // En cas d'erreur, retourner un message d'erreur
    echo json_encode(['error' => $e->getMessage()]);
}
?>
