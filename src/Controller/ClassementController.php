<?php
namespace App\Controller;

use App\Model\Restaurant;

class ClassementController extends BaseController
{
    private $restaurantModel;

    public function __construct($pdo){
        $this->restaurantModel = new Restaurant($pdo);
    }
    public function index() {
        // le render de la page de classement
        $this->renderView('classement.twig',['restaurants'=>$this->restaurantModel->getRestaurants()]);
    }
}