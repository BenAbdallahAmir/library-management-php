-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 15 juil. 2025 à 11:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `bibliothecaires`
--

CREATE TABLE `bibliothecaires` (
  `id_bibliothecaire` int(11) NOT NULL,
  `login_bibliothecaire` varchar(50) NOT NULL,
  `mot_de_passe_bibliothecaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bibliothecaires`
--

INSERT INTO `bibliothecaires` (`id_bibliothecaire`, `login_bibliothecaire`, `mot_de_passe_bibliothecaire`) VALUES
(1, 'admin', 'admin'),
(3, 'test', 'password'),
(5, 'amir', 'amir');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id_genre` varchar(50) NOT NULL,
  `nom_genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id_genre`, `nom_genre`) VALUES
('azaza', 'azaza'),
('FIC', 'Fiction'),
('HIS', 'Histoire'),
('test', 'new'),
('SCI', 'Science');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id_livre` int(11) NOT NULL,
  `titre_livre` varchar(255) NOT NULL,
  `exemplaires_disponibles` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `id_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id_livre`, `titre_livre`, `exemplaires_disponibles`, `isbn`, `id_genre`) VALUES
(1, 'Le Seigneur des Anneaux', 5, '978-2070612345', 'FIC'),
(2, 'Sapiens: Une brève histoire de l\'humanité', 3, '978-2253084411', 'HIS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bibliothecaires`
--
ALTER TABLE `bibliothecaires`
  ADD PRIMARY KEY (`id_bibliothecaire`),
  ADD UNIQUE KEY `login_bibliothecaire` (`login_bibliothecaire`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genre`),
  ADD UNIQUE KEY `nom_genre` (`nom_genre`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id_livre`),
  ADD UNIQUE KEY `titre_livre` (`titre_livre`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `id_genre` (`id_genre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bibliothecaires`
--
ALTER TABLE `bibliothecaires`
  MODIFY `id_bibliothecaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id_livre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `fk_livres_genres` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
