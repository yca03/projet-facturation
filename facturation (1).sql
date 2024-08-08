-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 août 2024 à 10:30
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
  `remise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siege` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_internet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regime_fiscal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facture_pro_format_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C82E749505321D` (`facture_pro_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adresse`, `contact`, `type_societe`, `numero_compte_contribuable`, `remise`, `ville`, `siege`, `pays`, `site_internet`, `regime_fiscal`, `activite`, `facture_pro_format_id`) VALUES
(1, 'SIB', 'sib@gmail.com', '1212121249', 'SA', '1234567899AAF', NULL, '', '', '', '', '', '', NULL),
(2, 'PETROCI', 'petroci@gmail.com', '258963542214', 'SARL', '123456789CB02', '', '', '', '', '', '', '', NULL),
(3, 'ORANGE', 'orangeci@gmail.com', '070707070707', 'SA', '123456789KHH25', '20000', '', '', '', '', '', '', NULL),
(4, 'AFRIKATOON', 'afrikatoonci@gmail.com', '2525252525', 'SARLU', '124555YA55', NULL, '', '', '', '', '', '', NULL),
(5, 'MTN', 'mtnci@gmail.com', '1515896336', 'SARL', '123456789CZ1236', '', '', '', '', '', '', '', NULL),
(6, 'SIR', 'sir@gmail.com', '1519191910', 'SA', '1254563333hD4', '100000', '', '', '', '', '', '', NULL),
(7, 'OFFSET-CONSULTING', 'offset@gmail.com', '1519191910', 'SARLU', '1254563333hD4765', NULL, 'Abidjan', 'Abidjan', 'Côte d\'ivoire', 'offsetConsulting.com', 'RE', 'Informatique', NULL),
(8, 'IVOIRE SOFT', 'ivoirsoft@gmail.com', '1595258566', 'SARL', '1254563333uay25', '50000', '', '', '', '', '', '', NULL);

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
  `remise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `facture_id` int DEFAULT NULL,
  `facture_proformat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9949E4C5F347EFB` (`produit_id`),
  KEY `IDX_9949E4C57F2DEE08` (`facture_id`),
  KEY `IDX_9949E4C5BDC4C10D` (`facture_proformat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_facture`
--

INSERT INTO `detail_facture` (`id`, `quantite`, `prix`, `montant_ttc`, `montant_ht`, `montant_tva`, `remise`, `produit_id`, `facture_id`, `facture_proformat_id`) VALUES
(1, 2, '1230000000', '2902788200', '2459990000', '442798200', '10000', 1, 1, NULL),
(2, 2, '5000000', '11776400', '9980000', '1796400', '20000', 4, 2, NULL),
(3, 2, '1230000000', '2900440000', '2458000000', '442440000', '2000000', 1, 3, NULL),
(4, 1, '5000000', '5876400.00', '4980000.00', '896400.00', '20000', 4, 3, NULL),
(5, 1, '1230000000', '1449040000.00', '1228000000.00', '221040000.00', '2000000', 5, 4, NULL),
(6, 1, '1230000000', '1449040000.00', '1228000000.00', '221040000.00', '2000000', 1, 5, NULL),
(7, 2, '1230000000', '2902682000.00', '2459900000.00', '442782000.00', '100000', 5, 6, NULL),
(8, 2, '500000', '1174100.00', '995000.00', '179100.00', '5000', 6, 7, NULL),
(9, 2, '5000000', '11798820.00', '9999000.00', '1799820.00', '1000', 4, 8, NULL),
(10, 2, '5000000', '11797640.00', '9998000.00', '1799640.00', '2000', 4, 9, NULL),
(11, 2, '12000000', '25960000', '22000000', '3960000', '2000000', 1, 10, NULL),
(12, 2, '12000000', '28296400', '23980000', '4316400', '20000', 1, 11, NULL),
(13, 1, '12000000', '14042000', '11900000', '2142000', '100000', 1, 12, NULL),
(14, 2, '500000', '1062000', '900000', '162000', '100000', 6, 12, NULL),
(15, 1, '1000000', '1180000', '1000000', '180000', '0', 5, 13, NULL),
(16, 2, '500000', '1180000', '1000000', '180000', '0', 6, 13, NULL),
(17, 1, '12000000', '11800000', '10000000', '1800000', '2000000', 1, 14, NULL),
(18, 1, '12000000', '14042000', '11900000', '2142000', '100000', 1, 15, NULL),
(20, 2, '12000000', '28202000', '23900000', '4302000', '100000', 1, 17, NULL),
(21, 1, '12000000', '14160000', '12000000', '2160000', NULL, 1, 18, NULL),
(22, 2, '5000000', '11800000', '10000000', '1800000', NULL, 4, 19, NULL),
(23, 1, '5000000', '5900000', '5000000', '900000', NULL, 4, 20, NULL),
(24, 2, '500000', '1062000', '900000', '162000', '100000', 6, 20, NULL),
(25, 1, '20000000', '23576400', '19980000', '3596400', '20000', 7, 21, NULL),
(26, 2, '5000000', '11800000', '10000000', '1800000', NULL, 4, 22, NULL),
(27, 2, '1000000', '2360000', '2000000', '360000', NULL, 5, 23, NULL),
(28, 1, '5000000', '5900000', '5000000', '900000', NULL, 4, 23, NULL),
(29, 2, '300000', '708000', '600000', '108000', '20000', 4, 24, NULL),
(30, 3, '20000000', '70800000', '60000000', '10800000', NULL, 6, 24, NULL),
(31, 12, '200000', '2242000', '1900000', '342000', '500000', 1, 25, NULL),
(32, 4, '20000000', '94388200', '79990000', '14398200', '10000', 6, 25, NULL),
(33, 2, '200000', '448400', '380000', '68400', '20000', 1, 26, NULL),
(34, 1, '200000', '200600', '170000', '30600', '30000', 1, 26, NULL),
(35, 3, '200000', '708000', '600000', '108000', NULL, 1, 26, NULL),
(36, 1, '200000', '236000', '200000', '36000', '100000', 1, 27, NULL),
(37, 1, '200000', '212400', '180000', '32400', '20000', 1, 28, NULL),
(38, 1, '200000', '236000', '200000', '36000', NULL, 1, 29, NULL),
(39, 2, '200000', '472000', '400000', '72000', NULL, 1, 29, NULL),
(40, 2, '200000', '472000', '400000', '72000', NULL, 1, 30, NULL),
(41, 2, '200000', '472000', '400000', '72000', NULL, 1, 30, NULL),
(42, 1, '200000', '236000', '200000', '36000', NULL, 1, NULL, NULL),
(43, 2, '200000', '472000', '400000', '72000', NULL, 1, NULL, NULL),
(44, 6, '200000', '1416000', '1200000', '216000', NULL, 1, NULL, NULL),
(45, 3, '200000', '708000', '600000', '108000', NULL, 1, NULL, NULL),
(46, 5, '200000', '1180000', '1000000', '180000', NULL, 1, NULL, 31),
(47, 4, '10000000', '47200000', '40000000', '7200000', NULL, 7, NULL, 31),
(48, 4, '200000', '944000', '800000', '144000', NULL, 1, NULL, 32),
(49, 1, '200000', '236000', '200000', '36000', NULL, 1, NULL, 33),
(50, 15, '200000', '3540000', '3000000', '540000', NULL, 1, NULL, 34),
(51, 1, '200000', '236000', '200000', '36000', NULL, 1, 31, NULL),
(52, 4, '200000', '920400', '780000', '140400', '20000', 1, NULL, 35),
(53, 1, '200000', '212400', '180000', '32400', '20000', 1, NULL, 35),
(54, 3, '200000', '708000', '600000', '108000', NULL, 1, NULL, 36),
(55, 2, '200000', '472000', '400000', '72000', NULL, 1, NULL, NULL),
(56, 2, '200000', '472000', '400000', '72000', NULL, 1, NULL, NULL),
(57, 2, '200000', '472000', '400000', '72000', NULL, 1, NULL, NULL),
(58, 1, '200000', '236000', '200000', '36000', NULL, 1, NULL, NULL),
(59, 1, '200000', '236000', '200000', '36000', NULL, 1, NULL, NULL),
(60, 2, '200000', '448400', '380000', '68400', '20000', 1, 32, NULL),
(61, 5, '200000', '1180000', '1000000', '180000', NULL, 1, NULL, 37),
(62, 2, '200000', '472000', '400000', '72000', NULL, 1, NULL, 37),
(63, 1, '200000', '236000', '200000', '36000', NULL, 1, NULL, 38);

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
('DoctrineMigrations\\Version20240701104137', '2024-07-01 10:41:58', 18),
('DoctrineMigrations\\Version20240703152319', '2024-07-03 15:27:21', 22538),
('DoctrineMigrations\\Version20240703153446', '2024-07-03 15:35:00', 2465),
('DoctrineMigrations\\Version20240722091506', '2024-07-22 09:16:13', 47),
('DoctrineMigrations\\Version20240722103630', '2024-07-22 10:37:02', 351),
('DoctrineMigrations\\Version20240722171021', '2024-07-22 17:17:46', 221),
('DoctrineMigrations\\Version20240729144455', '2024-07-29 14:45:28', 30),
('DoctrineMigrations\\Version20240729144941', '2024-07-29 14:49:50', 68),
('DoctrineMigrations\\Version20240729154240', '2024-07-29 15:42:45', 27),
('DoctrineMigrations\\Version20240729164046', '2024-07-29 16:40:51', 73);

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
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_expiration` date NOT NULL,
  `total_ht` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_tva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ttc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641099DED506` (`id_client_id`),
  KEY `IDX_FE866410EF4F1912` (`mode_payement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `code_facture`, `id_client_id`, `date`, `mode_payement_id`, `reference`, `date_expiration`, `total_ht`, `total_tva`, `total_ttc`) VALUES
(1, 'F001fd2d', 1, '2024-08-01 00:00:00', 1, 'REF-2024-cc07c4', '2024-06-03', '2459990000', '442798200', '2902788200'),
(2, 'F0017725', 1, '2024-08-01 00:00:00', 1, 'REF-2024-19d30c', '2024-06-11', '9980000', '1796400', '11776400'),
(3, 'F00154d8', 2, '2024-05-30 00:00:00', NULL, '', '2024-06-02', '', '', ''),
(4, 'F21 314 Z0075/66589fd84ca0b', 3, '2024-05-30 00:00:00', NULL, '', '2024-06-18', '', '', ''),
(5, 'F 21 Z0075/ 658a08a7a229', 3, '2024-05-30 00:00:00', NULL, '', '2024-06-01', '', '', ''),
(6, 'F 21 Z0075/ 659a3f71de71', 4, '2024-05-31 00:00:00', 1, '', '2024-06-11', '', '', ''),
(7, 'F 21 Z0075/ 65daaed88158', 5, '2024-06-03 00:00:00', 2, '', '2024-06-03', '', '', ''),
(8, 'F 21 Z0075/ 65eef8a50404', 2, '2024-06-04 00:00:00', 2, '', '2024-06-03', '', '', ''),
(9, 'F 21 Z0075/ 65f20c8f1f7f', 4, '2024-06-04 00:00:00', 1, 'REF-2024-8f1f84', '2024-06-06', '', '', ''),
(10, 'F 21 Z0075/ 65f22a0a3f51', 1, '2024-06-04 00:00:00', 1, 'REF-2024-0a3f56', '2024-06-05', '', '', ''),
(11, 'F 21 Z0075/ 65f22dff0a3f', 1, '2024-06-04 00:00:00', 2, 'REF-2024-ff0a44', '2024-06-10', '', '', ''),
(12, 'F 21 Z0075/ 660456aeede8', 6, '2024-06-05 00:00:00', 1, 'REF-2024-aeeded', '2024-06-10', '', '', ''),
(13, 'F 21 Z0075/ 660935b7a784', 7, '2024-06-05 00:00:00', 1, 'REF-2024-b7a789', '2024-06-22', '', '', ''),
(14, 'F 21 Z0075/ 661bcac21cef', 1, '2024-06-06 00:00:00', 1, 'REF-2024-c21cf4', '2024-06-18', '', '', ''),
(15, 'F 21 Z0075/ 661c45653769', 4, '2024-06-06 00:00:00', 1, 'REF-2024-65376f', '2024-06-11', '', '', ''),
(17, 'F 21 Z0075/ 661cb2ba2c96', 6, '2024-06-06 00:00:00', 1, 'REF-2024-ba2c9c', '2024-06-17', '', '', ''),
(18, 'F 21 Z0075/ 661dd436ce2f', 1, '2024-06-06 00:00:00', 1, 'REF-2024-36ce34', '2024-06-10', '', '', ''),
(19, 'F 21 Z0075/ 661dd6283b0e', 4, '2024-06-06 00:00:00', 1, 'REF-2024-283b13', '2024-06-17', '', '', ''),
(20, 'F 21 Z0075/ 666ad861b097', 7, '2024-06-10 00:00:00', 2, 'REF-2024-61b09d', '2024-06-19', '', '', ''),
(21, 'N 21 Z0075/ 66af4a2a10cf', 2, '2024-06-13 00:00:00', 2, 'REF-2024-2a10d4', '2024-06-28', '', '', ''),
(22, 'N 21 Z0075/ 66c233ec31a5', 1, '2024-06-14 00:00:00', 2, 'REF-2024-ec31aa', '2024-07-05', '', '', ''),
(23, 'N 21 Z0075/ 67a9935c5ffa', 3, '2024-06-25 00:00:00', 1, 'REF-2024-5c6000', '2024-06-26', '', '', ''),
(24, 'N 21 Z0075/ 6827c83e46ff', 8, '2024-08-01 00:00:00', 1, 'REF-2024-3e4705', '2024-07-07', '60600000', '10908000', '71508000'),
(25, 'N 21 Z0075/ 683fc5282cc8', 7, '2024-07-02 00:00:00', 1, 'REF-2024-282cd2', '2024-07-17', '', '', ''),
(26, 'N 21 Z0075/ 6864e88521f1', 2, '2024-07-04 00:00:00', 1, 'REF-2024-8521fa', '2024-07-04', '', '', ''),
(27, 'N 21 Z0075/ 686d67250c7a', 6, '2024-07-04 00:00:00', 1, 'REF-2024-250c80', '2024-07-28', '', '', ''),
(28, 'N 21 Z0075/ 6a7af2370674', 3, '2024-07-29 00:00:00', 1, 'REF-2024-370679', '2024-07-31', '180000', '32400', '212400'),
(29, 'N 21 Z0075/ 6a7b2bc1fced', 1, '2024-07-29 00:00:00', 1, 'REF-2024-c1fcf2', '2024-08-11', '600000', '108000', '708000'),
(30, 'N 21 Z0075/ 6a7b71c6e3c4', 1, '2024-07-29 00:00:00', 1, 'REF-2024-c6e3c9', '2024-08-08', '800000', '144000', '944000'),
(31, 'N 21 Z0075/ 6a9159d29166', 1, '2024-07-30 00:00:00', 1, 'REF-2024-d2916c', '2024-07-31', '200000', '36000', '236000'),
(32, 'N 21 Z0075/ 6b09f8fc5cab', 3, '2024-08-05 00:00:00', 1, 'REF-2024-fc5cb0', '2024-08-08', '380000', '68400', '448400');

-- --------------------------------------------------------

--
-- Structure de la table `facture_pro_format`
--

DROP TABLE IF EXISTS `facture_pro_format`;
CREATE TABLE IF NOT EXISTS `facture_pro_format` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_facture_pro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_echeance` datetime NOT NULL,
  `clients_id` int DEFAULT NULL,
  `mode_payement_id` int DEFAULT NULL,
  `total_ht` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_tva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ttc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92A7118CAB014612` (`clients_id`),
  KEY `IDX_92A7118CEF4F1912` (`mode_payement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture_pro_format`
--

INSERT INTO `facture_pro_format` (`id`, `date`, `reference`, `numero_facture_pro`, `date_echeance`, `clients_id`, `mode_payement_id`, `total_ht`, `total_tva`, `total_ttc`) VALUES
(1, '2024-08-01 00:00:00', 'REF-2024-fc6a35', 'N-2024-8521', '2024-08-10 09:00:00', 3, 1, '400000', '72000', '472000'),
(2, '2024-07-29 00:00:00', 'REF-2024-fc6a36', 'N-2024-8520', '2024-08-17 09:49:00', 4, 1, NULL, NULL, NULL),
(3, '2024-07-29 00:00:00', 'REF-2024-fc6a366', 'N-2024-85233', '2024-08-07 10:00:00', 3, 1, NULL, NULL, NULL),
(5, '2024-08-01 00:00:00', 'REF-2024-fc6a367', 'N-2024-85233', '2024-07-29 10:52:00', 3, 2, '400000', '72000', '472000'),
(28, '2024-08-01 00:00:00', 'REF-2024-fc6a366', 'N-2024-8521', '2024-08-08 16:34:00', 1, 1, '400000', '72000', '472000'),
(29, '2024-07-30 00:00:00', 'REF-2024-fc6a36600', 'N-2024-852000', '2024-08-08 08:40:00', 2, 1, '400000', '72000', '472000'),
(30, '2024-07-30 00:00:00', 'REF-2024-fc6a361111', 'N-2024-85211111', '2024-08-10 11:42:00', 1, 1, '1800000', '324000', '2124000'),
(31, '2024-07-30 00:00:00', 'REF-2024-fc6a36111133', 'N-2024-852111113333', '2024-12-30 13:40:00', 1, 1, '41000000', '7380000', '48380000'),
(32, '2024-08-01 00:00:00', 'REF-2024-fc', 'N-2024-0000', '2024-08-10 14:12:00', 1, 1, '800000', '144000', '944000'),
(33, '2024-08-01 00:00:00', 'REF-2024-fc6a350.32', 'N-2024-', '2024-07-30 14:13:00', 1, 1, '200000', '36000', '236000'),
(34, '2024-07-30 00:00:00', 'REF-2024-496c9', 'N 21 Z0075/ 496c5', '2024-09-05 14:47:00', 1, 1, '3000000', '540000', '3540000'),
(35, '2024-07-31 00:00:00', 'REF-2024-17b74', 'N 21 Z0075/ 17b70', '2024-08-16 16:21:00', 3, 1, '960000', '172800', '1132800'),
(36, '2024-07-31 00:00:00', 'REF-2024-a34a9', 'N 21 Z0075/ a34a5', '2024-09-03 16:24:00', 1, 1, '600000', '108000', '708000'),
(37, '2024-08-05 00:00:00', 'REF-2024-169c0', 'N 21 Z0075/ 169bc', '2024-08-09 09:49:00', 4, 1, '1400000', '252000', '1652000'),
(38, '2024-08-05 00:00:00', 'REF-2024-9953c', 'N 21 Z0075/ 99538', '2024-08-07 09:57:00', 1, 1, '200000', '36000', '236000');

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
  `facture_pro_format_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B16D0C1E9505321D` (`facture_pro_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_payement`
--

INSERT INTO `mode_payement` (`id`, `nom`, `code`, `facture_pro_format_id`) VALUES
(1, 'Virement', 'vrt', NULL),
(2, 'cheque bancaire', 'cqb', NULL);

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
  `tva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `raison_social` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `siege` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_internet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_commercial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `regime_fiscal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `forme_juridique` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `raison_social`, `activite`, `numero`, `siege`, `telephone`, `ville`, `pays`, `email`, `site_internet`, `code_commercial`, `regime_fiscal`, `date`, `forme_juridique`, `adresse_postal`) VALUES
(1, 'Offset-Consulting', 'informatique', '12365478HH52', 'Cocody', '2727272727', 'Abidjan', 'côte d\'ivoire', 'offset-consulting@gmail.com', 'www.offset-consulting.com', 'cm003', 'RME', '2024-07-04 00:00:00', 'SARL', '08 BP 2941 Abidjan 08');

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
  `nom_utilisateur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`nom_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `contact`, `status`, `nom_utilisateur`) VALUES
(2, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$kueMwi97JdCVcm5lUchBvOaniG6NbQLu9g0E.SZBGiK315vgwkJoC', 'admin', 'user', '12131615144', 1, 'chris_arnold'),
(23, 'user@gmail.com', '[\"ROLE_CONSULTER\"]', '$2y$13$H6si8znCmA7pNQxeuOBgNOaqphGt0vI5bNj5sMxmEotPM4RbK0L/2', 'josias', 'yao', '0749162107', 1, 'josias@'),
(25, 'admin1@gmail.com', '[\"ROLE_FACTURE\"]', '$2y$13$.EvGQXF3aHdJR5ibRv1t5O8LAghgP4fdgY.Ta5xhzWRnWoJwAhIfi', 'Koffi', 'joe', '2225553686', 1, 'amelie#'),
(26, 'yaograce@gmail.com', '[\"ROLE_SOCIETY\"]', '$2y$13$xVEKSkB9y/GcrmfxmUUVNe3q2heqP3Eu0k53DkLILylc.SsbOFkJa', 'yao', 'grace', '010101010101', 1, 'grace@'),
(28, 'chris200311@gmail.com', '[\"ROLE_CREATION\"]', '$2y$13$/lbVs17W4YhU1uchlXx0IOqE4YkO6Pk4cYW70mV1m5FraTbvgVWM6', 'konan', 'franck', '010101010101', 1, 'franck@'),
(30, 'yaochris620@gmail.com', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$BI2CxNj6WtH5hmyYg43ijeGS7vdZ3fpAZszSXxZJGvoNxgXnfeXve', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, '__chris_arnold__'),
(31, 'produit@gmail.com', '[\"ROLE_PRODUIT\"]', '$2y$13$GxlhYaXLN7ZTuBEWljpT8uja6MDcFKITIR6gNG7aL6QwpIFScM18u', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, 'product@'),
(32, 'client@gmail.com', '[\"ROLE_CLIENT\"]', '$2y$13$S2adZtVFsS7KjVC9z9f2N.o3oYjuvnJRVRQ5BpKMLgP5l6W5IKFeu', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, 'client@');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_C82E749505321D` FOREIGN KEY (`facture_pro_format_id`) REFERENCES `facture_pro_format` (`id`);

--
-- Contraintes pour la table `detail_facture`
--
ALTER TABLE `detail_facture`
  ADD CONSTRAINT `FK_9949E4C57F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `FK_9949E4C5BDC4C10D` FOREIGN KEY (`facture_proformat_id`) REFERENCES `facture_pro_format` (`id`),
  ADD CONSTRAINT `FK_9949E4C5F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE86641099DED506` FOREIGN KEY (`id_client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_FE866410EF4F1912` FOREIGN KEY (`mode_payement_id`) REFERENCES `mode_payement` (`id`);

--
-- Contraintes pour la table `facture_pro_format`
--
ALTER TABLE `facture_pro_format`
  ADD CONSTRAINT `FK_92A7118CAB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_92A7118CEF4F1912` FOREIGN KEY (`mode_payement_id`) REFERENCES `mode_payement` (`id`);

--
-- Contraintes pour la table `mode_payement`
--
ALTER TABLE `mode_payement`
  ADD CONSTRAINT `FK_B16D0C1E9505321D` FOREIGN KEY (`facture_pro_format_id`) REFERENCES `facture_pro_format` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC271237A8DE` FOREIGN KEY (`type_produit_id`) REFERENCES `type_produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
