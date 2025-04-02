-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 02 avr. 2025 à 06:37
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `random-combat`
--

-- --------------------------------------------------------

DROP
DATABASE IF EXISTS `random-combat`;
CREATE
DATABASE `random-combat`;
USE
`random-combat`;

--
-- Structure de la table `aptitude`
--

CREATE TABLE `aptitude`
(
    `Id`  int(11) NOT NULL,
    `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `aptitude`
--

INSERT INTO `aptitude` (`Id`, `nom`)
VALUES (1, 'Coup de poing droit'),
       (2, 'Coup de poing gauche'),
       (3, 'Coup de pied droit'),
       (4, 'Coup de pied gauche'),
       (5, 'Balayette'),
       (6, 'Takedown'),
       (7, 'Coup de tête');

-- --------------------------------------------------------

--
-- Structure de la table `combat`
--

CREATE TABLE `combat`
(
    `Id`              int(11) NOT NULL,
    `id_combattant_1` int(11) DEFAULT NULL,
    `id_combattant_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `combat`
--

INSERT INTO `combat` (`Id`, `id_combattant_1`, `id_combattant_2`)
VALUES (1, 1, 2),
       (2, 3, 4),
       (3, 5, 6),
       (4, 7, 8),
       (5, 9, 10),
       (6, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `combattant`
--

CREATE TABLE `combattant`
(
    `Id`       int(11) NOT NULL,
    `nom`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `force`    int(11) DEFAULT NULL,
    `sante`    int(11) DEFAULT NULL,
    `niveau`   int(11) DEFAULT NULL,
    `id_style` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `combattant`
--

INSERT INTO `combattant` (`Id`, `nom`, `force`, `sante`, `niveau`, `id_style`)
VALUES (1, 'Bruce Lee', 95, 95, 18, 1),
       (2, 'Muhammad Ali', 85, 100, 16, 2),
       (3, 'Mike Tyson', 98, 92, 19, 2),
       (4, 'Georges St-Pierre', 85, 100, 16, 3),
       (5, 'Khabib Nurmagomedov', 93, 120, 17, 4),
       (6, 'Conor McGregor', 88, 105, 15, 5),
       (7, 'Anderson Silva', 89, 108, 16, 6),
       (8, 'Jon Jones', 96, 115, 10, 7),
       (9, 'Fedor Emelianenko', 94, 118, 17, 1),
       (10, 'Chuck Liddell', 87, 102, 14, 2),
       (11, 'Ronda Rousey', 85, 108, 13, 8);



-- --------------------------------------------------------

--
-- Structure de la table `combattant_aptitude`
--

CREATE TABLE `combattant_aptitude`
(
    `id_combattant` int(11) NOT NULL,
    `id_aptitude`   int(11) NOT NULL,
    `note`          int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `combattant_aptitude`
--

INSERT INTO `combattant_aptitude` (`id_combattant`, `id_aptitude`, `note`)
VALUES (1, 1, 8),
       (1, 2, 7),
       (1, 3, 9),
       (1, 4, 6),
       (1, 5, 8),
       (1, 6, 7),
       (1, 7, 6),
       (2, 1, 7),
       (2, 2, 6),
       (2, 3, 8),
       (2, 4, 7),
       (2, 5, 8),
       (2, 6, 6),
       (2, 7, 7),
       (3, 1, 6),
       (3, 2, 8),
       (3, 3, 7),
       (3, 4, 9),
       (3, 5, 7),
       (3, 6, 6),
       (3, 7, 8),
       (4, 1, 8),
       (4, 2, 6),
       (4, 3, 7),
       (4, 4, 9),
       (4, 5, 6),
       (4, 6, 8),
       (4, 7, 7),
       (5, 1, 7),
       (5, 2, 6),
       (5, 3, 8),
       (5, 4, 7),
       (5, 5, 7),
       (5, 6, 6),
       (5, 7, 9),
       (6, 1, 9),
       (6, 2, 8),
       (6, 3, 7),
       (6, 4, 6),
       (6, 5, 9),
       (6, 6, 7),
       (6, 7, 8),
       (7, 1, 6),
       (7, 2, 7),
       (7, 3, 8),
       (7, 4, 7),
       (7, 5, 6),
       (7, 6, 9),
       (7, 7, 8),
       (8, 1, 5),
       (8, 2, 6),
       (8, 3, 7),
       (8, 4, 8),
       (8, 5, 6),
       (8, 6, 7),
       (8, 7, 5),
       (9, 1, 8),
       (9, 2, 7),
       (9, 3, 6),
       (9, 4, 7),
       (9, 5, 8),
       (9, 6, 6),
       (9, 7, 7),
       (10, 1, 9),
       (10, 2, 8),
       (10, 3, 7),
       (10, 4, 6),
       (10, 5, 9),
       (10, 6, 8),
       (10, 7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat`
(
    `id_combat` int(11) NOT NULL,
    `gagnant`   int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `resultat`
--

INSERT INTO `resultat` (`id_combat`, `gagnant`)
VALUES (1, 1),
       (2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `round`
--

CREATE TABLE `round`
(
    `Id`            int(11) NOT NULL,
    `id_combat`     int(11) DEFAULT NULL,
    `id_aptitude`   int(11) DEFAULT NULL,
    `id_combattant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `round`
--

INSERT INTO `round` (`Id`, `id_combat`, `id_aptitude`, `id_combattant`)
VALUES (1, 1, 1, 1),
       (2, 1, 1, 2),
       (3, 1, 3, 1),
       (4, 1, 3, 2),
       (5, 2, 1, 3),
       (6, 2, 1, 4),
       (7, 2, 4, 3),
       (8, 2, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

CREATE TABLE `style`
(
    `Id`  int(11) NOT NULL,
    `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`Id`, `nom`)
VALUES (1, 'Boxe thai'),
       (2, 'Boxe anglaise'),
       (3, 'Judo'),
       (4, 'Capoeira'),
       (5, 'Krav Maga'),
       (6, 'Takwendo'),
       (7, 'JJB'),
       (8, 'Karaté');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aptitude`
--
ALTER TABLE `aptitude`
    ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `combat`
--
ALTER TABLE `combat`
    ADD PRIMARY KEY (`Id`),
  ADD KEY `id_combattant_1` (`id_combattant_1`),
  ADD KEY `id_combattant_2` (`id_combattant_2`);

--
-- Index pour la table `combattant`
--
ALTER TABLE `combattant`
    ADD PRIMARY KEY (`Id`),
  ADD KEY `id_style` (`id_style`);

--
-- Index pour la table `combattant_aptitude`
--
ALTER TABLE `combattant_aptitude`
    ADD PRIMARY KEY (`id_combattant`, `id_aptitude`),
  ADD KEY `id_aptitude` (`id_aptitude`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
    ADD PRIMARY KEY (`id_combat`),
  ADD KEY `gagnant` (`gagnant`);

--
-- Index pour la table `round`
--
ALTER TABLE `round`
    ADD PRIMARY KEY (`Id`),
  ADD KEY `id_combat` (`id_combat`),
  ADD KEY `id_aptitude` (`id_aptitude`),
  ADD KEY `id_combattant` (`id_combattant`);

--
-- Index pour la table `style`
--
ALTER TABLE `style`
    ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aptitude`
--
ALTER TABLE `aptitude`
    MODIFY `Id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `combat`
--
ALTER TABLE `combat`
    MODIFY `Id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `combattant`
--
ALTER TABLE `combattant`
    MODIFY `Id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `round`
--
ALTER TABLE `round`
    MODIFY `Id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `style`
--
ALTER TABLE `style`
    MODIFY `Id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `combat`
--
ALTER TABLE `combat`
    ADD CONSTRAINT `combat_ibfk_1` FOREIGN KEY (`id_combattant_1`) REFERENCES `combattant` (`Id`),
  ADD CONSTRAINT `combat_ibfk_2` FOREIGN KEY (`id_combattant_2`) REFERENCES `combattant` (`Id`);

--
-- Contraintes pour la table `combattant`
--
ALTER TABLE `combattant`
    ADD CONSTRAINT `combattant_ibfk_1` FOREIGN KEY (`id_style`) REFERENCES `style` (`Id`);

--
-- Contraintes pour la table `combattant_aptitude`
--
ALTER TABLE `combattant_aptitude`
    ADD CONSTRAINT `combattant_aptitude_ibfk_1` FOREIGN KEY (`id_combattant`) REFERENCES `combattant` (`Id`),
  ADD CONSTRAINT `combattant_aptitude_ibfk_2` FOREIGN KEY (`id_aptitude`) REFERENCES `aptitude` (`Id`);

--
-- Contraintes pour la table `resultat`
--
ALTER TABLE `resultat`
    ADD CONSTRAINT `resultat_ibfk_1` FOREIGN KEY (`id_combat`) REFERENCES `combat` (`Id`),
  ADD CONSTRAINT `resultat_ibfk_2` FOREIGN KEY (`gagnant`) REFERENCES `combattant` (`Id`);

--
-- Contraintes pour la table `round`
--
ALTER TABLE `round`
    ADD CONSTRAINT `round_ibfk_1` FOREIGN KEY (`id_combat`) REFERENCES `combat` (`Id`),
  ADD CONSTRAINT `round_ibfk_2` FOREIGN KEY (`id_aptitude`) REFERENCES `aptitude` (`Id`),
  ADD CONSTRAINT `round_ibfk_3` FOREIGN KEY (`id_combattant`) REFERENCES `combattant` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
