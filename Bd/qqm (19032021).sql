-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 19 mars 2021 à 13:09
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `qqm`
--

-- --------------------------------------------------------

--
-- Structure de la table `a_recipe`
--

CREATE TABLE `a_recipe` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `id_ingredient` int(10) UNSIGNED NOT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `id_UOM` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `a_recipe`
--

INSERT INTO `a_recipe` (`id_recipe`, `id_ingredient`, `qty`, `id_UOM`) VALUES
(21, 3, 100, 5),
(49, 2, 2, 8),
(50, 2, 2, 8),
(51, 2, 2, 8),
(54, 2, 2, 8),
(55, 2, 2, 8),
(56, 2, 2, 8),
(57, 2, 2, 8),
(58, 2, 2, 8),
(59, 2, 2, 8),
(61, 1, 100, 5),
(61, 2, 2, 8),
(62, 5, 3, 8),
(62, 8, 300, 5),
(62, 9, 3, 9),
(62, 10, 2, 9),
(62, 11, 50, 5),
(62, 12, 60, 10),
(63, 4, 100, 5),
(64, 4, 100, 5),
(65, 4, 100, 5),
(66, 4, 100, 5),
(67, 4, 100, 5),
(68, 4, 100, 5),
(69, 4, 100, 5),
(70, 4, 100, 5),
(71, 4, 100, 5),
(72, 4, 100, 5),
(73, 4, 100, 5),
(74, 4, 100, 5),
(75, 4, 100, 5),
(76, 4, 100, 5);

-- --------------------------------------------------------

--
-- Structure de la table `cooker`
--

CREATE TABLE `cooker` (
  `id_cooker` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cooker`
--

INSERT INTO `cooker` (`id_cooker`, `pseudo`, `pwd`, `admin`) VALUES
(1, 'Plue', '123', 1),
(3, 'romain', '789', 0),
(4, 'Elisa', '456', 0),
(5, 'Cécile', '789', 0),
(13, 'BigMac', '123', 0),
(16, 'Lou', '123', 0),
(17, 'Lou', '123', 0),
(18, 'Lou', '123', 0),
(19, 'aa', 'aa', 0),
(20, 'aa', 'aa', 0),
(21, 'dada', '456', 0),
(22, 'ababa', 'a', 0),
(23, 'aza', 'a', 0),
(24, 'zze', 'a', 0),
(25, 'rrre', 'a', 0),
(26, 'hgfs', 'aa', 0);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id_country` int(10) NOT NULL,
  `country_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id_country`, `country_name`) VALUES
(1, 'france'),
(2, 'japon'),
(3, 'italie'),
(4, 'mexique'),
(5, 'espagne'),
(6, 'thailande'),
(43, 'chine');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ingredient` int(10) UNSIGNED NOT NULL,
  `ingredient` varchar(50) NOT NULL,
  `ingredient_calorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `ingredient`, `ingredient_calorie`) VALUES
(1, 'carotte', '30'),
(2, 'pomme', '52'),
(3, 'pomme de terre', '85'),
(4, 'riz', '130'),
(5, 'oeuf', '155'),
(7, 'panais', '75'),
(8, 'farine', '364'),
(9, 'sucre', '387'),
(10, 'huile d\'olive', '884'),
(11, 'beurre', '717'),
(12, 'lait', '42'),
(13, 'Tomate', '15');

-- --------------------------------------------------------

--
-- Structure de la table `position_in_meal`
--

CREATE TABLE `position_in_meal` (
  `position` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `position_in_meal`
--

INSERT INTO `position_in_meal` (`position`) VALUES
('apéritif'),
('dessert'),
('entrée'),
('plat');

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

CREATE TABLE `recipe` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `recipe_title` varchar(50) NOT NULL,
  `recipe` text NOT NULL,
  `recipe_visibility` int(1) NOT NULL,
  `id_cooker` int(10) UNSIGNED NOT NULL,
  `photoFileName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recipe`
--

INSERT INTO `recipe` (`id_recipe`, `recipe_title`, `recipe`, `recipe_visibility`, `id_cooker`, `photoFileName`) VALUES
(2, 'Pate à crépe', 'Mettre la farine dans une terrine et former un puits. Y déposer les oeufs entiers, le sucre, l\'huile et le beurre.\r\nMélanger délicatement avec un fouet en ajoutant au fur et à mesure le lait. La pâte ainsi obtenue doit avoir une consistance d\'un liquide légèrement épais.\r\nParfumer de rhum.Faire chauffer une poêle antiadhésive et la huiler très légèrement. Y verser une louche de pâte, la répartir dans la poêle puis attendre qu\'elle soit cuite\r\n d\'un côté avant de la retourner. Cuire ainsi toutes les crêpes à feu doux.', 1, 1, 'recette-crepes.jpg'),
(4, 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 1, 'default.jpg'),
(7, 'GFNS GSHJN', 'SDHJ?NDSHGJN G', 1, 1, 'default.jpg'),
(8, 'qdfhbq', 'qdfhqdfhb ', 1, 1, 'default.jpg'),
(9, 'nfqw&#60;dfgnw', 'dfqhn qerTHUB ', 1, 16, 'default.jpg'),
(10, 'nfqw&#60;dfgnw', 'dfqhn qerTHUB ', 0, 16, 'default.jpg'),
(11, 'aaA', 'AAAAAAAAAazazazazaza', 1, 1, 'default.jpg'),
(12, 'BBBBBBBBBBBBBBBBBBBBBBBB', 'BBBBBBBBBBBBBBBBBBBBBBBBBBBBBb', 1, 1, 'default.jpg'),
(13, 'CCCCCCCCCCC', 'CCCCCCCCCCCCCCCCcc', 1, 1, 'default.jpg'),
(14, 'cccccccccc', 'cccccccccccc', 1, 1, 'default.jpg'),
(15, 'cccccccccc', 'cccccccccccc', 1, 1, 'default.jpg'),
(16, 'dddddddd', 'ddddddddddddddd', 1, 1, 'default.jpg'),
(17, 'qdgfdfrg aa', 'fggfgffdddddd', 1, 1, 'default.jpg'),
(18, 'hhhhhhhhhhhhhh', 'hhhhhhhhhhhhhhhhhhhhh', 1, 1, 'default.jpg'),
(19, 'qtdefhdftgh', 'qrhnbsfgns', 1, 1, 'default.jpg'),
(20, 'qtdefhdftgh', 'qrhnbsfgns', 1, 1, 'default.jpg'),
(21, 'qdfhb', 'qdefhbc ', 1, 1, 'default.jpg'),
(24, 'gfnqfrhb', 'qdfbnhqartzfghn', 1, 4, 'default.jpg'),
(25, 'gfnqfrhb', 'qdfbnhqartzfghn', 1, 4, 'default.jpg'),
(26, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(27, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(28, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(30, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(31, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(32, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(33, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(34, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(35, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(36, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(37, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(38, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(39, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(40, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(41, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(42, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(43, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(44, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(45, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(46, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(47, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(49, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(50, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(51, 'GBRFER', 'dgerffgQVDEH', 1, 4, 'default.jpg'),
(52, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(53, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(54, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(55, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(56, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(57, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(58, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(59, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(61, 'dfsGBrdefg', 'qfdbhqerfhberf', 1, 4, 'default.jpg'),
(62, 'Pâte à crêpes', 'Mettre la farine dans une terrine et former un puits. Y déposer les oeufs entiers, le sucre, l\'huile et le beurre.\r\nMélanger délicatement avec un fouet en ajoutant au fur et à mesure le lait. La pâte ainsi obtenue doit avoir une consistance d\'un liquide légèrement épais.\r\nParfumer de rhum.Faire chauffer une poêle antiadhésive et la huiler très légèrement. Y verser une louche de pâte, la répartir dans la poêle puis attendre qu\'elle soit cuite\r\nd\'un côté avant de la retourner. Cuire ainsi toutes les crêpes à feu doux.', 1, 4, 'recette-crepes.jpg'),
(63, 'rrrrrrrrrRRR', 'RRRRRRRRRRRRRRRRRRRR', 1, 1, NULL),
(64, 'qqqqqqqqqqqqqq', 'QQQQQQQQQQQQQQQQQQQQQ', 1, 1, NULL),
(65, 'ssssssssssssssssssss', 'QQQQQQQQQQQQQQQQQQQQ', 1, 1, NULL),
(66, 'FFFFFFFFFFFFFFFFF', 'fffffffffffffffffffffffffffff', 1, 1, '1-FFFFFFFFFFFFFFFFF.jpg'),
(67, 'dddddddddddddddd', 'DDDDDDDDDDDDDDDDDDDDDDDD', 1, 1, '1-dddddddddddddddd.jpg'),
(68, 'wwwwwwwwwwwwww', 'WWWWWWWWWWWWWWWWWW', 1, 1, '1-wwwwwwwwwwwwww.jpg'),
(69, 'wwwwwwwwwwwwww', 'WWWWWWWWWWWWWWWWWW', 1, 1, '1-wwwwwwwwwwwwww.jpg'),
(70, 'wwwwwwwwwwwwww', 'WWWWWWWWWWWWWWWWWW', 1, 1, '1-wwwwwwwwwwwwww.jpg'),
(71, 'wwwwwwwwwwwwww', 'WWWWWWWWWWWWWWWWWW', 1, 1, '1-wwwwwwwwwwwwww.jpg'),
(72, 'hhhhhhh', 'HHHHHHHHHHHHHHHHH', 1, 1, '1-hhhhhhh.jpg'),
(73, 'azertry', 'AZERTY', 1, 1, '1-azertry.jpg'),
(74, 'poiu', 'mjukgpiumgoiu', 1, 1, '1-poiu.jpg'),
(75, 'poiu', ':khjfgipmuyhfgvimu', 1, 1, '1-poiu.jpg'),
(76, 'vvvvvvvvvvvvvv', 'VVVVVVVVVVVVVvvvvvvvvvvvvvv', 1, 1, '1-vvvvvvvvvvvvvv.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `season`
--

CREATE TABLE `season` (
  `season_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `season`
--

INSERT INTO `season` (`season_name`) VALUES
('automne'),
('été'),
('hiver'),
('printemp');

-- --------------------------------------------------------

--
-- Structure de la table `the_recipe_country`
--

CREATE TABLE `the_recipe_country` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `id_country` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `the_recipe_country`
--

INSERT INTO `the_recipe_country` (`id_recipe`, `id_country`) VALUES
(21, 2),
(61, 2),
(62, 1),
(63, 2),
(64, 2),
(65, 2),
(66, 4),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 3),
(75, 3),
(76, 2);

-- --------------------------------------------------------

--
-- Structure de la table `the_recipe_meal_position`
--

CREATE TABLE `the_recipe_meal_position` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `position` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `the_recipe_meal_position`
--

INSERT INTO `the_recipe_meal_position` (`id_recipe`, `position`) VALUES
(12, 'dessert'),
(13, 'entrée'),
(14, 'entrée'),
(15, 'entrée'),
(16, 'entrée'),
(17, 'plat'),
(18, 'entrée'),
(19, 'entrée'),
(20, 'entrée'),
(21, 'entrée'),
(61, 'dessert'),
(62, 'dessert'),
(63, 'apéritif'),
(64, 'dessert'),
(65, 'entrée'),
(66, 'plat'),
(67, 'entrée'),
(68, 'entrée'),
(69, 'entrée'),
(70, 'entrée'),
(71, 'entrée'),
(72, 'dessert'),
(73, 'entrée'),
(74, 'dessert'),
(75, 'dessert'),
(76, 'apéritif');

-- --------------------------------------------------------

--
-- Structure de la table `the_recipe_season`
--

CREATE TABLE `the_recipe_season` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `season_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `the_recipe_season`
--

INSERT INTO `the_recipe_season` (`id_recipe`, `season_name`) VALUES
(21, 'été'),
(61, 'été'),
(62, 'hiver'),
(63, 'été'),
(64, 'été'),
(65, 'hiver'),
(66, 'printemp'),
(67, 'automne'),
(68, 'printemp'),
(69, 'printemp'),
(70, 'printemp'),
(71, 'printemp'),
(72, 'été'),
(73, 'automne'),
(74, 'été'),
(75, 'hiver'),
(76, 'été');

-- --------------------------------------------------------

--
-- Structure de la table `the_recipe_type`
--

CREATE TABLE `the_recipe_type` (
  `id_recipe` int(10) UNSIGNED NOT NULL,
  `id_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `the_recipe_type`
--

INSERT INTO `the_recipe_type` (`id_recipe`, `id_type`) VALUES
(21, 2),
(61, 2),
(62, 5),
(63, 2),
(64, 2),
(65, 2),
(66, 3),
(67, 2),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 2),
(73, 2),
(74, 1),
(75, 2),
(76, 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_of_dish`
--

CREATE TABLE `type_of_dish` (
  `id_type` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_of_dish`
--

INSERT INTO `type_of_dish` (`id_type`, `type_name`) VALUES
(1, 'vegetarien'),
(2, 'viande'),
(3, 'poisson'),
(4, 'vegan'),
(5, 'sans viande'),
(6, 'tarte');

-- --------------------------------------------------------

--
-- Structure de la table `unite_of_measure`
--

CREATE TABLE `unite_of_measure` (
  `id_UOM` int(11) UNSIGNED NOT NULL,
  `uom` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unite_of_measure`
--

INSERT INTO `unite_of_measure` (`id_UOM`, `uom`) VALUES
(5, 'g'),
(6, 'kg'),
(7, 'l'),
(8, 'pcs'),
(9, 'Cuillères à soupe'),
(10, 'cl');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `a_recipe`
--
ALTER TABLE `a_recipe`
  ADD PRIMARY KEY (`id_recipe`,`id_ingredient`),
  ADD KEY `id_ingredient` (`id_ingredient`),
  ADD KEY `a_recipe_to_unite_of_measure` (`id_UOM`);

--
-- Index pour la table `cooker`
--
ALTER TABLE `cooker`
  ADD PRIMARY KEY (`id_cooker`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Index pour la table `position_in_meal`
--
ALTER TABLE `position_in_meal`
  ADD PRIMARY KEY (`position`);

--
-- Index pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id_recipe`),
  ADD KEY `recipe_to_cooker` (`id_cooker`);

--
-- Index pour la table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`season_name`);

--
-- Index pour la table `the_recipe_country`
--
ALTER TABLE `the_recipe_country`
  ADD PRIMARY KEY (`id_recipe`,`id_country`),
  ADD KEY `id_country` (`id_country`);

--
-- Index pour la table `the_recipe_meal_position`
--
ALTER TABLE `the_recipe_meal_position`
  ADD PRIMARY KEY (`id_recipe`,`position`),
  ADD KEY `position` (`position`);

--
-- Index pour la table `the_recipe_season`
--
ALTER TABLE `the_recipe_season`
  ADD PRIMARY KEY (`id_recipe`,`season_name`),
  ADD KEY `season_name` (`season_name`);

--
-- Index pour la table `the_recipe_type`
--
ALTER TABLE `the_recipe_type`
  ADD PRIMARY KEY (`id_recipe`,`id_type`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `type_of_dish`
--
ALTER TABLE `type_of_dish`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `unite_of_measure`
--
ALTER TABLE `unite_of_measure`
  ADD PRIMARY KEY (`id_UOM`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cooker`
--
ALTER TABLE `cooker`
  MODIFY `id_cooker` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingredient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id_recipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `type_of_dish`
--
ALTER TABLE `type_of_dish`
  MODIFY `id_type` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `unite_of_measure`
--
ALTER TABLE `unite_of_measure`
  MODIFY `id_UOM` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `a_recipe`
--
ALTER TABLE `a_recipe`
  ADD CONSTRAINT `aRecipe_to_recipe_to_ingredient` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`),
  ADD CONSTRAINT `a_recipe_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`),
  ADD CONSTRAINT `a_recipe_to_unite_of_measure` FOREIGN KEY (`id_UOM`) REFERENCES `unite_of_measure` (`id_UOM`);

--
-- Contraintes pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_to_cooker` FOREIGN KEY (`id_cooker`) REFERENCES `cooker` (`id_cooker`);

--
-- Contraintes pour la table `the_recipe_country`
--
ALTER TABLE `the_recipe_country`
  ADD CONSTRAINT `the_recipe_country_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id_country`),
  ADD CONSTRAINT `the_recipe_to_country` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`);

--
-- Contraintes pour la table `the_recipe_meal_position`
--
ALTER TABLE `the_recipe_meal_position`
  ADD CONSTRAINT `the_recipe_meal_position_ibfk_1` FOREIGN KEY (`position`) REFERENCES `position_in_meal` (`position`),
  ADD CONSTRAINT `the_recipe_to_meal_position` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`);

--
-- Contraintes pour la table `the_recipe_season`
--
ALTER TABLE `the_recipe_season`
  ADD CONSTRAINT `the_recipe_season_ibfk_1` FOREIGN KEY (`season_name`) REFERENCES `season` (`season_name`),
  ADD CONSTRAINT `the_recipe_season_to_recipe_to_season` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`);

--
-- Contraintes pour la table `the_recipe_type`
--
ALTER TABLE `the_recipe_type`
  ADD CONSTRAINT `the_recipe_to_type_of_dish` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`),
  ADD CONSTRAINT `the_recipe_type_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_of_dish` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
