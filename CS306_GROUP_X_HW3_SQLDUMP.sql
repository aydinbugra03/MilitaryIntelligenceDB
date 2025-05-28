-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: military_intelligence
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `agent_activity_log`
--

DROP TABLE IF EXISTS `agent_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agent_activity_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `agent_id` int DEFAULT NULL,
  `old_rank` varchar(50) DEFAULT NULL,
  `new_rank` varchar(50) DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL,
  `activity_type` varchar(50) DEFAULT NULL,
  `activity_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_activity_log`
--

LOCK TABLES `agent_activity_log` WRITE;
/*!40000 ALTER TABLE `agent_activity_log` DISABLE KEYS */;
INSERT INTO `agent_activity_log` VALUES (1,1,'','','2025-05-28 03:06:29','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(2,2,'','','2025-05-28 03:06:31','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(3,3,'','','2025-05-28 03:06:32','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(4,2,'','','2025-05-28 03:06:51','REPORT_CREATED','Agent created intelligence report: Field Activity Report - Agent 2'),(5,3,'','','2025-05-28 03:06:52','REPORT_CREATED','Agent created intelligence report: Post-Promotion Activity Report'),(6,1,'','','2025-05-28 03:12:38','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(7,6,'','','2025-05-28 03:17:51','REPORT_CREATED','Agent created intelligence report: 752'),(8,1,'','','2025-05-28 03:18:03','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(9,2,'','','2025-05-28 03:18:11','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(10,3,'','','2025-05-28 03:18:17','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(11,1,'','','2025-05-28 03:52:52','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(12,2,'','','2025-05-28 03:52:53','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(13,3,'','','2025-05-28 03:52:54','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(14,1,'','','2025-05-28 03:52:58','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(15,1,'','','2025-05-28 03:52:58','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(16,1,'','','2025-05-28 03:52:59','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(17,2,'','','2025-05-28 03:56:02','REPORT_CREATED','Agent created intelligence report: Field Activity Report - Agent 2'),(18,3,'','','2025-05-28 03:56:11','REPORT_CREATED','Agent created intelligence report: Post-Promotion Activity Report'),(19,1,'','','2025-05-28 04:18:39','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(20,2,'','','2025-05-28 04:18:46','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(21,3,'','','2025-05-28 04:18:49','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(22,2,'','','2025-05-28 04:19:20','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(23,3,'','','2025-05-28 04:19:21','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(24,2,'','','2025-05-28 04:29:47','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(25,2,'','','2025-05-28 04:29:50','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(26,3,'','','2025-05-28 04:29:50','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(27,1,'','','2025-05-28 11:59:49','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(28,2,'','','2025-05-28 11:59:50','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(29,3,'','','2025-05-28 11:59:50','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(30,2,'','','2025-05-28 12:00:06','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(31,3,'','','2025-05-28 12:00:09','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(32,1,'','','2025-05-28 12:37:34','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(33,2,'','','2025-05-28 12:37:34','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(34,3,'','','2025-05-28 12:37:35','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(35,2,'','','2025-05-28 12:37:55','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(36,3,'','','2025-05-28 12:37:55','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(37,1,'','','2025-05-28 12:58:04','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(38,2,'','','2025-05-28 12:58:05','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(39,3,'','','2025-05-28 12:58:05','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(40,2,'','','2025-05-28 12:58:19','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(41,3,'','','2025-05-28 12:58:19','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(42,10,'','','2025-05-28 13:04:07','REPORT_CREATED','Agent created intelligence report: er'),(43,1,'','','2025-05-28 13:19:52','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(44,2,'','','2025-05-28 13:19:59','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(45,3,'','','2025-05-28 13:20:02','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(46,2,'','','2025-05-28 13:21:46','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(47,3,'','','2025-05-28 13:21:49','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(48,1,'','','2025-05-28 13:23:46','REPORT_CREATED','Agent created intelligence report: rt'),(49,1,'','','2025-05-28 13:45:37','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(50,2,'','','2025-05-28 13:45:37','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(51,3,'','','2025-05-28 13:45:38','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(52,2,'','','2025-05-28 13:45:56','REPORT_CREATED','Agent created intelligence report: we'),(53,2,'','','2025-05-28 13:49:04','REPORT_CREATED','Agent created intelligence report: sr'),(54,2,'','','2025-05-28 13:50:20','REPORT_CREATED','Agent created intelligence report: sr'),(55,3,'','','2025-05-28 13:51:01','REPORT_CREATED','Agent created intelligence report: treew'),(56,4,'','','2025-05-28 13:51:13','REPORT_CREATED','Agent created intelligence report: ww'),(57,4,'','','2025-05-28 13:53:45','REPORT_CREATED','Agent created intelligence report: ww'),(58,4,'','','2025-05-28 13:53:48','REPORT_CREATED','Agent created intelligence report: ww'),(59,4,'','','2025-05-28 13:53:49','REPORT_CREATED','Agent created intelligence report: ww'),(60,4,'','','2025-05-28 13:53:49','REPORT_CREATED','Agent created intelligence report: ww'),(61,4,'','','2025-05-28 13:55:14','REPORT_CREATED','Agent created intelligence report: ww'),(62,6,'','','2025-05-28 13:55:30','REPORT_CREATED','Agent created intelligence report: wqq'),(63,6,'','','2025-05-28 13:58:58','REPORT_CREATED','Agent created intelligence report: AAA'),(64,6,'','','2025-05-28 14:00:24','REPORT_CREATED','Agent created intelligence report: EE'),(65,1,'','','2025-05-28 15:06:42','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(66,2,'','','2025-05-28 15:06:45','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(67,3,'','','2025-05-28 15:06:47','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(68,2,'','','2025-05-28 15:07:21','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(69,3,'','','2025-05-28 15:07:23','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(70,3,'','','2025-05-28 15:08:51','REPORT_CREATED','Agent created intelligence report: trt'),(71,1,'','','2025-05-28 15:34:33','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(72,2,'','','2025-05-28 15:34:33','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(73,3,'','','2025-05-28 15:34:33','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(74,1,'','','2025-05-28 15:35:06','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(75,2,'','','2025-05-28 15:35:06','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(76,3,'','','2025-05-28 15:35:07','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(77,2,'','','2025-05-28 15:35:22','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(78,3,'','','2025-05-28 15:35:22','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report'),(79,1,'','','2025-05-28 15:35:55','REPORT_CREATED','Agent created intelligence report: Operation Phoenix - Top Secret'),(80,2,'','','2025-05-28 15:35:55','REPORT_CREATED','Agent created intelligence report: Routine Patrol Report - Classified'),(81,3,'','','2025-05-28 15:35:55','REPORT_CREATED','Agent created intelligence report: Public Information Bulletin'),(82,2,'','','2025-05-28 15:36:01','REPORT_CREATED','Agent created intelligence report: Field Activity Report'),(83,3,'','','2025-05-28 15:36:02','REPORT_CREATED','Agent created intelligence report: Post-Promotion Report');
/*!40000 ALTER TABLE `agent_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_wrote_report`
--

DROP TABLE IF EXISTS `agent_wrote_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agent_wrote_report` (
  `agent_id` int NOT NULL,
  `report_id` int NOT NULL,
  PRIMARY KEY (`agent_id`,`report_id`),
  KEY `report_id` (`report_id`),
  CONSTRAINT `agent_wrote_report_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`),
  CONSTRAINT `agent_wrote_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_wrote_report`
--

LOCK TABLES `agent_wrote_report` WRITE;
/*!40000 ALTER TABLE `agent_wrote_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `agent_wrote_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `agent_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `rank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (1,'John Gray','Captain'),(2,'Sarah Black','Lieutenant'),(3,'Derek White','Major'),(4,'Lucy Green','Captain'),(5,'Mia Brown','Sergeant'),(6,'James Fox','Corporal'),(7,'Nina Red','Chief Officer'),(8,'Omar Blue','Lieutenant'),(9,'Iris Golden','Sergeant'),(10,'Ethan Silver','Major');
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `base`
--

DROP TABLE IF EXISTS `base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `base` (
  `base_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int DEFAULT NULL,
  `country_id` int NOT NULL,
  PRIMARY KEY (`base_id`),
  KEY `country_id` (`country_id`),
  CONSTRAINT `base_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `base`
--

LOCK TABLES `base` WRITE;
/*!40000 ALTER TABLE `base` DISABLE KEYS */;
INSERT INTO `base` VALUES (1,'Fort Eagle',500,1),(2,'Camp Iron',350,2),(3,'Station Echo',600,3),(4,'Forward Ops Delta',400,4),(5,'Redwood Garrison',300,5),(6,'Desert Storm Post',200,6),(7,'Skywatch Base',800,7),(8,'Oceanic Outpost',250,8),(9,'Ziggurat HQ',750,9),(10,'Polar Command',1000,10);
/*!40000 ALTER TABLE `base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `base_stores_supply`
--

DROP TABLE IF EXISTS `base_stores_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `base_stores_supply` (
  `base_id` int NOT NULL,
  `supply_id` int NOT NULL,
  PRIMARY KEY (`base_id`,`supply_id`),
  KEY `supply_id` (`supply_id`),
  CONSTRAINT `base_stores_supply_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`),
  CONSTRAINT `base_stores_supply_ibfk_2` FOREIGN KEY (`supply_id`) REFERENCES `supply` (`supply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `base_stores_supply`
--

LOCK TABLES `base_stores_supply` WRITE;
/*!40000 ALTER TABLE `base_stores_supply` DISABLE KEYS */;
INSERT INTO `base_stores_supply` VALUES (2,1),(3,2),(1,3),(4,4),(6,5),(7,6),(8,7),(5,8),(9,9),(10,10);
/*!40000 ALTER TABLE `base_stores_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `civil`
--

DROP TABLE IF EXISTS `civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `civil` (
  `person_id` int NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  CONSTRAINT `civil_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `civil`
--

LOCK TABLES `civil` WRITE;
/*!40000 ALTER TABLE `civil` DISABLE KEYS */;
INSERT INTO `civil` VALUES (6,'Logistics','Accountant'),(7,'HR','Recruiter'),(8,'IT','Technician'),(9,'Maintenance','Supervisor'),(10,'Transport','Driver');
/*!40000 ALTER TABLE `civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `country_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `political_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Atlantis','North Sea','Stable Democracy'),(2,'Azura','South Sea','Monarchy'),(3,'Rivia','Eastern Continent','Federation'),(4,'Arcadia','Western Isles','Republic'),(5,'Novia','Northern Mainland','Confederation'),(6,'Eldora','Eastern Mainland','Kingdom'),(7,'Valoria','Valley Region','Stable Democracy'),(8,'Terranova','Island Frontier','Republic'),(9,'Sandora','Desert Region','Autocracy'),(10,'Polaris','Polar Region','Stable Democracy');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drone_attack_log`
--

DROP TABLE IF EXISTS `drone_attack_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drone_attack_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `drone_id` int NOT NULL,
  `target_id` int NOT NULL,
  `attack_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `drone_id` (`drone_id`),
  KEY `target_id` (`target_id`),
  CONSTRAINT `drone_attack_log_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
  CONSTRAINT `drone_attack_log_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drone_attack_log`
--

LOCK TABLES `drone_attack_log` WRITE;
/*!40000 ALTER TABLE `drone_attack_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `drone_attack_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drone_missile_usage`
--

DROP TABLE IF EXISTS `drone_missile_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drone_missile_usage` (
  `drone_id` int NOT NULL,
  `missile_id` int NOT NULL,
  PRIMARY KEY (`drone_id`,`missile_id`),
  KEY `missile_id` (`missile_id`),
  CONSTRAINT `drone_missile_usage_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
  CONSTRAINT `drone_missile_usage_ibfk_2` FOREIGN KEY (`missile_id`) REFERENCES `missiles` (`missile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drone_missile_usage`
--

LOCK TABLES `drone_missile_usage` WRITE;
/*!40000 ALTER TABLE `drone_missile_usage` DISABLE KEYS */;
INSERT INTO `drone_missile_usage` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `drone_missile_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drone_target_attacks`
--

DROP TABLE IF EXISTS `drone_target_attacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drone_target_attacks` (
  `drone_id` int NOT NULL,
  `target_id` int NOT NULL,
  PRIMARY KEY (`drone_id`,`target_id`),
  KEY `target_id` (`target_id`),
  CONSTRAINT `drone_target_attacks_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
  CONSTRAINT `drone_target_attacks_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drone_target_attacks`
--

LOCK TABLES `drone_target_attacks` WRITE;
/*!40000 ALTER TABLE `drone_target_attacks` DISABLE KEYS */;
INSERT INTO `drone_target_attacks` VALUES (1,1),(7,2),(8,3),(2,4),(9,5),(10,6),(3,7),(5,8),(6,9),(4,10);
/*!40000 ALTER TABLE `drone_target_attacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drones`
--

DROP TABLE IF EXISTS `drones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drones` (
  `drone_id` int NOT NULL,
  `range` int DEFAULT NULL,
  `max_altitude` int DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `op_id` int NOT NULL,
  PRIMARY KEY (`drone_id`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `drones_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operator` (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drones`
--

LOCK TABLES `drones` WRITE;
/*!40000 ALTER TABLE `drones` DISABLE KEYS */;
INSERT INTO `drones` VALUES (1,100,2000,'Raven-X',1),(2,120,2500,'Falcon-A',1),(3,150,3000,'Eagle-B',5),(4,180,4000,'Condor-P',8),(5,200,4500,'Vulture-Q',1),(6,220,4800,'Hawk-V',3),(7,250,5200,'Buzzard-H',7),(8,270,5500,'Kestrel-R',8),(9,300,6000,'Harrier-T',9),(10,350,6500,'Phoenix-Z',25);
/*!40000 ALTER TABLE `drones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dronestatus`
--

DROP TABLE IF EXISTS `dronestatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dronestatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `drone_id` int DEFAULT NULL,
  `old_operator_id` int DEFAULT NULL,
  `new_operator_id` int DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `status_message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dronestatus`
--

LOCK TABLES `dronestatus` WRITE;
/*!40000 ALTER TABLE `dronestatus` DISABLE KEYS */;
INSERT INTO `dronestatus` VALUES (1,1,2,1,'2025-05-28 04:18:25','Operator assignment changed from 2 to 1'),(2,1,1,2,'2025-05-28 04:18:26','Operator assignment changed from 1 to 2'),(3,1,2,1,'2025-05-28 04:18:29','Operator assignment changed from 2 to 1'),(4,1,1,2,'2025-05-28 04:18:30','Operator assignment changed from 1 to 2'),(5,1,2,1,'2025-05-28 04:18:35','Operator assignment changed from 2 to 1'),(6,10,1,25,'2025-05-28 04:24:09','Operator assignment changed from 1 to 25'),(7,1,1,2,'2025-05-28 04:30:09','Operator assignment changed from 1 to 2'),(8,1,2,1,'2025-05-28 04:30:12','Operator assignment changed from 2 to 1'),(9,1,1,2,'2025-05-28 04:30:13','Operator assignment changed from 1 to 2'),(10,1,2,1,'2025-05-28 04:51:58','Operator assignment changed from 2 to 1'),(11,1,1,2,'2025-05-28 04:51:59','Operator assignment changed from 1 to 2'),(12,1,2,1,'2025-05-28 04:53:50','Operator assignment changed from 2 to 1'),(13,1,1,2,'2025-05-28 04:53:51','Operator assignment changed from 1 to 2'),(14,1,2,1,'2025-05-28 11:59:46','Operator assignment changed from 2 to 1'),(15,1,1,2,'2025-05-28 11:59:47','Operator assignment changed from 1 to 2'),(16,1,2,1,'2025-05-28 12:30:15','Operator assignment changed from 2 to 1'),(17,1,1,2,'2025-05-28 12:30:16','Operator assignment changed from 1 to 2'),(18,1,2,1,'2025-05-28 12:34:03','Operator assignment changed from 2 to 1'),(19,1,1,2,'2025-05-28 12:34:04','Operator assignment changed from 1 to 2'),(20,1,2,1,'2025-05-28 12:37:12','Operator assignment changed from 2 to 1'),(21,1,1,2,'2025-05-28 12:37:12','Operator assignment changed from 1 to 2'),(22,1,2,1,'2025-05-28 12:37:13','Operator assignment changed from 2 to 1'),(23,1,1,2,'2025-05-28 12:37:14','Operator assignment changed from 1 to 2'),(24,1,2,1,'2025-05-28 12:37:16','Operator assignment changed from 2 to 1'),(25,1,1,2,'2025-05-28 12:37:17','Operator assignment changed from 1 to 2'),(26,2,3,12,'2025-05-28 12:54:35','Operator assignment changed from 3 to 12'),(27,1,2,1,'2025-05-28 12:57:53','Operator assignment changed from 2 to 1'),(28,1,1,2,'2025-05-28 12:57:56','Operator assignment changed from 1 to 2'),(29,2,12,3,'2025-05-28 12:57:59','Operator assignment changed from 12 to 3'),(30,1,2,1,'2025-05-28 13:12:22','Operator assignment changed from 2 to 1'),(31,1,1,2,'2025-05-28 13:12:23','Operator assignment changed from 1 to 2'),(32,1,2,1,'2025-05-28 13:12:27','Operator assignment changed from 2 to 1'),(33,1,1,2,'2025-05-28 13:19:23','Operator assignment changed from 1 to 2'),(34,1,2,1,'2025-05-28 13:19:37','Operator assignment changed from 2 to 1'),(35,1,1,2,'2025-05-28 13:19:41','Operator assignment changed from 1 to 2'),(36,1,2,1,'2025-05-28 13:22:35','Operator assignment changed from 2 to 1'),(37,2,3,2,'2025-05-28 13:26:03','Operator assignment changed from 3 to 2'),(38,2,2,5,'2025-05-28 13:26:12','Operator assignment changed from 2 to 5'),(39,3,1,3,'2025-05-28 13:29:29','Operator assignment changed from 1 to 3'),(40,4,4,5,'2025-05-28 13:31:10','Operator assignment changed from 4 to 5'),(41,2,5,3,'2025-05-28 13:31:18','Operator assignment changed from 5 to 3'),(42,1,1,2,'2025-05-28 13:31:30','Operator assignment changed from 1 to 2'),(43,4,5,8,'2025-05-28 13:32:03','Operator assignment changed from 5 to 8'),(44,2,3,6,'2025-05-28 13:32:31','Operator assignment changed from 3 to 6'),(45,2,6,20,'2025-05-28 13:32:40','Operator assignment changed from 6 to 20'),(46,5,1,20,'2025-05-28 13:33:15','Operator assignment changed from 1 to 20'),(47,1,2,5,'2025-05-28 13:35:21','Operator assignment changed from 2 to 5'),(48,2,20,5,'2025-05-28 13:35:26','Operator assignment changed from 20 to 5'),(49,5,20,1,'2025-05-28 13:37:31','Operator assignment changed from 20 to 1'),(50,3,3,1,'2025-05-28 13:37:39','Operator assignment changed from 3 to 1'),(51,3,1,3,'2025-05-28 13:37:50','Operator assignment changed from 1 to 3'),(52,6,1,5,'2025-05-28 13:40:31','Operator assignment changed from 1 to 5'),(53,1,5,1,'2025-05-28 13:43:43','Operator assignment changed from 5 to 1'),(54,6,5,3,'2025-05-28 14:10:02','Operator assignment changed from 5 to 3'),(55,1,1,2,'2025-05-28 15:06:33','Operator assignment changed from 1 to 2'),(56,2,5,3,'2025-05-28 15:06:36','Operator assignment changed from 5 to 3'),(57,2,3,10000,'2025-05-28 15:07:38','Operator assignment changed from 3 to 10000'),(58,3,3,5,'2025-05-28 15:07:49','Operator assignment changed from 3 to 5'),(59,2,10000,5,'2025-05-28 15:07:53','Operator assignment changed from 10000 to 5'),(60,1,2,1,'2025-05-28 15:30:58','Operator assignment changed from 2 to 1'),(61,1,1,2,'2025-05-28 15:30:59','Operator assignment changed from 1 to 2'),(62,2,5,3,'2025-05-28 15:30:59','Operator assignment changed from 5 to 3'),(63,1,2,1,'2025-05-28 15:34:27','Operator assignment changed from 2 to 1'),(64,1,1,2,'2025-05-28 15:34:28','Operator assignment changed from 1 to 2'),(65,1,2,1,'2025-05-28 15:35:03','Operator assignment changed from 2 to 1'),(66,1,1,2,'2025-05-28 15:35:03','Operator assignment changed from 1 to 2'),(67,1,2,1,'2025-05-28 15:35:42','Operator assignment changed from 2 to 1'),(68,1,1,2,'2025-05-28 15:35:43','Operator assignment changed from 1 to 2'),(69,1,2,1,'2025-05-28 15:35:51','Operator assignment changed from 2 to 1'),(70,2,3,1,'2025-05-28 15:36:52','Operator assignment changed from 3 to 1');
/*!40000 ALTER TABLE `dronestatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intelligence_report_decides_target`
--

DROP TABLE IF EXISTS `intelligence_report_decides_target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intelligence_report_decides_target` (
  `report_id` int NOT NULL,
  `target_id` int NOT NULL,
  PRIMARY KEY (`report_id`,`target_id`),
  KEY `target_id` (`target_id`),
  CONSTRAINT `intelligence_report_decides_target_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`),
  CONSTRAINT `intelligence_report_decides_target_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intelligence_report_decides_target`
--

LOCK TABLES `intelligence_report_decides_target` WRITE;
/*!40000 ALTER TABLE `intelligence_report_decides_target` DISABLE KEYS */;
INSERT INTO `intelligence_report_decides_target` VALUES (4,1),(5,2),(2,3),(8,4),(1,5),(1,6),(2,7),(6,8),(3,9),(7,10);
/*!40000 ALTER TABLE `intelligence_report_decides_target` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intelligence_reports`
--

DROP TABLE IF EXISTS `intelligence_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intelligence_reports` (
  `report_id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text,
  `date_created` datetime NOT NULL,
  `classification_level` varchar(50) DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  KEY `agent_id` (`agent_id`),
  CONSTRAINT `intelligence_reports_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intelligence_reports`
--

LOCK TABLES `intelligence_reports` WRITE;
/*!40000 ALTER TABLE `intelligence_reports` DISABLE KEYS */;
INSERT INTO `intelligence_reports` VALUES (1,'Scouting Operation','Arctic Recon','2025-01-01 00:00:00','Secret',1),(2,'Threat Analysis','Desert Intel','2025-01-02 00:00:00','Classified',2),(3,'Base Status','Camp Survey','2025-01-03 00:00:00','TopSecret',3),(4,'Forward Plans','Inshore Recon','2025-01-04 00:00:00','Secret',4),(5,'Unit Position','Air Patrol','2025-01-05 00:00:00','Classified',5),(6,'Alert Notice','Mountain Watch','2025-01-06 00:00:00','Secret',6),(7,'Rescue Mission','Night Ops','2025-01-07 00:00:00','TopSecret',7),(8,'Supply Drop','Outpost Refill','2025-01-08 00:00:00','Secret',8),(9,'Recon Summary','Base Threat','2025-01-09 00:00:00','TopSecret',9),(10,'Final Brief','Operation Dawn','2025-01-10 00:00:00','Classified',10),(11,'sadas','asdasd','2025-05-28 02:28:47','Unclassified',3),(12,'Taylan Baskan','gg','2025-05-28 02:29:31','Top Secret',10),(13,'Activity Log Report - Agent 1','Automated activity log entry for agent 1','2025-05-28 02:31:01','Unclassified',1),(14,'Buğra','gg','2025-05-28 02:34:35','Secret',3),(15,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 02:45:54','Top Secret',1),(16,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 02:45:58','Classified',2),(17,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 02:45:59','Unclassified',3),(18,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 02:48:06','Top Secret',1),(19,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 02:48:08','Classified',2),(20,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 02:48:10','Unclassified',3),(21,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 02:57:59','Top Secret',1),(22,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 02:58:01','Classified',2),(23,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 02:58:02','Unclassified',3),(24,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 02:58:07','Top Secret',1),(25,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:06:29','Top Secret',1),(26,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 03:06:31','Classified',2),(27,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 03:06:32','Unclassified',3),(28,'Field Activity Report - Agent 2','Routine field activity and intelligence gathering completed successfully.','2025-05-28 03:06:51','Confidential',2),(29,'Post-Promotion Activity Report','Initial report following recent promotion to Major rank.','2025-05-28 03:06:52','Secret',3),(30,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:12:38','Top Secret',1),(31,'752','2111','2025-05-28 03:17:51','Confidential',6),(32,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:18:03','Top Secret',1),(33,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 03:18:11','Classified',2),(34,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 03:18:17','Unclassified',3),(35,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:52:52','Top Secret',1),(36,'Routine Patrol Report - Classified','Standard patrol findings in designated area. No immediate threats detected. Regular surveillance data collected for analysis.','2025-05-28 03:52:53','Classified',2),(37,'Public Information Bulletin','General information update for public distribution. Weather conditions and basic operational status. No sensitive information included.','2025-05-28 03:52:54','Unclassified',3),(38,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:52:58','Top Secret',1),(39,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:52:58','Top Secret',1),(40,'Operation Phoenix - Top Secret','Classified military operation details. High-priority intelligence regarding enemy movements in sector 7. This information requires immediate attention from command.','2025-05-28 03:52:59','Top Secret',1),(41,'Field Activity Report - Agent 2','Routine field activity and intelligence gathering completed successfully.','2025-05-28 03:56:02','Confidential',2),(42,'Post-Promotion Activity Report','Initial report following recent promotion to Major rank.','2025-05-28 03:56:11','Secret',3),(43,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 04:18:39','Top Secret',1),(44,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 04:18:46','Classified',2),(45,'Public Information Bulletin','General information update.','2025-05-28 04:18:49','Unclassified',3),(46,'Field Activity Report','Routine field activity completed.','2025-05-28 04:19:20','Confidential',2),(47,'Post-Promotion Report','Report following promotion.','2025-05-28 04:19:21','Secret',3),(48,'Field Activity Report','Routine field activity completed.','2025-05-28 04:29:47','Confidential',2),(49,'Field Activity Report','Routine field activity completed.','2025-05-28 04:29:50','Confidential',2),(50,'Post-Promotion Report','Report following promotion.','2025-05-28 04:29:50','Secret',3),(51,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 11:59:49','Top Secret',1),(52,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 11:59:50','Classified',2),(53,'Public Information Bulletin','General information update.','2025-05-28 11:59:50','Unclassified',3),(54,'Field Activity Report','Routine field activity completed.','2025-05-28 12:00:06','Confidential',2),(55,'Post-Promotion Report','Report following promotion.','2025-05-28 12:00:09','Secret',3),(56,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 12:37:34','Top Secret',1),(57,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 12:37:34','Classified',2),(58,'Public Information Bulletin','General information update.','2025-05-28 12:37:35','Unclassified',3),(59,'Field Activity Report','Routine field activity completed.','2025-05-28 12:37:55','Confidential',2),(60,'Post-Promotion Report','Report following promotion.','2025-05-28 12:37:55','Secret',3),(61,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 12:58:04','Top Secret',1),(62,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 12:58:05','Classified',2),(63,'Public Information Bulletin','General information update.','2025-05-28 12:58:05','Unclassified',3),(64,'Field Activity Report','Routine field activity completed.','2025-05-28 12:58:19','Confidential',2),(65,'Post-Promotion Report','Report following promotion.','2025-05-28 12:58:19','Secret',3),(66,'er','top-secret','2025-05-28 13:04:07','ww',10),(67,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 13:19:52','Top Secret',1),(68,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 13:19:59','Classified',2),(69,'Public Information Bulletin','General information update.','2025-05-28 13:20:02','Unclassified',3),(70,'Field Activity Report','Routine field activity completed.','2025-05-28 13:21:46','Confidential',2),(71,'Post-Promotion Report','Report following promotion.','2025-05-28 13:21:49','Secret',3),(72,'rt','top-secret','2025-05-28 13:23:46','rtr',1),(73,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 13:45:37','Top Secret',1),(74,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 13:45:37','Classified',2),(75,'Public Information Bulletin','General information update.','2025-05-28 13:45:38','Unclassified',3),(76,'we','ee','2025-05-28 13:45:56','we',2),(77,'sr','Top Secret','2025-05-28 13:49:04','sd',2),(78,'sr','Top Secret','2025-05-28 13:50:20','sd',2),(79,'treew','Top Secret','2025-05-28 13:51:01','aaa',3),(80,'ww','Top Secret','2025-05-28 13:51:13','wwww',4),(81,'ww','Top Secret','2025-05-28 13:53:45','wwww',4),(82,'ww','Top Secret','2025-05-28 13:53:48','wwww',4),(83,'ww','Top Secret','2025-05-28 13:53:49','wwww',4),(84,'ww','Top Secret','2025-05-28 13:53:49','wwww',4),(85,'ww','Top Secret','2025-05-28 13:55:14','wwww',4),(86,'wqq','Top Secret','2025-05-28 13:55:30','wwww',6),(87,'AAA','Top Secret','2025-05-28 13:58:58','LLLL',6),(88,'EE','DD','2025-05-28 14:00:24','Top Secret',6),(89,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 15:06:42','Top Secret',1),(90,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 15:06:45','Classified',2),(91,'Public Information Bulletin','General information update.','2025-05-28 15:06:47','Unclassified',3),(92,'Field Activity Report','Routine field activity completed.','2025-05-28 15:07:21','Confidential',2),(93,'Post-Promotion Report','Report following promotion.','2025-05-28 15:07:23','Secret',3),(94,'trt','trtrt','2025-05-28 15:08:51','Top Secret',3),(95,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 15:34:33','Top Secret',1),(96,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 15:34:33','Classified',2),(97,'Public Information Bulletin','General information update.','2025-05-28 15:34:33','Unclassified',3),(98,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 15:35:06','Top Secret',1),(99,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 15:35:06','Classified',2),(100,'Public Information Bulletin','General information update.','2025-05-28 15:35:07','Unclassified',3),(101,'Field Activity Report','Routine field activity completed.','2025-05-28 15:35:22','Confidential',2),(102,'Post-Promotion Report','Report following promotion.','2025-05-28 15:35:22','Secret',3),(103,'Operation Phoenix - Top Secret','Classified military operation details.','2025-05-28 15:35:55','Top Secret',1),(104,'Routine Patrol Report - Classified','Standard patrol findings.','2025-05-28 15:35:55','Classified',2),(105,'Public Information Bulletin','General information update.','2025-05-28 15:35:55','Unclassified',3),(106,'Field Activity Report','Routine field activity completed.','2025-05-28 15:36:01','Confidential',2),(107,'Post-Promotion Report','Report following promotion.','2025-05-28 15:36:02','Secret',3);
/*!40000 ALTER TABLE `intelligence_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missiles`
--

DROP TABLE IF EXISTS `missiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missiles` (
  `missile_id` int NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `range` int DEFAULT NULL,
  PRIMARY KEY (`missile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missiles`
--

LOCK TABLES `missiles` WRITE;
/*!40000 ALTER TABLE `missiles` DISABLE KEYS */;
INSERT INTO `missiles` VALUES (1,'Air-to-Air',50),(2,'Air-to-Ground',60),(3,'Short-Range',70),(4,'Long-Range',80),(5,'Cruise',90),(6,'Tactical',110),(7,'Surface-to-Air',120),(8,'Anti-Ship',130),(9,'Interceptor',140),(10,'Ballistic',150);
/*!40000 ALTER TABLE `missiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operator` (
  `op_id` int NOT NULL,
  `rank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator`
--

LOCK TABLES `operator` WRITE;
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
INSERT INTO `operator` VALUES (1,NULL),(2,NULL),(3,NULL),(4,'Major'),(5,NULL),(6,NULL),(7,NULL),(8,NULL),(9,'Colonel'),(10,'Major'),(12,'Captain'),(20,NULL),(25,'tt'),(10000,NULL);
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `person` (
  `person_id` int NOT NULL,
  `base_id` int NOT NULL,
  PRIMARY KEY (`person_id`),
  KEY `base_id` (`base_id`),
  CONSTRAINT `person_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_update_log`
--

DROP TABLE IF EXISTS `report_update_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_update_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `report_id` int NOT NULL,
  `old_title` varchar(200) DEFAULT NULL,
  `new_title` varchar(200) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `report_id` (`report_id`),
  CONSTRAINT `report_update_log_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_update_log`
--

LOCK TABLES `report_update_log` WRITE;
/*!40000 ALTER TABLE `report_update_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_update_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satellite_target_watches`
--

DROP TABLE IF EXISTS `satellite_target_watches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `satellite_target_watches` (
  `satellite_id` int NOT NULL,
  `target_id` int NOT NULL,
  PRIMARY KEY (`satellite_id`,`target_id`),
  KEY `target_id` (`target_id`),
  CONSTRAINT `satellite_target_watches_ibfk_1` FOREIGN KEY (`satellite_id`) REFERENCES `satellites` (`satellite_id`),
  CONSTRAINT `satellite_target_watches_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satellite_target_watches`
--

LOCK TABLES `satellite_target_watches` WRITE;
/*!40000 ALTER TABLE `satellite_target_watches` DISABLE KEYS */;
INSERT INTO `satellite_target_watches` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `satellite_target_watches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satellites`
--

DROP TABLE IF EXISTS `satellites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `satellites` (
  `satellite_id` int NOT NULL,
  `operational_status` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`satellite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satellites`
--

LOCK TABLES `satellites` WRITE;
/*!40000 ALTER TABLE `satellites` DISABLE KEYS */;
INSERT INTO `satellites` VALUES (1,'Operational','HawkEye-1'),(2,'Standby','HawkEye-2'),(3,'Operational','StratoView'),(4,'Under Maintenance','CosmoTracker'),(5,'Operational','SkyNet-Alpha'),(6,'Standby','SkyNet-Beta'),(7,'Operational','GeoSat-7'),(8,'Under Maintenance','CloudWatcher'),(9,'Operational','Orbiter-9'),(10,'Operational','Zenith-X');
/*!40000 ALTER TABLE `satellites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soldier`
--

DROP TABLE IF EXISTS `soldier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `soldier` (
  `person_id` int NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `rank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  CONSTRAINT `soldier_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soldier`
--

LOCK TABLES `soldier` WRITE;
/*!40000 ALTER TABLE `soldier` DISABLE KEYS */;
INSERT INTO `soldier` VALUES (1,'Sniper Ops','Alpha Squad','Sergeant'),(2,'Medical','Bravo Squad','Lieutenant'),(3,'Infantry','Charlie Squad','Captain'),(4,'Engineer','Delta Squad','Sergeant'),(5,'Pilot','Echo Squad','Major');
/*!40000 ALTER TABLE `soldier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supply`
--

DROP TABLE IF EXISTS `supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supply` (
  `supply_id` int NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`supply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supply`
--

LOCK TABLES `supply` WRITE;
/*!40000 ALTER TABLE `supply` DISABLE KEYS */;
INSERT INTO `supply` VALUES (1,'Ammo Crates','Ammunition',25),(2,'Ration Packs','Food',200),(3,'Medical Kits','Medical',165),(4,'Fuel Barrels','Fuel',928),(5,'Spare Parts','Mechanic',220),(6,'Electronics','Electronic',150),(7,'Uniforms','Clothing',400),(8,'Water Tanks','Water',600),(9,'Satellite Parts','Components',50),(10,'Office Supplies','Stationery',100);
/*!40000 ALTER TABLE `supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supply_audit`
--

DROP TABLE IF EXISTS `supply_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supply_audit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supply_id` int NOT NULL,
  `old_quantity` int DEFAULT NULL,
  `new_quantity` int DEFAULT NULL,
  `audit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `audit_message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supply_audit`
--

LOCK TABLES `supply_audit` WRITE;
/*!40000 ALTER TABLE `supply_audit` DISABLE KEYS */;
INSERT INTO `supply_audit` VALUES (1,1,100,90,'2025-05-28 03:10:00','Test audit entry'),(2,1,500,150,'2025-05-28 03:44:18','Quantity changed from 500 to 150'),(3,1,150,25,'2025-05-28 03:44:27','Quantity changed from 150 to 25'),(4,1,150,25,'2025-05-28 03:44:27','LOW STOCK ALERT: Quantity below threshold!'),(5,1,25,500,'2025-05-28 03:44:28','Quantity changed from 25 to 500'),(6,1,500,150,'2025-05-28 03:44:34','Quantity changed from 500 to 150'),(7,1,150,25,'2025-05-28 03:55:40','Quantity changed from 150 to 25'),(8,1,150,25,'2025-05-28 03:55:40','LOW STOCK ALERT: Quantity below threshold!'),(9,1,25,4,'2025-05-28 03:58:41','Quantity changed from 25 to 4'),(10,1,25,4,'2025-05-28 03:58:41','LOW STOCK ALERT: Quantity below threshold!'),(11,1,4,150,'2025-05-28 03:58:58','Quantity changed from 4 to 150'),(12,1,150,25,'2025-05-28 03:59:04','Quantity changed from 150 to 25'),(13,1,150,25,'2025-05-28 03:59:04','LOW STOCK ALERT: Quantity below threshold!'),(14,1,25,2,'2025-05-28 04:03:00','Quantity changed from 25 to 2'),(15,1,25,2,'2025-05-28 04:03:00','LOW STOCK ALERT: Quantity below threshold!'),(16,2,300,285,'2025-05-28 04:04:45','Quantity changed from 300 to 285'),(17,2,285,270,'2025-05-28 04:04:48','Quantity changed from 285 to 270'),(18,1,2,150,'2025-05-28 04:19:10','Quantity changed from 2 to 150'),(19,1,150,25,'2025-05-28 04:19:12','Quantity changed from 150 to 25'),(20,1,150,25,'2025-05-28 04:19:12','LOW STOCK ALERT: Quantity below threshold!'),(21,2,270,200,'2025-05-28 04:19:13','Quantity changed from 270 to 200'),(22,1,25,150,'2025-05-28 11:59:57','Quantity changed from 25 to 150'),(23,1,150,25,'2025-05-28 11:59:58','Quantity changed from 150 to 25'),(24,1,150,25,'2025-05-28 11:59:58','LOW STOCK ALERT: Quantity below threshold!'),(25,1,25,150,'2025-05-28 12:00:01','Quantity changed from 25 to 150'),(26,1,150,25,'2025-05-28 12:00:02','Quantity changed from 150 to 25'),(27,1,150,25,'2025-05-28 12:00:02','LOW STOCK ALERT: Quantity below threshold!'),(28,1,25,150,'2025-05-28 12:58:14','Quantity changed from 25 to 150'),(29,1,150,25,'2025-05-28 12:58:14','Quantity changed from 150 to 25'),(30,1,150,25,'2025-05-28 12:58:14','LOW STOCK ALERT: Quantity below threshold!'),(31,1,25,150,'2025-05-28 12:58:15','Quantity changed from 25 to 150'),(32,1,150,25,'2025-05-28 13:21:25','Quantity changed from 150 to 25'),(33,1,150,25,'2025-05-28 13:21:25','LOW STOCK ALERT: Quantity below threshold!'),(34,2,200,170,'2025-05-28 13:24:30','Quantity changed from 200 to 170'),(35,2,170,120,'2025-05-28 13:24:42','Quantity changed from 170 to 120'),(36,2,120,70,'2025-05-28 14:09:33','Quantity changed from 120 to 70'),(37,4,1000,994,'2025-05-28 14:17:36','Quantity changed from 1000 to 994'),(38,4,994,988,'2025-05-28 14:17:43','Quantity changed from 994 to 988'),(39,4,988,982,'2025-05-28 14:17:44','Quantity changed from 988 to 982'),(40,4,982,976,'2025-05-28 14:17:44','Quantity changed from 982 to 976'),(41,4,976,970,'2025-05-28 14:17:52','Quantity changed from 976 to 970'),(42,4,970,964,'2025-05-28 14:17:52','Quantity changed from 970 to 964'),(43,4,964,958,'2025-05-28 14:17:52','Quantity changed from 964 to 958'),(44,4,958,952,'2025-05-28 14:17:53','Quantity changed from 958 to 952'),(45,4,952,946,'2025-05-28 14:17:53','Quantity changed from 952 to 946'),(46,4,946,940,'2025-05-28 14:17:53','Quantity changed from 946 to 940'),(47,4,940,934,'2025-05-28 14:17:53','Quantity changed from 940 to 934'),(48,4,934,928,'2025-05-28 14:17:53','Quantity changed from 934 to 928'),(49,3,200,165,'2025-05-28 14:21:05','Quantity changed from 200 to 165'),(50,5,250,245,'2025-05-28 14:22:37','Quantity changed from 250 to 245'),(51,5,245,240,'2025-05-28 14:23:23','Quantity changed from 245 to 240'),(52,5,240,235,'2025-05-28 14:23:26','Quantity changed from 240 to 235'),(53,5,235,230,'2025-05-28 14:24:19','Quantity changed from 235 to 230'),(54,5,230,225,'2025-05-28 14:24:42','Quantity changed from 230 to 225'),(55,5,225,220,'2025-05-28 14:28:52','Quantity changed from 225 to 220'),(56,1,25,150,'2025-05-28 15:07:05','Quantity changed from 25 to 150'),(57,1,150,25,'2025-05-28 15:07:09','Quantity changed from 150 to 25'),(58,1,150,25,'2025-05-28 15:07:09','LOW STOCK ALERT: Quantity below threshold!'),(59,2,70,200,'2025-05-28 15:07:11','Quantity changed from 70 to 200'),(60,2,200,168,'2025-05-28 15:09:54','Quantity changed from 200 to 168'),(61,1,25,150,'2025-05-28 15:35:15','Quantity changed from 25 to 150'),(62,1,150,25,'2025-05-28 15:35:15','Quantity changed from 150 to 25'),(63,1,150,25,'2025-05-28 15:35:15','LOW STOCK ALERT: Quantity below threshold!'),(64,2,168,200,'2025-05-28 15:35:15','Quantity changed from 168 to 200'),(65,1,25,150,'2025-05-28 15:35:58','Quantity changed from 25 to 150'),(66,1,150,25,'2025-05-28 15:35:58','Quantity changed from 150 to 25'),(67,1,150,25,'2025-05-28 15:35:58','LOW STOCK ALERT: Quantity below threshold!');
/*!40000 ALTER TABLE `supply_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `target_base_radar`
--

DROP TABLE IF EXISTS `target_base_radar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `target_base_radar` (
  `target_id` int NOT NULL,
  `base_id` int NOT NULL,
  PRIMARY KEY (`target_id`,`base_id`),
  KEY `base_id` (`base_id`),
  CONSTRAINT `target_base_radar_ibfk_1` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`),
  CONSTRAINT `target_base_radar_ibfk_2` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `target_base_radar`
--

LOCK TABLES `target_base_radar` WRITE;
/*!40000 ALTER TABLE `target_base_radar` DISABLE KEYS */;
INSERT INTO `target_base_radar` VALUES (3,1),(4,2),(8,3),(1,4),(9,5),(7,6),(10,7),(5,8),(2,9),(6,10);
/*!40000 ALTER TABLE `target_base_radar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `targets`
--

DROP TABLE IF EXISTS `targets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `targets` (
  `target_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `priority_level` int DEFAULT NULL,
  PRIMARY KEY (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `targets`
--

LOCK TABLES `targets` WRITE;
/*!40000 ALTER TABLE `targets` DISABLE KEYS */;
INSERT INTO `targets` VALUES (1,'Bunker Bravo','Ground Installation',5),(2,'Radar Station','Communications',7),(3,'Supply Depot','Logistics',4),(4,'Enemy Outpost','Forward Base',8),(5,'Submarine Dock','Naval',9),(6,'Convoy Route','Transport',3),(7,'Rebel Camp','Hostile',6),(8,'Aircraft Carrier','Naval',10),(9,'Missile Silo','Strategic',9),(10,'Mountain Hideout','Guerrilla',7);
/*!40000 ALTER TABLE `targets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_status_log`
--

DROP TABLE IF EXISTS `vehicle_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_status_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `vehicle_status_log_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_status_log`
--

LOCK TABLES `vehicle_status_log` WRITE;
/*!40000 ALTER TABLE `vehicle_status_log` DISABLE KEYS */;
INSERT INTO `vehicle_status_log` VALUES (7,1,'Active','Maintenance','2025-05-28 00:03:16'),(8,1,'Maintenance','Repair','2025-05-28 00:03:17'),(9,1,'Repair','Active','2025-05-28 00:03:19'),(10,1,'Active','Maintenance','2025-05-28 00:06:18'),(11,1,'Maintenance','Repair','2025-05-28 00:06:35'),(12,1,'Repair','Active','2025-05-28 00:06:36'),(13,3,'Maintenance','Decommissioned','2025-05-28 00:16:17'),(14,1,'Active','Maintenance','2025-05-28 00:56:57'),(15,1,'Maintenance','Active','2025-05-28 00:57:24'),(16,1,'Active','Repair','2025-05-28 00:57:27'),(17,1,'Repair','Maintenance','2025-05-28 01:19:00'),(18,1,'Maintenance','Repair','2025-05-28 01:19:03'),(19,1,'Repair','Active','2025-05-28 01:19:05'),(20,1,'Active','Maintenance','2025-05-28 01:29:59'),(21,1,'Maintenance','Repair','2025-05-28 01:30:01'),(22,1,'Repair','Active','2025-05-28 01:30:02'),(23,1,'Active','Maintenance','2025-05-28 08:59:53'),(24,1,'Maintenance','Repair','2025-05-28 08:59:53'),(25,1,'Repair','Active','2025-05-28 08:59:53'),(26,1,'Active','Maintenance','2025-05-28 09:58:08'),(27,1,'Maintenance','Repair','2025-05-28 09:58:09'),(28,1,'Repair','Active','2025-05-28 09:58:09'),(29,1,'Active','Maintenance','2025-05-28 10:20:07'),(30,1,'Maintenance','Repair','2025-05-28 10:20:10'),(31,1,'Repair','Active','2025-05-28 10:20:13'),(32,1,'Active','Maintenance','2025-05-28 11:06:03'),(33,1,'Maintenance','Repair','2025-05-28 11:06:05'),(34,1,'Repair','Active','2025-05-28 11:06:05'),(35,1,'Active','Repair','2025-05-28 11:06:07'),(36,1,'Repair','Maintenance','2025-05-28 11:08:35'),(37,1,'Maintenance','Repair','2025-05-28 11:08:38'),(38,1,'Repair','Active','2025-05-28 11:08:40'),(39,1,'Active','Maintenance','2025-05-28 11:08:43'),(40,1,'Maintenance','Repair','2025-05-28 11:08:44'),(41,1,'Repair','Maintenance','2025-05-28 11:08:46'),(42,1,'Maintenance','Active','2025-05-28 11:08:49'),(43,1,'Active','Maintenance','2025-05-28 12:06:55'),(44,1,'Maintenance','Repair','2025-05-28 12:06:57'),(45,1,'Repair','Active','2025-05-28 12:06:59'),(46,3,'Decommissioned','Active','2025-05-28 12:09:06'),(47,3,'Active','Repair','2025-05-28 12:09:13'),(48,5,'Active','Maintenance','2025-05-28 12:09:21'),(49,1,'Active','Maintenance','2025-05-28 12:35:09'),(50,1,'Maintenance','Repair','2025-05-28 12:35:10'),(51,1,'Repair','Active','2025-05-28 12:35:10');
/*!40000 ALTER TABLE `vehicle_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `vehicle_id` int NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `operational_status` varchar(50) DEFAULT NULL,
  `base_id` int NOT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `base_id` (`base_id`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Humvee',5,'Active',1),(2,'APC',8,'Active',2),(3,'Tank',3,'Repair',3),(4,'Jeep',2,'Active',4),(5,'Truck',10,'Maintenance',5),(6,'Helicopter',2,'Repair',6),(7,'Artillery',1,'Active',7),(8,'Fighter Jet',1,'Active',8),(9,'Drone Carrier',0,'Maintenance',9),(10,'Transport Bus',20,'Active',10);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiclestatuslog`
--

DROP TABLE IF EXISTS `vehiclestatuslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehiclestatuslog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `change_date` datetime DEFAULT NULL,
  `change_reason` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiclestatuslog`
--

LOCK TABLES `vehiclestatuslog` WRITE;
/*!40000 ALTER TABLE `vehiclestatuslog` DISABLE KEYS */;
INSERT INTO `vehiclestatuslog` VALUES (1,1,'Active','Maintenance','2025-05-28 03:03:16','Status changed from Active to Maintenance'),(2,1,'Maintenance','Repair','2025-05-28 03:03:17','Status changed from Maintenance to Repair'),(3,1,'Repair','Active','2025-05-28 03:03:19','Status changed from Repair to Active'),(4,1,'Active','Maintenance','2025-05-28 03:06:18','Status changed from Active to Maintenance'),(5,1,'Maintenance','Repair','2025-05-28 03:06:35','Status changed from Maintenance to Repair'),(6,1,'Repair','Active','2025-05-28 03:06:36','Status changed from Repair to Active'),(7,3,'Maintenance','Decommissioned','2025-05-28 03:16:17','Status changed from Maintenance to Decommissioned'),(8,1,'Active','Maintenance','2025-05-28 03:56:57','Status changed from Active to Maintenance'),(9,1,'Maintenance','Active','2025-05-28 03:57:24','Status changed from Maintenance to Active'),(10,1,'Active','Repair','2025-05-28 03:57:27','Status changed from Active to Repair'),(11,1,'Repair','Maintenance','2025-05-28 04:19:00','Status changed from Repair to Maintenance'),(12,1,'Maintenance','Repair','2025-05-28 04:19:03','Status changed from Maintenance to Repair'),(13,1,'Repair','Active','2025-05-28 04:19:05','Status changed from Repair to Active'),(14,1,'Active','Maintenance','2025-05-28 04:29:59','Status changed from Active to Maintenance'),(15,1,'Maintenance','Repair','2025-05-28 04:30:01','Status changed from Maintenance to Repair'),(16,1,'Repair','Active','2025-05-28 04:30:02','Status changed from Repair to Active'),(17,1,'Active','Maintenance','2025-05-28 11:59:53','Status changed from Active to Maintenance'),(18,1,'Maintenance','Repair','2025-05-28 11:59:53','Status changed from Maintenance to Repair'),(19,1,'Repair','Active','2025-05-28 11:59:53','Status changed from Repair to Active'),(20,1,'Active','Maintenance','2025-05-28 12:58:08','Status changed from Active to Maintenance'),(21,1,'Maintenance','Repair','2025-05-28 12:58:09','Status changed from Maintenance to Repair'),(22,1,'Repair','Active','2025-05-28 12:58:09','Status changed from Repair to Active'),(23,1,'Active','Maintenance','2025-05-28 13:20:07','Status changed from Active to Maintenance'),(24,1,'Maintenance','Repair','2025-05-28 13:20:10','Status changed from Maintenance to Repair'),(25,1,'Repair','Active','2025-05-28 13:20:13','Status changed from Repair to Active'),(26,1,'Active','Maintenance','2025-05-28 14:06:03','Status changed from Active to Maintenance'),(27,1,'Maintenance','Repair','2025-05-28 14:06:05','Status changed from Maintenance to Repair'),(28,1,'Repair','Active','2025-05-28 14:06:05','Status changed from Repair to Active'),(29,1,'Active','Repair','2025-05-28 14:06:07','Status changed from Active to Repair'),(30,1,'Repair','Maintenance','2025-05-28 14:08:35','Status changed from Repair to Maintenance'),(31,1,'Maintenance','Repair','2025-05-28 14:08:38','Status changed from Maintenance to Repair'),(32,1,'Repair','Active','2025-05-28 14:08:40','Status changed from Repair to Active'),(33,1,'Active','Maintenance','2025-05-28 14:08:43','Status changed from Active to Maintenance'),(34,1,'Maintenance','Repair','2025-05-28 14:08:44','Status changed from Maintenance to Repair'),(35,1,'Repair','Maintenance','2025-05-28 14:08:46','Status changed from Repair to Maintenance'),(36,1,'Maintenance','Active','2025-05-28 14:08:49','Status changed from Maintenance to Active'),(37,5,'Active','Active','2025-05-28 14:33:58',NULL),(38,4,'Active','Active','2025-05-28 14:36:33',NULL),(39,1,'Active','Maintenance','2025-05-28 15:06:55','Status changed from Active to Maintenance'),(40,1,'Maintenance','Repair','2025-05-28 15:06:57','Status changed from Maintenance to Repair'),(41,1,'Repair','Active','2025-05-28 15:06:59','Status changed from Repair to Active'),(42,3,'Decommissioned','Active','2025-05-28 15:09:06','Status changed from Decommissioned to Active'),(43,3,'Decommissioned','Active','2025-05-28 15:09:06',NULL),(44,3,'Active','Repair','2025-05-28 15:09:13','Status changed from Active to Repair'),(45,3,'Active','Repair','2025-05-28 15:09:13',NULL),(46,5,'Active','Maintenance','2025-05-28 15:09:21','Status changed from Active to Maintenance'),(47,5,'Active','Maintenance','2025-05-28 15:09:21',NULL),(48,1,'Active','Maintenance','2025-05-28 15:35:09','Status changed from Active to Maintenance'),(49,1,'Maintenance','Repair','2025-05-28 15:35:10','Status changed from Maintenance to Repair'),(50,1,'Repair','Active','2025-05-28 15:35:10','Status changed from Repair to Active');
/*!40000 ALTER TABLE `vehiclestatuslog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-28 17:13:30
