-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 14 Avril 2021 à 16:40
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GestionPE`
--

-- --------------------------------------------------------

--
-- Structure de la table `bsalaire`
--

CREATE TABLE `bsalaire` (
  `id` int(11) NOT NULL,
  `mois` date NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salaire_base` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salaire_brut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sur_salaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE `conge` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_reprise` datetime NOT NULL,
  `type_conge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbr_jours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id` int(11) NOT NULL,
  `nature_contrat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree_contrat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `id_service_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sfamiliale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recrut` datetime NOT NULL,
  `date_embauche` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `employe`
--

INSERT INTO `employe` (`id`, `id_user_id`, `id_service_id`, `image_id`, `fonction_id`, `matricule`, `noms`, `naissance`, `adresse`, `telephone`, `cin`, `genre`, `sfamiliale`, `date_recrut`, `date_embauche`) VALUES
(1, 1, 1, 1, 2, 'CSTP8963', 'ousmane Dieng', '01/01/1988', 'Grand Yoff', '772046703', '16411993011162', 'Homme', 'Célibataire', '2021-04-12 00:00:00', '2021-04-12 00:00:00'),
(2, 5, 2, NULL, 1, 'CSTP6442', 'Khadim Séne', '24/02/1987', 'Fass Delorme', '777916624', '16411992011068', 'Homme', 'Marié', '2021-04-13 01:41:33', '2021-04-13 01:41:33'),
(3, 3, 2, 2, 3, 'CSTP7763', 'Maréme Pouye', '12/10/1996', 'Dakar Colobane', '782214044', '164119990111', 'Femme', 'Célibataire', '2021-04-13 08:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE `fonction` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `nom_fonction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id`, `service_id`, `nom_fonction`) VALUES
(1, 2, 'Comptable'),
(2, 1, 'Directeur'),
(3, 1, 'Secrétaire ');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `file_path`) VALUES
(1, '60763c3e59fcd_BeautyPlus_20190910224924962_save.jpg'),
(2, '60763c7ab0cb9_Mareme Pouye .jpg');

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `employers_id` int(11) DEFAULT NULL,
  `date_du` date NOT NULL,
  `audate` date NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `permission`
--

INSERT INTO `permission` (`id`, `employers_id`, `date_du`, `audate`, `motif`, `status`) VALUES
(1, 1, '2021-04-14', '2021-04-17', 'Mariage', 'En Cours'),
(2, 3, '2021-04-14', '2021-04-19', 'Mariage', 'Validée');

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `profile`
--

INSERT INTO `profile` (`id`, `libelle`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_SECRETAIRE'),
(3, 'ROLE_EMPLOYE');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `nom_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `nom_service`) VALUES
(1, 'Administration'),
(2, 'Comptabilité et Finance'),
(3, 'Hydraulique'),
(4, 'Construction Batiments');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `profile_id`, `username`, `password`, `is_active`) VALUES
(1, 1, 'ousmane881@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$KsvEQzjRNyPyRVuiqoLAmg$0oNo2bjUmsDs0DEplFkUO4iEz6zFiHIv5mRlDNAA6SY', 1),
(2, 2, 'korrou', '$argon2id$v=19$m=65536,t=4,p=1$knWF9LgjYqOWsI5FzpclIw$U0pzcCUKIAoxVf8q/CZrekZFibNwt6infsnuLfVI5+I', 1),
(3, 2, 'mareme', '$argon2id$v=19$m=65536,t=4,p=1$lOr9kpagKvODj5kr7aBWvg$ef2iPfxn62sGyIInQ6X0/OfCSUDMBiVyJlkQhwGkJAE', 1),
(5, 3, 'khadim', '$argon2id$v=19$m=65536,t=4,p=1$Y+PcdGMgqjTR2fpISZ7dkA$a8IYJQCrPfe6Q6kN0SK+G7wenENfPCi0r5cXKPK/erA', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bsalaire`
--
ALTER TABLE `bsalaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2ED893481B65292` (`employe_id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F804D3B979F37AE5` (`id_user_id`),
  ADD KEY `IDX_F804D3B948D62931` (`id_service_id`),
  ADD KEY `IDX_F804D3B93DA5256D` (`image_id`),
  ADD KEY `IDX_F804D3B957889920` (`fonction_id`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_900D5BDED5CA9E6` (`service_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E04992AA57E0E899` (`employers_id`);

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D649CCFA12B8` (`profile_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bsalaire`
--
ALTER TABLE `bsalaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `conge`
--
ALTER TABLE `conge`
  ADD CONSTRAINT `FK_2ED893481B65292` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`);

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `FK_F804D3B93DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_F804D3B948D62931` FOREIGN KEY (`id_service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_F804D3B957889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`),
  ADD CONSTRAINT `FK_F804D3B979F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD CONSTRAINT `FK_900D5BDED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `FK_E04992AA57E0E899` FOREIGN KEY (`employers_id`) REFERENCES `employe` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
