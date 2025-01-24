<?php
namespace App\Controller;

class Deconection extends Controller
{
    
    private function Deconection() {
        // Afficher la page d'accueil
        echo $this->renderView('Deconection.twig');
    }

}