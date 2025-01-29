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

    // Fonction qui affiche la page des détails
    public function afficherDetails($id)
    {
        $this->renderView('infoCrous/details.twig', ['restaurant' => $this->restaurantModel->getRestaurantDetails($id)]);
    }

    // Fonction permettant d'ajouter un avis
    public function ajouterAvis($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $IdUser = $_POST['IdUser'];
            $note = $_POST['note'];
            $comment = $_POST['comment'];

            $this->avisModel->ajouterAvis($IdUser, $note, $comment, $id);
        }

        header('Location: index.php?page=avis&id=' . $id);
    }

    // Fonction qui affiche la page des menus
    public function afficherMenu($id)
    {
        $menu = $this->restaurantModel->getMenu($id);
        $this->renderView('infoCrous/menu.twig', ['menu' => $menu]);
    }

    // Fonction qui affiche la page des avis
    public function afficherAvis($id)
    {
        $avis = $this->avisModel->getAvis($id);

        $moyenneAvis = $this->restaurantModel->getMoyenneAvis($id);
        $this->renderView('infoCrous/avis.twig', ['avis' => $avis, 'moyenneAvis' => $moyenneAvis]);
    }
}