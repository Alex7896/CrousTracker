<?php

namespace App\Controller;

class ConnexionController extends BaseController
{
    public function index() {
        // Afficher la page d'accueil
        $this->renderView('connexion.twig');
    }
}