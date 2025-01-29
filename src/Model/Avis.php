<?php

namespace App\Model;

class Avis
{
// fonction pour fetch toutes les données des reviews google maps
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAvis($id) {
        $stmt = $this->pdo->prepare("SELECT a.*, u.nom, u.prenom FROM avis a JOIN user u ON a.IdUser = u.IdUser WHERE IdRestaurant = ? ORDER BY date_publication DESC");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function ajouterAvis($IdUser, $note, $comment, $id) {
        $stmt = $this->pdo->prepare("
        INSERT INTO avis (IdUser, note, commentaire, IdRestaurant, date_publication) 
        VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$IdUser, $note, $comment, $id]);
    }
}