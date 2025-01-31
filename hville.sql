-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 jan. 2025 à 10:30
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
-- Base de données : `hville`
--

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

DROP TABLE IF EXISTS `compose`;
CREATE TABLE IF NOT EXISTS `compose` (
  `ID_SERVICE` int NOT NULL,
  `ID_SALLE` int NOT NULL,
  `QTE_CHAMBRE` int DEFAULT NULL,
  PRIMARY KEY (`ID_SERVICE`,`ID_SALLE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`ID_SERVICE`, `ID_SALLE`, `QTE_CHAMBRE`) VALUES
(1, 1, 10),
(2, 2, 10),
(3, 3, 2),
(4, 4, 5),
(5, 5, 5),
(6, 6, 2),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `ID_EMPLOYE` int NOT NULL AUTO_INCREMENT,
  `ID_SERVICE` int NOT NULL,
  `TYPE_EMPLOYE` varchar(25) NOT NULL,
  `NOM_EMPLOYE` varchar(25) DEFAULT NULL,
  `PRENOM_EMPLOYE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_EMPLOYE`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`ID_EMPLOYE`, `ID_SERVICE`, `TYPE_EMPLOYE`, `NOM_EMPLOYE`, `PRENOM_EMPLOYE`) VALUES
(1, 1, 'C', 'VACHET', 'LUKAS'),
(2, 2, 'I', 'SID', 'WASSIM'),
(3, 3, 'A', 'PICQUET', 'NICOLAS'),
(4, 4, 'I', 'CERVEAUX', 'MARCEAU'),
(5, 5, 'A', 'SERGIO', 'WICRAMACHINE'),
(6, 6, 'A', 'KONIECZKOWICZ', 'RAPHAEL');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `ID_SALLE` int NOT NULL AUTO_INCREMENT,
  `TYPE_SALLE` varchar(25) NOT NULL,
  `TEMP_SALLE` int DEFAULT NULL,
  PRIMARY KEY (`ID_SALLE`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`ID_SALLE`, `TYPE_SALLE`, `TEMP_SALLE`) VALUES
(1, 'M', 19),
(2, 'O', 17),
(3, 'B', 22);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `ID_SERVICE` int NOT NULL AUTO_INCREMENT,
  `LIBELLE_SERVICE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_SERVICE`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ID_SERVICE`, `LIBELLE_SERVICE`) VALUES
(1, 'Service Urologie'),
(2, 'Service Gastroentérologie'),
(3, 'Service Chirurgie'),
(4, 'Service Obstétrique'),
(5, 'Service Pédiatrie'),
(6, 'Service Cardiologie');

-- --------------------------------------------------------

--
-- Structure de la table `type_employe`
--

DROP TABLE IF EXISTS `type_employe`;
CREATE TABLE IF NOT EXISTS `type_employe` (
  `TYPE_EMPLOYE` varchar(25) NOT NULL,
  `LIBELLE_EMPLOYE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`TYPE_EMPLOYE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_employe`
--

INSERT INTO `type_employe` (`TYPE_EMPLOYE`, `LIBELLE_EMPLOYE`) VALUES
('C', 'Chef de service'),
('I', 'Infirmier'),
('A', 'Aide soignant');

-- --------------------------------------------------------

--
-- Structure de la table `type_salle`
--

DROP TABLE IF EXISTS `type_salle`;
CREATE TABLE IF NOT EXISTS `type_salle` (
  `TYPE_SALLE` varchar(25) NOT NULL,
  `LIBELLE_SALLE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`TYPE_SALLE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_salle`
--

INSERT INTO `type_salle` (`TYPE_SALLE`, `LIBELLE_SALLE`) VALUES
('M', 'Chambre médicale'),
('O', 'Bloc opératoire'),
('B', 'Bureau');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
