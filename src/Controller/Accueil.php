<?php
namespace App\Controller;

class Accueil extends Controller
{
    
    private function accueil() {
        // Afficher la page d'accueil
        echo $this->renderView('accueil.twig');
    }

}
