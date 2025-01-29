<?php

namespace App\Model;

class Avis
{
    private $pdo;

    // Constructeur : Initialise la connexion à la base de données via PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupère tous les avis d'un restaurant donné, en joignant les informations de l'utilisateur
    public function getAvis($id) {
        $stmt = $this->pdo->prepare("SELECT a.*, u.nom, u.prenom FROM avis a JOIN user u ON a.IdUser = u.IdUser WHERE IdRestaurant = ? ORDER BY date_publication DESC");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    // Ajoute un nouvel avis pour un restaurant avec une note et un commentaire, en enregistrant la date actuelle
    public function ajouterAvis($IdUser, $note, $comment, $id) {
        $stmt = $this->pdo->prepare("
        INSERT INTO avis (IdUser, note, commentaire, IdRestaurant, date_publication) 
        VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$IdUser, $note, $comment, $id]);
    }
}
