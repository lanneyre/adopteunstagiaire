-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le : mar. 31 mars 2020 à 14:30
-- Version du serveur :  10.5.1-MariaDB-log
-- Version de PHP : 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `adopteunstagiaire`
--
CREATE DATABASE IF NOT EXISTS `adopteunstagiaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `adopteunstagiaire`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_role` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `admin_utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `admin_utilisateur_id` (`admin_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacter`
--

DROP TABLE IF EXISTS `contacter`;
CREATE TABLE IF NOT EXISTS `contacter` (
  `stagiaire_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`entreprise_id`),
  KEY `contacter_entreprise_id` (`entreprise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dispenser`
--

DROP TABLE IF EXISTS `dispenser`;
CREATE TABLE IF NOT EXISTS `dispenser` (
  `formateur_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  PRIMARY KEY (`formateur_id`,`formation_id`),
  KEY `dispenser_formation_id` (`formation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `entreprise_id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_raisonSociale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_cp` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_siret` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_caracteristiques` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`entreprise_id`),
  KEY `entreprise_utilisateur_id` (`entreprise_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `formateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `formateur_nom` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `formateur_prenom` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `formateur_utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`formateur_id`),
  KEY `formateur_utilisateur_id` (`formateur_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `formation_id` int(11) NOT NULL AUTO_INCREMENT,
  `formation_nom` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `formation_dateDebut` datetime NOT NULL DEFAULT current_timestamp(),
  `formation_dateFin` datetime NOT NULL DEFAULT current_timestamp(),
  `formation_typeformation_id` int(11) NOT NULL,
  PRIMARY KEY (`formation_id`),
  KEY `formation_typeformation_id` (`formation_typeformation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `informer`
--

DROP TABLE IF EXISTS `informer`;
CREATE TABLE IF NOT EXISTS `informer` (
  `formateur_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  PRIMARY KEY (`formateur_id`,`entreprise_id`),
  KEY `informer_entreprise_id` (`entreprise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `stage_id` int(11) NOT NULL,
  `stage_dateDebut` date NOT NULL,
  `stage_dateFin` date NOT NULL,
  `stage_suivi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_convention` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_formation_id` int(11) NOT NULL,
  `stage_entreprise_id` int(11) NOT NULL,
  `stage_formateur_id` int(11) NOT NULL,
  PRIMARY KEY (`stage_id`),
  KEY `stage_formation_id` (`stage_formation_id`),
  KEY `stage_entreprise_id` (`stage_entreprise_id`),
  KEY `stage_formateur_id` (`stage_formateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `stagiaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `stagiaire_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_statut` tinyint(4) NOT NULL,
  `stagiaire_preferences` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_utilisateur_id` int(11) DEFAULT NULL,
  `stagiaire_formation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stagiaire_id`),
  KEY `stagiaire_utilisateur_id` (`stagiaire_utilisateur_id`),
  KEY `stagiaire_formation_id` (`stagiaire_formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`stagiaire_id`, `stagiaire_nom`, `stagiaire_prenom`, `stagiaire_cv`, `stagiaire_statut`, `stagiaire_preferences`, `stagiaire_utilisateur_id`, `stagiaire_formation_id`) VALUES
(1, 'Marie', 'BLANC', '', 0, 'Lorem Ipsum', NULL, NULL),
(2, 'Benedicte', 'BOUI ', '', 0, 'Lorem Ipsum', NULL, NULL),
(3, 'Soumaya', 'CANCOIN', '', 0, 'Lorem Ipsum', NULL, NULL),
(4, 'Vincent', 'COCHET-HILGENBERG', '', 0, 'Lorem Ipsum', NULL, NULL),
(5, 'Sabrina', 'DAOUD', '', 0, 'Lorem Ipsum', NULL, NULL),
(6, 'Hugo', 'DEJEAN', '', 0, 'Lorem Ipsum', NULL, NULL),
(7, 'Nagui', 'DELIQUAIRE', '', 0, 'Lorem Ipsum', NULL, NULL),
(8, 'Fleur', 'DEVELEY', '', 0, 'Lorem Ipsum', NULL, NULL),
(9, 'Anissa', 'EL HELALI', '', 0, 'Lorem Ipsum', NULL, NULL),
(10, 'Jeremy', 'FILLIN ', '', 0, 'Lorem Ipsum', NULL, NULL),
(11, 'Emmanuel', 'GARCIA', '', 0, 'Lorem Ipsum', NULL, NULL),
(12, 'Corinne', 'HERVE ', '', 0, 'Lorem Ipsum', NULL, NULL),
(13, 'Ahmed', 'KARA ', '', 0, 'Lorem Ipsum', NULL, NULL),
(14, 'Franck', 'MARTINEZ', '', 0, 'Lorem Ipsum', NULL, NULL),
(15, 'Audrey', 'MEDICI', '', 0, 'Lorem Ipsum', NULL, NULL),
(16, 'Benjamin', 'MORIN', '', 0, 'Lorem Ipsum', NULL, NULL),
(17, 'Lorry', 'NADER ', '', 0, 'Lorem Ipsum', NULL, NULL),
(18, 'Nathalie', 'NOIRFALISE ', '', 0, 'Lorem Ipsum', NULL, NULL),
(19, 'Nadeje', 'THOMASSET ', '', 0, 'Lorem Ipsum', NULL, NULL),
(20, 'Axel', 'AVAD ', '', 0, 'Lorem Ipsum', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

DROP TABLE IF EXISTS `suivre`;
CREATE TABLE IF NOT EXISTS `suivre` (
  `stagiaire_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`stage_id`),
  KEY `suivre_stage_id` (`stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeformation`
--

DROP TABLE IF EXISTS `typeformation`;
CREATE TABLE IF NOT EXISTS `typeformation` (
  `typeformation_id` int(11) NOT NULL AUTO_INCREMENT,
  `typeformation_programme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeformation_competences` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`typeformation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utilisateur_mdp` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utilisateur_presentation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utilisateur_tel` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`utilisateur_id`),
  UNIQUE KEY `Utilisateur_mail` (`utilisateur_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_utilisateur_id` FOREIGN KEY (`admin_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contacter`
--
ALTER TABLE `contacter`
  ADD CONSTRAINT `contacter_entreprise_id` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`entreprise_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacter_stagiaire_id` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`stagiaire_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `dispenser`
--
ALTER TABLE `dispenser`
  ADD CONSTRAINT `dispenser_formateur_id` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`formateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dispenser_formation_id` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`formation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `entreprise_utilisateur_id` FOREIGN KEY (`entreprise_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `formateur_utilisateur_id` FOREIGN KEY (`formateur_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_typeformation_id` FOREIGN KEY (`formation_typeformation_id`) REFERENCES `typeformation` (`typeformation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `informer`
--
ALTER TABLE `informer`
  ADD CONSTRAINT `informer_entreprise_id` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`entreprise_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `informer_formateur_id` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`formateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_entreprise_id` FOREIGN KEY (`stage_entreprise_id`) REFERENCES `entreprise` (`entreprise_utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stage_formateur_id` FOREIGN KEY (`stage_formateur_id`) REFERENCES `formateur` (`formateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stage_formation_id` FOREIGN KEY (`stage_formation_id`) REFERENCES `formation` (`formation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_formation_id` FOREIGN KEY (`stagiaire_formation_id`) REFERENCES `formation` (`formation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stagiaire_utilisateur_id` FOREIGN KEY (`stagiaire_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_stage_id` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`stage_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `suivre_stagiaire_id` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`stagiaire_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
