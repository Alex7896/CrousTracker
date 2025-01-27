-- Création de la base de données
CREATE DATABASE IF NOT EXISTS crous_tracker;

-- Utilisation de la base de données
USE crous_tracker;

-- Création de la table user
CREATE TABLE user (
                      IdUser INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique pour chaque utilisateur
                      login VARCHAR(64) NOT NULL,           -- Nom d'utilisateur (unique si nécessaire)
                      mdp VARCHAR(255) NOT NULL,           -- Mot de passe
                      nom VARCHAR(64) NOT NULL,           -- Nom de l'utilisateur
                      prenom VARCHAR(64) NOT NULL           -- Prénom de l'utilisateur
);

-- Création de la table avis
CREATE TABLE avis (
                      IdAvis INT AUTO_INCREMENT PRIMARY KEY,  -- Identifiant unique pour chaque avis
                      date_publication DATE NOT NULL,         -- Date de publication de l'avis
                      IdUser INT NOT NULL,                    -- Référence à l'utilisateur qui a publié l'avis
                      IdRestaurant INT NOT NULL,
                      note DECIMAL(3, 2) CHECK (Note BETWEEN 1 AND 5),  -- Note entre 1 et 5
                      commentaire TEXT,                       -- Contenu du commentaire
                      FOREIGN KEY (IdUser) REFERENCES User(IdUser) ON DELETE CASCADE -- Relation avec la table User
);

-- Création de la table restaurant
CREATE TABLE restaurant (
                            IdRestaurant INT AUTO_INCREMENT PRIMARY KEY,
                            type VARCHAR(255) NOT NULL,
                            nom VARCHAR(255) NOT NULL,
                            adresse VARCHAR(255) NOT NULL,
                            latitude DECIMAL(9, 6) NOT NULL,
                            longitude DECIMAL(9, 6) NOT NULL,
                            urlApi VARCHAR(255) NOT NULL,
                            moyenneAvis DECIMAL(3, 2)
);


DELIMITER $$

CREATE TRIGGER update_moyenne_avis
    AFTER INSERT ON avis
    FOR EACH ROW
BEGIN
    DECLARE new_moyenne DECIMAL(3, 2);

    -- Calcul de la nouvelle moyenne des avis pour le restaurant concerné
    SELECT AVG(Note) INTO new_moyenne
    FROM avis
    WHERE IdRestaurant = NEW.IdRestaurant;

    -- Mise à jour de la moyenne des avis dans la table restaurant
    UPDATE restaurant
    SET moyenneAvis = new_moyenne
    WHERE IdRestaurant = NEW.IdRestaurant;
END $$

DELIMITER ;

