# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Värd: 127.0.0.1 (MySQL 5.5.58-0ubuntu0.14.04.1)
# Databas: blogg
# Genereringstid: 2017-11-19 19:56:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Tabelldump author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `post-author` (`id`),
  KEY `user-author` (`user_id`),
  CONSTRAINT `post-author` FOREIGN KEY (`id`) REFERENCES `posts` (`id`),
  CONSTRAINT `user-author` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;

INSERT INTO `author` (`id`, `user_id`)
VALUES
	(1,2),
	(2,2),
	(3,1),
	(4,3),
	(5,3);

/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump cat_bind
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cat_bind`;

CREATE TABLE `cat_bind` (
  `cat_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL,
  KEY `cat` (`cat_id`),
  KEY `post` (`id`),
  CONSTRAINT `cat` FOREIGN KEY (`cat_id`) REFERENCES `cathegory` (`cat_id`),
  CONSTRAINT `post` FOREIGN KEY (`id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

LOCK TABLES `cat_bind` WRITE;
/*!40000 ALTER TABLE `cat_bind` DISABLE KEYS */;

INSERT INTO `cat_bind` (`cat_id`, `id`)
VALUES
	(1,1),
	(1,2),
	(1,3),
	(2,3),
	(2,4),
	(2,5);

/*!40000 ALTER TABLE `cat_bind` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump cathegory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cathegory`;

CREATE TABLE `cathegory` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

LOCK TABLES `cathegory` WRITE;
/*!40000 ALTER TABLE `cathegory` DISABLE KEYS */;

INSERT INTO `cathegory` (`cat_id`, `cat_name`)
VALUES
	(1,'uncategorized'),
	(2,'elefant');

/*!40000 ALTER TABLE `cathegory` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `title` varchar(75) CHARACTER SET latin1 DEFAULT NULL,
  `content` longtext CHARACTER SET utf16,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `date`, `title`, `content`)
VALUES
	(1,'2017-09-15','Hej alla vänner','<p>\n		<span id=\"dropcap\">A</span><span class=\"smallcaps\">orem ipsum dolor</span> sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n		<p>\n  		”Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <div class=\"pull\">”Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”</div>\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n       <p>\n		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n		<p>\n  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <blockquote>”Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.”</blockquote>\n    <p>'),
	(2,'2017-10-15','Du luktar jordgubbe','<p>\n		<span id=\"dropcap\">A</span><span class=\"smallcaps\">orem ipsum dolor</span> sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n		<p>\n  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <div class=\"pull\">»Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.»</div>\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n       <p>\n		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n		<p>\n  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n    <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>\n    <p>'),
	(3,'0000-00-00','Nykterismens nyckfullhet','<p><span id=\"dropcap\">J</span><span>ag kan utan att ljuga</span> säga att jag aldrig varit full. Jag har aldrig druckit sprit. Jag har aldrig druckit öl. Jag har aldrig druckit vin. Inte ens champagne dricker jag, ens på nyårsafton. Jag är alltså helnykterist, absolutist och torrare än fnöske. Nu är det sagt och förklarat, vilket är viktigt för vad som komma skall.</p>\n<p><span id=\"more-19\"></span></p>\n<p>Av någon anledning är det aldrig neutralt att vara nykter av annan orsak än att man måste köra bil. Det är aldrig något som kan tas med ett ?Jaha?. Det måste alltid, alltid bändas åt det ena eller det andra hållet: diskuteras, debatteras, analyseras, ifrågasättas eller för den del berömmas. Det kan aldrig bara få <i>vara</i>.</p>\n<p>Orsaken till min absolutism är inte på något sätt en önskan om moralisk överlägsenhet; och för mig som aldrig druckit alkohol är det inte <em>svårt</em>. För mig som inte vant sig med smaken, är sprit brännande bittert och det känns direkt som att jag fått i mig något slags farlig kemikalie när tungan bedövas efter att den begynnande hettan svalnat av. Jag tycker alltså det smakar jätteäckligt och att det känns obehagligt i munnen.</p>\n<p>Om än, tack och lov, inte lika vanligt får man tidvis även kommentarer om hur tråkig man är. Finge nykterister en krona för varje ?men kom igen? skulle de alla vara väldigt rika. I övrigt är vi inte en homogen grupp: vissa är tråkiga, andra är roliga ? men de flesta är precis som alla andra sådär mittemellan.</p>\n<p>Andra känner ett slags behov att rättfärdiga sitt alkoholbruk, något slags korsbefruktning av de båda ovan nämnda, vilket ibland kan leda till långa verbala excesser månget par öron hade klarat sig utan. Kan vi inte bara säga så: jag ifrågasätter och kräver inte att du skall rättfärdiga ditt val, och du gör samma sak för mig. Jag dömer inte dig ? måste du döma mig?</p>\n<p>Att vara nykterist innebär också att man antas vara totalt ointresserad av att vara med i sammanhang där det konsumeras alkohol. Det antas att man är totalt ointresserad av att träffa andra människor efter klockan 18 på kvällen eller bara ?hänga? på ?vuxenvis?. Personer som inte är nykterister själva tar sig rättigheten och tolkningsöfreträdet vad gäller saker som du tycker är roliga och trevliga, inte roliga eller trevliga, och vad du står ut med, vad du är bekväm med, etc. etc. Bara för att du inte står ut att umgås med andra som är fulla när du själv är nykter innebär det inte att samma sak gäller för mig.</p>\n<p>Det finns vissa saker vad gäller alkohol jag inte har koll på och som gör att jag faktiskt inte kan förstå en del referenser som folk gör. Jag vet inte hur mycket sprit som är mycket vare det vin, öl eller ren vodka. Är tre öl normalt, eller är en normal kväll fem öl? Bör jag automatiskt förstå att någon är jättebakis för att hen drack åtta öl på en kväll, eller är det något som de flesta klarar av? Hur många shots blir man full på? <i>Les questions de la vie!</i></p>\n<p>Avsaknad av referenspunkter betyder dock inte att jag är dum. Jag vet att alkohol ger en känsla av välbehag. Du eller någon annan för den delen behöver inte förklara för mig att det är skönt och roligt: jag vet det redan. Om inte för att flertalet personer redan sagt det, så kanske till följd av de synbarligen ändlösa kulturella referenserna till den effekten av alkohol. Det är liksom bara väldigt svårt att missa. <i>Jättesvårt</i> att missa, faktiskt.</p>\n<p>Men ? ibland känns det som det är något jag missar. Jag syftar då inte på fyllor och berusning (eller baksmälla och kräkningar heller för den delen). Nej, jag tänker på det osynliga kulturella nät som byggs upp kring alkoholen och det utanskap man hamnar i när man väljer att stå utanför. Jag tänker på den <i>bondande</i> effekt som det verkar ha att bli full med någon. Jag tänker på alla de dörrar som öppnas när man är, och gör, som alla andra.</p>\n<p>Tiden får utvisa, om det är värt det.</p>'),
	(4,'0000-00-00','Dies iræ, dies illa','<p>\n		<span id=\"dropcap\">A</span><span class=\"smallcaps\">orem ipsum dolor</span> sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
	(5,'0000-00-00','Surkålsproduktion','<p>\n		<span id=\"dropcap\">A</span><span class=\"smallcaps\">orem ipsum dolor</span> sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `f_name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `s_name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `username`, `password`, `f_name`, `s_name`, `email`)
VALUES
	(1,'admin','$2y$10$1LZdjAhbtl8D3BbnnXlon.9Sv5tSzJ72nrJSedaVMm.pavq.V0Tq6','Martin','Falk Johansson','martin@falkjohansson.se'),
	(2,'moot','$2y$10$1LZdjAhbtl8D3BbnnXlon.9Sv5tSzJ72nrJSedaVMm.pavq.V0Tq6','Nomen','Nescio','email@email.com'),
	(3,'jesus','$2y$10$1LZdjAhbtl8D3BbnnXlon.9Sv5tSzJ72nrJSedaVMm.pavq.V0Tq6','Jesus','Kristus','jesus@himlen.com');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
