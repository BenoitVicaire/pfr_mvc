-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: logicariumdb
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avatar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avatar`
--

LOCK TABLES `avatar` WRITE;
/*!40000 ALTER TABLE `avatar` DISABLE KEYS */;
INSERT INTO `avatar` VALUES (0,'/pfr_new/logicarium/public/assets/images/avatar/Avatar_1.png','avatar1'),(1,'/pfr_new/logicarium/public/assets/images/avatar/Avatar_2.png','avatar2'),(2,'/pfr_new/logicarium/public/assets/images/avatar/Avatar_3.png','avatar3');
/*!40000 ALTER TABLE `avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `comments_ibfk_2` (`thread_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (0,'Il est super top ce thread, trop bien de ouf','2026-01-27 13:03:03',1,1),(1,'Bouhhh trop naze','2026-01-27 13:03:03',2,1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,'Test','\nWhat is Lorem Ipsum?\n\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n','2026-01-27 13:03:03',1,'2026-01-30 16:05:07','une belle description plus ou moins longue'),(2,'Test2','Lorem Ipsum','2026-01-28 13:03:03',2,'2026-01-30 16:05:07','une belle description plus ou moins longue'),(3,'qsssssssssssssssssssssssssssssssssssssssss','qsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd ddddddddddddddddddddddd','2026-01-28 13:03:03',3,'2026-01-30 16:05:07','une belle description plus ou moins longue');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `avatar_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_avatar` (`avatar_id`),
  CONSTRAINT `fk_avatar` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bob','$2y$10$FvfDKWH8KJ1Bt4PZnfNdj.IbtqqLSrXExNIWteCgm80lzhyzggmoe','2026-01-27 13:03:03','test@test.com',NULL),(2,'bob','$2y$10$TueRuBOyaM2QX3ei1a5dwuiIEZ5YZl6YtHX9HrPE8351IYuTONh0G','2026-01-27 13:07:42','test1@test.com',NULL),(3,'laureneavecunnomaralongedefoufurieux','$2y$10$8dSB4eUNXQ4XCusx0ZdbI.9ZvXYB2XSI03cShAnqET509luHpX4CC','2026-01-27 14:11:35','laurene.castor@exemple.com',NULL),(4,'jon','$2y$10$.nbN4Qt7HL4mpsRaLUMVa.n0IDas2TPWPEMXPlIkT3PsPg957GSWa','2026-01-27 14:33:19','jon@test.com',NULL),(5,'qsdqs','$2y$10$k1XudpwTeTYLeK/QNu8HG.hKy60YhjWiJbpq6NzVl1BdUMM8ZBsL2','2026-01-27 14:34:44','test2@test.com',NULL),(6,'azert','$2y$10$JWCEe4bjQa/uoiuefhpNT.DbrkSJqoUVCazltGELwgfjfpizWt2ZG','2026-01-27 14:35:18','test3@test.com',NULL),(7,'qsdqsd','$2y$10$nPnRmFwiiaGprtOvnsCOmeIcLG1B/4dVuYxlfx5UozylFoSsKSLQC','2026-01-27 14:36:00','test10@test.com',NULL),(8,'azer','$2y$10$01UpqRQTe7vFv9.TIH.EGe51gKqwUZ/5Jqkad8djRkw3G8AZYHthG','2026-01-27 14:36:30','qsdqs@gmail.com',NULL),(9,'1234','$2y$10$f0fwUUHNJx6A02pUYtdjNubdOsJf43sQdPwyHEDqbODfO2yCcEc7i','2026-01-29 14:19:35','1234@gmail.com',NULL),(10,'benito','$2y$10$KLdlz0G11iX/3CQCY2NmGuLr5DkLGBISaKMV6puyB.CEzBQAqhqZ2','2026-01-29 16:21:21','testing2@gmail.com',NULL),(11,'jojo','$2y$10$aH0B.XwoqdxqO9yx6I5.bu0qByk3eJxhoTX35KtiCzvLj9MRcRMHy','2026-01-29 16:45:43','joseph@gmail.com',NULL),(12,'zugzug','$2y$10$ZYHHaFgpvojNdpYS4j46kudzBqUDndEU3qPU1sHawwtSixiGmY9t2','2026-01-29 17:09:04','zugzug@gmail.com',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-02  9:18:58
