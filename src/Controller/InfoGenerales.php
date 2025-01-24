<?php
namespace App\Controller;

class InfoGenerales extends Controller
{
    
    private function InfoGenerales() {
        // Afficher la page d'accueil
        echo $this->renderView('InfoGenerales.twig');
    }

}