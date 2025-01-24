<?php

namespace App\Controller;

class BaseController
{
    protected function renderView($view, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($view, $data);
    }
}