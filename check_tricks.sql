-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 21 Juin 2022 à 08:31
-- Version du serveur :  5.7.11
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `check_tricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `difficulty`
--

CREATE TABLE `difficulty` (
  `id_diff` int(11) NOT NULL,
  `libelle_diff` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `difficulty`
--

INSERT INTO `difficulty` (`id_diff`, `libelle_diff`) VALUES
(1, 'beginner'),
(2, 'intermediate'),
(3, 'confirmed'),
(4, 'expert');

-- --------------------------------------------------------

--
-- Structure de la table `realised`
--

CREATE TABLE `realised` (
  `id_user` int(11) NOT NULL,
  `id_tricks` int(11) NOT NULL,
  `id_stance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `realised`
--

INSERT INTO `realised` (`id_user`, `id_tricks`, `id_stance`) VALUES
(22, 1, 1),
(22, 1, 2),
(22, 1, 3),
(22, 1, 4),
(22, 2, 1),
(22, 2, 2),
(22, 2, 3),
(22, 2, 4),
(22, 3, 1),
(22, 3, 2),
(22, 3, 3),
(22, 3, 4),
(22, 4, 1),
(22, 4, 2),
(22, 4, 3),
(22, 4, 4),
(22, 5, 1),
(22, 5, 2),
(22, 5, 3),
(22, 5, 4),
(22, 6, 1),
(22, 6, 2),
(22, 6, 3),
(22, 6, 4),
(22, 7, 1),
(22, 7, 2),
(22, 7, 3),
(22, 7, 4),
(22, 8, 1),
(22, 8, 2),
(22, 8, 3),
(22, 8, 4),
(22, 9, 1),
(22, 9, 2),
(22, 9, 4),
(22, 11, 1),
(22, 11, 2),
(22, 13, 2),
(22, 13, 4),
(22, 14, 2),
(22, 14, 4),
(22, 15, 1),
(22, 15, 2),
(22, 15, 3),
(22, 15, 4),
(22, 16, 1),
(22, 16, 2),
(22, 16, 4),
(22, 17, 1),
(22, 17, 2),
(22, 18, 2),
(22, 20, 1),
(22, 20, 2),
(22, 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stance`
--

CREATE TABLE `stance` (
  `id_stance` int(11) NOT NULL,
  `libelle_stance` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `stance`
--

INSERT INTO `stance` (`id_stance`, `libelle_stance`) VALUES
(1, 'normal'),
(2, 'fakie'),
(3, 'switch'),
(4, 'nollie');

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

CREATE TABLE `tricks` (
  `id_trick` int(11) NOT NULL,
  `nom_trick` varchar(50) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `lien_tuto` varchar(50) DEFAULT NULL,
  `id_diff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tricks`
--

INSERT INTO `tricks` (`id_trick`, `nom_trick`, `stars`, `lien_tuto`, `id_diff`) VALUES
(1, 'Ollie', 1, NULL, 1),
(2, 'Pop shuv it', 1, NULL, 1),
(3, '180 Frontside', 1, NULL, 1),
(4, '180 Backside', 1, NULL, 1),
(5, 'Kickflip', 2, NULL, 1),
(6, 'Heelflip', 2, NULL, 1),
(7, 'Varial flip', 2, NULL, 1),
(8, 'Varial heelflip', 3, NULL, 2),
(9, 'Backside kickflip', 3, NULL, 2),
(10, 'Frontside kickflip', 3, NULL, 2),
(11, 'Backside heelflip', 3, NULL, 2),
(12, 'Frontside heelflip', 3, NULL, 2),
(13, 'Backside bigspin', 3, NULL, 2),
(14, 'Frontside bigspin', 3, NULL, 2),
(15, '360 Kickflip', 4, NULL, 3),
(16, '360 Pop shuv it', 4, NULL, 3),
(17, 'Hardflip', 4, NULL, 3),
(18, 'Backside bigspin kickflip', 5, NULL, 3),
(19, 'Frontside bigspin heelflip', 5, NULL, 3),
(20, 'Impossible', 5, NULL, 3),
(21, 'Lazer flip', 5, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `mdp_user` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `biographie` varchar(255) DEFAULT NULL,
  `skating_since` date DEFAULT NULL,
  `stance` varchar(255) DEFAULT NULL,
  `fav_trick` varchar(255) DEFAULT NULL,
  `role` varchar(55) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `country`, `nickname`, `mdp_user`, `mail`, `birth_date`, `biographie`, `skating_since`, `stance`, `fav_trick`, `role`, `createdAt`, `updatedAt`) VALUES
(4, 'Jonny', 'Okay', 'France', 'Johnnny', '$2b$10$PSh7zyK3RtVxvdBuGWR/geDR0Y0YUIm94WcZPDdj9fMtaQKkOa5Ve', 'voila@g.com', NULL, NULL, NULL, NULL, NULL, '', '2022-05-24 00:00:00', '2022-05-24 00:00:00'),
(21, 'xsweak', 'xsweak', NULL, 'Coucou', '$2b$10$cSgePqjN3zapQvEwJ4QLY.82TtluZMhgea3XuFa7ar577l/ukFOty', 'Coucou@g', NULL, NULL, NULL, NULL, NULL, '', '2022-05-02 09:23:54', '2022-05-02 09:23:54'),
(22, 'Kraichette', 'ThÃ©o', 'France', 'xsweak', 'aa90605f6415adb8b47da822269dcbe5dbd1225112b3cb4af29f43fd10ffe073200eb631192cbd09e81b94f7fe2cd3a8ad4923d426a10c43764c7342ccfe8b56', 'kraich@gmail.com', NULL, 'Blablabla une jolie belle petite biographie pour mon profil de skateur', '2022-06-11', 'Goofy', 'Lazer flip', 'user', NULL, NULL),
(23, 'Doe', 'John', NULL, 'xsweak', 'aa90605f6415adb8b47da822269dcbe5dbd1225112b3cb4af29f43fd10ffe073200eb631192cbd09e81b94f7fe2cd3a8ad4923d426a10c43764c7342ccfe8b56', 'coucouuuu@gmail.com', NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL),
(24, 'Doe', 'John', NULL, 'coucou', 'aa90605f6415adb8b47da822269dcbe5dbd1225112b3cb4af29f43fd10ffe073200eb631192cbd09e81b94f7fe2cd3a8ad4923d426a10c43764c7342ccfe8b56', 'coucooooou@gmail.com', NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL),
(25, 'Doe', 'John', NULL, 'xsweak', 'aa90605f6415adb8b47da822269dcbe5dbd1225112b3cb4af29f43fd10ffe073200eb631192cbd09e81b94f7fe2cd3a8ad4923d426a10c43764c7342ccfe8b56', 'coucou@gmail.com', NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL),
(27, 'Kraichette', 'ThÃ©o', NULL, 'coucou', 'aa90605f6415adb8b47da822269dcbe5dbd1225112b3cb4af29f43fd10ffe073200eb631192cbd09e81b94f7fe2cd3a8ad4923d426a10c43764c7342ccfe8b56', 'mer@gmail.fr', NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`id_diff`);

--
-- Index pour la table `realised`
--
ALTER TABLE `realised`
  ADD PRIMARY KEY (`id_user`,`id_tricks`,`id_stance`),
  ADD KEY `id_tricks` (`id_tricks`),
  ADD KEY `id_stance` (`id_stance`);

--
-- Index pour la table `stance`
--
ALTER TABLE `stance`
  ADD PRIMARY KEY (`id_stance`);

--
-- Index pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD PRIMARY KEY (`id_trick`),
  ADD KEY `id_diff` (`id_diff`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `realised`
--
ALTER TABLE `realised`
  ADD CONSTRAINT `realised_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `realised_ibfk_2` FOREIGN KEY (`id_tricks`) REFERENCES `tricks` (`id_trick`),
  ADD CONSTRAINT `realised_ibfk_3` FOREIGN KEY (`id_stance`) REFERENCES `stance` (`id_stance`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `tricks_ibfk_1` FOREIGN KEY (`id_diff`) REFERENCES `difficulty` (`id_diff`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
