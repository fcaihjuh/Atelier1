-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 03 nov. 2021 à 14:54
-- Version du serveur : 5.5.68-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dautecou5u`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`Id`, `Nom`, `Description`) VALUES
(1, 'Légume', '**'),
(2, 'Fruit', '**'),
(3, 'Produits laitiers', '**'),
(4, 'Viande', '**');

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `Id` int(11) NOT NULL,
  `Nom_client` varchar(25) NOT NULL,
  `Mail_client` varchar(50) NOT NULL,
  `Tel_client` int(10) NOT NULL,
  `Montant` double NOT NULL,
  `Etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Gerant`
--

CREATE TABLE `Gerant` (
  `Id` int(11) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Gerant`
--

INSERT INTO `Gerant` (`Id`, `Mail`, `Mdp`) VALUES
(1, 'test.gérant@mail.com', '123123'),
(2, 'chef@mail.com', '987987');

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `Id_produit` int(11) NOT NULL,
  `Id_Commande` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Producteur`
--

CREATE TABLE `Producteur` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Localisation` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Producteur`
--

INSERT INTO `Producteur` (`Id`, `Nom`, `Localisation`, `Mail`, `Mdp`) VALUES
(1, 'Marchal', 'Nancy', 'marchal@mail.com', '123456'),
(2, 'Dupond', 'Metz', 'dupond@mail.com', '147258'),
(3, 'Thierry', 'Strasbourg', 'thierry@mail.com', '000000');

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `Id` int(11) NOT NULL,
  `Id_Producteur` int(11) NOT NULL,
  `Id_Categorie` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Tarif_Unitaire` double NOT NULL,
  `Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`Id`, `Id_Producteur`, `Id_Categorie`, `Nom`, `Description`, `Tarif_Unitaire`, `Photo`) VALUES
(1, 2, 1, 'Salade', '**', 0.65, 'default.png\r\n'),
(2, 2, 2, 'Fraise', '**', 1.2, 'default.png'),
(3, 2, 2, 'Pomme', '**', 0.8, 'default.png'),
(4, 1, 1, 'Carotte', '**', 0.75, 'default.png'),
(5, 2, 2, 'Tomate', '**', 0.45, 'default.png'),
(6, 2, 2, 'Abricot', '**', 1.25, 'default.png'),
(7, 3, 4, 'Steak Haché', '**', 2.6, 'default.png'),
(8, 3, 4, 'Entrecôte', '**', 6.8, 'default.png'),
(9, 1, 2, 'Tomate', 'Bio', 1.4, 'default.png'),
(10, 1, 3, 'Camembert', '**', 2.1, 'default.png'),
(11, 1, 3, 'Emmental', '**', 2, 'default.png'),
(12, 1, 1, 'Roquette', 'Bio', 1.35, 'default.png'),
(13, 3, 4, 'Sauté de porc', '**', 4.2, 'default.png'),
(14, 3, 4, 'Jambon blanc', '**', 2.6, 'default.png'),
(15, 3, 4, 'Jambon de Parme', '**', 3.6, 'default.png'),
(16, 1, 2, 'Fraise ', 'Bio', 3.8, 'default.png'),
(17, 3, 4, 'Escalope de poulet', '**', 3.4, 'default.png'),
(18, 3, 4, 'Merguez', '**', 2.3, 'default.png'),
(19, 2, 3, 'Fromage blanc', '**', 3.1, 'default.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Gerant`
--
ALTER TABLE `Gerant`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD KEY `Id_produit` (`Id_produit`),
  ADD KEY `Id_Commande` (`Id_Commande`);

--
-- Index pour la table `Producteur`
--
ALTER TABLE `Producteur`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Producteur` (`Id_Producteur`) USING BTREE,
  ADD KEY `fk_Categorie` (`Id_Categorie`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Gerant`
--
ALTER TABLE `Gerant`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Producteur`
--
ALTER TABLE `Producteur`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD CONSTRAINT `Panier_ibfk_1` FOREIGN KEY (`Id_produit`) REFERENCES `Produit` (`Id`),
  ADD CONSTRAINT `Panier_ibfk_2` FOREIGN KEY (`Id_Commande`) REFERENCES `Commande` (`Id`);

--
-- Contraintes pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD CONSTRAINT `Produit_ibfk_1` FOREIGN KEY (`Id_Producteur`) REFERENCES `Producteur` (`Id`),
  ADD CONSTRAINT `Produit_ibfk_2` FOREIGN KEY (`Id_Categorie`) REFERENCES `Categorie` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
