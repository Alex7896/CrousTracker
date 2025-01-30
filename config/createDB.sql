-- Création de la base de données
CREATE DATABASE IF NOT EXISTS crous_tracker;

-- Utilisation de la base de données
USE crous_tracker;

-- Création de la table user
CREATE TABLE user
(
    IdUser INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique pour chaque utilisateur
    login  VARCHAR(64)  NOT NULL,          -- Nom d'utilisateur (unique si nécessaire)
    mdp    VARCHAR(255) NOT NULL,          -- Mot de passe
    nom    VARCHAR(64)  NOT NULL,          -- Nom de l'utilisateur
    prenom VARCHAR(64)  NOT NULL           -- Prénom de l'utilisateur
);

-- Création de la table avis
CREATE TABLE avis
(
    IdAvis           INT AUTO_INCREMENT PRIMARY KEY,                -- Identifiant unique pour chaque avis
    date_publication DATETIME NOT NULL,                             -- Date de publication de l'avis
    IdUser           INT      NOT NULL,                             -- Référence à l'utilisateur qui a publié l'avis
    IdRestaurant     INT      NOT NULL,
    note             DECIMAL(3, 2) CHECK (Note BETWEEN 1 AND 5),    -- Note entre 1 et 5
    commentaire      TEXT,                                          -- Contenu du commentaire
    FOREIGN KEY (IdUser) REFERENCES User (IdUser) ON DELETE CASCADE -- Relation avec la table User
);

-- Création de la table restaurant
CREATE TABLE restaurant
(
    IdRestaurant INT AUTO_INCREMENT PRIMARY KEY,
    type         VARCHAR(255)  NOT NULL,
    nom          VARCHAR(255)  NOT NULL,
    adresse      VARCHAR(255)  NOT NULL,
    latitude     DECIMAL(9, 6) NOT NULL,
    longitude    DECIMAL(9, 6) NOT NULL,
    urlApi       VARCHAR(255)  NOT NULL,
    moyenneAvis  DECIMAL(3, 2)
);

-- Trigger qui recalcule la moyenne d'un restaurant a chaque ajout d'un avis
DELIMITER $$

CREATE TRIGGER update_moyenne_avis
    AFTER INSERT
    ON avis
    FOR EACH ROW
BEGIN
    DECLARE new_moyenne DECIMAL(3, 2);

    -- Calcul de la nouvelle moyenne des avis pour le restaurant concerné
    SELECT AVG(note)
    INTO new_moyenne
    FROM avis
    WHERE IdRestaurant = NEW.IdRestaurant;

    -- Mise à jour de la moyenne des avis dans la table restaurant
    UPDATE restaurant
    SET moyenneAvis = new_moyenne
    WHERE IdRestaurant = NEW.IdRestaurant;
END $$

DELIMITER ;


INSERT INTO user (login, mdp, nom, prenom)
VALUES ('user1', 'password1', 'Dupont', 'Jean'),
       ('user2', 'password2', 'Martin', 'Sophie'),
       ('user3', 'password3', 'Lemoine', 'Paul'),
       ('user4', 'password4', 'Durand', 'Emma'),
       ('user5', 'password5', 'Morel', 'Lucas'),
       ('user6', 'password6', 'Rousseau', 'Clara'),
       ('user7', 'password7', 'Fournier', 'Thomas'),
       ('user8', 'password8', 'Blanc', 'Elise'),
       ('user9', 'password9', 'Garnier', 'Hugo'),
       ('user10', 'password10', 'Lambert', 'Alice');


INSERT INTO avis (date_publication, IdUser, IdRestaurant, note, commentaire)
VALUES
-- Avis positifs pour le Restaurant 1
('2024-01-20 12:30:00', 1, 1267, 5.0, 'Une expérience exceptionnelle ! Tout était parfait.'),
('2024-01-21 13:45:00', 2, 1267, 4.9, 'Service rapide et nourriture délicieuse.'),
('2024-01-22 18:10:00', 3, 1267, 5.0, 'Meilleur restaurant de la ville !'),
('2024-01-23 19:20:00', 4, 1267, 4.8, 'Accueil chaleureux et plats exquis.'),
('2024-01-24 12:15:00', 5, 1267, 5.0, 'Je recommande à 100 %, un pur régal !'),
('2024-01-25 14:40:00', 6, 1267, 4.7, 'Très belle expérience culinaire.'),
('2024-01-26 11:50:00', 7, 1267, 5.0, 'Les saveurs sont incroyables !'),
('2024-01-27 17:30:00', 8, 1267, 4.9, 'Superbe ambiance et plats raffinés.'),
('2024-01-28 13:00:00', 9, 1267, 5.0, 'Un service impeccable et une cuisine divine.'),
('2024-01-29 18:45:00', 10, 1267, 4.8, 'Délicieux et excellent rapport qualité-prix.'),
('2024-01-30 12:35:00', 1, 1267, 5.0, 'Tout était parfait ! J\'y retournerai.'),
('2024-01-31 15:10:00', 2, 1267, 4.9, 'Un restaurant à ne pas manquer !'),
('2024-02-01 11:25:00', 3, 1267, 5.0, 'Cuisine authentique et raffinée.'),
('2024-02-02 16:55:00', 4, 1267, 4.7, 'Le personnel est très accueillant.'),
('2024-02-03 12:10:00', 5, 1267, 5.0, 'Je recommande vivement ce restaurant !'),
('2024-02-04 14:20:00', 6, 1267, 4.8, 'Une adresse incontournable.'),
('2024-02-05 13:40:00', 7, 1267, 5.0, 'Expérience inoubliable !'),
('2024-02-06 17:05:00', 8, 1267, 4.9, 'Les plats sont d\'une grande finesse.'),
('2024-02-07 12:50:00', 9, 1267, 5.0, 'Le top du top ! Rien à redire.'),
('2024-02-08 18:30:00', 10, 1267, 4.8, 'J\'ai adoré chaque bouchée !'),
('2024-02-09 12:30:00', 1, 1267, 5.0, 'Une explosion de saveurs !'),
('2024-02-10 13:45:00', 2, 1267, 4.9, 'Service impeccable et repas délicieux.'),
('2024-02-11 18:10:00', 3, 1267, 5.0, 'À refaire sans hésitation !'),
('2024-02-12 19:20:00', 4, 1267, 4.8, 'Plats copieux et savoureux.'),
('2024-02-13 12:15:00', 5, 1267, 5.0, 'Juste parfait !'),
('2024-02-14 14:40:00', 6, 1267, 4.7, 'Un cadre agréable et une cuisine succulente.'),
('2024-02-15 11:50:00', 7, 1267, 5.0, 'L\'adresse idéale pour un bon repas.'),
('2024-02-16 17:30:00', 8, 1267, 4.9, 'Un pur bonheur pour les papilles !'),
('2024-02-17 13:00:00', 9, 1267, 5.0, 'Meilleur restaurant du quartier !'),
-- Avis négatifs pour le Restaurant 2
('2024-01-20 12:30:00', 1, 242, 1.5, 'Très décevant, service lent et plats insipides.'),
('2024-01-21 13:45:00', 2, 242, 1.0, 'Une catastrophe, nourriture immangeable.'),
('2024-01-22 18:10:00', 3, 242, 1.3, 'Expérience médiocre du début à la fin.'),
('2024-01-23 19:20:00', 4, 242, 1.2, 'Le pire restaurant où j\'ai mangé.'),
('2024-01-24 12:15:00', 5, 242, 1.5, 'Nourriture sans goût et ambiance glaciale.'),
('2024-01-25 14:40:00', 6, 242, 1.0, 'Service inexistant et plats mal cuits.'),
('2024-01-26 11:50:00', 7, 242, 1.3, 'Déception totale, ne mérite pas une étoile.'),
('2024-01-27 17:30:00', 8, 242, 1.4, 'Attente interminable pour des plats insipides.'),
('2024-01-28 13:00:00', 9, 242, 1.2, 'Évitez ce restaurant à tout prix !'),
('2024-01-29 18:45:00', 10, 242, 1.5, 'Rapport qualité-prix déplorable.'),
('2024-01-30 12:35:00', 1, 242, 1.1, 'Cuisine industrielle sans intérêt.'),
('2024-01-31 15:10:00', 2, 242, 1.3, 'Plats froids et service désagréable.'),
('2024-02-01 11:25:00', 3, 242, 1.0, 'Une honte pour la gastronomie !'),
('2024-02-02 16:55:00', 4, 242, 1.2, 'Nourriture insipide et trop chère.'),
('2024-02-03 12:10:00', 5, 242, 1.4, 'Endroit à éviter absolument !'),
('2024-02-04 14:20:00', 6, 242, 1.3, 'Une grosse arnaque.'),
('2024-02-05 13:40:00', 7, 242, 1.1, 'Rien n\'était bon, très mauvaise expérience.'),
('2024-02-06 17:05:00', 8, 242, 1.2, 'Mauvaise ambiance et plats immangeables.'),
('2024-02-07 12:50:00', 9, 242, 1.0, 'Le pire repas de ma vie !'),
('2024-02-08 18:30:00', 10, 242, 1.1, 'Un scandale, je déconseille vivement.');