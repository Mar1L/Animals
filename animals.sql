-- Progettazione Web 
DROP DATABASE if exists project; 
CREATE DATABASE project; 
USE project; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chart`
--

DROP TABLE IF EXISTS `chart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chart` (
  `chartId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `game_gameId` int(11) NOT NULL,
  PRIMARY KEY (`chartId`),
  KEY `fk_chart_user1_idx` (`user_userId`),
  KEY `fk_chart_game1_idx` (`game_gameId`),
  CONSTRAINT `fk_chart_game1` FOREIGN KEY (`game_gameId`) REFERENCES `game` (`gameId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_chart_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart`
--

LOCK TABLES `chart` WRITE;
/*!40000 ALTER TABLE `chart` DISABLE KEYS */;
INSERT INTO `chart` VALUES (15,2,193),(16,27,184),(17,28,185),(18,9,186),(19,8,187),(20,7,188),(21,6,189),(22,5,190),(23,4,191),(24,3,192);
/*!40000 ALTER TABLE `chart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `gameId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `errors` int(11) DEFAULT NULL,
  `lives` int(11) DEFAULT NULL,
  `helps` int(11) DEFAULT NULL,
  `gameTime` datetime NOT NULL,
  PRIMARY KEY (`gameId`),
  KEY `fk_game_user_idx` (`user_userId`),
  CONSTRAINT `fk_game_user` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (176,2,17,0,0,0,'2020-02-03 02:39:17'),(177,2,10,0,0,0,'2020-02-03 02:40:39'),(178,2,6,0,0,0,'2020-02-03 02:46:32'),(183,27,39,0,0,0,'2020-02-03 04:33:43'),(184,27,85,5,0,0,'2020-02-03 04:35:56'),(185,28,88,58,1,3,'2020-02-03 05:14:40'),(186,9,107,14,3,0,'2020-02-03 05:23:12'),(187,8,81,35,3,0,'2020-02-03 05:30:40'),(188,7,65,18,0,0,'2020-02-03 05:34:35'),(189,6,75,40,2,3,'2020-02-03 05:38:41'),(190,5,86,19,3,0,'2020-02-03 05:42:38'),(191,4,24,3,0,0,'2020-02-03 05:43:53'),(192,3,42,12,0,0,'2020-02-03 05:48:47'),(193,2,77,13,0,0,'2020-02-03 09:57:26');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture` (
  `pictureId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(45) NOT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`pictureId`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture`
--

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` VALUES (20,'turtle','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/turtle.png'),(21,'fish','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/fish2.png'),(22,'duck','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/duck.png'),(23,'crocodile','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/crocodile.png'),(24,'chicken','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/chicken.png'),(25,'cat','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/cat.png'),(26,'bull','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/bull.png'),(27,'horse','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/Horse.png'),(28,'dog','https://ntmblumenau.com.br/atvinfo2017/EBM%20Vidal%20Ramos/1%20ano/Ciencias/Nanimais/Dog.png'),(47,'goat','https://upload.wikimedia.org/wikipedia/commons/f/f5/Goat_cartoon_04.svg'),(49,'koala','https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Koala.svg/1024px-Koala.svg.png'),(50,'bird','https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Songbird-new.svg/1024px-Songbird-new.svg.png'),(51,'chameleon','https://upload.wikimedia.org/wikipedia/commons/7/74/Farm-Fresh_chameleon.png'),(56,'lion','https://upload.wikimedia.org/wikipedia/commons/b/b8/Lion_icon.png'),(60,'donkey','https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Donkey_cartoon_04.svg/859px-Donkey_cartoon_04.svg.png'),(61,'sheep','https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Sheep_cartoon_04.svg/1170px-Sheep_cartoon_04.svg.png'),(62,'cow','https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Cow_cartoon_04.svg/425px-Cow_cartoon_04.svg.png'),(63,'rooster','https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/Rooster_cartoon_04.svg/377px-Rooster_cartoon_04.svg.png'),(64,'pig','https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Pig_cartoon_04.svg/425px-Pig_cartoon_04.svg.png'),(65,'rabbit','https://images.vexels.com/media/users/3/159218/isolated/preview/c9f2f44183fdf1d4a1cc0b1f1caa733a-bunny-rabbit-muzzle-ear-illustration-by-vexels.png'),(66,'penguin','https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Penguin_icon_by_Fabuio.svg/426px-Penguin_icon_by_Fabuio.svg.png'),(67,'giraffe','https://i.ya-webdesign.com/images/vector-giraffe-8.png'),(68,'fox','https://premiumbpthemes.com/images/fox-cartoon-png-2.png'),(69,'elephant','https://i.ya-webdesign.com/images/elephants-svg-adorable-6.png'),(70,'panda','https://i2.wp.com/www.marcolivetti.com/wp-content/uploads/kisspng-giant-panda-tiger-gorilla-cartoon-panda-vector-5a83548a677434.9585946615185562984238.png'),(71,'bear','https://pngimg.com/uploads/bear/bear_PNG23449.png'),(72,'butterfly','https://i.ya-webdesign.com/images/monarch-clipart-6.png'),(73,'tiger','https://i.ya-webdesign.com/images/tiger-clipart-transparent-background-1.png'),(74,'bee','http://pluspng.com/img-png/bee-free-png-cartoon-bee-png-800.png'),(75,'bat','https://i.ya-webdesign.com/images/bat-clipart-file-7.png'),(76,'hedgehog','https://i.ya-webdesign.com/images/hedgehog-svg-vector.png'),(77,'kangaroo','https://i.ya-webdesign.com/images/kangaroo-clipart-ear-22.png'),(78,'reindeer','https://images.vexels.com/media/users/3/133897/isolated/preview/8789fce2f10b18c9860fcf652c4edbb4-reindeer-cartoon-running-01-by-vexels.png'),(80,'gorilla','https://upload.wikimedia.org/wikipedia/commons/1/11/201502_gorilla.png'),(81,'squirrel','https://i.ya-webdesign.com/images/black-squirrel-png-4.png'),(82,'armadillo','https://webstockreview.net/images250_/armadillo-clipart-transparent-4.png'),(83,'skunk','https://img.pngio.com/pepe-le-pew-wikipedia-cartoon-animals-step-by-step-png-1200_1324.png'),(85,'deer','https://lh3.googleusercontent.com/proxy/WCbatXLfvIGSVPuOyhHXXqsAtfcaO8uZRtcKAyye6h11-D6UciMJUFpD4hPIZnLRY1IWnwwe8cRDVwxKQU6n7UNumxuZK-1z0A8E0IL-Q3T740YPj_osTSZP6BBsJJlaydVFnc2H8lA-zWj-w7xftbia'),(86,'hyena','https://i.ya-webdesign.com/images/hyena-vector-3.png'),(87,'hamster','https://upload.wikimedia.org/wikipedia/commons/4/4b/201606_hamster.png'),(88,'porcupine','https://upload.wikimedia.org/wikipedia/commons/3/3f/Libertarian_porcupine.png'),(89,'panther','https://i.ya-webdesign.com/images/baby-panther-png-7.png'),(90,'dolphin','https://webstockreview.net/images/clipart-dolphin-flipper-17.png'),(91,'flamingo','https://pngimage.net/wp-content/uploads/2018/06/flamencos-png-3.png'),(92,'raccoon','https://i.dlpng.com/static/png/6386301_thumb.png'),(93,'walrus','https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/Lemmling_walrus.svg/512px-Lemmling_walrus.svg.png'),(94,'jaguar','https://www.stickpng.com/assets/images/580b57fbd9996e24bc43bc7d.png'),(95,'spider','https://svgsilh.com/svg_v2/146550.svg'),(96,'pigeon','https://storageseriallabs.blob.core.windows.net/icono/PNG/Birds/Dove/Traditional/NaturalColor/D_pose.png'),(97,'jellyfish','https://i.pinimg.com/originals/c1/ac/40/c1ac40c9a58b3ff1224e691cd81bff28.png');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` char(6) NOT NULL DEFAULT 'Others',
  `email` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `privilege` varchar(45) NOT NULL DEFAULT 'user',
  `profilePic` varchar(500) DEFAULT '0',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `Email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin',25,'Others','administrator@gmail.com','Admin01','Admin','0'),(2,'Anna',6,'Girl','anna@gmail.com','anna123','User','profile2.png'),(3,'Alfredo',4,'Boy','m.rossi@gmail.com','alfredo9','User','0'),(4,'Anna',6,'Girl','g.verdi@gmail.com','anna123','User','0'),(5,'Giulia',3,'Girl','a.rossi@yahoo.com','giulia5','User','0'),(6,'Marco',8,'Boy','a.verdi@alice.it','marco08','User','0'),(7,'Giada',5,'Girl','giada@gmail.com','giada12','User','0'),(8,'Giulia',4,'Girl','giulia@gmail.com','giulia12','User','profile8.jpg'),(9,'Adriano',7,'Boy','adriano@gmail.com','adriano1','User','profile9.jpg'),(10,'Giovanni',26,'Others','admin@gmail.com','Admin01','Admin','0'),(27,'Alfredo',10,'Boy','alfredo@gmail.com','alfredo1','User','profile27.png'),(28,'Martina',6,'Girl','martina@gmail.com','martina1','User','profile28.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-03 22:00:59
