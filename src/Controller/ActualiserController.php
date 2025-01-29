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
        $this->renderView('LLMtest.twig');
        //$this->restaurantModel->reload();
        //header('Location: index.php');
    }
}
