<?php
namespace App\Controller;
use App\Model\Model1;

class Controller
{
    protected function renderView($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader('../src/vue');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
}