-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: fcai_signup
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `whatsapp_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mohamed tamer','mohamed','01123435870','01123435870','October','midoelharery@mai.coms','$2y$10$MA8WcEb0NseRLCQZnwaHkOF5ccTPLoZn7b3zMUyuPhA1TdB/QqAmq','/uploads/68029b4c63a06_IMG_20160225_125831.jpg','2025-04-18 18:34:52'),(3,'mohamed tamer','mohamed_1','01123435870','01123435870','Fardous','midoelharery@mai.com','$2y$10$Zh4jfXOdemLyvaS7ikv5neGbhLTNE2B9XsmySkgkUVXBqZN7MF.FK','/uploads/68029fef4e636_4.jpg','2025-04-18 18:54:39'),(4,'mohamed tamer','mohamed_2','01123435870','01123435870','Fardous','midoelharery@mail.com','$2y$10$Q6CbaIgftSgcWJ3Q6BCdDuMi.WTTvLVEieUUdCeTlBTaEPYGR91ca','/uploads/6802a0ce5d6c8_4.jpg','2025-04-18 18:58:22'),(5,'Amr Elharery','amrmero','01126469477','01126469477','October','amrelharery@gmail.com','$2y$10$aOGIdokWEdYtKMNL8JfAU.eqLk9EOI9v5O7p.ExfV9dyk/IOE44lW','/uploads/6802a0ffd537c_20141226_213618.jpg','2025-04-18 18:59:11'),(6,'Amr Elharery','amrmero_1','01126469477','01126469477','October','amrelharery@gmail.ca','$2y$10$RRUWMouvw855BRiy97sER.Sit2mIZJdWJ88s4.AR36to3uT8t9FLu','/uploads/6802a13b4f073_20141226_213618.jpg','2025-04-18 19:00:11');
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

-- Dump completed on 2025-04-18 21:17:47
