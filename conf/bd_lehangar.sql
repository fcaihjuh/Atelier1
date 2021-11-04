-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 nov. 2021 à 13:36
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_lehangar`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Id`, `Nom`, `Description`) VALUES
(1, 'Légume', '**'),
(2, 'Fruit', '**'),
(3, 'Produits laitiers', '**'),
(4, 'Viande', '**');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_client` varchar(25) NOT NULL,
  `Mail_client` varchar(50) NOT NULL,
  `Tel_client` int(10) NOT NULL,
  `Montant` double NOT NULL,
  `Etat` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

DROP TABLE IF EXISTS `gerant`;
CREATE TABLE IF NOT EXISTS `gerant` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`Id`, `Nom`, `Mail`, `Mdp`) VALUES
(1, 'Etienne', 'test.gérant@mail.com', '123123'),
(2, 'Laurent', 'chef@mail.com', '987987');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `Id_Produit` int(11) NOT NULL,
  `Id_Commande` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  PRIMARY KEY (`Id_Produit`,`Id_Commande`),
  KEY `Id_produit` (`Id_Produit`),
  KEY `Id_Commande` (`Id_Commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

DROP TABLE IF EXISTS `producteur`;
CREATE TABLE IF NOT EXISTS `producteur` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Localisation` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `producteur`
--

INSERT INTO `producteur` (`Id`, `Nom`, `Localisation`, `Mail`, `Mdp`) VALUES
(1, 'Marchal', 'Nancy', 'marchal@mail.com', '123456'),
(2, 'Dupond', 'Metz', 'dupond@mail.com', '147258'),
(3, 'Thierry', 'Strasbourg', 'thierry@mail.com', '000000'),
(4, 'Manceau', 'Verdun', 'manceau@mail.com', '555');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Producteur` int(11) NOT NULL,
  `Id_Categorie` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Tarif_Unitaire` double NOT NULL,
  `Photo` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Producteur` (`Id_Producteur`) USING BTREE,
  KEY `fk_Categorie` (`Id_Categorie`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id`, `Id_Producteur`, `Id_Categorie`, `Nom`, `Description`, `Tarif_Unitaire`, `Photo`) VALUES
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
(13, 3, 4, 'Saute de porc', '**', 4.2, 'default.png'),
(14, 3, 4, 'Jambon blanc', '**', 2.6, 'default.png'),
(15, 3, 4, 'Jambon de Parme', '**', 3.6, 'default.png'),
(16, 1, 2, 'Fraise ', 'Bio', 3.8, 'default.png'),
(17, 3, 4, 'Escalope de poulet', '**', 3.4, 'default.png'),
(18, 3, 4, 'Merguez', '**', 2.3, 'default.png'),
(19, 2, 3, 'Fromage blanc', '**', 3.1, 'default.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `Panier_ibfk_1` FOREIGN KEY (`Id_produit`) REFERENCES `produit` (`Id`),
  ADD CONSTRAINT `Panier_ibfk_2` FOREIGN KEY (`Id_Commande`) REFERENCES `commande` (`Id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `Produit_ibfk_1` FOREIGN KEY (`Id_Producteur`) REFERENCES `producteur` (`Id`),
  ADD CONSTRAINT `Produit_ibfk_2` FOREIGN KEY (`Id_Categorie`) REFERENCES `categorie` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
