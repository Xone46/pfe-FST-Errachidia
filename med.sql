-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Mar 15 Septembre 2020 à 01:27
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `med`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaires` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text CHARACTER SET ucs2 NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `temp` date NOT NULL,
  PRIMARY KEY (`id_commentaires`),
  UNIQUE KEY `id_commentaires` (`id_commentaires`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaires`, `commentaire`, `id_post`, `id_user`, `temp`) VALUES
(2, 'iooizoizoijjömöl', 1, 24, '2020-06-30'),
(4, 'asdasdas asdasdas', 5, 24, '2020-06-30'),
(6, 'sdg df dgdfgfg dgdfg fgdfgfd sgsdg sdsf', 7, 24, '2020-07-02'),
(7, 'adfadfsdsd sdfsdf  sdfsdf', 1, 24, '2020-07-02'),
(8, 'sadasd asdasd', 8, 24, '2020-07-06'),
(9, 'jhvkjhk kugikjo ouo', 5, 24, '2020-07-08'),
(10, 'Vous devriez consulter un medecin avant de prendre ce medicament', 16, 10, '2020-07-17'),
(11, 'Vous devriez voir un medecin bientot', 16, 25, '2020-07-17'),
(12, 'Mercie a votre conseil', 16, 24, '2020-07-17'),
(13, 'Vous devez prendre de la cortisone', 17, 10, '2020-07-17'),
(14, 'Aller chez le medecin et se reposer', 18, 10, '2020-07-17'),
(15, 'fgfnhgfj jhfj', 17, 10, '2020-09-06'),
(16, 'asdasdas asdasdas', 20, 10, '2020-09-13');

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `temp` date NOT NULL,
  `cas` text NOT NULL,
  `con` int(50) NOT NULL,
  PRIMARY KEY (`id_demande`),
  UNIQUE KEY `id_demande` (`id_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `demandes`
--

INSERT INTO `demandes` (`id_demande`, `from`, `to`, `temp`, `cas`, `con`) VALUES
(32, 23, 10, '2020-09-13', 'oui', 1);

-- --------------------------------------------------------

--
-- Structure de la table `eng`
--

CREATE TABLE IF NOT EXISTS `eng` (
  `id_eng` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_eng`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `eng`
--

INSERT INTO `eng` (`id_eng`, `id_user`, `id_post`) VALUES
(1, 10, 20);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE IF NOT EXISTS `medicament` (
  `id_medicament` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordonance` int(11) NOT NULL,
  `medicament` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id_medicament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf32 NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `temp` date NOT NULL,
  UNIQUE KEY `id_message` (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id_message`, `message`, `from`, `to`, `temp`) VALUES
(41, 'salam docteur', 23, 10, '2020-09-13'),
(42, 'salam labas', 10, 23, '2020-09-13'),
(43, 'ach 3anda a moniseur', 23, 10, '2020-09-13');

-- --------------------------------------------------------

--
-- Structure de la table `ordonance`
--

CREATE TABLE IF NOT EXISTS `ordonance` (
  `id_ordonance` int(11) NOT NULL AUTO_INCREMENT,
  `id_consultation` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ordonance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `post` text CHARACTER SET utf8 NOT NULL,
  `temp` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `id_post` (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id_post`, `post`, `temp`, `id_user`) VALUES
(16, 'S il vous plait, aidez-moi a ressentir des douleurs a l estomac', '2020-07-17', 24),
(17, 'J ai mal a la tete', '2020-07-17', 23),
(18, 'Ressentez une douleur dans le cou', '2020-07-17', 10),
(19, 'jgfjf jkztkutk', '2020-09-06', 10),
(20, 'DFSAF SDFSDF', '2020-09-13', 10),
(22, 'hello', '2020-09-13', 23),
(23, 'dfsdf', '2020-09-14', 23),
(24, 'fffffffffffffffffffffffffffff', '2020-09-14', 23);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id_rdv` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `descriptionn` text NOT NULL,
  PRIMARY KEY (`id_rdv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`id_rdv`, `id_patient`, `date`, `heure`, `descriptionn`) VALUES
(3, 24, '1222-07-15', '13:00:00', 'we are row'),
(4, 24, '0000-00-00', '00:00:00', ''),
(5, 23, '2020-09-01', '10:44:00', 'how '),
(6, 25, '2021-10-12', '12:00:00', ''),
(7, 25, '2022-10-10', '01:00:00', ''),
(8, 23, '2020-12-01', '11:22:00', ''),
(9, 23, '2020-12-12', '22:22:00', ''),
(10, 23, '2023-01-01', '12:12:00', 'hi'),
(11, 23, '1998-01-13', '11:11:00', 'li');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE IF NOT EXISTS `reglement` (
  `id_reglement` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `date` date NOT NULL,
  `paye` int(11) NOT NULL,
  PRIMARY KEY (`id_reglement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `reglement`
--

INSERT INTO `reglement` (`id_reglement`, `id_patient`, `montant`, `reste`, `date`, `paye`) VALUES
(1, 24, 1000, 0, '2020-07-15', 500),
(3, 23, 200, 0, '1999-01-01', 10);

-- --------------------------------------------------------

--
-- Structure de la table `sup`
--

CREATE TABLE IF NOT EXISTS `sup` (
  `id_sup` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_sup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_employee`
--

CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(30) CHARACTER SET utf8 NOT NULL,
  `type_user` text CHARACTER SET utf8 NOT NULL,
  `ville` text CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pays` text CHARACTER SET utf8 NOT NULL,
  `region` varchar(30) CHARACTER SET utf8 NOT NULL,
  `code_postal` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_creation` date NOT NULL,
  `Specialite` varchar(100) CHARACTER SET utf8 NOT NULL,
  `etablissement` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `certificate` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `pin` int(6) NOT NULL,
  `nomcabinet` varchar(50) CHARACTER SET utf8 NOT NULL,
  `poids` int(11) NOT NULL,
  `taille` int(11) NOT NULL,
  `cholesterol` int(11) NOT NULL,
  `glycemie` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `pouls` int(11) NOT NULL,
  `motif` text CHARACTER SET utf8 NOT NULL,
  `diagnostique` text CHARACTER SET utf8 NOT NULL,
  `remarque` text CHARACTER SET utf8 NOT NULL,
  `symptomes` text CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `telephone` (`telephone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `type_user`, `ville`, `telephone`, `adresse`, `pays`, `region`, `code_postal`, `email`, `pass`, `date_creation`, `Specialite`, `etablissement`, `certificate`, `description`, `pin`, `nomcabinet`, `poids`, `taille`, `cholesterol`, `glycemie`, `temperature`, `pouls`, `motif`, `diagnostique`, `remarque`, `symptomes`) VALUES
(10, 'achraf', 'lhaj', 'docteur', 'Errachidia', '0652420203', 'N17 CITE TOUCHKA PRES LA PISCINE MUNICIPALE', 'France', 'DRRA TAFILALET', '52000', 'aitachraf1000@gmail.com', '0000', '0000-00-00', 'medecins-generalistes', ' FacultÃ©', 'Formation', 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(23, 'Fouad', 'asdasd', 'patient', 'meknes', '065242367', '3223vsdsdf', 'Tunise', 'Soussa', '5643', 'r1000@gmail.com', '1111', '0000-00-00', 'dermatologie-et-venereologie', 'FacultÃ©1133 paris', 'dsdsd', 'ssssssssssssss', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(24, 'Hatim', 'Naim', 'patient', 'Errachidia', '0675432312', 'N17 CITE ', 'France', 'DRRA TAFILALET', '52000', 'af10@gmail.com', '4444', '0000-00-00', '', '', '', '', 0, '', 12, 198, 12, 44, 45, 89, 'fffffffffffffffffffffffffffffffffff', 'dddddddddddddddddddddddd', 'knnnnnnnnnnnnnnnnnn', 'kkkkkkkkkkkkkkkkkkkkkkkkkk'),
(25, 'Acharki', 'Ahmed', 'docteur', 'Errachidia', '0678350495', 'N17 CITE TOUCHKA PRES LA PISCINE MUNICIPALE', 'France', 'DRRA TAFILALET', '52000', 'ahmed99@gmail.com', '5555', '0000-00-00', 'chirurgie-orthopedique-et-traumatologique', 'FacultÃ©', 'Formation', 'dddddddddddd', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(26, 'Meknassi', 'Ilham ', 'docteur', 'Rabat', '0675436783', '3, avenue Ibn Sina, resid. Pirou, 2 ett. Apparteme', 'Maroc', 'Rabat-Salé-Kénitra', '23020', 'ilhamelmeknass@gmail.com', '1212', '2020-07-17', 'medecins-generalistes', 'Faculté de médecine et de pharmacie d''Agadir', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(27, 'BENABDELJALIL', 'AHLAM', 'docteur', 'Errachidia', '0743567634', '142, Avenue Bouchaib DOUKKALI El Jadida', 'Maroc', 'DRRA TAFILALET	', '34332', 'benabdjlil@gmail.com', '1313', '2020-07-17', 'Medecine Generale', 'Faculté de médecine et de pharmacie de Casablanca', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(28, 'Zahri ', 'Lahbib', 'docteur', 'Errachidia', '07896534', '41,boulevardNehrou, Appartement n 5', 'Maroc', 'DRRA TAFILALET	', '45678', 'zahri@gmail.com', '1414', '2020-07-08', 'medecins-generalistes', 'Faculté de médecine et de pharmacie de Rabat', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(29, 'Ait Benali ', 'Hassan', 'docteur', 'Errachidia', '0765879123', '22,boulevardNehrou, Immeuble des Habous', 'Errachidia', 'DRRA TAFILALET	', '52000', 'aitbenali@gmail.com', '1515', '2020-07-01', 'medecins-generalistes', 'Faculté de médecine et de pharmacie de Sale', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(30, 'Elbaaj', ' Abderrahmane', 'docteur', 'Errachidia', '0675436781', 'bd des F.a.r., Ismailia II, Immeuble B, Appartemen', 'Maroc', 'DRRA TAFILALE', '52000', 'elbaaj@gmail.com', '1515', '2020-07-01', 'medecins-generalistes', 'Faculté de médecine et de pharmacie d''Agadir', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(31, 'Assoukout', 'Tarik', 'docteur', 'Rabat', '0675436543', '56,boulevardAllal Ben Abdallah', 'Maroc', 'DRRA TAFILALET', '52000', 'assoukout', '161616', '2020-07-08', 'medecins-generalistes', 'Faculté de médecine et de pharmacie de Casablanca', 'Diplôme de docteur en Médecine', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(32, 'Amdan', 'Jaouad', 'docteur', 'Rabat', '0688775533', '37,boulevardAllal Ben Abdallah, Immeuble Al Watany', 'Maroc', 'Rabat', '45000', 'adnis@gmail.com', '9999', '2020-06-06', 'medecins-generalistes', 'FDM Errachidia', 'DDF', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(33, 'Akirane ', 'Mohamed Said', 'docteur', 'Rabat', '0688115533', '56,boulevardAllal Ben Abdallah', 'Maroc', 'Rabat', '78900', 'Akirane ', '5555', '2020-07-20', 'chirurgie-orthopedique-et-traumatologique', 'FDM Oujda', 'DDF', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(34, 'Taali', 'Oussama', 'patient', 'Errachidia', '0688111133', 'Rue Derb Soultan N1 ', 'Maroc', 'Draa-tafilalet', '52000', 'taali@gmail.com', '7777', '2020-07-09', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(35, 'karimi', 'ahmed', 'patient', 'meknes', '0611223344', 'n18 ain ati', 'Maroc', 'darra tafilalet', '5466', 'karim100@gmail.com', '1234', '0000-00-00', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(36, 'saad', 'halim', 'docteur', 'Casablanca', '0699887766', 'n18 ain ati', 'Maroc', 'Grand Casablanca', '2000', 'halim67@gmail.com', '1234', '0000-00-00', 'cardiologie', 'Umi', 'Diplome Medecin', 'fffffffffffff', 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `wdwd`
--

CREATE TABLE IF NOT EXISTS `wdwd` (
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
