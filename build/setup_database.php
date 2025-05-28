<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "2003";

try {
    // Create initial connection without database
    $conn = new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "Connected successfully\n";
    
    // Set MySQL settings
    $conn->query("SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT");
    $conn->query("SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS");
    $conn->query("SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION");
    $conn->query("SET NAMES utf8");
    $conn->query("SET @OLD_TIME_ZONE=@@TIME_ZONE");
    $conn->query("SET TIME_ZONE='+00:00'");
    $conn->query("SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0");
    $conn->query("SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0");
    $conn->query("SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO'");
    $conn->query("SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0");
    
    // Drop and create database
    $conn->query("DROP DATABASE IF EXISTS military_intelligence");
    echo "Dropped existing database if it existed\n";
    
    $conn->query("CREATE DATABASE military_intelligence");
    echo "Created new database\n";
    
    $conn->query("USE military_intelligence");
    echo "Switched to military_intelligence database\n";

    // Create agent_activity_log table
    $sql = "CREATE TABLE `agent_activity_log` (
        `id` int NOT NULL AUTO_INCREMENT,
        `agent_id` int DEFAULT NULL,
        `old_rank` varchar(50) DEFAULT NULL,
        `new_rank` varchar(50) DEFAULT NULL,
        `activity_date` datetime DEFAULT NULL,
        `activity_type` varchar(50) DEFAULT NULL,
        `activity_description` text,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created agent_activity_log table\n";

    // Create agent_wrote_report table
    $sql = "CREATE TABLE `agent_wrote_report` (
        `agent_id` int NOT NULL,
        `report_id` int NOT NULL,
        PRIMARY KEY (`agent_id`,`report_id`),
        KEY `report_id` (`report_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created agent_wrote_report table\n";

    // Create agents table
    $sql = "CREATE TABLE `agents` (
        `agent_id` int NOT NULL,
        `name` varchar(100) NOT NULL,
        `rank` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`agent_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created agents table\n";

    // Create countries table
    $sql = "CREATE TABLE `countries` (
        `country_id` int NOT NULL,
        `name` varchar(100) NOT NULL,
        `region` varchar(100) DEFAULT NULL,
        `political_status` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`country_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created countries table\n";

    // Create base table
    $sql = "CREATE TABLE `base` (
        `base_id` int NOT NULL,
        `name` varchar(100) NOT NULL,
        `capacity` int DEFAULT NULL,
        `country_id` int NOT NULL,
        PRIMARY KEY (`base_id`),
        KEY `country_id` (`country_id`),
        CONSTRAINT `base_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created base table\n";

    // Create supply table
    $sql = "CREATE TABLE `supply` (
        `supply_id` int NOT NULL,
        `sup_name` varchar(100) NOT NULL,
        `type` varchar(50) DEFAULT NULL,
        `quantity` int DEFAULT NULL,
        PRIMARY KEY (`supply_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created supply table\n";

    // Create base_stores_supply table
    $sql = "CREATE TABLE `base_stores_supply` (
        `base_id` int NOT NULL,
        `supply_id` int NOT NULL,
        PRIMARY KEY (`base_id`,`supply_id`),
        KEY `supply_id` (`supply_id`),
        CONSTRAINT `base_stores_supply_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`),
        CONSTRAINT `base_stores_supply_ibfk_2` FOREIGN KEY (`supply_id`) REFERENCES `supply` (`supply_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created base_stores_supply table\n";

    // Create person table
    $sql = "CREATE TABLE `person` (
        `person_id` int NOT NULL,
        `base_id` int NOT NULL,
        PRIMARY KEY (`person_id`),
        KEY `base_id` (`base_id`),
        CONSTRAINT `person_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created person table\n";

    // Create civil table
    $sql = "CREATE TABLE `civil` (
        `person_id` int NOT NULL,
        `department` varchar(100) DEFAULT NULL,
        `occupation` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`person_id`),
        CONSTRAINT `civil_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created civil table\n";

    // Create soldier table
    $sql = "CREATE TABLE `soldier` (
        `person_id` int NOT NULL,
        `specialty` varchar(100) DEFAULT NULL,
        `unit` varchar(100) DEFAULT NULL,
        `rank` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`person_id`),
        CONSTRAINT `soldier_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created soldier table\n";

    // Create operator table (FIXED: escaped rank with backticks)
    $sql = "CREATE TABLE `operator` (
        `op_id` int NOT NULL,
        `rank` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`op_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created operator table\n";

    // Create missiles table
    $sql = "CREATE TABLE `missiles` (
        `missile_id` int NOT NULL,
        `type` varchar(50) DEFAULT NULL,
        `range` int DEFAULT NULL,
        PRIMARY KEY (`missile_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created missiles table\n";

    // Create drones table
    $sql = "CREATE TABLE `drones` (
        `drone_id` int NOT NULL,
        `range` int DEFAULT NULL,
        `max_altitude` int DEFAULT NULL,
        `model` varchar(100) DEFAULT NULL,
        `op_id` int NOT NULL,
        PRIMARY KEY (`drone_id`),
        KEY `op_id` (`op_id`),
        CONSTRAINT `drones_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operator` (`op_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created drones table\n";

    // Create vehicles table
    $sql = "CREATE TABLE `vehicles` (
        `vehicle_id` int NOT NULL,
        `type` varchar(50) DEFAULT NULL,
        `capacity` int DEFAULT NULL,
        `operational_status` varchar(50) DEFAULT NULL,
        `base_id` int NOT NULL,
        PRIMARY KEY (`vehicle_id`),
        KEY `base_id` (`base_id`),
        CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created vehicles table\n";

    // Create satellites table
    $sql = "CREATE TABLE `satellites` (
        `satellite_id` int NOT NULL,
        `operational_status` varchar(50) DEFAULT NULL,
        `name` varchar(100) NOT NULL,
        PRIMARY KEY (`satellite_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created satellites table\n";

    // Create targets table
    $sql = "CREATE TABLE `targets` (
        `target_id` int NOT NULL,
        `name` varchar(100) NOT NULL,
        `type` varchar(50) DEFAULT NULL,
        `priority_level` int DEFAULT NULL,
        PRIMARY KEY (`target_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created targets table\n";

    // Create intelligence_reports table
    $sql = "CREATE TABLE `intelligence_reports` (
        `report_id` int NOT NULL,
        `title` varchar(200) NOT NULL,
        `content` text,
        `date_created` datetime NOT NULL,
        `classification_level` varchar(50) DEFAULT NULL,
        `agent_id` int DEFAULT NULL,
        PRIMARY KEY (`report_id`),
        KEY `agent_id` (`agent_id`),
        CONSTRAINT `intelligence_reports_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created intelligence_reports table\n";

    // Create relationship tables
    
    // Create drone_attack_log table
    $sql = "CREATE TABLE `drone_attack_log` (
        `log_id` int NOT NULL AUTO_INCREMENT,
        `drone_id` int NOT NULL,
        `target_id` int NOT NULL,
        `attack_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`log_id`),
        KEY `drone_id` (`drone_id`),
        KEY `target_id` (`target_id`),
        CONSTRAINT `drone_attack_log_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
        CONSTRAINT `drone_attack_log_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created drone_attack_log table\n";

    // Create drone_missile_usage table
    $sql = "CREATE TABLE `drone_missile_usage` (
        `drone_id` int NOT NULL,
        `missile_id` int NOT NULL,
        PRIMARY KEY (`drone_id`,`missile_id`),
        KEY `missile_id` (`missile_id`),
        CONSTRAINT `drone_missile_usage_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
        CONSTRAINT `drone_missile_usage_ibfk_2` FOREIGN KEY (`missile_id`) REFERENCES `missiles` (`missile_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created drone_missile_usage table\n";

    // Create drone_target_attacks table
    $sql = "CREATE TABLE `drone_target_attacks` (
        `drone_id` int NOT NULL,
        `target_id` int NOT NULL,
        PRIMARY KEY (`drone_id`,`target_id`),
        KEY `target_id` (`target_id`),
        CONSTRAINT `drone_target_attacks_ibfk_1` FOREIGN KEY (`drone_id`) REFERENCES `drones` (`drone_id`),
        CONSTRAINT `drone_target_attacks_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created drone_target_attacks table\n";

    // Create dronestatus table
    $sql = "CREATE TABLE `dronestatus` (
        `id` int NOT NULL AUTO_INCREMENT,
        `drone_id` int DEFAULT NULL,
        `old_operator_id` int DEFAULT NULL,
        `new_operator_id` int DEFAULT NULL,
        `status_date` datetime DEFAULT NULL,
        `status_message` text,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created dronestatus table\n";

    // Create intelligence_report_decides_target table
    $sql = "CREATE TABLE `intelligence_report_decides_target` (
        `report_id` int NOT NULL,
        `target_id` int NOT NULL,
        PRIMARY KEY (`report_id`,`target_id`),
        KEY `target_id` (`target_id`),
        CONSTRAINT `intelligence_report_decides_target_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`),
        CONSTRAINT `intelligence_report_decides_target_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created intelligence_report_decides_target table\n";

    // Create report_update_log table
    $sql = "CREATE TABLE `report_update_log` (
        `log_id` int NOT NULL AUTO_INCREMENT,
        `report_id` int NOT NULL,
        `old_title` varchar(200) DEFAULT NULL,
        `new_title` varchar(200) DEFAULT NULL,
        `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`log_id`),
        KEY `report_id` (`report_id`),
        CONSTRAINT `report_update_log_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created report_update_log table\n";

    // Create satellite_target_watches table
    $sql = "CREATE TABLE `satellite_target_watches` (
        `satellite_id` int NOT NULL,
        `target_id` int NOT NULL,
        PRIMARY KEY (`satellite_id`,`target_id`),
        KEY `target_id` (`target_id`),
        CONSTRAINT `satellite_target_watches_ibfk_1` FOREIGN KEY (`satellite_id`) REFERENCES `satellites` (`satellite_id`),
        CONSTRAINT `satellite_target_watches_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created satellite_target_watches table\n";

    // Create supply_audit table
    $sql = "CREATE TABLE `supply_audit` (
        `id` int NOT NULL AUTO_INCREMENT,
        `supply_id` int NOT NULL,
        `old_quantity` int DEFAULT NULL,
        `new_quantity` int DEFAULT NULL,
        `audit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `audit_message` text,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created supply_audit table\n";

    // Create target_base_radar table
    $sql = "CREATE TABLE `target_base_radar` (
        `target_id` int NOT NULL,
        `base_id` int NOT NULL,
        PRIMARY KEY (`target_id`,`base_id`),
        KEY `base_id` (`base_id`),
        CONSTRAINT `target_base_radar_ibfk_1` FOREIGN KEY (`target_id`) REFERENCES `targets` (`target_id`),
        CONSTRAINT `target_base_radar_ibfk_2` FOREIGN KEY (`base_id`) REFERENCES `base` (`base_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created target_base_radar table\n";

    // Create vehicle_status_log table
    $sql = "CREATE TABLE `vehicle_status_log` (
        `log_id` int NOT NULL AUTO_INCREMENT,
        `vehicle_id` int NOT NULL,
        `old_status` varchar(50) DEFAULT NULL,
        `new_status` varchar(50) DEFAULT NULL,
        `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`log_id`),
        KEY `vehicle_id` (`vehicle_id`),
        CONSTRAINT `vehicle_status_log_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created vehicle_status_log table\n";

    // Create vehiclestatuslog table
    $sql = "CREATE TABLE `vehiclestatuslog` (
        `id` int NOT NULL AUTO_INCREMENT,
        `vehicle_id` int DEFAULT NULL,
        `old_status` varchar(50) DEFAULT NULL,
        `new_status` varchar(50) DEFAULT NULL,
        `change_date` datetime DEFAULT NULL,
        `change_reason` text,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $conn->query($sql);
    echo "Created vehiclestatuslog table\n";

    // Add foreign key constraints for agent_wrote_report
    $sql = "ALTER TABLE `agent_wrote_report` 
            ADD CONSTRAINT `agent_wrote_report_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`),
            ADD CONSTRAINT `agent_wrote_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `intelligence_reports` (`report_id`)";
    $conn->query($sql);
    echo "Added foreign key constraints for agent_wrote_report\n";

    echo "All tables created successfully!\n";
    echo "Now inserting data...\n";

    // Insert data from the SQL dump
    
    // Insert countries data
    $sql = "INSERT INTO `countries` VALUES 
        (1,'Atlantis','North Sea','Stable Democracy'),
        (2,'Azura','South Sea','Monarchy'),
        (3,'Rivia','Eastern Continent','Federation'),
        (4,'Arcadia','Western Isles','Republic'),
        (5,'Novia','Northern Mainland','Confederation'),
        (6,'Eldora','Eastern Mainland','Kingdom'),
        (7,'Valoria','Valley Region','Stable Democracy'),
        (8,'Terranova','Island Frontier','Republic'),
        (9,'Sandora','Desert Region','Autocracy'),
        (10,'Polaris','Polar Region','Stable Democracy')";
    $conn->query($sql);
    echo "Inserted countries data\n";

    // Insert base data
    $sql = "INSERT INTO `base` VALUES 
        (1,'Fort Eagle',500,1),
        (2,'Camp Iron',350,2),
        (3,'Station Echo',600,3),
        (4,'Forward Ops Delta',400,4),
        (5,'Redwood Garrison',300,5),
        (6,'Desert Storm Post',200,6),
        (7,'Skywatch Base',800,7),
        (8,'Oceanic Outpost',250,8),
        (9,'Ziggurat HQ',750,9),
        (10,'Polar Command',1000,10)";
    $conn->query($sql);
    echo "Inserted base data\n";

    // Insert supply data
    $sql = "INSERT INTO `supply` VALUES 
        (1,'Ammo Crates','Ammunition',25),
        (2,'Ration Packs','Food',200),
        (3,'Medical Kits','Medical',165),
        (4,'Fuel Barrels','Fuel',928),
        (5,'Spare Parts','Mechanic',220),
        (6,'Electronics','Electronic',150),
        (7,'Uniforms','Clothing',400),
        (8,'Water Tanks','Water',600),
        (9,'Satellite Parts','Components',50),
        (10,'Office Supplies','Stationery',100)";
    $conn->query($sql);
    echo "Inserted supply data\n";

    // Insert person data
    $sql = "INSERT INTO `person` VALUES 
        (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10)";
    $conn->query($sql);
    echo "Inserted person data\n";

    // Insert soldier data
    $sql = "INSERT INTO `soldier` VALUES 
        (1,'Sniper Ops','Alpha Squad','Sergeant'),
        (2,'Medical','Bravo Squad','Lieutenant'),
        (3,'Infantry','Charlie Squad','Captain'),
        (4,'Engineer','Delta Squad','Sergeant'),
        (5,'Pilot','Echo Squad','Major')";
    $conn->query($sql);
    echo "Inserted soldier data\n";

    // Insert civil data
    $sql = "INSERT INTO `civil` VALUES 
        (6,'Logistics','Accountant'),
        (7,'HR','Recruiter'),
        (8,'IT','Technician'),
        (9,'Maintenance','Supervisor'),
        (10,'Transport','Driver')";
    $conn->query($sql);
    echo "Inserted civil data\n";

    // Insert agents data
    $sql = "INSERT INTO `agents` VALUES 
        (1,'John Gray','Captain'),
        (2,'Sarah Black','Lieutenant'),
        (3,'Derek White','Major'),
        (4,'Lucy Green','Captain'),
        (5,'Mia Brown','Sergeant'),
        (6,'James Fox','Corporal'),
        (7,'Nina Red','Chief Officer'),
        (8,'Omar Blue','Lieutenant'),
        (9,'Iris Golden','Sergeant'),
        (10,'Ethan Silver','Major')";
    $conn->query($sql);
    echo "Inserted agents data\n";

    // Insert operator data
    $sql = "INSERT INTO `operator` VALUES 
        (1,NULL),(2,NULL),(3,NULL),(4,'Major'),(5,NULL),(6,NULL),(7,NULL),(8,NULL),(9,'Colonel'),(10,'Major'),(12,'Captain'),(20,NULL),(25,'tt'),(10000,NULL)";
    $conn->query($sql);
    echo "Inserted operator data\n";

    // Insert missiles data
    $sql = "INSERT INTO `missiles` VALUES 
        (1,'Air-to-Air',50),
        (2,'Air-to-Ground',60),
        (3,'Short-Range',70),
        (4,'Long-Range',80),
        (5,'Cruise',90),
        (6,'Tactical',110),
        (7,'Surface-to-Air',120),
        (8,'Anti-Ship',130),
        (9,'Interceptor',140),
        (10,'Ballistic',150)";
    $conn->query($sql);
    echo "Inserted missiles data\n";

    // Insert drones data
    $sql = "INSERT INTO `drones` VALUES 
        (1,100,2000,'Raven-X',1),
        (2,120,2500,'Falcon-A',1),
        (3,150,3000,'Eagle-B',5),
        (4,180,4000,'Condor-P',8),
        (5,200,4500,'Vulture-Q',1),
        (6,220,4800,'Hawk-V',3),
        (7,250,5200,'Buzzard-H',7),
        (8,270,5500,'Kestrel-R',8),
        (9,300,6000,'Harrier-T',9),
        (10,350,6500,'Phoenix-Z',25)";
    $conn->query($sql);
    echo "Inserted drones data\n";

    // Insert vehicles data
    $sql = "INSERT INTO `vehicles` VALUES 
        (1,'Humvee',5,'Active',1),
        (2,'APC',8,'Active',2),
        (3,'Tank',3,'Repair',3),
        (4,'Jeep',2,'Active',4),
        (5,'Truck',10,'Maintenance',5),
        (6,'Helicopter',2,'Repair',6),
        (7,'Artillery',1,'Active',7),
        (8,'Fighter Jet',1,'Active',8),
        (9,'Drone Carrier',0,'Maintenance',9),
        (10,'Transport Bus',20,'Active',10)";
    $conn->query($sql);
    echo "Inserted vehicles data\n";

    // Insert satellites data
    $sql = "INSERT INTO `satellites` VALUES 
        (1,'Operational','HawkEye-1'),
        (2,'Standby','HawkEye-2'),
        (3,'Operational','StratoView'),
        (4,'Under Maintenance','CosmoTracker'),
        (5,'Operational','SkyNet-Alpha'),
        (6,'Standby','SkyNet-Beta'),
        (7,'Operational','GeoSat-7'),
        (8,'Under Maintenance','CloudWatcher'),
        (9,'Operational','Orbiter-9'),
        (10,'Operational','Zenith-X')";
    $conn->query($sql);
    echo "Inserted satellites data\n";

    // Insert targets data
    $sql = "INSERT INTO `targets` VALUES 
        (1,'Bunker Bravo','Ground Installation',5),
        (2,'Radar Station','Communications',7),
        (3,'Supply Depot','Logistics',4),
        (4,'Enemy Outpost','Forward Base',8),
        (5,'Submarine Dock','Naval',9),
        (6,'Convoy Route','Transport',3),
        (7,'Rebel Camp','Hostile',6),
        (8,'Aircraft Carrier','Naval',10),
        (9,'Missile Silo','Strategic',9),
        (10,'Mountain Hideout','Guerrilla',7)";
    $conn->query($sql);
    echo "Inserted targets data\n";

    // Insert relationship data
    $sql = "INSERT INTO `base_stores_supply` VALUES 
        (2,1),(3,2),(1,3),(4,4),(6,5),(7,6),(8,7),(5,8),(9,9),(10,10)";
    $conn->query($sql);
    echo "Inserted base_stores_supply data\n";

    $sql = "INSERT INTO `drone_missile_usage` VALUES 
        (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10)";
    $conn->query($sql);
    echo "Inserted drone_missile_usage data\n";

    $sql = "INSERT INTO `drone_target_attacks` VALUES 
        (1,1),(7,2),(8,3),(2,4),(9,5),(10,6),(3,7),(5,8),(6,9),(4,10)";
    $conn->query($sql);
    echo "Inserted drone_target_attacks data\n";

    $sql = "INSERT INTO `intelligence_report_decides_target` VALUES 
        (4,1),(5,2),(2,3),(8,4),(1,5),(1,6),(2,7),(6,8),(3,9),(7,10)";
    $conn->query($sql);
    echo "Inserted intelligence_report_decides_target data\n";

    $sql = "INSERT INTO `satellite_target_watches` VALUES 
        (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10)";
    $conn->query($sql);
    echo "Inserted satellite_target_watches data\n";

    $sql = "INSERT INTO `target_base_radar` VALUES 
        (3,1),(4,2),(8,3),(1,4),(9,5),(7,6),(10,7),(5,8),(2,9),(6,10)";
    $conn->query($sql);
    echo "Inserted target_base_radar data\n";

    // Insert initial intelligence reports
    $sql = "INSERT INTO `intelligence_reports` VALUES 
        (1,'Scouting Operation','Arctic Recon','2025-01-01 00:00:00','Secret',1),
        (2,'Threat Analysis','Desert Intel','2025-01-02 00:00:00','Classified',2),
        (3,'Base Status','Camp Survey','2025-01-03 00:00:00','TopSecret',3),
        (4,'Forward Plans','Inshore Recon','2025-01-04 00:00:00','Secret',4),
        (5,'Unit Position','Air Patrol','2025-01-05 00:00:00','Classified',5),
        (6,'Alert Notice','Mountain Watch','2025-01-06 00:00:00','Secret',6),
        (7,'Rescue Mission','Night Ops','2025-01-07 00:00:00','TopSecret',7),
        (8,'Supply Drop','Outpost Refill','2025-01-08 00:00:00','Secret',8),
        (9,'Recon Summary','Base Threat','2025-01-09 00:00:00','TopSecret',9),
        (10,'Final Brief','Operation Dawn','2025-01-10 00:00:00','Classified',10)";
    $conn->query($sql);
    echo "Inserted initial intelligence_reports data\n";

    echo "Database setup completed successfully!\n";
    echo "All tables and data have been created according to the SQL dump.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$conn->close();
?>
