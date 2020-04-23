-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 23 avr. 2020 à 10:57
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

--
-- Déchargement des données de la table `dispenser`
--

INSERT INTO `dispenser` (`formateur_id`, `formation_id`) VALUES
(1, 1),
(2, 5),
(2, 6),
(3, 3),
(4, 2),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `entreprise_id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_raisonSociale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_cp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_siret` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_caracteristiques` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`entreprise_id`),
  KEY `entreprise_utilisateur_id` (`entreprise_utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`entreprise_id`, `entreprise_raisonSociale`, `entreprise_adresse`, `entreprise_cp`, `entreprise_ville`, `entreprise_siret`, `entreprise_caracteristiques`, `entreprise_utilisateur_id`) VALUES
(2, 'Graine de fermier', NULL, NULL, NULL, '0123456789987', NULL, 1),
(3, 'CCI', NULL, NULL, NULL, '9876543210123', NULL, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`formateur_id`, `formateur_nom`, `formateur_prenom`, `formateur_utilisateur_id`) VALUES
(1, 'LANNEY', 'Rémi', 3),
(2, 'ENRICI', 'Cyril', 24),
(3, 'Debrun', 'Maxime', 26),
(4, 'ALLIO', 'Jacques', 25),
(5, 'AMSELEM', 'Jonathan', 27);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`formation_id`, `formation_nom`, `formation_dateDebut`, `formation_dateFin`, `formation_typeformation_id`) VALUES
(1, 'DWWM2', '2020-04-07 14:57:07', '2020-04-07 14:57:07', 1),
(2, 'TAI 1', '2019-12-09 08:30:00', '2020-07-17 16:30:00', 2),
(3, 'TAI 2', '2020-03-23 08:30:00', '2020-09-18 16:30:00', 2),
(4, 'CDA 1', '2019-11-18 08:30:00', '2020-11-13 16:30:00', 6),
(5, 'java1', '2020-04-21 12:18:17', '2020-04-21 12:18:17', 3),
(6, 'PHP1', '2020-04-21 12:18:17', '2020-04-21 12:18:17', 4);

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

--
-- Déchargement des données de la table `informer`
--

INSERT INTO `informer` (`formateur_id`, `entreprise_id`) VALUES
(1, 2),
(1, 3);

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
  `stagiaire_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_statut` tinyint(4) NOT NULL,
  `stagiaire_preferences` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `stagiaire_utilisateur_id` int(11) DEFAULT NULL,
  `stagiaire_formation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stagiaire_id`),
  KEY `stagiaire_utilisateur_id` (`stagiaire_utilisateur_id`),
  KEY `stagiaire_formation_id` (`stagiaire_formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`stagiaire_id`, `stagiaire_prenom`, `stagiaire_nom`, `stagiaire_cv`, `stagiaire_statut`, `stagiaire_preferences`, `stagiaire_utilisateur_id`, `stagiaire_formation_id`) VALUES
(1, 'Marie', 'BLANC', '', 0, 'Lorem Ipsum', 4, 1),
(2, 'Benedicte', 'BOUY', '', 0, 'Lorem Ipsum', 5, 1),
(3, 'Soumaya', 'CANCOIN', '', 0, 'Lorem Ipsum', 6, 1),
(4, 'Vincent', 'COCHET-HILGENBERG', '', 0, 'Lorem Ipsum', 7, 1),
(5, 'Sabrina', 'DAOUD', '', 0, 'Lorem Ipsum', 8, 1),
(6, 'Hugo', 'DEJEAN', '', 0, 'Observateur', 9, 1),
(7, 'Nagui', 'DELIQUAIRE', '', 0, 'Lorem Ipsum', 10, 1),
(8, 'Fleur', 'DEVELEY', '', 0, 'Lorem Ipsum', 11, 1),
(9, 'Anissa', 'EL HELALI', '', 0, 'Lorem Ipsum', 12, 1),
(10, 'Jeremy', 'FILIN ', '', 0, 'Lorem Ipsum', 13, 1),
(11, 'Emmanuel', 'GARCIA', '', 0, 'Lorem Ipsum', 14, 1),
(12, 'Corinne', 'HERVE ', '', 0, 'Lorem Ipsum', 15, 1),
(13, 'Ahmed', 'KARA ', '', 0, 'Lorem Ipsum', 16, 1),
(14, 'Franck', 'MARTINEZ', '', 0, 'Lorem Ipsum', 17, 1),
(15, 'Audrey', 'MEDICI', '', 0, 'Lorem Ipsum', 18, 1),
(16, 'Benjamin', 'MORIN', '', 0, 'Lorem Ipsum', 19, 1),
(17, 'Lorry', 'NADER ', '', 0, 'Lorem Ipsum', 20, 1),
(18, 'Nathalie', 'NOIRFALISE ', '', 0, 'Lorem Ipsum', 21, 1),
(19, 'Nadeje', 'THOMASSET ', '', 0, 'Lorem Ipsum', 22, 1),
(20, 'Axel', 'MINDEAU ABAD', '', 0, 'Lorem Ipsum', 23, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typeformation`
--

INSERT INTO `typeformation` (`typeformation_id`, `typeformation_programme`, `typeformation_competences`) VALUES
(1, 'DWWM', 'pleins'),
(2, 'TAI', 'Pleins'),
(3, 'Dev Java', 'Oui'),
(4, 'Dev PHP/Mysql', 'Oui'),
(5, 'TSSR', 'OUI'),
(6, 'CDA', 'Pleins');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_mail`, `utilisateur_mdp`, `utilisateur_presentation`, `utilisateur_tel`) VALUES
(1, 'test@gdf.fr', '$2y$10$pHtlFt4I3UnsF01IYsj/sOVIsnjsWQA7456CLIge0gnyBnbhLHlxS', NULL, NULL),
(2, 'contact@cci.com', '$2y$10$pHtlFt4I3UnsF01IYsj/sOVIsnjsWQA7456CLIge0gnyBnbhLHlxS', NULL, NULL),
(3, 'remi.lanney@cote-azur.cci.fr', '$2y$10$9DTxVdA4zY9GD1Gymf8P.uWEeYlCVCYBLNsnX9MjDtKG7goolOJg2', NULL, NULL),
(4, 'm.blanc@ics-nice.com', '$2y$10$.escNzunJ4GSbmNMt7eOKen17EBPQBCR53b055iISqb8LucMqT//m', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(5, 'b.bouy@ics-nice.com', '$2y$10$gY.npCWcqpAvnsC2ANcTEurdVSopqeGJ8i0tbIePulrFgP82PxGum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(6, 's.cancoin@ics-nice.com', '$2y$10$zJtC9ktqk32Wmxf53VWhK.c4VBWKnwXySKJr61hOr.Gsv6CX8iG4e', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(7, 'v.cochet-hilgenberg@ics-nice.com', '$2y$10$pHtlFt4I3UnsF01IYsj/sOVIsnjsWQA7456CLIge0gnyBnbhLHlxS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(8, 's.daoud@ics-nice.com', '$2y$10$12G7dICQJutr3wvgQR04veysPgEK2Uu6Uv49hqByosq3ggvPC8egS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(9, 'h.dejean@ics-nice.com', '$2y$10$GNwazpKJ/mgH2i5nLC/x0.rHoDbIUOpr/1.l4lXsmK0u4nw9r.Cny', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(10, 'n.deliquaire@ics-nice.com', '$2y$10$mHtDTPqHISUmaN1C6cENWOoRrXv2irgmvxegk6OjDY0dJhilJoQci', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(11, 'f.develey@ics-nice.com', '$2y$10$qkipfIphZb8/4zrxNUvqV.RaJQ1K8bM6YuU/iR9FnaIDiZk3iRmGS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(12, 'a.el-helali@ics-nice.com', '$2y$10$jvV4RbcH5Ib1n.3t2sqZKupV7RPZFckuQ6gSgyXJXfMsbzQKskSL.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(13, 'j.filin-@ics-nice.com', '$2y$10$KprTyTlQpq41m6JK/2pZ/OLWkyDUAPfrbcx8O6tQFyv.6vAlgi9ia', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(14, 'e.garcia@ics-nice.com', '$2y$10$NWJ/EtmuC1P.y6F.I4Wuz.q3rrjvtiRiU/eK1WoBLVgA40t28Cawq', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(15, 'c.herve-@ics-nice.com', '$2y$10$7fHwzMslD7I7jJ8BS/ni/.0rztXjnj.q.ZEqRKnlBybpVW7XhUMa2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(16, 'a.kara-@ics-nice.com', '$2y$10$5/m7I8kAAcSx2VxcweD37ujUU1cN/fiYqcS.CZSSna3nnsLqoQgLm', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(17, 'f.martinez@ics-nice.com', '$2y$10$IG5/vWpn/7eWlrIZozmO7u3fnLssj8BR3UTsu19cdj95fha.BN8EG', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(18, 'a.medici@ics-nice.com', '$2y$10$C9kjzJKWJZmhHlv4Qy6yYeW6E9panB1DtwBqD06GQD0Tl2VAYUf5K', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(19, 'b.morin@ics-nice.com', '$2y$10$f67oSz9m8T0rIvvOWkwT9OU/MbvnBCghXTXNCaRvHLe5Js9rsky76', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(20, 'l.nader-@ics-nice.com', '$2y$10$qZgY4R4CYSdhBondN6kRX.UOfhBu4lrzM2JZuC.f7nCJ6JwJuPhqC', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(21, 'n.noirfalise-@ics-nice.com', '$2y$10$GJ/EBYoMojR3vr8tRbpsqeKUpt67XJ/8LSZbEQozOVF.VIAaH92rG', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(22, 'n.thomasset-@ics-nice.com', '$2y$10$v87ki9l.2nVF5EXlF4h3z.9EZUquulVaWxs1qyliosA5zj1dhoW9K', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(23, 'a.mindeau-abad@ics-nice.com', '$2y$10$aPQE4nsZ.nLagpxCDOdl5uKb6YV/Sij5szIT14NjRuqF9CsnG6F9S', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam eius deleniti sit obcaecati, porro doloremque voluptatum a qui saepe consequatur! Optio rem quis unde laudantium laborum enim dolorum corporis architecto.', '06 21 34 59 78'),
(24, 'cyril.enrici@cote-azur.cci.fr', 'oui', NULL, NULL),
(25, 'jacques.allio@cote-azur.cci.fr', 'oui', NULL, NULL),
(26, 'maxime.debrun@cote-azur.cci.fr', 'oui', NULL, NULL),
(27, 'jonathan.amselem@cote-azur.cci.fr', 'oui', NULL, NULL);

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
