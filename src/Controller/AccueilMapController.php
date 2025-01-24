<?php
namespace App\Controller;

class AccueilMapController extends BaseController
{
    public function index() {
        // Afficher la page d'accueil
        $this->renderView('accueilMap.twig');
    }
}
