# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: tiddeR
# Generation Time: 2015-05-02 16:05:46 +0000
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
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post`) REFERENCES `post` (`id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `post`, `user`, `text`, `date`)
VALUES
	(1,1,2,'GO CS:GO noob','2015-04-30 18:03:00'),
	(2,2,1,'Faut que t\'arrête avec la glitch!','2015-04-30 18:33:54');

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
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `title`, `link`, `content`, `user`, `date`, `note`)
VALUES
	(1,'Akkes.fr','http://akkes.fr/','Le site parfais de quelqu\'un de parfais.',1,'2015-04-29 23:17:32',0),
	(2,'Uinelj.eu','http://uinelj.eu/','Mon site perso, il est trop bien!',2,'2015-04-30 18:31:55',0),
	(3,'Thunderclap: Contre la loi renseignement','https://www.thunderclap.it/fr/projects/25535-contre-la-loi-renseignement','“Le #PJLRenseignement tant décrié sera voté demain. Pour nos libertés individuelles, nous voulons un débat national ! http://thndr.it/1E3fVkV”',1,'2015-05-02 16:50:40',0),
	(4,'Corporate Ipsum','http://doubleforte.net/widgets/corporate/','Efficiently unleash cross-media information without «cross-media» value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar.',2,'2015-05-02 16:51:49',0),
	(5,'Cat Ipsum','http://www.catipsum.com/','Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up on goofballs.',1,'2015-05-02 16:56:10',0),
	(6,'Tuna Ipsum','http://tunaipsum.com/','European minnow priapumfish mosshead warbonnet shrimpfish bigscale. Cutlassfish porbeagle shark ricefish walking catfish glassfish Black swallower.',1,'2015-05-02 16:56:10',0);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `name`)
VALUES
	(1,'site perso'),
	(2,'ipsum');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `tagsOfPost` WRITE;
/*!40000 ALTER TABLE `tagsOfPost` DISABLE KEYS */;

INSERT INTO `tagsOfPost` (`id`, `post`, `tag`)
VALUES
	(1,1,1),
	(2,2,1),
	(3,4,2),
	(4,5,2),
	(5,6,2);

/*!40000 ALTER TABLE `tagsOfPost` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) NOT NULL DEFAULT '',
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nick`, `mail`)
VALUES
	(1,'Ak:kes','louis@akkes.fr'),
	(2,'Uinelj','aulien.jbadji@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
