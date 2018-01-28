SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdcreneau`
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
  `commentaireApres` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`id`, `idProf`, `dateDebut`, `duree`, `exclusivite`, `datePublic`, `libre`, `commentaireAvant`, `commentaireApres`, `note`) VALUES
(1, 0, '2018-10-18 11:00:00', 41867, 0, '2017-11-07 03:30:03', 1, '', '', 0),
(6, 0, '2018-01-28 20:12:38', 504, 1, '2019-03-14 07:20:17', 0, 'Venir avec un ordinateur.', 'Parfait.', 20),
(7, 10, '2018-01-28 20:14:42', 1235, 1, '2017-11-22 10:00:00', 1, 'Venir en avance.', '', 0),
(16, 0, '2018-04-28 05:36:00', 2320, 0, '2017-09-18 11:22:00', 0, 'Pas de commentaire', 'Passable.', 9),
(20, 9, '2017-09-14 19:16:10', 122259, 1, '2018-01-28 20:16:59', 0, 'Se prÃ©senter avec une piÃ¨ce d\'identitÃ©.', 'L&#39;Ã©lÃ¨ve peut mieux faire.', 11),
(21, 11, '2018-01-01 20:17:05', 20059, 0, '2018-01-28 20:17:41', 0, 'Se prÃ©senter avec sa carte Ã©tudiante.', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `idProf` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10, 'Carlisle', 'Henry'),
(11, 'Claudet', 'Antoine');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `creneau`
--
ALTER TABLE `creneau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD CONSTRAINT `creneau_ibfk_1` FOREIGN KEY (`idProf`) REFERENCES `professeur` (`idProf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
