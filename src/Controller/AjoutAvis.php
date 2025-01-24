<?php
namespace App\Controller;

class AjoutAvis extends Controller
{
    
    private function AjoutAvis() {
        // Afficher la page d'accueil  
        echo $this->renderView('AjoutAvis.twig');
    }

}
