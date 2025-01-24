<?php
namespace App\Controller;

class CarteInteractive extends Controller
{
    
    private function CarteInteractive() {
        // Afficher la page d'accueil
        echo $this->renderView('CarteInteractive.twig');
    }
}