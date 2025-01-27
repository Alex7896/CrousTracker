<?php
namespace App\Controller;

use App\Model\Avis;
use App\Model\Restaurant;
use App\Model\User;

class InfoCrousController extends BaseController
{
    private $restaurantModel;
    private $avisModel;

    public function __construct($pdo) {
        $this->restaurantModel = new Restaurant($pdo);
        $this->avisModel = new Avis($pdo);
    }

    public function afficherDetails($id) {
        $this->renderView('infoCrous/details.twig', ['restaurant' =>$this->restaurantModel->getRestaurantDetails($id)]);
    }


    public function afficherMenu($id) {
        $menu = $this->restaurantModel->getMenu($id);
        $this->renderView('infoCrous/menu.twig', ['menu' => $menu]);
    }

    public function afficherAvis($id) {
        $avis = $this->avisModel->getAvis($id);

        $moyenneAvis = $this->restaurantModel->getMoyenneAvis($id);
        $this->renderView('infoCrous/avis.twig', ['avis' => $avis, 'moyenneAvis' => $moyenneAvis]);
    }
}