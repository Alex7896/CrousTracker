<?php
namespace App\Controller;

class AccueilMapController extends BaseController
{
    public function index() {
        // Afficher la page d'accueil
        echo $this->renderView('accueilMap.twig');
    }
}
