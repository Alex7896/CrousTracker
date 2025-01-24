<?php
namespace App\Controller;

class Connexion extends Controller
{
    
    private function Connexion() {
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

}