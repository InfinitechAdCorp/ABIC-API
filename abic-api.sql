-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: abic-database-1.cxe4oaswio3m.ap-southeast-1.rds.amazonaws.com    Database: abic-database-1
-- ------------------------------------------------------
-- Server version	8.0.39

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `career_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES ('01JJ5SJWTXDY52G3F20GWEWEYB','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5SJWDK6C662XXHHC86CCAM.pdf','2025-01-22 01:21:17','2025-01-22 01:21:17'),('01JJ5TH2GN1Y98YM37VE5W9DQD','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5TH25VE01KQG88690PVPZP.pdf','2025-01-22 01:37:46','2025-01-22 01:37:46'),('01JJ5TJZGXT4KAMEAR0K35V354','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5TJZ67SH106E9S96FHQ40F.pdf','2025-01-22 01:38:48','2025-01-22 01:38:48'),('01JJ5TKT364GMQ7X8WC89BJ9ED','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5TKSTEAR59KFY18K1NS1ME.pdf','2025-01-22 01:39:15','2025-01-22 01:39:15'),('01JJ5TPDAD2K8PCZ57C20N5QS8','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5TPD278CREC7PM76RRQ0TT.pdf','2025-01-22 01:40:40','2025-01-22 01:40:40'),('01JJ5TT5JQYZ3K2W94PPKY1N9S','01JJ3YMQEGHSFGT446C0JW5A9Z','Giolo','Evora','giolo.evora@gmail.com','09163918132','Makati City','01JJ5TT55YPPM5ZGE5FTA7NFP2.pdf','2025-01-22 01:42:44','2025-01-22 01:42:44');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `careers`
--

DROP TABLE IF EXISTS `careers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `careers` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slots` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `careers`
--

LOCK TABLES `careers` WRITE;
/*!40000 ALTER TABLE `careers` DISABLE KEYS */;
INSERT INTO `careers` VALUES ('01JJ3S2Q0YP18VQ84ZRRMX1X14','Real Estate Agent',50,'uploads/careers/images/agent1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3S2QEWEARKQ053R4V621JF','Property Manager',30,'uploads/careers/images/manager1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3S2QH5ZMD1B1WJAF4GXXVX','Marketing Specialist',15,'uploads/careers/images/marketing1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3S2QKDEC01KF9GCN2T2DS0','Sales Consultant',10,'uploads/careers/images/sales1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3S2QNM07A98YK4T2E42SDS','Leasing Officer',25,'uploads/careers/images/leasing1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3S2QQW5FV4H9GYH7GN122Q','Administrative Officer',30,'uploads/careers/images/admin1.jpg','2025-01-21 06:33:58','2025-01-21 06:33:58'),('01JJ3YM7N7VDJ7SQ1WCTJFFMSY','123',123,'01JJ3YM7GCHTY2T54KH4309RFS.jpg','2025-01-21 08:10:55','2025-01-21 08:10:55'),('01JJ3YMQEGHSFGT446C0JW5A9Z','123',123,'01JJ3YMQ9HMHGGZSTP7YK7BRYF.png','2025-01-21 08:11:11','2025-01-21 08:11:11');
/*!40000 ALTER TABLE `careers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES ('01JFH3E1C78VVFRHMRSXGHXFJA','01JFH3E1C78VVFRHMRSXGHXFJB','TOP SONORA SELLER','2020-12-10','credentials1.jpg','2024-12-20 03:57:56','2024-12-20 03:57:56'),('01JFH3E1C78VVFRHMRSXGHXFJC','01JFH3E1C78VVFRHMRSXGHXFJD','TOP SELLER','2021-03-08','credentials2.jpg','2024-12-20 03:57:56','2024-12-20 03:57:56'),('01JFH3E1C78VVFRHMRSXGHXFJE','01JFH3E1C78VVFRHMRSXGHXFJF','TOP 1 PERFORMER OF TEAM IKIGAI','2021-12-16','credentials3.jpg','2024-12-20 03:57:56','2024-12-20 03:57:56'),('01JFH3E1C78VVFRHMRSXGHXFJG','01JFH3E1C78VVFRHMRSXGHXFJH','TOP PERFORMER FOR THE MONTH OF NOVEMBER 2023','2023-12-02','credentials4.jpg','2024-12-20 03:57:56','2024-12-20 03:57:56'),('01JFH63QTY51PW7N3QEM3FN1KR','01JFH63QTY51PW7N3QEM3FN1KS','TOP SONORA SELLER','2020-12-10','credentials1.jpg','2024-12-20 04:44:45','2024-12-20 04:44:45'),('01JFH63QTY51PW7N3QEM3FN1KT','01JFH63QTY51PW7N3QEM3FN1KV','TOP SELLER','2021-03-08','credentials2.jpg','2024-12-20 04:44:45','2024-12-20 04:44:45'),('01JFH63QTY51PW7N3QEM3FN1KW','01JFH63QTY51PW7N3QEM3FN1KX','TOP 1 PERFORMER OF TEAM IKIGAI','2021-12-16','credentials3.jpg','2024-12-20 04:44:45','2024-12-20 04:44:45'),('01JFH63QTY51PW7N3QEM3FN1KY','01JFH63QTY51PW7N3QEM3FN1KZ','TOP PERFORMER FOR THE MONTH OF NOVEMBER 2023','2023-12-02','credentials4.jpg','2024-12-20 04:44:45','2024-12-20 04:44:45');
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `closed_deals`
--

DROP TABLE IF EXISTS `closed_deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `closed_deals` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `closed_deals`
--

LOCK TABLES `closed_deals` WRITE;
/*!40000 ALTER TABLE `closed_deals` DISABLE KEYS */;
/*!40000 ALTER TABLE `closed_deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructures`
--

DROP TABLE IF EXISTS `infrastructures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `infrastructures` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` decimal(50,2) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructures`
--

LOCK TABLES `infrastructures` WRITE;
/*!40000 ALTER TABLE `infrastructures` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES ('01JJ5Z1GE02MGRZSVH9N6MVEVW',NULL,'Giolo','Evora','giolo.evora@gmail.com','09163918132','Property Viewing',NULL,'Is this unit available','2025-01-22 02:56:38','2025-01-22 02:56:38'),('01JJ5ZBX3SYZWA46QJTA9FFNBV',NULL,'Giolo','Evora','giolo.evora@gmail.com','09163918132','Property Viewing',NULL,'this is a test message','2025-01-22 03:02:19','2025-01-22 03:02:19'),('01JJ6F5JEV3H33H9TA0M17WPQR',NULL,'Giolo','Evora','giolo.evora@gmail.com','09163918132','Sales Inquiry',NULL,'This is a testing inquiry.','2025-01-22 07:38:29','2025-01-22 07:38:29'),('01JJ6FBAB6M52FZ1SRGKP88SGA',NULL,'Giolo','Evora','giolo.evora@gmail.com','09163918132','Property Viewing',NULL,'This is a testing inquiry','2025-01-22 07:41:37','2025-01-22 07:41:37');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agenda` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (94,'2014_10_12_000000_create_users_table',1),(95,'2014_10_12_100000_create_password_reset_tokens_table',1),(96,'2019_08_19_000000_create_failed_jobs_table',1),(97,'2019_12_14_000001_create_personal_access_tokens_table',1),(99,'2024_12_18_053631_create_certificates_table',1),(103,'2024_12_19_075313_create_partners_table',1),(106,'2024_12_18_032112_create_properties_table',2),(119,'2024_12_18_080837_create_submissions_table',11),(121,'2025_01_21_021835_create_amenities_table',13),(122,'2025_01_21_031403_create_careers_table',14),(123,'2025_01_21_033654_create_applications_table',15),(124,'2024_12_18_063800_create_schedules_table',16),(126,'2025_01_21_055350_create_services_table',18),(127,'2025_01_06_040045_create_closed_deals_table',19),(128,'2025_01_06_034406_create_events_table',20),(129,'2025_01_06_032722_create_meetings_table',21),(130,'2025_01_06_041915_create_news_table',22),(131,'2025_01_06_020506_create_seminars_table',23),(132,'2024_12_18_074120_create_testimonials_table',24),(133,'2025_01_21_065938_create_tips_table',25),(134,'2025_01_21_071418_create_infrastructures_table',26),(135,'2025_01_20_012554_create_inquiries_table',27),(137,'2025_01_22_025451_create_articles_table',28),(138,'2024_12_19_082519_create_items_table',29),(139,'2025_01_20_070258_create_property_submissions_table',30);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES ('01JFH4EDQ509H7D4XPJBD6RREN','BPI','01JJ3WG3XEYQ2ZBWVKQCV83MC4.png','2024-12-20 04:15:38','2025-01-21 07:33:43');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (16,'01JFH4D8EYAJ31286QT4R0BDPP','App\\Models\\User','Name-AuthToken','c68c05abe30f7054bfb6da9dee793b34965108f68b5bc5c48334927d80311aa1','[\"*\"]',NULL,NULL,'2024-12-20 09:43:19','2024-12-20 09:43:19'),(17,'01JFHP97Q7X1023PK7Y7ATXX41','App\\Models\\User','Gabriel Mercado-AuthToken','18017c588080f54111187d16ad8666fa85e7a7e162e03a252e9be5884eb93c2b','[\"*\"]',NULL,NULL,'2024-12-20 09:58:35','2024-12-20 09:58:35'),(18,'01JGWG733J600MKNEHR97C86N0','App\\Models\\User','Name-AuthToken','7b4da6f3b324267c22c63954ecd0d594bb346c75dfc0327c6e07abb8fa0ad374','[\"*\"]','2025-01-06 00:35:03',NULL,'2025-01-06 00:28:53','2025-01-06 00:35:03'),(19,'01JGWGNVTVHXDAAXAYJSXR8ZKF','App\\Models\\User','Name-AuthToken','8d559dd484e0242fac8200f8192d0469413409e1f298b30ca62cbf1b4f7a8c34','[\"*\"]','2025-01-06 00:37:25',NULL,'2025-01-06 00:36:52','2025-01-06 00:37:25'),(65,'01JGWH459K5PCTSCSBFN3EC0SS','App\\Models\\User','Name-AuthToken','0808e3c0ea9a571bbebba9c97597b1c8f41f405d95b0841bcd941f4bdd57f169','[\"*\"]',NULL,NULL,'2025-01-21 06:46:08','2025-01-21 06:46:08');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(50,2) DEFAULT NULL,
  `area` int DEFAULT NULL,
  `parking` tinyint(1) DEFAULT NULL,
  `vacant` tinyint(1) DEFAULT NULL,
  `nearby` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_furnish` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL,
  `amenities` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES ('01JFHT4X9VR3E2Z0DTQBZHJS88','01JFHP97Q7X1023PK7Y7ATXX41','Penhurst Park Place','Condominium','Penhurst Park Place, Taguig, 1630 Metro Manila',95000.00,93,0,1,'Marcielo Villas','Located in the quiet area of Fort Bonifacio Global City, on 1st Avenue, Penhurst Parkplace was developed by G&W Architects. It is composed by 24 residential floors with basement parking and a low density of 8 units per floor, composed by only 2 and 3 bedrooms apartments.','For Lease','NEW','RFO','5E','3BR','Fully Furnished','10','[\"penhurst.jpg\"]','[\"[Fitness Gym, Children\'s Playground]\"]','2024-12-20 10:34:55','2025-01-15 01:51:09'),('01JFHTCJ93Y8D2RZ7KB7WRN3VB','01JFHP97Q7X1023PK7Y7ATXX41','Tivoli Garden Iris','Condominium','Iris Tower, Tivoli Garden Residences, Iris Tower, 69 Coronado, St, Mandaluyong, 1550 Metro Manila',28000.00,59,0,1,'Brio Tower','Come home to lush Asian Tropical gardens and patios set amidst the sky. Located on 2.7 hectares of land near the Makati-Mandaluyong Bridge, these high-rise condominiums offer a serene retreat amidst the bustling metropolis.','For Lease','NEW','RFO','3004','2BR','Fully Furnished','7','[\"tivoli.jpg\"]','[\"[Fitness Gym, Children\'s Playground]\"]','2024-12-20 10:39:06','2025-01-15 01:56:23'),('01JFHTMH81WP3YNX0QSBY130GA','01JFHP97Q7X1023PK7Y7ATXX41','Madison Park West','Condominium','Madison Park West, 7th Avenue corner 36th and 38th Streets North Bonifacio District, Taguig, 1637 Metro Manila',60000.00,60,0,1,'MC Home Depot','Madison Park West at Grand Central Park is inspired by the stunning architecture, grand lobbies and sublime designs of the Grand Hyatt.  Souring above Fort Bonifacio, your luxury address is an exemplar of modern architecture.','For Lease','HOT','RFO','16E','2BR','Fully Furnished','16','[\"madison.jpg\"]','[\"[Hall, Children\'s Playground]\"]','2024-12-20 10:43:27','2025-01-15 01:59:53'),('01JFHV1D5X3PZDWRYD2XQG007R','01JFHP97Q7X1023PK7Y7ATXX41','PMR Celeste','Condominium','Pasig Boulevard, Brgy. Bagong Ilog',21000.00,32,0,1,'Allegra Garden Place','Experience complete access to the CBDs of BGC and Ortigas while enjoying the different shades of nature. Revel in the overall convenience of a home that reflects the spectrum of quality, craftsmanship and competence. Begin to see life in a more colorful perspective with Prisma Residences, DMCI Homes\' latest development in Pasig City','For Lease','HOT','RFO','3410','1BR','Fully Furnished','6','[\"pmr.jpg\"]','[\"[Children\'s Playground, Fitness Gym]\"]','2024-12-20 10:50:28','2025-01-15 02:03:02'),('01JHSBJGDFMMXZ636QAB8R6QZ3','01JFHP97Q7X1023PK7Y7ATXX41','Sheridan','Condo','Pasig Boulevard, Brgy. Bagong Ilog',21000.00,32,1,1,'Nearby','Description','For Lease','Badge','Status','3410','1BR','FF','30','[\"01JHSBJG2YJCV29JKCYYNVKHF8.jpg\"]','[\"[test, test2]\"]','2025-01-17 05:25:31','2025-01-17 05:25:31');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_submissions`
--

DROP TABLE IF EXISTS `property_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_submissions` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_last` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_first` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_unit_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_price` decimal(50,2) DEFAULT NULL,
  `property_area` decimal(50,2) DEFAULT NULL,
  `property_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_parking` tinyint(1) DEFAULT NULL,
  `property_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_rent_terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_sale_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_sale_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_sale_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_sale_turnover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_description` text COLLATE utf8mb4_unicode_ci,
  `property_amenities` json DEFAULT NULL,
  `images` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_submissions`
--

LOCK TABLES `property_submissions` WRITE;
/*!40000 ALTER TABLE `property_submissions` DISABLE KEYS */;
INSERT INTO `property_submissions` VALUES ('01JJ6F7Y6JF23QDRF787N3862Q','Evora','Giolo','giolo.evora@gmail.com','9163918132','Agent','Sonora Garden Residences','1BR','Bare',9090909.00,878.00,'2',0,'For Rent','6 Months',NULL,NULL,NULL,NULL,NULL,'[\"Pool Area\", \"Guest Suite\"]',NULL,'2025-01-22 07:39:46','2025-01-22 07:39:46');
/*!40000 ALTER TABLE `property_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES ('01JJ62NR84DG6707E7G74X53YM','01JFHP97Q7X1023PK7Y7ATXX41','Giolo','Evora','giolo.evora@gmail.com','09163918132','2025-01-22','12:03:00','1BR','PMR Celeste','this is a test message','Pending','2025-01-22 04:00:07','2025-01-22 04:00:07'),('01JJ6FD080K1YQYMFY8K945G6Z','01JFHP97Q7X1023PK7Y7ATXX41','Giolo','Evora','giolo.evora@gmail.com','09163918132','2025-01-22','15:46:00','1BR','Sheridan','This is a Testing inquiry','Pending','2025-01-22 07:42:32','2025-01-22 07:42:32');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seminars`
--

DROP TABLE IF EXISTS `seminars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seminars` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seminars`
--

LOCK TABLES `seminars` WRITE;
/*!40000 ALTER TABLE `seminars` DISABLE KEYS */;
/*!40000 ALTER TABLE `seminars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submissions` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(50,2) NOT NULL,
  `area` int NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `vacant` tinyint(1) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submit_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_furnish` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` tinyint(1) NOT NULL,
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turnover` date DEFAULT NULL,
  `lease` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenities` json NOT NULL,
  `images` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES ('01JJ16E3643MY0RCP1J0KSB8Y7',NULL,'Sonora','Residencessfsfs','9163918132','giolo.evora@gmail.com','null','Owner','Alabang-Zapote Road, Talon Tres, Las Pinas',9090909.00,878,0,NULL,'null','null','null','null','null',NULL,'Studio Type','Semi-Furnished',NULL,NULL,1,NULL,NULL,NULL,NULL,'[]','[]','2025-01-20 06:29:39','2025-01-20 06:29:39'),('01JJ16XRM7Y27FWNSXK102QRVG',NULL,'Giolo','Evora','9163918132','giolo.evora@gmail.com','Sonora Garden Residences','Agent','Alabang-Zapote Road, Talon Tres, Las Pinas',9090909.00,878,1,NULL,'null','null','null','null','null',NULL,'1BR','Bare',NULL,NULL,1,NULL,NULL,NULL,NULL,'[]','[]','2025-01-20 06:38:12','2025-01-20 06:38:12'),('01JJ1752ZA8C92PPT4QYA5VST3',NULL,'Giolo','Evora','9163918132','giolo.evora@gmail.com','Sonora Garden Residences','Agent','Alabang-Zapote Road, Talon Tres, Las Pinas',9090909.00,878,0,NULL,'null','null','null','null','null',NULL,'1BR','Semi-Furnished','2',NULL,1,NULL,NULL,NULL,NULL,'[]','[]','2025-01-20 06:42:12','2025-01-20 06:42:12'),('01JJ177KN92EKQ7T30CGJYMF00',NULL,'Giolo','Evora','9163918132','giolo.evora@gmail.com','Sonora Garden Residences','Owner','Alabang-Zapote Road, Talon Tres, Las Pinas',9090909.00,878,0,NULL,'null','null','null','null','null',NULL,'Studio Type','Semi-Furnished','2',NULL,1,NULL,NULL,NULL,'6 Months','[]','[]','2025-01-20 06:43:35','2025-01-20 06:43:35');
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES ('01JJ3T3EC69KF930RRHA03BPZF','01JGWH459K5PCTSCSBFN3EC0SS','123123123123','31231233123','1231231231231','2025-01-21 06:51:50','2025-01-21 06:54:34');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tips` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tips`
--

LOCK TABLES `tips` WRITE;
/*!40000 ALTER TABLE `tips` DISABLE KEYS */;
/*!40000 ALTER TABLE `tips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('01JFH71EQY68YX8KSA0R1E450Y','Kimberly Nineria','infinitech.kimberly@gmail.com','$2y$12$7ClvDmTjuwzBBC1KJCWyhuwxsYw9lUiP0eb3.iCzSSUTAmesAQGTK','Admin',NULL,NULL,'2024-12-20 05:00:59','2024-12-20 05:00:59','tunepogi'),('01JFH75G82SEEVPZJB8ZVG6725','Lyca Mae Nobleza','infinitech.lycanobleza@gmail.com','$2y$12$Ou8CkqcnQasbnHv2kZzP9eF31Q6NxhsN2f2N1ZpNbB/Iu9VYrb2m6','Agent',NULL,NULL,'2024-12-20 05:03:11','2024-12-20 05:03:11','mathpogi'),('01JFHP97Q7X1023PK7Y7ATXX41','Gabriel Mercado','gabmercado@gmail.com','$2y$12$ncHKmb7zE4zbMo5r.s955O3B1JAkP5ENJTQjsUsXqzJNYKFE3fRyW','Agent',NULL,NULL,'2024-12-20 09:27:22','2024-12-20 09:27:22','fortunematthewpogi'),('01JGWH459K5PCTSCSBFN3EC0SS','Name','email@gmail.com','$2y$12$QcfWZDsW.bbhDJ9JTFEIZOoVm4uxIPSn1/fS8xEZYoaMaE9t8rn7W','Admin',NULL,NULL,'2025-01-06 00:44:33','2025-01-06 00:44:33','hesoyam'),('01JJ8BV4GJXPF64PB20H0AAEH7','Jayvee Valeriano','jayvee@gmail.com','$2y$12$oiTIxolOm3gTbdat7B8lR.ooF0c0eO3i4rarNEkEA8YmGyJrG/XEm','Agent',NULL,NULL,'2025-01-23 01:18:50','2025-01-23 01:18:50','ABCCR4Ixdo9oQowZ');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-23  9:28:31
