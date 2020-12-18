-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 26 nov. 2020 à 09:23
-- Version du serveur :  8.0.22-0ubuntu0.20.04.2
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `strashelp`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id` int NOT NULL,
  `id_applicant` int NOT NULL,
  `id_category` int NOT NULL,
  `advertStatus` smallint NOT NULL DEFAULT '0' COMMENT '0 - en attente de validation\r\n1 - validée\r\n2 - archivée\r\n3 - annulé',
  `search_service` varchar(60) NOT NULL,
  `location` varchar(60) NOT NULL,
  `duration` int NOT NULL,
  `description` mediumtext NOT NULL,
  `availability` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `id_applicant`, `id_category`, `advertStatus`, `search_service`, `location`, `duration`, `description`, `availability`) VALUES
(27, 6, 1, 1, 'Apprendre à cuisiner un pot au feu', 'Strasbourg', 2, 'Bonjour, je cherche quelqu\'un qui puisse m\'apprendre une recette authentique de pot au feu. Merci', 'Les week-end'),
(28, 7, 2, 0, 'Aide pour installer une étagère', 'Ostwald', 2, 'Bonjour, je cherche quelqu\'un pour m\'aide à fixer une étagère au mur de ma cuisine. ', 'Tous les jours'),
(29, 8, 3, 0, 'Anglais', 'Schiltigheim', 3, 'Bonjour, je cherche quelqu\'un avec qui je pourrait parler anglais pendant quelques heures, pour me préparer pour mon futur voyage à Londres. Merci.', 'Tous les soirs de la semaine'),
(30, 9, 4, 0, 'Déclaration impots', 'Strasbourg', 1, 'Bonjour, j\'ai quelques question au sujet de ma déclaration d\'impôts et je n\'arrive pas trouver de réponse. Si quelqu\'un s\'y connaît, vous pouvez me contacter. Merci.', 'Tous les jours'),
(31, 10, 5, 0, 'Conseils', 'Strasbourg', 3, 'Bonjour, je cherche quelqu\'un qui pratique la course à pied et qui pourrait me donner des conseils pour commencer ma pratique. On pourrait faire deux-trois entraînements de 1h. Merci.', 'Lundi Jeudi Vendredi'),
(32, 11, 6, 0, 'Aide pour laver les vitres', 'Hoenheim', 3, 'Bonjour, j\'ai besoin d\'aide pour nettoyer les vitres de ma véranda. Merci.', 'Les week-end'),
(35, 12, 7, 0, 'Aide pour ajouter de la ram', 'Strasbourg', 1, 'Bonjour, je cherche quelqu\'un qui saurait ajouter de la ram à mon PC. Merci.', 'Tous les soirs de la semaine'),
(36, 13, 8, 0, 'Tailler les haies', 'Schiltigheim', 3, 'Bonjour, j\'ai besoin d\'aide pour tailler les haies de mon jardin. Merci.', 'Les week-end'),
(37, 6, 2, 0, 'Aide pour peindre un mur', 'Strasbourg', 2, 'Bonjour, je cherche quelqu\'un qui pourrait m\'aider à peindre le mur de mon salon. Merci.', 'Tous les jours'),
(38, 7, 3, 0, 'Piano', 'Ostwald', 3, 'Bonjour, je suis un peu rouillé au piano et j\'aurais aimé un peu d\'aide pour m\'y remettre. Cordialement.', 'Tous les soirs de la semaine'),
(39, 8, 4, 0, 'Changement d\'opérateur', 'Schiltigheim', 1, 'Bonjour, je cherche quelqu\'un qui pourrait m\'aider à changer d\'opérateur téléphonique. Merci.', 'Mercredi'),
(40, 9, 5, 0, 'Yoga', 'Strasbourg', 2, 'Bonjour, je débute en yoga et je cherche quelqu\'un de confirmé pour corriger mes postures. merci.', 'Tous les jours'),
(41, 10, 6, 0, 'Nettoyer un garage', 'Strasbourg', 2, 'Bonjour, je cherche de l\'aide pour nettoyer mon garage. Il faudrait passer le balais et la serpillière. Merci.', 'Mardi jeudi samedi'),
(42, 11, 7, 0, 'Formater un ordinateur', 'Hoenheim', 2, 'Bonjour, j\'ai besoin d\'aide pour formater mon ordinateur. Merci.', 'Tous les soirs de la semaine'),
(43, 12, 8, 0, 'Tailler les rosiers', 'Strasbourg', 2, 'Bonjour, j\'aimerais de l\'aide pour tailler mes rosiers et avoir des conseils pour le faire moi même. Merci.', 'Les week-end'),
(44, 13, 1, 0, 'Faire une paella', 'Schiltigheim', 3, 'Bonjour, je chercher quelqu\'un qui pourrait m\'apprendre à cuisiner une paella traditionnelle. Merci.', 'Les week-end');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `id_imgcategory` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `id_imgcategory`) VALUES
(1, 'Cuisine', 1),
(2, 'Bricolage', 2),
(3, 'Cours', 3),
(4, 'Administratif', 4),
(5, 'Sport', 5),
(6, 'Ménage', 6),
(7, 'Informatique', 7),
(8, 'Jardinage', 8);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identity`
--

CREATE TABLE `identity` (
  `id` int NOT NULL,
  `isAdmin` tinyint NOT NULL DEFAULT '0' COMMENT '0 - non 1 - oui',
  `accountStatus` smallint NOT NULL DEFAULT '0' COMMENT '0 - en attente \r\n1 - accepté\r\n2 - bannit',
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `city` varchar(45) NOT NULL,
  `phone` varchar(17) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `credit` int NOT NULL DEFAULT '5',
  `publications` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `identity`
--

INSERT INTO `identity` (`id`, `isAdmin`, `accountStatus`, `firstname`, `lastname`, `gender`, `date_of_birth`, `city`, `phone`, `email`, `password`, `credit`, `publications`) VALUES
(6, 0, 0, 'Aquila', 'Kaufman', 'female', '1956-12-05', 'strasbourg', '0645268496', 'a.kaufman@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(7, 0, 0, 'Herrold', 'Hendricks', 'male', '1960-11-02', 'Ostwald', '0648632598', 'h.hendricks@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(8, 0, 0, 'Brian', 'George', 'male', '1980-02-28', 'Schiltigheim', '0684963274', 'b.george@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(9, 0, 0, 'Odile', 'Dupuis', 'female', '1963-06-23', 'Strasbourg', '0648988558', 'o.dupuis@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(10, 0, 0, 'Hubert', 'Martin', 'male', '1965-01-03', 'Strasbourg', '0674748596', 'h.martin@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(11, 0, 0, 'Charlène', 'Leroy', 'female', '1984-08-16', 'Hoenheim', '0625321552', 'c.leroy@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(12, 0, 0, 'Léa', 'Oberlin', 'female', '1991-02-02', 'Strasbourg', '0654525598', 'l.oberlin@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0),
(13, 0, 0, 'Marc', 'Dufour', 'male', '1974-01-03', 'Schiltigheim', '0644115265', 'm.dufour@help.com', '657f8b8da628ef83cf69101b6817150a', 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `imgcat`
--

CREATE TABLE `imgcat` (
  `id` int NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `imgcat`
--

INSERT INTO `imgcat` (`id`, `name`, `image`) VALUES
(1, 'cuisine', 'https://www.lettresadhesives.net/storage/stickers/Sticker%20Cloche.png'),
(2, 'bricolage', 'https://cdn.icon-icons.com/icons2/583/PNG/512/work-tools-crossed_icon-icons.com_55052.png'),
(3, 'cours', 'http://www.sivom-alliance-nord-ouest.fr/userfiles/user/Pictogrammes/livres.png'),
(4, 'administratif', 'https://i1.wp.com/www.le-toaster.fr/wp-content/uploads/2015/03/folder-dossier-picto.png?resize=300%2C300'),
(5, 'sport', 'https://cdn.icon-icons.com/icons2/67/PNG/512/running_sport_13282.png'),
(6, 'ménage', 'https://business-cliparts.com/material/062-occupation-illustration.jpg'),
(7, 'informatique', 'https://picto-fr.s3.eu-west-3.amazonaws.com/pictos/images/000/000/577/medium/Sans-titre---7.png?1484660600'),
(8, 'jardinage', 'https://image.flaticon.com/icons/png/512/90/90608.png');

-- --------------------------------------------------------

--
-- Structure de la table `orderHelp`
--

CREATE TABLE `orderHelp` (
  `id` int NOT NULL,
  `id_advert` int NOT NULL,
  `id_receiver` int NOT NULL,
  `id_category` int NOT NULL,
  `validated` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `rating` smallint NOT NULL COMMENT '1 - 10\r\n1 - Very bad\r\n10- Very good',
  `comment` text NOT NULL,
  `id_orderHelp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_applicant` (`id_applicant`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imgcategory` (`id_imgcategory`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `identity`
--
ALTER TABLE `identity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `imgcat`
--
ALTER TABLE `imgcat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orderHelp`
--
ALTER TABLE `orderHelp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_receiver` (`id_receiver`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_advert` (`id_advert`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orderHelp` (`id_orderHelp`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `identity`
--
ALTER TABLE `identity`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `orderHelp`
--
ALTER TABLE `orderHelp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `advert_ibfk_1` FOREIGN KEY (`id_applicant`) REFERENCES `identity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `advert_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `imgcat`
--
ALTER TABLE `imgcat`
  ADD CONSTRAINT `imgcat_ibfk_1` FOREIGN KEY (`id`) REFERENCES `category` (`id_imgcategory`);

--
-- Contraintes pour la table `orderHelp`
--
ALTER TABLE `orderHelp`
  ADD CONSTRAINT `orderHelp_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `identity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orderHelp_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orderHelp_ibfk_4` FOREIGN KEY (`id_advert`) REFERENCES `advert` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_orderHelp`) REFERENCES `orderHelp` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
