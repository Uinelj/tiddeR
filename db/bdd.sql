-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 30 Avril 2015 à 18:35
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `tiddeR`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `post` varchar(200) NOT NULL,
  `user` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`post`, `user`, `text`, `date`) VALUES
('http://akkes.fr/', 'Uinelj', 'GO CS:GO noob', '2015-04-30 18:03:00'),
('http://uinelj.eu/', 'Ak:kes', 'Faut que t''arrête avec la glitch!', '2015-04-30 18:33:54');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `title` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `name` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `note` float NOT NULL,
  `votenumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`title`, `link`, `content`, `name`, `date`, `note`, `votenumber`) VALUES
('Akkes.fr', 'http://akkes.fr/', 'Le site parfais de quelqu''un de parfais.', 'Ak:kes', '2015-04-29 23:17:32', 5, 2),
('Uinelj.eu', 'http://uinelj.eu/', 'Mon site perso, il est trop bien!', 'Uinelj', '2015-04-30 18:31:55', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`name`) VALUES
('site perso');

-- --------------------------------------------------------

--
-- Structure de la table `tagsOfPost`
--

CREATE TABLE `tagsOfPost` (
  `post` varchar(200) NOT NULL,
  `tag` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tagsOfPost`
--

INSERT INTO `tagsOfPost` (`post`, `tag`) VALUES
('http://akkes.fr/', 'site perso');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `name` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`name`, `mail`) VALUES
('Ak:kes', 'louis@akkes.fr'),
('Uinelj', 'aulien.jbadji@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`post`,`user`,`date`), ADD KEY `post` (`post`), ADD KEY `user` (`user`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`link`), ADD KEY `name` (`name`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`name`);

--
-- Index pour la table `tagsOfPost`
--
ALTER TABLE `tagsOfPost`
 ADD PRIMARY KEY (`post`,`tag`), ADD KEY `post` (`post`), ADD KEY `tags` (`tag`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`name`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`post`) REFERENCES `post` (`link`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`name`) REFERENCES `user` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tagsOfPost`
--
ALTER TABLE `tagsOfPost`
ADD CONSTRAINT `tagsofpost_ibfk_1` FOREIGN KEY (`tag`) REFERENCES `tags` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `tagsofpost_ibfk_2` FOREIGN KEY (`post`) REFERENCES `post` (`link`) ON DELETE NO ACTION ON UPDATE NO ACTION;
