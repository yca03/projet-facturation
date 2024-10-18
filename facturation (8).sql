-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 oct. 2024 à 11:03
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
-- Structure de la table `banque_client`
--

DROP TABLE IF EXISTS `banque_client`;
CREATE TABLE IF NOT EXISTS `banque_client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `banque_only_id` int DEFAULT NULL,
  `numero_compte_banque` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rib` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_bic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gestionnaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_48214E8519EB6921` (`client_id`),
  KEY `IDX_48214E8587C553BE` (`banque_only_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `banque_only`
--

DROP TABLE IF EXISTS `banque_only`;
CREATE TABLE IF NOT EXISTS `banque_only` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_banque` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `siege` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_internet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `regime_fiscal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facture_pro_format_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C82E749505321D` (`facture_pro_format_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `montant_brut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9949E4C5F347EFB` (`produit_id`),
  KEY `IDX_9949E4C57F2DEE08` (`facture_id`),
  KEY `IDX_9949E4C5BDC4C10D` (`facture_proformat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_mode_payement`
--

DROP TABLE IF EXISTS `detail_mode_payement`;
CREATE TABLE IF NOT EXISTS `detail_mode_payement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `encaissement_id` int DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banque_client_id` int DEFAULT NULL,
  `banque_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21CE12E56F272231` (`encaissement_id`),
  KEY `IDX_21CE12E5A32C6EC6` (`banque_client_id`),
  KEY `IDX_21CE12E537E080D9` (`banque_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail_produit`
--

DROP TABLE IF EXISTS `detail_produit`;
CREATE TABLE IF NOT EXISTS `detail_produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E6A6CF2F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detatil_encaissement`
--

DROP TABLE IF EXISTS `detatil_encaissement`;
CREATE TABLE IF NOT EXISTS `detatil_encaissement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `encaissement_id` int DEFAULT NULL,
  `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solde` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facture_id` int DEFAULT NULL,
  `montant_du` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_verse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CEDB6C16F272231` (`encaissement_id`),
  KEY `IDX_9CEDB6C17F2DEE08` (`facture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20240729164046', '2024-07-29 16:40:51', 73),
('DoctrineMigrations\\Version20240813100609', '2024-08-13 10:06:25', 89),
('DoctrineMigrations\\Version20240813142550', '2024-08-13 14:25:57', 65),
('DoctrineMigrations\\Version20240827091608', '2024-08-27 09:19:48', 19),
('DoctrineMigrations\\Version20240827112844', '2024-08-27 11:29:45', 162),
('DoctrineMigrations\\Version20240828152122', '2024-08-28 15:22:01', 206),
('DoctrineMigrations\\Version20240828153916', '2024-08-28 15:39:30', 95),
('DoctrineMigrations\\Version20240828160743', '2024-08-28 16:10:48', 63),
('DoctrineMigrations\\Version20240828165502', '2024-08-28 16:56:04', 97),
('DoctrineMigrations\\Version20240828171220', '2024-08-28 17:13:25', 89),
('DoctrineMigrations\\Version20240829152248', '2024-08-29 15:24:35', 99),
('DoctrineMigrations\\Version20240829162501', '2024-08-29 16:25:23', 26),
('DoctrineMigrations\\Version20240829170755', '2024-08-29 17:07:58', 36),
('DoctrineMigrations\\Version20240829171654', '2024-08-29 17:16:57', 72),
('DoctrineMigrations\\Version20240830101814', '2024-08-30 10:18:34', 88),
('DoctrineMigrations\\Version20240830113718', '2024-08-30 11:37:42', 185),
('DoctrineMigrations\\Version20240830141300', '2024-08-30 14:13:12', 77),
('DoctrineMigrations\\Version20240830144847', '2024-08-30 14:49:18', 90),
('DoctrineMigrations\\Version20240830162648', '2024-08-30 16:27:07', 91),
('DoctrineMigrations\\Version20240831203344', '2024-09-02 08:01:22', 29),
('DoctrineMigrations\\Version20240909142310', '2024-09-09 14:38:21', 94),
('DoctrineMigrations\\Version20241004145632', '2024-10-04 14:58:15', 258),
('DoctrineMigrations\\Version20241011095952', '2024-10-11 10:00:15', 203),
('DoctrineMigrations\\Version20241011111834', '2024-10-11 11:18:38', 36),
('DoctrineMigrations\\Version20241011112422', '2024-10-11 11:24:25', 72);

-- --------------------------------------------------------

--
-- Structure de la table `encaissement`
--

DROP TABLE IF EXISTS `encaissement`;
CREATE TABLE IF NOT EXISTS `encaissement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mode_payement_id` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int DEFAULT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D4869B0EF4F1912` (`mode_payement_id`),
  KEY `IDX_5D4869B019EB6921` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `total_ht` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_tva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ttc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut_paye` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE86641099DED506` (`id_client_id`),
  KEY `IDX_FE866410EF4F1912` (`mode_payement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture_pro_format`
--

DROP TABLE IF EXISTS `facture_pro_format`;
CREATE TABLE IF NOT EXISTS `facture_pro_format` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_facture_pro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_echeance` datetime NOT NULL,
  `clients_id` int DEFAULT NULL,
  `mode_payement_id` int DEFAULT NULL,
  `total_ht` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_tva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ttc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `convertir_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92A7118CAB014612` (`clients_id`),
  KEY `IDX_92A7118CEF4F1912` (`mode_payement_id`),
  KEY `IDX_92A7118C14F9D5F6` (`convertir_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_payement`
--

INSERT INTO `mode_payement` (`id`, `nom`, `code`, `facture_pro_format_id`) VALUES
(1, 'Virement', 'vrt', NULL),
(2, 'chèque', 'cqb', NULL),
(3, 'Espèce', 'esp', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notify`
--

DROP TABLE IF EXISTS `notify`;
CREATE TABLE IF NOT EXISTS `notify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facture_id` int DEFAULT NULL,
  `facture_pro_format_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_217BEDC87F2DEE08` (`facture_id`),
  KEY `IDX_217BEDC89505321D` (`facture_pro_format_id`),
  KEY `IDX_217BEDC8FB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Offset-Consulting', 'informatique', '12365478HH52', 'Cocody Riviera', '2727272727', 'Abidjan', 'côte d\'ivoire', 'offset-consulting@gmail.com', 'www.offset-consulting.com', 'cm003', 'RME', '2024-07-04 00:00:00', 'SARL', '08 BP 2941 Abidjan 08');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `contact`, `status`, `nom_utilisateur`) VALUES
(1, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$QxCTfAJ11Os9Zs1F7IWIY.xaTHwpWwjGoVdsIdd/VUvPXI8T6/pJm', 'admin', 'user', '12131615144', 1, 'chris_arnold'),
(2, 'user@gmail.com', '[\"ROLE_CONSULTER\"]', '$2y$13$QxCTfAJ11Os9Zs1F7IWIY.xaTHwpWwjGoVdsIdd/VUvPXI8T6/pJm', 'josias', 'yao', '0749162107', 1, 'josias@'),
(3, 'admin1@gmail.com', '[\"ROLE_FACTURE\"]', '$2y$13$.EvGQXF3aHdJR5ibRv1t5O8LAghgP4fdgY.Ta5xhzWRnWoJwAhIfi', 'Koffi', 'joe', '2225553686', 1, 'emmanuella@'),
(4, 'yaograce@gmail.com', '[\"ROLE_VALIDED_FACTURE\"]', '$2y$13$hYK1alCZ61CZnsh2f52QOesPmhRPK0GQcqwtAoCzvX/Zo0eFuQ29y', 'yao', 'grace', '010101010101', 1, 'grace@'),
(5, 'chris200311@gmail.com', '[\"ROLE_VALIDED_FACTURE_PRO\"]', '$2y$13$IZ0vkUiyC4RWE6ez61/tnOd4FYeDiIQFhNp1P4jKrTWf8iJMI9xYi', 'konan', 'franck', '010101010101', 1, 'franck@'),
(6, 'yaochris620@gmail.com', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$BI2CxNj6WtH5hmyYg43ijeGS7vdZ3fpAZszSXxZJGvoNxgXnfeXve', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, '__chris_arnold__'),
(7, 'produit@gmail.com', '[\"ROLE_FACTURE_PRO\"]', '$2y$13$QxCTfAJ11Os9Zs1F7IWIY.xaTHwpWwjGoVdsIdd/VUvPXI8T6/pJm', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, 'product@'),
(8, 'client@gmail.com', '[\"ROLE_FACTURE\"]', '$2y$13$.WTwsbuZml5CTFnWcz70Vu18o4Kl84MWdBIMET7OoswNsqGVhvpBi', 'YAO', 'CHRIS ARNOLD', '0749162109', 1, 'client@');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `banque_client`
--
ALTER TABLE `banque_client`
  ADD CONSTRAINT `FK_48214E8519EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_48214E8587C553BE` FOREIGN KEY (`banque_only_id`) REFERENCES `banque_only` (`id`);

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
-- Contraintes pour la table `detail_mode_payement`
--
ALTER TABLE `detail_mode_payement`
  ADD CONSTRAINT `FK_21CE12E537E080D9` FOREIGN KEY (`banque_id`) REFERENCES `banque_only` (`id`),
  ADD CONSTRAINT `FK_21CE12E56F272231` FOREIGN KEY (`encaissement_id`) REFERENCES `encaissement` (`id`),
  ADD CONSTRAINT `FK_21CE12E5A32C6EC6` FOREIGN KEY (`banque_client_id`) REFERENCES `banque_client` (`id`);

--
-- Contraintes pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  ADD CONSTRAINT `FK_4E6A6CF2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `detatil_encaissement`
--
ALTER TABLE `detatil_encaissement`
  ADD CONSTRAINT `FK_9CEDB6C16F272231` FOREIGN KEY (`encaissement_id`) REFERENCES `encaissement` (`id`),
  ADD CONSTRAINT `FK_9CEDB6C17F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`);

--
-- Contraintes pour la table `encaissement`
--
ALTER TABLE `encaissement`
  ADD CONSTRAINT `FK_5D4869B019EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_5D4869B0EF4F1912` FOREIGN KEY (`mode_payement_id`) REFERENCES `mode_payement` (`id`);

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
  ADD CONSTRAINT `FK_92A7118C14F9D5F6` FOREIGN KEY (`convertir_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `FK_92A7118CAB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_92A7118CEF4F1912` FOREIGN KEY (`mode_payement_id`) REFERENCES `mode_payement` (`id`);

--
-- Contraintes pour la table `mode_payement`
--
ALTER TABLE `mode_payement`
  ADD CONSTRAINT `FK_B16D0C1E9505321D` FOREIGN KEY (`facture_pro_format_id`) REFERENCES `facture_pro_format` (`id`);

--
-- Contraintes pour la table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `FK_217BEDC87F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `FK_217BEDC89505321D` FOREIGN KEY (`facture_pro_format_id`) REFERENCES `facture_pro_format` (`id`),
  ADD CONSTRAINT `FK_217BEDC8FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC271237A8DE` FOREIGN KEY (`type_produit_id`) REFERENCES `type_produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
