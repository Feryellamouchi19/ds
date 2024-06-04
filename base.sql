CREATE DATABASE siteaycha;
USE siteaycha;

-- Table des clients
CREATE TABLE clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    telephone VARCHAR(20),
    email VARCHAR(100)
);

-- Table des articles
CREATE TABLE articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix_achat DECIMAL(10, 2) NOT NULL,
    prix_vente DECIMAL(10, 2) NOT NULL,
    taux_tva DECIMAL(5, 2) NOT NULL,
    quantite_stock INT NOT NULL
);

-- Table des commandes
CREATE TABLE commandes (
    commande_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    date_commande DATE NOT NULL,
    etat_commande ENUM('en attente', 'en cours de traitement', 'expediee', 'livree') NOT NULL,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

-- Table de liaison entre commandes et articles
CREATE TABLE commande_articles (
    commande_id INT,
    article_id INT,
    quantite INT,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    taux_tva DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (commande_id, article_id),
    FOREIGN KEY (commande_id) REFERENCES commandes(commande_id),
    FOREIGN KEY (article_id) REFERENCES articles(article_id)
);

-- Table des devis
CREATE TABLE devis (
    devis_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    date_devis DATE NOT NULL,
    etat_devis ENUM('en attente', 'accepte', 'refuse') NOT NULL,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

-- Table de liaison entre devis et articles
CREATE TABLE devis_articles (
    devis_id INT,
    article_id INT,
    quantite INT,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    taux_tva DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (devis_id, article_id),
    FOREIGN KEY (devis_id) REFERENCES devis(devis_id),
    FOREIGN KEY (article_id) REFERENCES articles(article_id)
);

-- Table des fournisseurs
CREATE TABLE fournisseurs (
    fournisseur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    telephone VARCHAR(20),
    email VARCHAR(100)
);

-- Table d'approvisionnement du stock
CREATE TABLE approvisionnement (
    approvisionnement_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    fournisseur_id INT NOT NULL,
    date_approvisionnement DATE NOT NULL,
    quantite_approvisionnee INT NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    taux_tva DECIMAL(5, 2) NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(fournisseur_id)
);
