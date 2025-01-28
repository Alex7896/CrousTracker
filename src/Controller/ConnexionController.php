<?php

namespace App\Controller;

use App\Model\User;

class ConnexionController extends BaseController
{
    private $userModel;

    public function __construct($pdo){
        $this->userModel = new User($pdo);
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            $IdUser = $this->userModel->checkUser($login, $mdp);

            if($IdUser){
                session_start();
                $_SESSION['isLogged'] = true;
                $_SESSION['IdUser'] = $IdUser;
                header('Location: index.php?page=accueil');
                exit();
            } else {
                $this->renderView('connexion.twig', ['erreur' => 'login ou mot de passe incorrect']);
            }
        } else {
            $this->renderView('connexion.twig');
        }
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];

            $IdUser = $this->userModel->addUser($login, $mdp, $prenom, $nom);

            session_start();
            $_SESSION['isLogged'] = true;
            $_SESSION['IdUser'] = $IdUser;

            header('Location: index.php?page=accueil');
        } else {
            $this->renderView('inscription.twig');
        }
    }

    public function deconnexion()
    {
        session_start();
        $_SESSION['isLogged'] = false;
        $_SESSION['IdUser'] = null;
        header('Location: index.php?page=connexion');
    }
}