<?php
namespace App\Controller;

class Classement extends Controller
{
    
    private function Classement() {
        // Afficher la page d'accueil
        echo $this->renderView('Classement.twig');
    }

}