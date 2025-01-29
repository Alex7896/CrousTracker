<?php
namespace App\Controller;

use App\Model\Restaurant;

class AccueilMapController extends BaseController
{
    private $restaurantModel;

    public function __construct($pdo){
        $this->restaurantModel = new Restaurant($pdo);
    }

    // Fonction qui affiche la page d'accueil
    public function index() {
        $this->renderView('accueilMap.twig', ['restaurants' => $this->restaurantModel->getRestaurants()]);
    }
}
