-- Création de la base de données
CREATE DATABASE IF NOT EXISTS devoir_securite;
USE devoir_securite;

-- Création de la table 'users'
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
);

-- Index pour améliorer les performances des recherches par email et pseudo
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_pseudo ON users(pseudo);