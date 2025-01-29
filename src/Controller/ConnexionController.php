<?php

namespace App\Controller;

use App\Model\User;

/**
 * Classe ConnexionController
 *
 * Cette classe gère l'authentification des utilisateurs, y compris la connexion, l'inscription et la déconnexion.
 * Elle interagit avec le modèle User pour vérifier et enregistrer les utilisateurs en base de données.
 */
class ConnexionController extends BaseController
{
    private $userModel;

    /**
     * Constructeur
     *
     * Initialise le contrôleur avec une instance du modèle User.
     *
     * @param \PDO $pdo Connexion à la base de données.
     */
    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    /**
     * Gère la connexion des utilisateurs.
     *
     * - Vérifie si un formulaire POST a été soumis.
     * - Valide les informations d'identification.
     * - Démarre une session et stocke l'ID utilisateur si la connexion est réussie.
     * - Redirige l'utilisateur vers la page précédente après connexion.
     * - Affiche un message d'erreur en cas d'échec.
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            $IdUser = $this->userModel->checkUser($login, $mdp);

            if ($IdUser) {
                session_start();
                $_SESSION['isLogged'] = true;
                $_SESSION['IdUser'] = $IdUser;

                header('Location: ' . $_SESSION['referer']);
                exit();
            } else {
                $this->renderView('connexion.twig', ['erreur' => 'Login ou mot de passe incorrect']);
            }
        } else {
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referer = $_SERVER['HTTP_REFERER'];
                session_start();
                $_SESSION['referer'] = $referer;
            }

            $this->renderView('connexion.twig');
        }
    }

    /**
     * Gère l'inscription des nouveaux utilisateurs.
     *
     * - Vérifie si un formulaire POST a été soumis.
     * - Ajoute l'utilisateur en base de données.
     * - Démarre une session et connecte l'utilisateur après l'inscription.
     * - Redirige l'utilisateur vers la page précédente.
     */
    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];

            $IdUser = $this->userModel->addUser($login, $mdp, $prenom, $nom);

            session_start();
            $_SESSION['isLogged'] = true;
            $_SESSION['IdUser'] = $IdUser;

            header('Location: ' . $_SESSION['referer']);
        } else {
            $this->renderView('inscription.twig');
        }
    }

    /**
     * Gère la déconnexion des utilisateurs.
     *
     * - Supprime les informations de session de l'utilisateur.
     * - Redirige vers la page de connexion.
     */
    public function deconnexion()
    {
        session_start();
        $_SESSION['isLogged'] = false;
        $_SESSION['IdUser'] = null;
        header('Location: index.php?page=connexion');
    }
}
