<?php

namespace App\Controller;

class BaseController
{

    // Fonction commune à tous les controller permettant de render une vue twig
    protected function renderView($view, $data = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Fait passer dans les données twig si l'utilisateur est connecté, avec son Id
        if (isset($_SESSION['isLogged'])) {
            $data['isLogged'] = $_SESSION['isLogged'];
            $data['IdUser'] = $_SESSION['IdUser'];
        }

        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($view, $data);
    }
}