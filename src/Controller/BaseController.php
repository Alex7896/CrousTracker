<?php

namespace App\Controller;

class BaseController
{
    protected function renderView($view, $data = [])
    {
        session_start();
        if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
            $data['isLogged'] = $_SESSION['isLogged'];
        }

        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($view, $data);
    }
}