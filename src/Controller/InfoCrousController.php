<?php

namespace App\Controller;

use App\Model\Avis;
use App\Model\Restaurant;
use App\Model\User;

class InfoCrousController extends BaseController
{
    private $restaurantModel;
    private $avisModel;

    public function __construct($pdo)
    {
        $this->restaurantModel = new Restaurant($pdo);
        $this->avisModel = new Avis($pdo);
    }

    public function afficherDetails($id)
    {
        //fait un rendu de la page détails
        $this->renderView('infoCrous/details.twig', ['restaurant' => $this->restaurantModel->getRestaurantDetails($id)]);
    }

    public function ajouterAvis($id)
    {
        //récupération des avis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $IdUser = $_POST['IdUser'];
            $note = $_POST['note'];
            $comment = $_POST['comment'];

            $this->avisModel->ajouterAvis($IdUser, $note, $comment, $id);
        }

        header('Location: index.php?page=avis&id=' . $id);
    }


    public function afficherMenu($id)
    {
        //affiche les menus
        $menu = $this->restaurantModel->getMenu($id);
        $this->renderView('infoCrous/menu.twig', ['menu' => $menu]);
    }

    public function afficherAvis($id)
    {
        // afiiche les avis du ru
        $avis = $this->avisModel->getAvis($id);

        $moyenneAvis = $this->restaurantModel->getMoyenneAvis($id);
        $this->renderView('infoCrous/avis.twig', ['avis' => $avis, 'moyenneAvis' => $moyenneAvis]);
    }
}