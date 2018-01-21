SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `dbcreneau`
--

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

CREATE TABLE `creneau` (
  `id` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `dateDebut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duree` float NOT NULL DEFAULT '0',
  `exclusivite` tinyint(1) NOT NULL DEFAULT '0',
  `datePublic` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `libre` tinyint(1) NOT NULL DEFAULT '0',
  `commentaireAvant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aEuLieu` tinyint(1) NOT NULL DEFAULT '0',
  `commentaireApres` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`id`, `idProf`, `dateDebut`, `duree`, `exclusivite`, `datePublic`, `libre`, `commentaireAvant`, `aEuLieu`, `commentaireApres`, `note`) VALUES
(1, 0, '2018-01-20 22:02:28', 135, 0, '2017-11-07 03:30:03', 0, 'Apporter des stylos', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `idProf` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `nom`, `prenom`) VALUES
(0, 'Bacrat', 'Olivier'),
(1, 'Lescaut', 'Julie'),
(2, 'Canet', 'Sabrina'),
(3, 'Gerard', 'Sebastien'),
(4, 'Dupont', 'Valentin'),
(5, 'Flamand', 'Bernard'),
(6, 'Freon', 'Patrick'),
(7, 'Berger', 'Marc'),
(8, 'Hubert', 'Annie'),
(9, 'Roger', 'Marie'),
(10, 'André', 'Paul'),
(11, 'Carlisle', 'Henry'),
(12, 'Claudet', 'Antoine');

--
-- Index pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProf` (`idProf`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`idProf`);

--
-- AUTO_INCREMENT pour la table `creneau`
--
ALTER TABLE `creneau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD CONSTRAINT `creneau_ibfk_1` FOREIGN KEY (`idProf`) REFERENCES `professeur` (`idProf`);
COMMIT;
