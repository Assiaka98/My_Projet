CREATE DATABASE  BDD_Commerce;
USE BDD_Commerce;
CREATE TABLE membre(
    id_membre INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(20) NOT NULL,
    mdp VARCHAR(32) NOT NULL,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    sexe ENUM('H','F') NOT NULL,
    ville VARCHAR(20) NOT NULL,
    cp INT(5) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    statut INT(1) NOT NULL DEFAULT 0,
    UNIQUE (pseudo)
)ENGINE = InnoDB;

CREATE TABLE produit(
    id_produit INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    referenc VARCHAR(20) NOT NULL,
    categorie VARCHAR(20) NOT NULL,
    titre VARCHAR(100) NOT NULL,
    descript TEXT NOT NULL,
    couleur VARCHAR(20) NOT NULL,
    taille VARCHAR(5) NOT NULL,
    public ENUM('M','F') NOT NULL,
    photo VARCHAR(250) NOT NULL,
    prix INT(3) NOT NULL,
    stock INT(3) NOT NULL,
    UNIQUE(referenc)
)ENGINE = InnoDB;

CREATE TABLE commande(
    id_commande INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_membre INT(3) NULL DEFAULT NULL,
    montant INT(3) NOT NULL,
    date_enreegistrement DATETIME NOT NULL,
    etat ENUM('en cours de traitement','envoye', 'livre')
)ENGINE = InnoDB;

CREATE TABLE details_commande(
    id_details_commande INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_commande INT(3) NOT NULL,
    id_produit INT(3) NOT NULL,
    quantite INT(3) NOT NULL,
    prix INT(3) NOT NULL
)ENGINE = InnoDB;
