-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 04 nov. 2020 à 00:23
-- Version du serveur :  5.7.31-log
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `3ilreservation`
--

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

DROP TABLE IF EXISTS `creneau`;
CREATE TABLE IF NOT EXISTS `creneau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure_d` varchar(10) NOT NULL,
  `heure_f` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`id`, `heure_d`, `heure_f`) VALUES
(1, '08h00', '10h00'),
(2, '10h30', '12h00'),
(3, '13h30', '15h00'),
(4, '15h15', '16h45');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

DROP TABLE IF EXISTS `horaire`;
CREATE TABLE IF NOT EXISTS `horaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsalle` int(11) NOT NULL,
  `date` date NOT NULL,
  `nbplace` int(11) NOT NULL,
  `creneau1` int(11) NOT NULL,
  `creneau2` int(11) NOT NULL,
  `creneau3` int(11) NOT NULL,
  `creneau4` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idsalle` (`idsalle`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `idsalle`, `date`, `nbplace`, `creneau1`, `creneau2`, `creneau3`, `creneau4`) VALUES
(1, 1, '2020-10-02', 18, 1, 0, 0, 1),
(2, 2, '2020-10-02', 18, 1, 1, 1, 1),
(3, 3, '2020-10-02', 18, 1, 1, 0, 1),
(4, 4, '2020-10-03', 18, 1, 0, 1, 1),
(5, 5, '2020-10-03', 18, 0, 1, 0, 0),
(6, 6, '2020-10-03', 18, 1, 0, 0, 1),
(7, 7, '2020-10-05', 18, 0, 0, 0, 1),
(8, 8, '2020-10-05', 18, 1, 1, 1, 1),
(9, 9, '2020-10-05', 18, 1, 1, 1, 0),
(10, 10, '2020-10-05', 18, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idutilisateur` int(11) NOT NULL,
  `idsalle` int(11) NOT NULL,
  `date` date NOT NULL,
  `creneau` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idutilisateur` (`idutilisateur`),
  KEY `idsalle` (`idsalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `numero`) VALUES
(1, 100),
(2, 101),
(3, 102),
(4, 103),
(5, 104),
(6, 105),
(7, 106),
(8, 107),
(9, 108),
(10, 109);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL,
  `code_secret` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `role`, `code_secret`) VALUES
(1, 'test@3il.fr', 'test1', 'etudiant', 'ZKA-XZB-YCR-DGF-WMK-FVX'),
(2, 'erat.eget.tincidunt@etrutrum.net', 'test2', 'etudiant', 'ZKA-DGF-FVX-AAB-BAD-ACD'),
(3, 'non.bibendum@commodoipsumSuspendisse.net', 'test3', 'etudiant', 'YCR-XZB-ZKA-ACD-BAD-AAB'),
(4, 'volutpat.Nulla@parturientmontes.net', 'test4', 'etudiant', '\'WMK-DGF-YCR-XZB-ZKA-ACD'),
(5, 'ornare@egestasligulaNullam.ca', 'test5', 'etudiant', 'OYC-FVX-WMK-DGF-YCR-XZB'),
(6, 'ut.ipsum@sapien.net', 'test6', 'etudiant', 'FVX-WMK-DGF-YCR-XZB-ZKA'),
(7, 'sollicitudin.adipiscing@eleifendnec.co.uk', 'test7', 'etudiant', 'DGF-YCR-XZB-ZKA-ACD-BAD'),
(8, 'varius.orci@risusMorbi.net', 'test8', 'etudiant', 'DGF-WMK-YCR-XZB-ZKA-ACD'),
(9, 'tellus.eu@semsemper.net', 'test9', 'etudiant', 'BAD-ACD-ZKA-ZKA-YCR-YCR'),
(10, 'admin@3il.fr', 'admin', 'admin', 'BAD-ACD-ZKA-XZB-YCR-DGF');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `horaire_ibfk_1` FOREIGN KEY (`idsalle`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idsalle`) REFERENCES `salle` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
