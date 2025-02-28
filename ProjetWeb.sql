-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 28 avr. 2024 à 21:17
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ProjetWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Catalogue`
--

CREATE TABLE `Catalogue` (
  `id` int(11) NOT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `image` longblob,
  `nomProduit` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `groupe` int(250) DEFAULT NULL,
  `lien` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Catalogue`
--

INSERT INTO `Catalogue` (`id`, `Color`, `image`, `nomProduit`, `prix`, `groupe`, `lien`) VALUES
(6, 'Beige-Silver', 0x696d672f6e657762616c616e63652e77656270, 'New Balance 1906R', '109.99', 2, 0x70726f647569745f6e622e706870),
(7, 'Black-White-Tour Yellow', 0x696d672f6a6f7264616e342e77656270, 'Jordan 4 Retro', '149.99', 1, 0x70726f647569745f6a6f7264616e342e706870),
(17, 'White/ White-Metallic Silver-Max Orange', 0x696d672f73686f782e6a706567, 'Nike Shox TL', '169.99', 3, 0x70726f647569745f73686f782e706870),
(18, 'Black', 0x696d672f746e2e77656270, 'Nike Tuned 1', '189.99', 4, 0x70726f647569745f746e2e706870),
(19, 'Cream-Cream', 0x696d672f61736963732e77656270, 'Asics GEL-NYC', '149.99', 5, 0x70726f647569745f6173696373686f6d6d652e706870),
(20, 'Lt Iron Ore-Mtlc Sivler-Photon Dust', 0x696d672f6e696b652e77656270, 'Nike P-6000', '119.99', 6, 0x70726f647569745f6e696b6570362e706870),
(21, 'Black-Silver', 0x696d672f6c61636f73746566656d6d652e77656270, 'Lacoste L003 2K24', '159.99', 7, 0x70726f647569745f6c61636f73746566656d6d652e706870),
(22, 'Black-White', 0x696d672f63616d70757366656d6d652e61766966, 'ADIDAS CAMPUS 00S', '115.00', 8, 0x70726f647569745f63616d70757366656d6d652e706870),
(24, 'Black', 0x696d672f7567672e61766966, 'UGG Classic Ultra Mini', '175.00', 10, 0x70726f647569745f7567672e706870),
(25, 'Lt Iron Ore-Mtlc Sivler-Photon Dust', 0x696d672f6a6f7264616e31312e77656270, 'Jordan 11 Retro', '219.99', 11, 0x70726f647569745f6a313166656d6d652e706870),
(26, 'White', 0x696d672f616972666f7263652e77656270, 'Nike Air Force 1 Low Bébé', '65.00', 15, 0x70726f647569745f616972666f7263652e706870),
(28, 'White', 0x696d672f616469646173656e66616e742e77656270, 'Adidas Originals Ozweego Enfant', '65.00', 17, 0x70726f647569745f6f7a776565676f656e66616e742e706870),
(30, 'White-Hyper Violet', 0x696d672f6a6f7264616e626562652e77656270, 'Jordan AJ4 Retro', '64.99', 18, 0x70726f647569745f6a34626562652e706870),
(32, 'Black-Black', 0x696d672f6e6577626562652e77656270, 'New Balance 327', '69.99', 20, 0x70726f647569745f6e62656e66616e742e706870),
(33, 'Core Black-Core Black-Core Black', 0x696d672f6f7a656c69612e77656270, 'Adidas Ozelia', '59.99', 28, 0x70726f647569745f6f7a656c69612e706870),
(34, 'Deep Jungle-White-Light Silver', 0x696d672f64756e6b2e77656270, 'Nike Dunk Low', '59.99', 29, 0x70726f647569745f64756e6b2e706870),
(45, 'Beige-Silver', 0x696d672f617369637366656d6d652e77656270, 'Asics GEL-SONOMA', '129.99', 9, 0x70726f647569745f617369637366656d6d652e706870);

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `totalOrder` decimal(10,2) DEFAULT NULL,
  `livraison` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(10) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Commande`
--

INSERT INTO `Commande` (`orderID`, `userID`, `totalOrder`, `livraison`, `nom`, `prenom`, `adresse`, `ville`, `code_postal`, `pays`) VALUES
(5, 10, '149.99', 'standard', 'd', 'd', 'd', 'd', '0', 'd'),
(6, 10, '149.99', 'standard', 'd', 'd', 'd', 'd', '0', 'd'),
(14, 10, '149.99', 'standard', 'e', 'e', 'e', 'e', '0', 'e'),
(16, 10, '299.98', 'standard', 'n', 'n', 'n', 'n', '0', 'n'),
(17, 10, '319.98', 'standard', 'k', 'k', 'k', 'k', '0', 'k'),
(18, 9, '469.97', 'standard', 'd', 'd', 'd', 'd', '0', 'd'),
(19, 9, '149.99', 'standard', 'h', 'h', 'h', 'h', '0', 'z'),
(20, 8, '319.98', 'standard', 'melissa', 'barbie', '4 rue de barbie', 'binks', '93601', 'France'),
(21, 8, '319.98', 'express', 'nbvc', ' vc', '2 rue vhgf', 'jhgf', '93601', 'nhgbfvcd'),
(22, 8, '259.98', 'standard', 'yhgfd', ',jnhbgfv', 'kj,nhbgfv', 'k;j,hnbgfv', '0', 'j,hnbgvc'),
(23, 8, '1259.92', 'express', 'ghbjnk', ';,jhnbg', 'k,jnbgvf', 'l;k,jnhbg', '0', 'k;,jhnbgv'),
(24, 8, '1809.89', 'standard', 'fcdxs', 'fvcdxs', 'gvfcdxs', 'gvfcdxs', '0', 'gvfcdxs'),
(25, 9, '619.96', 'express', 'zehfbiz', 'ajhbzrfikcrz', 'dekbhehakfbeakf', 'aljfbaefaefuociaefaé', '0', 'zkbfhizf'),
(26, 9, '299.98', 'express', 'azdef', 'scfesf', 'sfvs', 'sfvbsb', '0', 'x bbdf'),
(27, 9, '124.99', 'express', 'd', 'd', 'd', 'd', '0', 'd'),
(28, 13, '115.00', 'standard', 'Remini', 'Melissa', 'dfghjk', 'ghjk', '93600', 'sdfghjk'),
(29, 13, '149.99', 'standard', 'f', 'd', 'd', 'd', '0', 'd'),
(30, 13, '149.99', 'standard', 'z', 'z', 'z', 'z', '0', 'z'),
(31, 13, '149.99', 'express', 'a', 'a', 'a', 'a', '0', 'a'),
(32, 13, '169.99', 'standard', 's', 's', 's', 's', '0', 's'),
(33, 13, '149.99', 'standard', 'a', 'a', 'a', 'a', '0', 'a'),
(34, 9, '65.00', 'express', 'd', 'd', 'd', 'd', '0', 'd');

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `panierID` int(11) NOT NULL,
  `totalPanier` decimal(10,3) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Panier`
--

INSERT INTO `Panier` (`panierID`, `totalPanier`, `userID`, `productID`, `quantite`) VALUES
(12, NULL, NULL, 2, 1),
(85, NULL, 12, 29, 2),
(86, NULL, 12, 66, 1),
(100, NULL, 9, 68, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `productID` int(20) NOT NULL,
  `nomProduit` varchar(100) DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `taille` decimal(3,1) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantite_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`productID`, `nomProduit`, `prix`, `taille`, `color`, `image`, `quantite_stock`) VALUES
(2, 'Jordan 4 Retro', '149.99', '41.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 197),
(3, 'Jordan 4 Retro', '149.99', '43.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 200),
(5, 'Jordan 4 Retro', '149.99', '39.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 194),
(8, 'New Balance 1906R', '109.99', '43.0', 'Beige-Silver', '/Projet_Php/img/newbalance.webp', 200),
(11, 'New Balance 1906R', '109.99', '37.0', 'Beige-Silver', '/Projet_Php/img/newbalance.webp', 200),
(13, 'New Balance 1906R', '109.99', '36.0', 'Beige-Silver', '/Projet_Php/img/newbalance.webp', 198),
(14, 'Jordan 4 Retro', '149.99', '40.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 200),
(15, 'Nike Shox TL', '169.99', '41.0', 'White/ White-Metallic Silver-Max Orange', '/Projet_Php/img/shox.jpeg', 189),
(16, 'Jordan 4 Retro', '149.99', '42.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 200),
(17, 'Jordan 4 Retro', '149.99', '36.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 184),
(18, 'Jordan 4 Retro', '149.99', '45.0', 'Black-White-Tour Yellow', '/Projet_Php/img/jordan4.webp', 199),
(20, 'Jordan 4 Retro', '149.99', '37.0', 'Black-White-Tour Yellow', 'img/jordan4.webp', 200),
(27, 'Jordan 4 Retro', '149.99', '38.0', 'Black-White-Tour Yellow', 'img/jordan4.webp', 198),
(28, 'Jordan 4 Retro', '149.99', '44.0', 'Black-White-Tour Yellow', 'img/jordan4.webp', 200),
(29, 'Nike Shox TL', '169.99', '36.0', 'White/ White-Metallic Silver-Max Orange', 'img/shox.jpeg', 194),
(30, 'Nike Shox TL', '169.99', '44.0', 'White/ White-Metallic Silver-Max Orange', 'img/shox.jpeg', 199),
(31, 'Nike Shox TL', '169.99', '38.0', 'White/ White-Metallic Silver-Max Orange', 'img/shox.jpeg', 200),
(51, 'Nike Air Force 1 Low Bébé', '65.00', '30.0', 'White', 'img/airforce.webp', 200),
(52, 'Nike Air Force 1 Low Bébé', '65.00', '32.0', 'White', 'img/airforce.webp', 200),
(53, 'Nike Air Force 1 Low Bébé', '65.00', '28.0', 'White', 'img/airforce.webp', 200),
(54, 'Nike Air Force 1 Low Bébé', '65.00', '29.0', 'White', 'img/airforce.webp', 200),
(55, 'Nike Air Force 1 Low Bébé', '65.00', '33.0', 'White', 'img/airforce.webp', 200),
(56, 'Nike Air Force 1 Low Bébé', '65.00', '36.0', 'White', 'img/airforce.webp', 200),
(57, 'New Balance 1906R', '109.99', '38.0', 'Beige-Silver', 'img/newbalance.webp', 200),
(58, 'Asics GEL-NYC', '149.99', '39.0', 'Cream-Cream', 'img/asics.webp', 200),
(59, 'Nike Tuned 1', '189.99', '41.0', 'Black', 'img/tn.webp', 200),
(60, 'Nike P-6000', '119.99', '42.0', 'Lt Iron Ore-Mtlc Sivler-Photon Dust', 'img/nike.webp', 200),
(61, 'Lacoste L003 2K24', '159.99', '36.0', 'Black-Silver', 'img/lacostefemme.webp', 200),
(62, 'UGG Classic Ultra Mini', '175.00', '40.0', 'Black', 'img/ugg.avif', 200),
(63, 'Jordan 11 Retro', '219.99', '40.0', 'Lt Iron Ore-Mtlc Sivler-Photon Dust', 'img/jordan11.webp', 200),
(64, 'Nike Air Force 1 Low Bébé', '65.00', '26.0', 'White', 'img/airforce.webp', 199),
(65, 'Adidas Ozelia', '59.99', '21.0', 'Core Black-Core Black-Core Black', 'img/ozelia.webp', 199),
(66, 'Adidas Originals Ozweego Enfant', '65.00', '21.0', 'White', 'img/adidasenfant.webp', 199),
(67, 'New Balance 327', '69.99', '21.0', 'Black-Black', 'img/newbebe.webp', 200),
(68, 'ADIDAS CAMPUS 00S', '115.00', '36.0', 'Black-White', 'img/campusfemme.avif', 199);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `userID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `addresse` varchar(100) DEFAULT NULL,
  `codePostal` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`userID`, `email`, `password`, `prenom`, `nom`, `addresse`, `codePostal`) VALUES
(7, 'remini.melissa@gmail.com', 'kjbezkjfb', 'melissa', 'remini', 'aulnay', 93600),
(8, 'amina@icloud.com', '222', 'Amina', 'Amina', 'jknldazl', 93390),
(9, 'sara@gmail.com', 'sara', 'Sara', 'Aïssa', '6 allée De gagny', 93390),
(10, 'zouane.amina@gmail.com', 'MPN93390', 'Amina', 'Zouane', '90 rue de Tolbiac', 75013),
(11, 'mina.zouane@gmail.com', '$2y$10$R3i8aF89DlZhBIRQ5QOr2.m1T7kCeANF0YuGtc9nV6nk0BSonueaa', 'Amina', 'Zouane', 'yuhb', 93270),
(12, 'aminaz@gmail.com', '$2y$10$kW9x21ThL/RZlMkYC0BXK.olVW.UTybVjG.R2ANQTAsoGBE8GlsIW', 'Amina', 'Zouane', '5 allée Pierre Ronsard', 93390),
(13, 'melissa.remini@gmail.com', '$2y$10$uBlCia8vW1KV12huV1HBjeRyB7ThaQ7oFuw7T8UUrrkl9b4ukndR2', 'Melissa', 'Remini', '5 rue de barbie', 93600);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Catalogue`
--
ALTER TABLE `Catalogue`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`panierID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`productID`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Catalogue`
--
ALTER TABLE `Catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `Panier`
--
ALTER TABLE `Panier`
  MODIFY `panierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utilisateur` (`userID`);

--
-- Contraintes pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utilisateur` (`userID`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `produit` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
