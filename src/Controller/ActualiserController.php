<?php

namespace App\Controller;

use App\Model\Restaurant;

class ActualiserController extends BaseController
{
    private $restaurantModel;

    public function __construct($pdo) {
        $this->restaurantModel = new Restaurant($pdo);
    }

    // Fonction qui actualise les restaurants dans la BDD
    public function index()
    {
        $this->restaurantModel->reload();
        header('Location: index.php');
    }
}
