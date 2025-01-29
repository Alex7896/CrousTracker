<?php

namespace App\Controller;

use App\Model\Restaurant;

class ActualiserController extends BaseController
{
    private $restaurantModel;

    public function __construct($pdo) {
        $this->restaurantModel = new Restaurant($pdo);
    }

    public function index()
    {
        //affichage de la page restaurants
        $this->restaurantModel->reload();
        header('Location: index.php');
    }
}
