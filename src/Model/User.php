<?php
namespace App\Model;

class User
{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function checkUser($login, $mdp): bool
    {
        $stmt = $this->pdo->prepare("SELECT IdUser FROM user WHERE login = ? AND mdp = ?");
        $stmt->execute([$login, $mdp]);
        return !empty($stmt->fetchAll());
    }
}