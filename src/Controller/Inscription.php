<?php
namespace App\Controller;

class Inscription extends Controller
{
    
    private function Inscription() {
        // Ajouter un utilisateur (demande de POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //a modifier selon la base de donne qu'on veut creer pour un utilisateur
            $Nom = $_POST['nom_etudiant'];
            $Prenom = $_POST['prenom_etudiant'];
            $NumeroEtudiant = $_POST['numero_etudiant'];
            $Login = $_POST['login'];
            $Mdp = $_POST['mdp'];

            $this->Model1->createUser($Nom, $Prenom, $Login, $Mdp, $NumeroEtudiant);
            header("Location: /projet-info-web/public/index.php?action=Stagiaire");
        } else {
            echo $this->renderView('StagiaireAjout.twig');
        }
    }

}