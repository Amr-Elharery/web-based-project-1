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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin_1','01111111111','01111111111','Address','admin-1@example.com','$2y$10$TwH/IwgDC6VdBa.QrO4ba.xv60O1Ad6TaLrU7pBSPIxAPcpRPdpUu','/uploads/6802b2ff468ae_default.png','2025-04-18 20:15:59'),(2,'admin','admin_2','01111111111','01111111111','Address','admin-2@example.com','$2y$10$/alGrkGuZaG/6XIU/sdlP.Z5rERmy5sj7.0brYygep105UtLCgNsS','/uploads/6802b30749c84_default.png','2025-04-18 20:16:07'),(3,'admin','admin_3','01111111111','01111111111','Address','admin-3@example.com','$2y$10$L1M/avFlA3Fu7ScBCwB6vOTzcue3K3IhIBwIfIAyvrNA5FbEDK0D6','/uploads/6802b30fb2fc8_default.png','2025-04-18 20:16:15'),(4,'admin','admin_4','01111111111','01111111111','Address','admin-4@example.com','$2y$10$OnFpoAvPTlfgUXMbTAUxaupVCOfVPwiVUkHMIp/wtXSXwBDrGHSq6','/uploads/6802b31843157_default.png','2025-04-18 20:16:24'),(5,'admin','admin_5','01111111111','01111111111','Address','admin-5@example.com','$2y$10$aaIVo/LcodBkQTmyXEiRlu7NfdeHJcRDNf0zeYygice7f1ViuRQjq','/uploads/6802b320c180f_default.png','2025-04-18 20:16:32');
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

-- Dump completed on 2025-04-18 22:18:07
