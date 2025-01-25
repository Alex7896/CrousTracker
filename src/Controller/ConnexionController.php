<?php

namespace App\Controller;

use App\Model\User;

class ConnexionController extends BaseController
{
    private $UserModel;

    public function __construct($pdo){
        $this->UserModel = new User($pdo);
    }



    public function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            if($this->UserModel->checkUser($login, $mdp)){
                session_start();
                $_SESSION['isLogged'] = true;
                header('Location: index.php?page=accueil');
                exit();
            } else {
                $this->renderView('connexion.twig', ['erreur' => 'login, mot de passe ou role incorrect']);
            }
        } else {
            $this->renderView('connexion.twig');
        }
    }


}