-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 mars 2021 à 22:16
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blue`
--

-- --------------------------------------------------------

--
-- Structure de la table `aimer`
--

CREATE TABLE `aimer` (
  `ID_TWEET` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `LIKER` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `centre_interet`
--

CREATE TABLE `centre_interet` (
  `ID_SUJET` int(11) NOT NULL,
  `LIB_CONTENU` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `centre_interet`
--

INSERT INTO `centre_interet` (`ID_SUJET`, `LIB_CONTENU`) VALUES
(1, 'sport'),
(2, 'music'),
(5, 'cuisine'),
(6, 'voyage');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `ID_COMMENTAIRE` int(11) NOT NULL,
  `CONTENU` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `ID_USER` int(11) NOT NULL,
  `ID_TWEET` int(11) NOT NULL,
  `DATEC` datetime NOT NULL DEFAULT current_timestamp(),
  `CONTENU` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commenter`
--

INSERT INTO `commenter` (`ID_USER`, `ID_TWEET`, `DATEC`, `CONTENU`) VALUES
(7, 102, '2021-03-15 22:02:17', 'cv?');

-- --------------------------------------------------------

--
-- Structure de la table `concerne`
--

CREATE TABLE `concerne` (
  `ID_TWEET` int(11) NOT NULL,
  `ID_SUJET` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `envoi`
--

CREATE TABLE `envoi` (
  `ID_USER1` int(11) NOT NULL,
  `ID_USER2` int(11) NOT NULL,
  `DATEM` datetime NOT NULL DEFAULT current_timestamp(),
  `CONTENU` varchar(250) NOT NULL,
  `IMAGE` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `envoi`
--

INSERT INTO `envoi` (`ID_USER1`, `ID_USER2`, `DATEM`, `CONTENU`, `IMAGE`) VALUES
(7, 9, '2021-03-15 22:04:18', 'salut cv?', 0),
(7, 27, '2021-03-15 22:05:10', 'salut cv?', 0),
(9, 7, '2021-03-15 22:04:46', 'cc cv?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `interesser`
--

CREATE TABLE `interesser` (
  `ID_SUJET` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `interesser`
--

INSERT INTO `interesser` (`ID_SUJET`, `ID_USER`) VALUES
(1, 7),
(1, 27),
(5, 7),
(5, 27),
(5, 28),
(6, 27);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `ID_MESSAGE` int(11) NOT NULL,
  `CONTENU` varchar(250) NOT NULL,
  `IMAGE` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

CREATE TABLE `suivre` (
  `ID_USER1` int(11) NOT NULL,
  `ID_USER2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `suivre`
--

INSERT INTO `suivre` (`ID_USER1`, `ID_USER2`) VALUES
(7, 9),
(7, 27),
(9, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `ID_TWEET` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TEXTE` text NOT NULL,
  `IMAGE` varchar(45) NOT NULL,
  `DATE_PARTAGE` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`ID_TWEET`, `ID_USER`, `TEXTE`, `IMAGE`, `DATE_PARTAGE`) VALUES
(102, 7, 'salut', '72021-03-15- 10-01-59.jpg', '2021-03-15 22:01:59');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `NOM_PRENOM` varchar(100) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `DATE_NAISSANCE` date NOT NULL,
  `MDP` varchar(20) NOT NULL,
  `PDP` varchar(40) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_USER`, `NOM_PRENOM`, `EMAIL`, `DATE_NAISSANCE`, `MDP`, `PDP`, `DESCRIPTION`) VALUES
(7, 'El Yousfii Alaoui Mohamed', 'sfeex@sfeex.sfe', '2000-11-14', 'SFEEEX', 'El Yousfii Alaoui Mohamed.jpg', 'oui frero'),
(9, 'chayma tlemcani', 'shay@shay.shay', '2005-04-17', 'shay', 'chayma tlemcani.jpeg', 'shaaaay'),
(27, 'Ayoub Fadili', 'fadili@fadili.fadili', '2001-03-15', 'SFEEEX', 'Ayoub Fadili.jpg', 'Fadilox'),
(28, 'Karim karim', 'karim@karim.karim', '2003-06-15', 'SFEEEX', 'Karim karim.jpg', 'karim');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aimer`
--
ALTER TABLE `aimer`
  ADD PRIMARY KEY (`ID_TWEET`,`ID_USER`),
  ADD KEY `ID_TWEET` (`ID_TWEET`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Index pour la table `centre_interet`
--
ALTER TABLE `centre_interet`
  ADD PRIMARY KEY (`ID_SUJET`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`ID_COMMENTAIRE`);

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`ID_USER`,`ID_TWEET`,`DATEC`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_TWEET` (`ID_TWEET`);

--
-- Index pour la table `concerne`
--
ALTER TABLE `concerne`
  ADD PRIMARY KEY (`ID_TWEET`,`ID_SUJET`),
  ADD KEY `ID_TWEET` (`ID_TWEET`),
  ADD KEY `ID_SUJET` (`ID_SUJET`);

--
-- Index pour la table `envoi`
--
ALTER TABLE `envoi`
  ADD PRIMARY KEY (`ID_USER1`,`ID_USER2`,`DATEM`),
  ADD KEY `ID_USER1` (`ID_USER1`),
  ADD KEY `ID_USER2` (`ID_USER2`);

--
-- Index pour la table `interesser`
--
ALTER TABLE `interesser`
  ADD PRIMARY KEY (`ID_SUJET`,`ID_USER`),
  ADD KEY `ID_SUJET` (`ID_SUJET`,`ID_USER`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_MESSAGE`);

--
-- Index pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD PRIMARY KEY (`ID_USER1`,`ID_USER2`),
  ADD KEY `ID_USER1` (`ID_USER1`),
  ADD KEY `ID_USER2` (`ID_USER2`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`ID_TWEET`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `centre_interet`
--
ALTER TABLE `centre_interet`
  MODIFY `ID_SUJET` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `ID_COMMENTAIRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ID_MESSAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `ID_TWEET` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aimer`
--
ALTER TABLE `aimer`
  ADD CONSTRAINT `aimer_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aimer_ibfk_2` FOREIGN KEY (`ID_TWEET`) REFERENCES `tweet` (`ID_TWEET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`ID_TWEET`) REFERENCES `tweet` (`ID_TWEET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `concerne`
--
ALTER TABLE `concerne`
  ADD CONSTRAINT `concerne_ibfk_1` FOREIGN KEY (`ID_TWEET`) REFERENCES `tweet` (`ID_TWEET`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `concerne_ibfk_2` FOREIGN KEY (`ID_SUJET`) REFERENCES `centre_interet` (`ID_SUJET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `envoi`
--
ALTER TABLE `envoi`
  ADD CONSTRAINT `envoi_ibfk_1` FOREIGN KEY (`ID_USER1`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envoi_ibfk_2` FOREIGN KEY (`ID_USER2`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `interesser`
--
ALTER TABLE `interesser`
  ADD CONSTRAINT `interesser_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interesser_ibfk_2` FOREIGN KEY (`ID_SUJET`) REFERENCES `centre_interet` (`ID_SUJET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_ibfk_1` FOREIGN KEY (`ID_USER1`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivre_ibfk_2` FOREIGN KEY (`ID_USER2`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
