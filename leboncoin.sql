-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 fév. 2023 à 08:13
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leboncoin`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Vehicules'),
(2, 'Mode'),
(3, 'Multimedia'),
(4, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `idp` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ids` int(11) NOT NULL,
  `Image` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idc` int(11) NOT NULL,
  PRIMARY KEY (`idp`),
  KEY `idu` (`idu`),
  KEY `ids` (`ids`),
  KEY `idc` (`idc`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`idp`, `idu`, `name`, `description`, `price`, `ids`, `Image`, `idc`) VALUES
(14, 15, 'xbox', 'omg ceci est une xbox', '123', 1, 'xbox.jpg', 3),
(15, 15, 'manteau', 'manteau chinois', '123', 2, 'manteau.png', 2),
(16, 15, 'ps5', 'cooooool', '123424', 2, 'ps5.jpg', 3),
(17, 23, 'asfasdfsa', 'sadfasd', '2423', 1, 'asfasdfsa.png', 3),
(18, 15, 'pistache de guerre', 'woaw mais cen\'est pas une pistache', '123', 2, 'pistache de guerre.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`id`, `nom`) VALUES
(1, 'Comme neuf'),
(2, 'Bon etat'),
(3, 'Mauvais etat');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `mail` varchar(100) CHARACTER SET latin1 NOT NULL,
  `PP` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `PP`) VALUES
(15, 'popo', '$2y$10$tv9JKxcld6hmpdcVjpVEr.y74igx5ZBlEAYJdPupSGgiOjQnXKp7i', 'popo@popo', ''),
(23, 'name', '$2y$10$ZKbuyH/.O6FdpNc6pq40TegafMA.NVwh5aScCHhpnzzlM6KJd7vmW', 'name@name', 'name'),
(24, 'name', '$2y$10$kLmgxEA.GqiwzMTqtx1gP.xHxi843a4zhEMu0lj7Qbq35mPMAamjO', 'name@name', 'name'),
(25, 'name', '$2y$10$nF1Q0LLahQOzLoM/Aph0GeAjNq8PhYrS2UL1Sl9tYOkK4xrx4AGOy', 'name@name', 'name'),
(26, 'picpac@q', '$2y$10$JQ/w9cMLVfn03na3uGWLbuUZH3wWCw7MuhvUzfst/7tXTlV1dap5S', 'picpac@q', 'picpac@q.png'),
(27, 'Pistache', '$2y$10$0RATqHu4xDIrB9yiqvmgd.vBtpaBK9LU7tfRLNHVgS4vBicf1i.um', 'pistache@pistache.pistache', 'Pistache.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ids`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`idc`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
