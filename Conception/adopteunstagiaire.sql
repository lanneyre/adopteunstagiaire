-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 18 mars 2020 à 14:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `adopteunstagiaire`
--
CREATE DATABASE IF NOT EXISTS `adopteunstagiaire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `adopteunstagiaire`;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raisonSociale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CP` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tronquer la table avant d'insérer `entreprise`
--

TRUNCATE TABLE `entreprise`;
-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CV` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` tinyint(4) NOT NULL,
  `formation` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tronquer la table avant d'insérer `stagiaire`
--

TRUNCATE TABLE `stagiaire`;
--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `mail`, `mdp`, `presentation`, `tel`, `nom`, `prenom`, `CV`, `statut`, `formation`) VALUES
(1, 'Marie.BLANC.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Marie', 'BLANC', '', 0, 1),
(3, 'Soumaya.CANCOIN.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Soumaya', 'CANCOIN', '', 0, 1),
(4, 'Vincent.COCHET-HILGENBERG.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Vincent', 'COCHET-HILGENBERG', '', 0, 1),
(5, 'Sabrina.DAOUD.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Sabrina', 'DAOUD', '', 0, 1),
(6, 'Hugo.DEJEAN.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Hugo', 'DEJEAN', '', 0, 1),
(7, 'Nagui.DELIQUAIRE.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Nagui', 'DELIQUAIRE', '', 0, 1),
(8, 'Fleur.DEVELEY.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Fleur', 'DEVELEY', '', 0, 1),
(9, 'Anissa.EL HELALI.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Anissa', 'EL HELALI', '', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
