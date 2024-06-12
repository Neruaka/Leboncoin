-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 juin 2024 à 03:28
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

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
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'Véhicules', 'Tout ce qui concerne les véhicules, voitures, motos, etc.'),
(2, 'Mode', 'Articles de mode, vêtements, accessoires, etc.'),
(3, 'Multimédia', 'Produits électroniques, informatiques, téléphones, etc.'),
(4, 'Autres', 'Catégorie pour tout ce qui ne rentre pas dans les catégories précédentes.');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `message_text` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `idp` int NOT NULL AUTO_INCREMENT,
  `idu` int NOT NULL,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` mediumtext NOT NULL,
  `ids` int NOT NULL,
  `Image` varchar(1000) NOT NULL,
  `idc` int DEFAULT NULL,
  PRIMARY KEY (`idp`),
  KEY `idu` (`idu`),
  KEY `ids` (`ids`),
  KEY `idc` (`idc`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`idp`, `idu`, `name`, `description`, `price`, `ids`, `Image`, `idc`) VALUES
(20, 1, 'Lampe de bureau', 'Lampe moderne pour bureau, état neuf', '35', 1, 'images/produits/lampe.jpg', 3),
(21, 2, 'Chaise gamer', 'Confortable pour longues sessions de jeux', '120', 1, 'images/produits/shopping.webp', 3),
(22, 3, 'Montre vintage', 'Montre des années 80, fonctionne parfaitement', '75', 2, 'images/produits/montre.webp', 2),
(23, 4, 'Casque audio', 'Casque avec réduction de bruit active', '59', 1, 'images/produits/casque.jpg', 3),
(24, 5, 'Sac à dos', 'Sac pour randonnée de grande capacité', '50', 2, 'images/produits/sqc.jpg', 2),
(25, 6, 'Smartphone', 'Dernier modèle, neuf, encore emballé', '300', 1, 'images/produits/tel.webp', 3),
(26, 7, 'Ensemble de jardin', 'Table et 4 chaises pour jardin, parfait état', '150', 1, 'images/produits/ensjardin.jpg', 3),
(27, 1, 'Vélo électrique', 'Vélo électrique en très bon état, peu servi', '850', 2, 'images/produits/veloel.jpg', 1),
(28, 2, 'Ordinateur portable', '16GB RAM, SSD 512GB, écran 15 pouces', '700', 1, 'images/produits/laptop.jpg', 3),
(29, 3, 'Tablette graphique', 'Idéale pour les designers, presque neuve', '200', 1, 'images/produits/wacom.jpg', 3),
(30, 4, 'Cafetière', 'Cafetière automatique avec broyeur intégré', '180', 1, 'images/produits/Cafetiere.jpg', 4),
(31, 5, 'Télévision 50 pouces', 'Smart TV 4K, marque reconnue, très bon état', '400', 2, 'images/produits/tele.jpg', 3),
(32, 6, 'Kit de jardinage', 'Comprend divers outils et gants', '90', 1, 'images/produits/jardikit.jpg', 4),
(33, 7, 'Livre de cuisine', 'Collection de recettes traditionnelles françaises', '25', 1, 'images/produits/cuisinelivre.jpg', 4),
(34, 8, 'Console de jeux', 'Dernière génération, utilisée 2 fois', '450', 1, 'images/produits/console2jeux.jpg', 3),
(35, 1, 'Guitare électrique', 'Guitare de marque reconnue, excellente condition', '350', 1, 'images/produits/Guitare.jpg', 4),
(36, 2, 'Appareil photo reflex', 'Idéal pour les amateurs de photographie', '450', 1, 'images/produits/Appareilphotoreflex.jpg', 3),
(37, 3, 'Skateboard électrique', 'Batterie longue durée, comme neuf', '250', 1, 'images/produits/Skateboardelectrique.jpg', 1),
(38, 4, 'Set de golf', 'Complet avec sac et clubs, bon état', '200', 2, 'images/produits/clubgolf.jpg', 4),
(39, 5, 'Rollers en ligne', 'Taille 42, peu utilisé', '70', 2, 'images/produits/roller.jpg', 4),
(40, 6, 'Drone avec caméra', 'Haute résolution, parfait pour les prises de vue aériennes', '550', 1, 'images/produits/dronecam.jpg', 3),
(41, 7, 'Ensemble de yoga', 'Tapis, blocs, et sangle, neuf', '60', 1, 'images/produits/yoga.jpg', 4),
(42, 8, 'Caméra de surveillance', 'Connectée WiFi, vision nocturne', '150', 1, 'images/produits/camera.jpg', 3),
(43, 9, 'Station météo', 'Affiche température, humidité, pression atmosphérique', '100', 1, 'images/produits/meteo.jpg', 4),
(44, 10, 'Lunettes de soleil', 'Protection UV, cadre robuste', '85', 1, 'images/produits/lunettesoleil.jpg', 2),
(45, 1, 'Sac de couchage', 'Idéal pour le camping, très peu utilisé', '90', 2, 'images/produits/sacouchage.jpg', 4),
(46, 2, 'Clavier mécanique', 'Clavier gamer RGB, excellent état', '80', 1, 'images/produits/keyboard.jpg', 3),
(47, 3, 'Bottes de randonnée', 'Taille 38, résistantes et imperméables', '120', 2, 'images/produits/randoboots.jpg', 4),
(48, 4, 'Montre intelligente', 'Connectivité Bluetooth, avec suivi de santé', '199', 1, 'images/produits/aplwatch.jpg', 3),
(49, 5, 'Blender', '300W, parfait pour les smoothies', '35', 1, 'images/produits/blender.jpg', 4),
(50, 6, 'Livre \"Le Grand Gatsby\"', 'Édition de luxe, couverture rigide', '25', 1, 'images/produits/', 4),
(51, 7, 'Tente pour 4 personnes', 'Facile à monter, idéale pour les familles', '150', 2, 'images/produits/', 4),
(52, 8, 'Console rétro', 'Inclut deux manettes et plusieurs jeux', '110', 1, 'images/produits/console.jpg', 3),
(53, 9, 'Veste de ski', 'Taille L, résiste aux intempéries', '130', 2, 'images/produits/Vestedeski.jpg', 2),
(54, 10, 'Aspirateur robot', 'Nettoyage automatique, contrôle via application', '250', 1, 'images/produits/Aspirateurrobot.jpg', 4),
(55, 1, 'Planche de surf', '7 pieds, bon état, idéale pour débutants', '200', 2, 'images/produits/Planchedesurf.jpg', 4),
(56, 2, 'Machine à café espresso', 'Pression 15 bars, comme neuve', '100', 1, 'images/produits/Machineacafeespresso.jpg', 4),
(57, 3, 'Couverture chauffante', 'Température réglable, très peu utilisée', '50', 1, 'images/produits/Couverturechauffante.jpg', 4),
(58, 4, 'Projecteur cinéma maison', 'Full HD, 3000 lumens', '450', 1, 'images/produits/projo.jpg', 3),
(59, 5, 'Ensemble haltères', 'De 2kg à 10kg, rack inclus', '200', 1, 'images/produits/altere.jpg', 4),
(60, 6, 'Piano numérique', '88 touches, avec pédales et support', '500', 1, 'images/produits/piano.jpg', 4),
(61, 7, 'Vélo de course', 'Cadre en carbone, ultra léger', '1000', 1, 'images/produits/Velodecourse.jpg', 1),
(62, 8, 'Système de son', 'Amplificateur et 5 haut-parleurs', '300', 1, 'images/produits/son.jpg', 3),
(63, 9, 'Chariot de golf', 'Électrique, avec chargeur', '800', 1, 'images/produits/Chariotdegolf.jpg', 4),
(64, 10, 'Set de peinture', 'Comprend pinceaux, peintures acryliques, toiles', '85', 1, 'images/produits/Setdepeinture.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `pp`) VALUES
(1, 'admin', 'admin123', 'admin@admin.fr', NULL),
(2, 'neruaka', 'blanco', 'blanco@gmail.com', NULL),
(3, 'pandaboy', 'asd', 'pandaboy54@gmail.com', NULL),
(4, 'bonjour', 'asd', 'bonjour@asd', NULL),
(5, 'test', '$2y$10$10BL5jJVPQiI5AKQ1x8vVuIZd5QSW/u.QwSMWTGfxWNfLmTmAfk7u', 'qwd@qwd', 'test.jpg'),
(6, 'userid6', '$2y$10$Qg54ZROynpcqexWHBj9tSOvj.Pee.7Y8/mQtPXOz0.gz2quZ8QLru', 'userid6id@id6', 'userid6.png'),
(7, 'chloe', '$2y$10$zb9.sMpg6b1VxlndZK9Sq.VANBVk7oBdugRsOeJLJt7xoHXIT6U3O', 'poulet@gmail.com', 'chloe.jpg'),
(8, 'Testaccount', '$2y$10$zBa67259NgT7vlFjkx5cIOzgK0yQmiRPMeTKeRGxUMeQMg9oQrweu', 'test@test', 'Testaccount.png'),
(9, 'root', 'root', 'root@root', NULL),
(10, 'root', 'root', 'root@root', NULL),
(11, 'neruaka', '$2y$10$xP6T9/r/MQkCt/V5lA.WXum4akPFlpG1uDGbRuDA5/7Olza3VcJLa', 'Hello@hello', 'neruaka.jpg'),
(12, 'testo', '$2y$10$42bdc2sAfROXhtu7uFShX.M.L9b6fX7IyH/eVc/sLJHKox0ddyJz2', 'test@teso', 'testo17179034248709.jpg'),
(13, 'bloup', '$2y$10$gZGeENMvR/hAe1x895zOieSIevCPiq22IE4ROjf3TeVlxnslIwTVa', 'bloup@bloupeur', 'bloup17179061143245.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `categorielien` FOREIGN KEY (`idc`) REFERENCES `categorie` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ids`) REFERENCES `state` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
