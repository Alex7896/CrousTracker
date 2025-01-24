-- Création de la base de données
CREATE DATABASE IF NOT EXISTS crous_tracker;

-- Utilisation de la base de données
USE crous_tracker;

-- Création de la table User
CREATE TABLE User (
                      IdUser INT AUTO_INCREMENT PRIMARY KEY, -- Identifiant unique pour chaque utilisateur
                      login VARCHAR(64) NOT NULL,           -- Nom d'utilisateur (unique si nécessaire)
                      mdp VARCHAR(255) NOT NULL,           -- Mot de passe
                      nom VARCHAR(64) NOT NULL,           -- Nom de l'utilisateur
                      prenom VARCHAR(64) NOT NULL           -- Prénom de l'utilisateur
);

-- Création de la table Avis
CREATE TABLE Avis (
                      IdAvis INT AUTO_INCREMENT PRIMARY KEY,  -- Identifiant unique pour chaque avis
                      date_publication DATE NOT NULL,         -- Date de publication de l'avis
                      IdUser INT NOT NULL,                    -- Référence à l'utilisateur qui a publié l'avis
                      Note INT CHECK (Note BETWEEN 1 AND 5),  -- Note entre 1 et 5
                      Commentaire TEXT,                       -- Contenu du commentaire
                      FOREIGN KEY (IdUser) REFERENCES User(IdUser) ON DELETE CASCADE -- Relation avec la table User
);