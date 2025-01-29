<?php
namespace App\Controller;

use App\Model\Restaurant;

class AccueilMapController extends BaseController
{
    private $restaurantModel;

    public function __construct($pdo){
        $this->restaurantModel = new Restaurant($pdo);
    }
    public function index() {
        //affichage de la page d'accueil

        $this->renderView('accueilMap.twig', ['restaurants' => $this->restaurantModel->getRestaurants()]);
    }
}
