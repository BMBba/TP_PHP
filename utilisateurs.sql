-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 10 nov. 2022 à 15:40
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `AMO`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricule` varchar(20) NOT NULL DEFAULT 'M',
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `roles` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `photo` blob DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Etat` int(11) NOT NULL DEFAULT 0,
  `dateArchive` datetime DEFAULT NULL,
  `dateModifier` datetime DEFAULT NULL,
  `date_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `matricule`, `nom`, `prenom`, `email`, `roles`, `pass`, `photo`, `date`, `Etat`, `dateArchive`, `dateModifier`, `date_change`) VALUES
(7, '2022-7-BMB', 'bobo', 'bilal', 'bou@gmail', 'Utilisateur', '25d55ad283aa400af464c76d713c07ad', 0x2f6f70742f6c616d70702f74656d702f7068706b4131423150, '2022-11-07 18:54:54', 1, '2022-11-07 00:00:00', NULL, NULL),
(8, '2022-8-BMB', 'BA', 'amadou ', 'amadou@gmail.com', 'Utilisateur', '016e4a8e19873e94854fc3429f6b4a63', '', '2022-11-07 18:48:20', 1, '2022-11-07 00:00:00', NULL, NULL),
(9, '2022-9-BMB', 'ba', 'mbacke', 'bgo@argmail', 'Utilisateur', 'e10adc3949ba59abbe56e057f20f883e', '', '2022-11-09 16:09:18', 1, '2022-11-09 00:00:00', '2022-11-08 00:00:00', NULL),
(10, '2022-10-BMB', 'ba', 'aliou', 'aliou@gmail', 'Admin', 'b62b66e98bda4b4a6f866775b04ed92e', '', '2022-11-10 10:50:00', 1, '2022-11-10 00:00:00', NULL, NULL),
(11, '2022-11-BMB', 'sow', 'lamine', 'sow@gmail', 'Utilisateur', '724b3e3cf7876886002ed7ea1112f284', '', '2022-11-08 07:22:14', 0, NULL, NULL, NULL),
(12, '2022-12-BMB', 'mbacke', 'massamba', 'mass@gmail', 'Admin', '6a6f1660fd929581019867f73cb5fcc4', '', '2022-11-09 16:10:13', 1, '2022-11-09 00:00:00', NULL, NULL),
(13, '2022-13-BMB', 'diop', 'papa', 'papa@gmail.com', 'Admin', 'fcea920f7412b5da7be0cf42b8c93759', '', '2022-11-10 11:04:51', 0, NULL, NULL, NULL),
(14, '2022-14-BMB', 'ba', 'Djibi', 'jibi@gmail', 'Utilisateur', '10134edb3620adda6babbc63e69e92fc', '', '2022-11-10 12:02:02', 0, NULL, NULL, NULL),
(15, '2022-15-BMB', 'sambe', 'cheikh', 'sambe@gmail', 'Utilisateur', '7aa0dce7d0022e88c6b9dc1016d7a306', '', '2022-11-10 12:02:52', 0, NULL, NULL, NULL),
(16, '2022-16-BMB', 'diawar', 'ali', 'ali@gmail', 'Admin', 'df5990d13480fba4d93fb9b369d90bc5', '', '2022-11-10 12:03:26', 0, NULL, NULL, NULL),
(17, '2022-17-BMB', 'sall', 'cherif', 'cheikh@gmail', 'Utilisateur', '4f5a614a95ba833a331c2c1627e51ee1', '', '2022-11-10 12:05:21', 0, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
