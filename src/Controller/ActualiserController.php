<?php

namespace App\Controller;

use App\Model\Restaurant;

class ActualiserController
{
    private $restaurantModel;

    public function __construct($pdo) {
        $this->restaurantModel = new Restaurant($pdo);
    }


    public function index()
    {
        $this->restaurantModel->reload();
        header('Location: ');
        //$command = 'python test.py';
        //exec($command, $out, $status);
        //var_dump($out);
    }
}
