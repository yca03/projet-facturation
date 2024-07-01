-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 juil. 2024 à 10:56
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facturation`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_societe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_compte_contribuable` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adresse`, `contact`, `type_societe`, `numero_compte_contribuable`, `remise`) VALUES
(1, 'SIB', 'sib@gmail.com', '1212121249', 'SA', '1234567899AAF', NULL),
(2, 'PETROCI', 'petroci@gmail.com', '258963542214', 'SARL', '123456789CB02', ''),
(3, 'ORANGE', 'orangeci@gmail.com', '070707070707', 'SA', '123456789KHH25', '20000'),
(4, 'AFRIKATOON', 'afrikatoonci@gmail.com', '2525252525', 'SARLU', '124555YA55', NULL),
(5, 'MTN', 'mtnci@gmail.com', '1515896336', 'SARL', '123456789CZ1236', ''),
(6, 'SIR', 'sir@gmail.com', '1519191910', 'SA', '1254563333hD4', '100000'),
(7, 'OFFSET-CONSULTING', 'offset@gmail.com', '1519191910', 'SARLU', '1254563333hD4765', NULL),
(8, 'IVOIRE SOFT', 'ivoirsoft@gmail.com', '1595258566', 'SARL', '1254563333uay25', '20000');

-- --------------------------------------------------------

--
-- Structure de la table `detail_facture`
--

DROP TABLE IF EXISTS `detail_facture`;
CREATE TABLE IF NOT EXISTS `detail_facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantite` int NOT NULL,
  `prix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_ttc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_ht` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_tva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `facture_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9949E4C5F347EFB` (`produit_id`),
  KEY `IDX_9949E4C57F2DEE08` (`facture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_facture`
--

INSERT INTO `detail_facture` (`id`, `quantite`, `prix`, `montant_ttc`, `montant_ht`, `montant_tva`, `remise`, `produit_id`, `facture_id`) VALUES
(1, 2, '1230000000', '2902788200', '2459990000', '442798200', '10000', 1, 1),
(2, 2, '5000000', '11776400', '9980000', '1796400', '20000', 4, 2),
(3, 2, '1230000000', '2900440000', '2458000000', '442440000', '2000000', 1, 3),
(4, 1, '5000000', '5876400.00', '4980000.00', '896400.00', '20000', 4, 3),
(5, 1, '1230000000', '1449040000.00', '1228000000.00', '221040000.00', '2000000', 5, 4),
(6, 1, '1230000000', '1449040000.00', '1228000000.00', '221040000.00', '2000000', 1, 5),
(7, 2, '1230000000', '2902682000.00', '2459900000.00', '442782000.00', '100000', 5, 6),
(8, 2, '500000', '1174100.00', '995000.00', '179100.00', '5000', 6, 7),
(9, 2, '5000000', '11798820.00', '9999000.00', '1799820.00', '1000', 4, 8),
(10, 2, '5000000', '11797640.00', '9998000.00', '1799640.00', '2000', 4, 9),
(11, 2, '12000000', '25960000', '22000000', '3960000', '2000000', 1, 10),
(12, 2, '12000000', '28296400', '23980000', '4316400', '20000', 1, 11),
(13, 1, '12000000', '14042000', '11900000', '2142000', '100000', 1, 12),
(14, 2, '500000', '1062000', '900000', '162000', '100000', 6, 12),
(15, 1, '1000000', '1180000', '1000000', '180000', '0', 5, 13),
(16, 2, '500000', '1180000', '1000000', '180000', '0', 6, 13),
(17, 1, '12000000', '11800000', '10000000', '1800000', '2000000', 1, 14),
(18, 1, '12000000', '14042000', '11900000', '2142000', '100000', 1, 15),
(20, 2, '12000000', '28202000', '23900000', '4302000', '100000', 1, 17),
(21, 1, '12000000', '14160000', '12000000', '2160000', NULL, 1, 18),
(22, 2, '5000000', '11800000', '10000000', '1800000', NULL, 4, 19),
(23, 1, '5000000', '5900000', '5000000', '900000', NULL, 4, 20),
(24, 2, '500000', '1062000', '900000', '162000', '100000', 6, 20),
(25, 1, '20000000', '23576400', '19980000', '3596400', '20000', 7, 21),
(26, 2, '5000000', '11800000', '10000000', '1800000', NULL, 4, 22),
(27, 2, '1000000', '2360000', '2000000', '360000', NULL, 5, 23),
(28, 1, '5000000', '5900000', '5000000', '900000', NULL, 4, 23),
(29, 2, '300000', '708000', '600000', '108000', '20000', 4, 24),
(30, 3, '20000000', '70800000', '60000000', '10800000', NULL, 6, 24);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240523111757', '2024-05-23 11:18:41', 215),
('DoctrineMigrations\\Version20240523112515', '2024-05-23 11:25:38', 91),
('DoctrineMigrations\\Version20240523120938', '2024-05-23 12:10:29', 124),
('DoctrineMigrations\\Version20240523131621', '2024-05-23 13:16:29', 23),
('DoctrineMigrations\\Version20240523132338', '2024-05-23 13:23:45', 81),
('DoctrineMigrations\\Version20240523140256', '2024-05-23 14:03:03', 18),
('DoctrineMigrations\\Version20240523142106', '2024-05-23 14:21:12', 55),
('DoctrineMigrations\\Version20240523160029', '2024-05-23 16:00:40', 37),
('DoctrineMigrations\\Version20240523160449', '2024-05-23 16:04:55', 95),
('DoctrineMigrations\\Version20240524112730', '2024-05-24 11:27:43', 59),
('DoctrineMigrations\\Version20240526090442', '2024-05-26 09:05:13', 2420),
('DoctrineMigrations\\Version20240526092342', '2024-05-26 09:23:48', 923),
('DoctrineMigrations\\Version20240530075734', '2024-05-30 07:57:54', 252),
('DoctrineMigrations\\Version20240530080532', '2024-05-30 08:05:38', 18),
('DoctrineMigrations\\Version20240530091414', '2024-05-30 09:14:20', 49),
('DoctrineMigrations\\Version20240530110745', '2024-05-30 11:07:53', 26),
('DoctrineMigrations\\Version20240530112750', '2024-05-30 11:27:55', 111),
('DoctrineMigrations\\Version20240530124534', '2024-05-30 12:45:40', 25),
('DoctrineMigrations\\Version20240531094550', '2024-05-31 09:46:01', 57),
('DoctrineMigrations\\Version20240531095113', '2024-05-31 09:51:21', 116),
('DoctrineMigrations\\Version20240602091857', '2024-06-02 09:19:17', 2829),
('DoctrineMigrations\\Version20240603082805', '2024-06-03 08:28:30', 34),
('DoctrineMigrations\\Version20240604135036', '2024-06-04 13:50:45', 80),
('DoctrineMigrations\\Version20240604152900', '2024-06-04 15:29:05', 28),
('DoctrineMigrations\\Version20240604155919', '2024-06-04 15:59:23', 71),
('DoctrineMigrations\\Version20240606160038', '2024-06-06 16:01:03', 149),
('DoctrineMigrations\\Version20240613132813', '2024-06-13 13:29:28', 304),
('DoctrineMigrations\\Version20240613141516', '2024-06-13 14:15:20', 19),
('DoctrineMigrations\\Version20240613145407', '2024-06-13 14:54:23', 37),
('DoctrineMigrations\\Version20240613145916', '2024-06-13 14:59:21', 51),
('DoctrineMigrations\\Version20240614111206', '2024-06-14 11:12:29', 97),
('DoctrineMigrations\\Version20240628101516', '2024-06-28 10:15:44', 134),
('DoctrineMigrations\\Version20240628103454', '2024-06-28 10:34:58', 33),
('DoctrineMigrations\\Version20240628103640', '2024-06-28 10:36:45', 97),
('DoctrineMigrations\\Version20240701102235', '2024-07-01 10:22:51', 112),
('DoctrineMigrations\\Version20240701104137', '2024-07-01 10:41:58', 18);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_facture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_client_id` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `mode_payement_id` int DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_expiration` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641099DED506` (`id_client_id`),
  KEY `IDX_FE866410EF4F1912` (`mode_payement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `code_facture`, `id_client_id`, `date`, `mode_payement_id`, `reference`, `date_expiration`) VALUES
(1, 'F001fd2d', 1, '2024-05-30 08:33:00', NULL, '', '2024-06-03'),
(2, 'F0017725', 1, '2024-05-30 00:00:00', NULL, '', '2024-06-11'),
(3, 'F00154d8', 2, '2024-05-30 00:00:00', NULL, '', '2024-06-02'),
(4, 'F21 314 Z0075/66589fd84ca0b', 3, '2024-05-30 00:00:00', NULL, '', '2024-06-18'),
(5, 'F 21 Z0075/ 658a08a7a229', 3, '2024-05-30 00:00:00', NULL, '', '2024-06-01'),
(6, 'F 21 Z0075/ 659a3f71de71', 4, '2024-05-31 00:00:00', 1, '', '2024-06-11'),
(7, 'F 21 Z0075/ 65daaed88158', 5, '2024-06-03 00:00:00', 2, '', '2024-06-03'),
(8, 'F 21 Z0075/ 65eef8a50404', 2, '2024-06-04 00:00:00', 2, '', '2024-06-03'),
(9, 'F 21 Z0075/ 65f20c8f1f7f', 4, '2024-06-04 00:00:00', 1, 'REF-2024-8f1f84', '2024-06-06'),
(10, 'F 21 Z0075/ 65f22a0a3f51', 1, '2024-06-04 00:00:00', 1, 'REF-2024-0a3f56', '2024-06-05'),
(11, 'F 21 Z0075/ 65f22dff0a3f', 1, '2024-06-04 00:00:00', 2, 'REF-2024-ff0a44', '2024-06-10'),
(12, 'F 21 Z0075/ 660456aeede8', 6, '2024-06-05 00:00:00', 1, 'REF-2024-aeeded', '2024-06-10'),
(13, 'F 21 Z0075/ 660935b7a784', 7, '2024-06-05 00:00:00', 1, 'REF-2024-b7a789', '2024-06-22'),
(14, 'F 21 Z0075/ 661bcac21cef', 1, '2024-06-06 00:00:00', 1, 'REF-2024-c21cf4', '2024-06-18'),
(15, 'F 21 Z0075/ 661c45653769', 4, '2024-06-06 00:00:00', 1, 'REF-2024-65376f', '2024-06-11'),
(17, 'F 21 Z0075/ 661cb2ba2c96', 6, '2024-06-06 00:00:00', 1, 'REF-2024-ba2c9c', '2024-06-17'),
(18, 'F 21 Z0075/ 661dd436ce2f', 1, '2024-06-06 00:00:00', 1, 'REF-2024-36ce34', '2024-06-10'),
(19, 'F 21 Z0075/ 661dd6283b0e', 4, '2024-06-06 00:00:00', 1, 'REF-2024-283b13', '2024-06-17'),
(20, 'F 21 Z0075/ 666ad861b097', 7, '2024-06-10 00:00:00', 2, 'REF-2024-61b09d', '2024-06-19'),
(21, 'N 21 Z0075/ 66af4a2a10cf', 2, '2024-06-13 00:00:00', 2, 'REF-2024-2a10d4', '2024-06-28'),
(22, 'N 21 Z0075/ 66c233ec31a5', 1, '2024-06-14 00:00:00', 2, 'REF-2024-ec31aa', '2024-07-05'),
(23, 'N 21 Z0075/ 67a9935c5ffa', 3, '2024-06-25 00:00:00', 1, 'REF-2024-5c6000', '2024-06-26'),
(24, 'N 21 Z0075/ 6827c83e46ff', 8, '2024-07-01 00:00:00', 1, 'REF-2024-3e4705', '2024-07-07');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mode_payement`
--

DROP TABLE IF EXISTS `mode_payement`;
CREATE TABLE IF NOT EXISTS `mode_payement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_payement`
--

INSERT INTO `mode_payement` (`id`, `nom`, `code`) VALUES
(1, 'Virement', 'vrt'),
(2, 'cheque bancaire', 'cqb');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `prix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_produit_id` int DEFAULT NULL,
  `tva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC271237A8DE` (`type_produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `libelle`, `uid`, `date_creation`, `update_date`, `prix`, `type_produit_id`, `tva`) VALUES
(1, 'loyer Orbis-station', '665839a9094dc', '2024-05-30 08:32:55', '2024-06-28 00:00:00', '200000', 1, '18'),
(4, 'Assistance Comptable', '665868a3f2ae2', '2024-05-30 11:53:24', '2024-06-28 00:00:00', '300000', 2, '18'),
(5, 'Réffacturation Serveur d\'application', '6658703c99f29', '2024-05-30 12:25:42', '2024-06-28 00:00:00', '500000', 1, '18'),
(6, 'Conception de Logiciel', '665d7f11a40d9', '2024-06-03 08:32:38', '2024-06-28 00:00:00', '20000000', 1, '18'),
(7, 'Assistance / Maintenance', '6669d46bc25a5', '2024-06-12 17:01:50', '2024-06-28 00:00:00', '10000000', 1, '18');

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `raison_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siege` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `raison_social`, `forme`, `activite`, `numero`, `siege`, `telephone`, `ville`) VALUES
(1, 'Offset-Consulting', 'moyen', 'informatique', '12365478HH52', 'Cocody', '2727272727', 'Abidjan');

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

DROP TABLE IF EXISTS `type_produit`;
CREATE TABLE IF NOT EXISTS `type_produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_produit`
--

INSERT INTO `type_produit` (`id`, `libelle`) VALUES
(1, 'INFORMATIQUE'),
(2, 'COMPTABILITE');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nom_utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`nom_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `contact`, `status`, `nom_utilisateur`) VALUES
(2, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$tMkbvtmBLDbysovEldvpl.al1UkMxTup7Pd56zdtKPvmufnMEutiq', 'admin', 'user', '12131615144', 1, 'chris_arnold'),
(23, 'user@gmail.com', '[\"USER_ROLE\"]', '$2y$13$H6si8znCmA7pNQxeuOBgNOaqphGt0vI5bNj5sMxmEotPM4RbK0L/2', 'josias', 'yao', '0749162107', 1, 'josias@'),
(25, 'admin1@gmail.com', '[\"USER_ROLE\"]', '$2y$13$FYCeVrudvX2vDPAPpUtZbOtQyutiMQTvbTOhj3wb346LgtB8RaObG', 'Koffi', 'Amelie', '2225553686', 0, 'amelie#'),
(26, 'yaograce@gmail.com', '[\"USER_ROLE\"]', '$2y$13$NlLxCLixioAnqtBd7sXdwundtWETVmGBaklDXsWE1SHFoTjl0tGV.', 'yao', 'grace', '010101010101', 0, 'grace@'),
(27, 'franck@gmail.com', '[\"USER_ROLE\"]', '$2y$13$zoQ4kpPkN0yOB.s.vWcn7uWMxfTqUvBZaVqJxkRIGZe5SZlqwP8FK', 'konan', 'franck', '010101010101', 1, 'franck@');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_facture`
--
ALTER TABLE `detail_facture`
  ADD CONSTRAINT `FK_9949E4C57F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `FK_9949E4C5F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE86641099DED506` FOREIGN KEY (`id_client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_FE866410EF4F1912` FOREIGN KEY (`mode_payement_id`) REFERENCES `mode_payement` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC271237A8DE` FOREIGN KEY (`type_produit_id`) REFERENCES `type_produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
