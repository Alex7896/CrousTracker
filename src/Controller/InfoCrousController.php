<?php
namespace App\Controller;

use App\Model\Avis;
use App\Model\Restaurant;

class InfoCrousController extends BaseController
{
    private $restaurantModel;
    private $avisModel;

    public function __construct($pdo) {
        $this->restaurantModel = new Restaurant($pdo);
        $this->avisModel = new Avis($pdo);
    }

    public function afficherDetails() { //a rajouter $id en parametre
        $this->renderView('infoCrous/details.twig');
    }

    public function afficherMenu() {
        $this->renderView('infoCrous/menu.twig');
    }

    public function afficherAvis() {
        $this->renderView('infoCrous/avis.twig');
    }
}