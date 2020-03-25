-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 20 mars 2020 à 09:11
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

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

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--


--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `mail`, `mdp`, `presentation`, `tel`, `nom`, `prenom`, `CV`, `statut`, `formation`) VALUES
(1, 'Marie.BLANC.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Marie', 'BLANC', '', 0, 1),
(2, 'Benedicte.BOUI.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Benedicte', 'BOUI ', '', 0, 1),
(3, 'Soumaya.CANCOIN.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Soumaya', 'CANCOIN', '', 0, 1),
(4, 'Vincent.COCHET-HILGENBERG.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Vincent', 'COCHET-HILGENBERG', '', 0, 1),
(5, 'Sabrina.DAOUD.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Sabrina', 'DAOUD', '', 0, 1),
(6, 'Hugo.DEJEAN.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Hugo', 'DEJEAN', '', 0, 1),
(7, 'Nagui.DELIQUAIRE.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Nagui', 'DELIQUAIRE', '', 0, 1),
(8, 'Fleur.DEVELEY.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Fleur', 'DEVELEY', '', 0, 1),
(9, 'Anissa.EL HELALI.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Anissa', 'EL HELALI', '', 0, 1),
(10, 'Jeremy.FILLIN.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Jeremy', 'FILLIN ', '', 0, 1),
(11, 'Emmanuel.GARCIA.ics-nice.com', '123456', 'Lorem Ipsum', '01 23 45 67 89', 'Emmanuel', 'GARCIA', '', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `stagiaire`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
