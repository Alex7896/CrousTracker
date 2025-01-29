# CrousTracker

### Fonctionnalités
*** 
* Localisation des restaurants et caféterias Crous en France  
* Affichage du classement des Crous
* Possibilité de se connecter à l'application afin de publier un avis
* Affichage des détails des addresses Crous
* Consultation du menu de la semaine


### Utilisation 
***

Avant de commencer, assurez-vous d'avoir installé **XAMPP** (incluant Apache et MySQL)

1. Cloner le dépôt Git : Clonez le projet depuis le dépôt Git et placez-le dans le dossier `C:\xampp\htdocs`.
2. Démarrer XAMPP.
3. Dans le **panneau de contrôle XAMPP**, démarrez :
   - **Apache** (serveur web)
   - **MySQL** (base de données)
4. Configuration de la base de données :
   - Allez sur [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Importez le script `createDB.sql`
5. La configuration est terminée. 🎉 Vous pouvez maintenant utiliser le site web depuis votre navigateur.
6. Une fois sur le site web de CrousTracker, n'oubliez pas d'actualiser les données des restaurants avec le bouton actualiser.


### Organisation de l'archive
***

* [`config`](https://github.com/Alex7896/WordFinder/tree/main/config) : Contient les fichiers de configuration du site
  * [`database.php`](https://github.com/Alex7896/WordFinder/blob/main/config/database.php) : Connexion à la BDD
  * [`routes.php`](https://github.com/Alex7896/WordFinder/blob/main/config/routes.php) : Routage vers les différentes pages
* [`public`](https://github.com/Alex7896/WordFinder/tree/main/public) : Contient les fichiers publiques du site
  * [`css`](https://github.com/Alex7896/WordFinder/tree/main/public/css) : Feuilles CSS
  * [`icons`](https://github.com/Alex7896/WordFinder/tree/main/public/icons) : Icones utilisés
  * [`js`](https://github.com/Alex7896/WordFinder/tree/main/public/js) : Scripts JavaScript
  * [`index.php`](https://github.com/Alex7896/WordFinder/blob/main/public/index.php) : Point d'entrée du site
* [`src`](https://github.com/Alex7896/WordFinder/tree/main/src) : Contient les sources du site web, suivant le modèle MVC
  * [`Controller`](https://github.com/Alex7896/WordFinder/tree/main/src/Controller) : Intéraction avec le _**Model**_ et choisit la _**View**_ à afficher
  * [`Model`](https://github.com/Alex7896/WordFinder/tree/main/src/Model) : Gestion des données et intéraction avec la BDD 
  * [`View`](https://github.com/Alex7896/WordFinder/tree/main/src/View) : Interface graphique du site 
* [`vendor`](https://github.com/Alex7896/WordFinder/tree/main/vendor) : Contient tous les fichiers de symfony/twig


### Membres
***

AILLAUD Romain  
MAITRE Alexandre  
RAKATOARISOA Housni  
DELAVEAUD Quentin  
Donzel Quentin  
