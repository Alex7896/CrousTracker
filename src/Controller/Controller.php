<?php
namespace App\Controller;

require_once '../config/database.php';

class Controller
{
    private function renderView($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader('../src/vue');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function accueil() {
        // Afficher la page d'accueil
        echo $this->renderView('accueil.twig');
    }

    public function AjoutAvis() {
        // Afficher la page d'accueil  
        echo $this->renderView('AjoutAvis.twig');
    }

    public function Avis() {
        // Afficher la page d'accueil  
        echo $this->renderView('Avis.twig');
    }

    public function CarteInteractive() {
        // Afficher la page d'accueil
        echo $this->renderView('CarteInteractive.twig');
    }

    public function Classement() {
        // Afficher la page d'accueil
        echo $this->renderView('Classement.twig');
    }

    public function Deconection() {
        // Afficher la page d'accueil
        echo $this->renderView('Deconection.twig');
    }

    public function InfoGenerales() {
        // Afficher la page d'accueil
        echo $this->renderView('InfoGenerales.twig');
    }

    public function Connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $role = $_POST['role'];
    
            try {
                
                //recuperation du login et du mot de passe de l'utilisateur
                $stmt = $this->pdo->prepare("SELECT * FROM professeur WHERE login = ? AND mdp = ?");
    
                $stmt->execute([$login, $mdp]);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    
                if ($user) {
                    $_SESSION['role'] = $role;
                    $_SESSION['login'] = $login;
                    // Si les identifiants sont corrects, redirection vers l'accueil
                    header('Location: index.php?action=Accueil');
                    exit;
                } else {
                    // Si les identifiants sont incorrects
                    $error_message = "Identifiant ou mot de passe incorrect.";
                    echo $this->renderView('accueilconnexion.twig', ['error_message' => $error_message]);
                }
            } catch (Exception $e) {
                // En cas d'erreur
                $error_message = "Erreur : " . $e->getMessage();
                echo $this->renderView('accueilconnexion.twig', ['error_message' => $error_message]);
            }
        } else {
            // Afficher simplement la page de connexion
            echo $this->renderView('accueilconnexion.twig');
        }
    }

    public function Inscription() {
        // Ajouter un utilisateur (demande de POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //a modifier selon la base de donne qu'on veut creer pour un utilisateur
            $Nom = $_POST['nom_etudiant'];
            $Prenom = $_POST['prenom_etudiant'];
            $NumeroEtudiant = $_POST['numero_etudiant'];
            $Login = $_POST['login'];
            $Mdp = $_POST['mdp'];

            $this->Prof1->createUser($Nom, $Prenom, $Login, $Mdp, $NumeroEtudiant);
            header("Location: /projet-info-web/public/index.php?action=Stagiaire");
        } else {
            echo $this->renderView('StagiaireAjout.twig');
        }
    }
}