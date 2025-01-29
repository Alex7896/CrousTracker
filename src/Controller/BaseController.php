<?php

namespace App\Controller;

class BaseController
{

    protected function renderView($view, $data = [])
    {
        // Fonction pour commune pour rendre une vue avec les données associées
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['isLogged'])) {
            $data['isLogged'] = $_SESSION['isLogged'];
            $data['IdUser'] = $_SESSION['IdUser'];
        }

        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($view, $data);
    }
}