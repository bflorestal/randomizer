-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 avr. 2021 à 22:07
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `randomizer`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `annee` year(4) NOT NULL,
  `photo` text NOT NULL,
  `affichage` varchar(3) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`nom`, `prenom`, `annee`, `photo`, `affichage`, `id`) VALUES
('Florestal', 'Bryan', 2021, 'Eleve_bryan.jpg', 'oui', 1),
('Artisien', 'Alexandre', 2021, 'Eleve_alexandre.jpg', 'oui', 2),
('Latchoumaya', 'Sonny', 2021, 'Eleve_sonny.jpg', 'oui', 7),
('Pery-Kasza', 'Martin', 2021, 'Eleve_martin.jpg', 'oui', 8),
('Harel', 'Sébastien', 2021, 'Eleve_sebastien.jpg', 'oui', 9),
('Thalgott', 'Kylian', 2021, 'Eleve_kylian.jpg', 'oui', 10),
('Gros-Desormeaux', 'Sanjay', 2021, 'no-image.jpg', 'non', 11),
('Dechaux', 'Yann', 2021, 'Eleve_yann.jpg', 'oui', 13),
('Gerri', 'Claire', 2021, 'Eleve_claire.jpg', 'oui', 14),
('Ben Maamar', 'Wiame', 2021, 'Eleve_wiame.jpg', 'oui', 15);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `annee` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `nom`, `annee`) VALUES
(8, 'Eleve_alexandre.jpg', 2021),
(9, 'Eleve_bryan.jpg', 2021),
(10, 'Eleve_martin.jpg', 2021),
(11, 'Eleve_sonny.jpg', 2021),
(13, 'Eleve_sebastien.jpg', 2021),
(14, 'Eleve_kylian.jpg', 2021),
(15, 'Eleve_claire.jpg', 2021),
(16, 'Eleve_wiame.jpg', 2021),
(19, 'no-image.jpg', 2021);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `droits` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `mdp`, `droits`) VALUES
(1, 'Florestal', 'Bryan', 'Pyrospower', 'admin', 'Admin'),
(3, 'Artisien', 'Alexandre', 'Neoko', 'user', 'Visiteur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
