<?php
namespace App\Model;

class User
{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Vérifie si l'utilisateur existe et si le mot de passe est correct
    public function checkUser($login, $mdp)
    {
        $stmt = $this->pdo->prepare("SELECT IdUser, mdp FROM user WHERE login = ?");
        $stmt->execute([$login]);
        $res = $stmt->fetch();

        // Vérifie si l'utilisateur existe et si le mot de passe est correct
        if ($res && password_verify($mdp, $res['mdp'])) {
            return $res['IdUser'];
        }
        return null;
    }

    // Ajoute un nouvel utilisateur avec un mot de passe sécurisé
    public function addUser($login, $mdp, $nom, $prenom) {
        $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT); // Hash sécurisé

        $stmt = $this->pdo->prepare("INSERT INTO user (login, mdp, nom, prenom) VALUES (?, ?, ?, ?)");
        $stmt->execute([$login, $hashedPassword, $nom, $prenom]);

        return (int) $this->pdo->lastInsertId();
    }
}
