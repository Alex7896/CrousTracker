<?php
namespace App\Controller;

class Avis extends Controller
{
    
    private function Avis() {
        // Afficher la page d'accueil  
        echo $this->renderView('Avis.twig');
    }

}
