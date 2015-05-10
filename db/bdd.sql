# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: tiddeR
# Generation Time: 2015-05-10 22:59:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post` int(11) unsigned NOT NULL,
  `user` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post` (`post`),
  KEY `user` (`user`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `post`, `user`, `text`, `date`)
VALUES
	(1,1,2,'GO CS:GO noob','2015-04-30 18:03:00'),
	(2,2,1,'Faut que t\'arrête avec la glitch!','2015-04-30 18:33:54'),
	(3,1,1,'T\'es serieux?','2015-05-03 19:11:40'),
	(4,3,1,'Faites gaffe, c\'est une loi super dangereuse!','2015-05-08 14:51:50'),
	(5,1,3,'plop','2015-05-08 15:46:06'),
	(6,3,3,'Tellement!','2015-05-08 15:46:18'),
	(7,2,3,'Moi j\'aime bien!','2015-05-08 15:46:51'),
	(8,5,5,'The internet is made of cats','2015-05-08 15:59:37');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post
# ------------------------------------------------------------

CREATE TABLE `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `user` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `note` float NOT NULL,
  `vote_number` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `title`, `link`, `content`, `user`, `date`, `note`, `vote_number`)
VALUES
	(1,'Akkes.fr','http://akkes.fr/','Le site parfait de quelqu\'un de parfait.',1,'2015-04-29 23:17:32',5,1),
	(2,'Uinelj.eu','http://uinelj.eu/','Mon site perso, il est trop bien!',2,'2015-04-30 18:31:55',4,0),
	(3,'Thunderclap: Contre la loi renseignement','https://www.thunderclap.it/fr/projects/25535-contre-la-loi-renseignement','“Le #PJLRenseignement tant décrié sera voté demain. Pour nos libertés individuelles, nous voulons un débat national ! http://thndr.it/1E3fVkV”',1,'2015-05-02 16:50:40',5,0),
	(4,'Corporate Ipsum','http://doubleforte.net/widgets/corporate/','Lorem Ipsum en entreprise: Efficiently unleash cross-media information without «cross-media» value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar.',2,'2015-05-02 16:51:49',0,0),
	(5,'Cat Ipsum','http://www.catipsum.com/','Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up on goofballs.',1,'2015-05-02 16:56:10',2,0),
	(6,'Tuna Ipsum','http://tunaipsum.com/','European minnow priapumfish mosshead warbonnet shrimpfish bigscale. Cutlassfish porbeagle shark ricefish walking catfish glassfish Black swallower.',1,'2015-05-02 16:56:10',0,0),
	(7,' Meet the Ipsums ','http://meettheipsums.com/','Parce qu\'il n\'y a jamais assez de Ipsums!',2,'2015-05-10 14:53:42',0,0),
	(9,'CHIP - The World\'s First Nine Dollar Computer by Next Thing Co. &mdash; Kickstarter','https://www.kickstarter.com/projects/1598272670/chip-the-worlds-first-9-computer','Pas cher cet ordi!',2,'2015-05-10 15:21:50',0,0),
	(18,'Vous Etes Perdu ?','http://perdu.com','J\'adore ce site!',5,'2015-05-10 17:46:15',0,0),
	(19,'Blade Runner c\'est pas fou non plus','http://bladerunnercestpasfounonplus.website/','OK quand il est sorti c\'est surement ce qui se faisait de mieux, l\'ambiance et les décors sont exceptionnels, mais on ne va pas se mentir, ça a quand même vieilli.\r\n\r\nVous aimez ce film par habitude, parce que vous l\'avez vu jeune, parce que tout le monde dit qu\'il est « culte », mais ne nous voilons pas la face, il ne s\'y passe pas grand chose en vrai.',13,'2015-05-10 19:04:52',0,0),
	(26,'Font Awesome Icons','http://fontawesome.io/icons/','Tout pleins d’icônes pour le web',3,'2015-05-10 20:22:26',5,1),
	(27,'Bienvenue!','http://localhost:8888/Web/tiddeR/p/27','bienvenue sur tidder, le journal du web. Créé par Uinelj &amp; Ak:kes.',3,'2015-05-10 23:17:56',0,0);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `name`)
VALUES
	(1,'perso'),
	(2,'ipsum'),
	(3,'HTML'),
	(4,'CSS'),
	(5,'astuces'),
	(6,'admin'),
	(9,'potatoes');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tagsOfPost
# ------------------------------------------------------------

CREATE TABLE `tagsOfPost` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post` int(11) unsigned NOT NULL,
  `tag` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post` (`post`),
  KEY `tags` (`tag`),
  CONSTRAINT `tagsofpost_ibfk_1` FOREIGN KEY (`post`) REFERENCES `post` (`id`),
  CONSTRAINT `tagsofpost_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

LOCK TABLES `tagsOfPost` WRITE;
/*!40000 ALTER TABLE `tagsOfPost` DISABLE KEYS */;

INSERT INTO `tagsOfPost` (`id`, `post`, `tag`)
VALUES
	(1,1,1),
	(2,2,1),
	(4,5,2),
	(5,6,2),
	(6,1,6),
	(7,2,6),
	(11,27,6),
	(12,26,5),
	(13,19,9),
	(14,18,3),
	(15,9,5),
	(16,9,9),
	(17,7,2),
	(18,7,5),
	(19,4,2),
	(20,3,6);

/*!40000 ALTER TABLE `tagsOfPost` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) NOT NULL DEFAULT '',
  `mail` varchar(50) NOT NULL,
  `permitions` enum('candidate','user','admin','ban') DEFAULT NULL,
  `pass` char(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nick`, `mail`, `permitions`, `pass`)
VALUES
	(1,'Ak:kes','louis@akkes.fr','admin',NULL),
	(2,'Uinelj','aulien.jbadji@gmail.com','admin',NULL),
	(3,'aklins','yolo@yolo.com','admin',NULL),
	(4,'swagg','swagg@yolo.com','user',NULL),
	(5,'AKS','akkes@akkes.fr','user',NULL),
	(10,'YOLOSWAGGINGS','foo@foo.fr','user',NULL),
	(11,'foutaises','foo@foo.fr','user',NULL),
	(12,'plop','foo@foo.fr','user',NULL),
	(13,'potatoes','foo@foo.fr','user',NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vote
# ------------------------------------------------------------

CREATE TABLE `vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned DEFAULT NULL,
  `post` int(11) unsigned DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `vote` WRITE;
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;

INSERT INTO `vote` (`id`, `user`, `post`, `value`)
VALUES
	(1,1,1,5),
	(2,5,15,2),
	(3,5,11,3),
	(4,5,14,3),
	(5,5,17,4),
	(6,5,16,2),
	(7,3,26,5);

/*!40000 ALTER TABLE `vote` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
