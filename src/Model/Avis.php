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
        $stmt = $this->pdo->prepare("SELECT * FROM avis WHERE IdRestaurant = ? ORDER BY date_publication DESC");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}