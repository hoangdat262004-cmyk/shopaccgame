-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ql_shopaccgame
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
-- Table structure for table `account_code_details`
--

DROP TABLE IF EXISTS `account_code_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_code_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `rank_name` varchar(100) DEFAULT '',
  `num_skins` int(11) DEFAULT 0,
  `skin_names` text DEFAULT '',
  `num_heroes` int(11) DEFAULT 0,
  `image_url` varchar(500) DEFAULT '',
  `extra_info` text DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `info` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_code` (`account_id`,`code`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_code_details`
--

LOCK TABLES `account_code_details` WRITE;
/*!40000 ALTER TABLE `account_code_details` DISABLE KEYS */;
INSERT INTO `account_code_details` VALUES (1,0,7652,'Bạch Kim I',28,'Butterfly Queen Violet, Gunner Mina, Dark Slayer Keera, Zodiac Grakk',45,'LIENQUAN.jpg/1.jpg','Full trang, nhiều skin hiếm, rank ổn định',NULL,NULL,NULL),(2,0,7651,'Kim Cương III',35,'Cyber Punk Zuka, Dragon Tamer Raz, Galaxy Alice, Neon City Arum',52,'LIENQUAN.jpg/2.jpg','Kim Cương, nhiều skin limited, tài khoản uy tín',NULL,NULL,NULL),(3,0,7650,'Kim Cương II',30,'Shadow Dancer Murad, Crystal Archer Elsu, Phoenix Tulen, Arctic Fox Celica',48,'LIENQUAN.jpg/3.jpg','Kim Cương full tướng mid, skin chất lượng cao',NULL,NULL,NULL),(4,0,4891,'Vàng II',12,'Dragon Knight Ryoma, Maid Tulen, Night Owl Thane',30,'LIENQUANRAMDOM/200k.jpg','Tài khoản cân bằng, phù hợp người mới',NULL,NULL,NULL),(5,0,4890,'Thách Đấu',65,'Super Idol Violet, Dragon God Lindis, Cosmic Dusk Keera, Sky Racer Mina, Emperor Nakroth',72,'LIENQUAN.jpg/4.jpg','Thách Đấu Top Server, skin cực hiếm, full tướng',NULL,NULL,NULL),(6,0,4885,'Thách Đấu',48,'Cyber Sakura Hayate, Dark Ronin Ryoma, Phantom Thief Zata, Ancient God Skud',60,'LIENQUAN.jpg/5.jpg','Thách Đấu, đầy đủ tướng thịnh hành, nhiều skin event',NULL,NULL,NULL),(7,0,4694,'Kim Cương I',40,'Lunar God Zuka, Starlight Butterfly Violet, Neon Dragon Raz',55,'LIENQUANRAMDOM/1.jpg','Giảm 30%, Kim Cương I nhiều skin hiếm, tài khoản VIP',NULL,NULL,NULL),(8,0,4693,'Bạch Kim II',22,'Chrome Wolf Omen, Rose Garden Lauriel, Sky Dance Arum',38,'LIENQUANRAMDOM/2.jpg','Giảm 5%, Bạch Kim full tướng xếp hạng, ổn định',NULL,NULL,NULL),(9,0,606,'Bạch Kim III',18,'Honey Bee Nata, Ice Queen Ilumia, Snow Bunny Mina',32,'LIENQUANRAMDOM/3.jpg','Giảm 25%, Bạch Kim skin dễ thương, phù hợp top lane',NULL,NULL,NULL),(10,0,554,'Thách Đấu',55,'Festival Dragon Zip, Golden Phoenix Ata, Space Explorer Zata, Royal Emperor Richter',68,'LIENQUANRAMDOM/4.jpg','Giảm 19%, Thách Đấu top rank, skin giá trị cao nhất server',NULL,NULL,NULL),(11,0,469,'Đồng III',5,'Basic Tulen, Starter Mina',15,'LIENQUANRAMDOM/20k.jpg','Tài khoản cơ bản, phù hợp luyện tập',NULL,NULL,NULL),(12,0,468,'Vàng I',10,'Street Racer Zuka, Classic Alice, Fire Spirit Diao Chan',25,'LIENQUANRAMDOM/50k.jpg','Giảm 40%, Vàng I nhiều tướng, giá rẻ nhất',NULL,NULL,NULL),(13,0,467,'Vàng III',8,'Dragon Scale Ryoma, Ancient Warrior Skud',22,'LIENQUANRAMDOM/100k.jpg','Vàng III, tài khoản sạch, phù hợp mới bắt đầu rank',NULL,NULL,NULL),(14,0,466,'Bạc II',6,'Classic Violet, Forest Spirit Yorn',18,'LIENQUANRAMDOM/200k.jpg','Bạc II, ít tướng nhưng giá thấp, phù hợp dùng main',NULL,NULL,NULL),(15,0,465,'Bạc III',7,'Bunny Nata, Festival Ormarr',20,'LIENQUANRAMDOM/1.jpg','Bạc III, account sạch email, dễ thay đổi thông tin',NULL,NULL,NULL),(16,0,464,'Đồng I',4,'Classic Omen, Default Butterfly',12,'LIENQUANRAMDOM/2.jpg','Đồng I, tài khoản mới, chưa bị ban',NULL,NULL,NULL);
/*!40000 ALTER TABLE `account_code_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `old_price` decimal(15,2) DEFAULT NULL,
  `status` enum('available','sold') DEFAULT 'available',
  `game_username` varchar(100) NOT NULL,
  `game_password` varchar(100) NOT NULL,
  `stock` int(11) DEFAULT 1,
  `buyer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `buyer_id` (`buyer_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (4,1,'Túi Mù 1 Nghìn','Tài khoản cực xịn','LIENQUANRAMDOM/tuimu.jpg',1000.00,2000.00,'available','random_user','random_pass',1371,NULL,'2026-06-09 20:08:04'),(5,1,'Túi Mù 20K','Tài khoản cực xịn','LIENQUANRAMDOM/20k.jpg',20000.00,40000.00,'available','random_user','random_pass',226,NULL,'2026-06-09 20:08:04'),(6,1,'Túi Mù 99K','Tài khoản cực xịn','LIENQUANRAMDOM/100k.jpg',99000.00,198000.00,'available','random_user','random_pass',3,NULL,'2026-06-09 20:08:04'),(7,1,'Túi Mù 299K','Tài khoản cực xịn','LIENQUANRAMDOM/200k.jpg',299000.00,598000.00,'available','random_user','random_pass',18,NULL,'2026-06-09 20:08:04'),(8,1,'Túi mù 699K','Tài khoản cực xịn','LIENQUANRAMDOM/4.jpg',699000.00,1398000.00,'available','random_user','random_pass',20,NULL,'2026-06-09 20:08:04'),(10,2,'Túi Mù FF 99K','Tài khoản Free Fire VIP','https://via.placeholder.com/400x200/FFC107/ffffff?text=Tui+Mu+FF+99k',99000.00,198000.00,'available','ff_user','ff_pass',1,NULL,'2026-06-09 20:08:04'),(11,2,'Túi Mù FF 199k','Tài khoản Free Fire VIP','https://via.placeholder.com/400x200/FF9800/ffffff?text=Tui+Mu+FF+199k',199000.00,398000.00,'available','ff_user','ff_pass',44,NULL,'2026-06-09 20:08:04'),(12,2,'Túi Mù FF 499K','Tài khoản Free Fire VIP','https://via.placeholder.com/400x200/F44336/ffffff?text=Tui+Mu+FF+499k',499000.00,998000.00,'available','ff_user','ff_pass',32,NULL,'2026-06-09 20:08:04'),(15,3,'NICK ROBOX FRUITS FULL GEAR 7 TỘC','Tài khoản Roblox siêu vip','FREE FIRE_GAMEKHAC.jpg/4.jpg',150000.00,300000.00,'available','roblox_user','roblox_pass',16,NULL,'2026-06-09 20:08:04'),(17,3,'ACC DRACO','Tài khoản Roblox siêu vip','BLOX FRUITS.jpg/1.jpg',200000.00,400000.00,'available','roblox_user','roblox_pass',19,NULL,'2026-06-09 20:08:04'),(20,6,'Random Acc 100% Có Dragon','100% DRAGON TRONG RƯƠNG. Tài khoản Anime Last Stand cực vip có sẵn Dragon và nhiều vật phẩm giá trị.','BLOX FRUITS.jpg/4.jpg',99000.00,198000.00,'available','als_user','als_pass',18,NULL,'2026-06-09 20:08:05'),(26,15,'Nick Tự Chọn Siêu Rẻ #9355','Trắng thông tin','DTCL_LIENMINH_VALORANT/4.jpg',35000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(27,15,'Nick Tự Chọn Siêu Rẻ #9356','Trắng thông tin','DTCL_LIENMINH_VALORANT/5.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(28,15,'Nick Tự Chọn Siêu Rẻ #9357','Trắng thông tin','DTCL_LIENMINH_VALORANT/6.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(29,15,'Nick Tự Chọn Siêu Rẻ #9358','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',35000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(30,15,'Nick Tự Chọn Siêu Rẻ #9359','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(31,15,'Nick Tự Chọn Siêu Rẻ #9360','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',35000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(32,15,'Nick Tự Chọn Siêu Rẻ #9361','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',20000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(33,15,'Nick Tự Chọn Siêu Rẻ #9362','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(34,15,'Nick Tự Chọn Siêu Rẻ #9363','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',20000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(35,15,'Nick Tự Chọn Siêu Rẻ #9364','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(36,15,'Nick Tự Chọn Siêu Rẻ #9365','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',20000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(37,15,'Nick Tự Chọn Siêu Rẻ #9366','Trắng thông tin','1780585670_Tìm Nick Theo Yêu Cầu.jpg',50000.00,50000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(38,8,'Nick VIP #5001','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(39,8,'Nick VIP #5002','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(40,8,'Nick VIP #5003','VIP Cao Cấp','1779355908_Nick VIP.jpg',300000.00,500000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(41,8,'Nick VIP #5004','VIP Cao Cấp','1779355908_Nick VIP.jpg',300000.00,500000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(42,8,'Nick VIP #5005','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(43,8,'Nick VIP #5006','VIP Cao Cấp','1779355908_Nick VIP.jpg',800000.00,1000000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(44,8,'Nick VIP #5007','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(45,8,'Nick VIP #5008','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(46,8,'Nick VIP #5009','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(47,8,'Nick VIP #5010','VIP Cao Cấp','1779355908_Nick VIP.jpg',800000.00,1000000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(48,8,'Nick VIP #5011','VIP Cao Cấp','1779355908_Nick VIP.jpg',300000.00,500000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(49,8,'Nick VIP #5012','VIP Cao Cấp','1779355908_Nick VIP.jpg',500000.00,700000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(50,9,'Nick Liên Quân REG #461','Trắng thông tin','lq_sieure_banner.png',400000.00,450000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(51,9,'Nick Liên Quân REG #462','Trắng thông tin','lq_sieure_banner.png',180000.00,230000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(52,9,'Nick Liên Quân REG #463','Trắng thông tin','lq_sieure_banner.png',180000.00,230000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(53,9,'Nick Liên Quân REG #464','Trắng thông tin','lq_sieure_banner.png',400000.00,450000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(54,9,'Nick Liên Quân REG #465','Trắng thông tin','lq_sieure_banner.png',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(55,9,'Nick Liên Quân REG #466','Trắng thông tin','lq_sieure_banner.png',400000.00,450000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(56,9,'Nick Liên Quân REG #467','Trắng thông tin','lq_sieure_banner.png',400000.00,450000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(57,9,'Nick Liên Quân REG #468','Trắng thông tin','lq_sieure_banner.png',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(58,9,'Nick Liên Quân REG #469','Trắng thông tin','lq_sieure_banner.png',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(59,9,'Nick Liên Quân REG #470','Trắng thông tin','lq_sieure_banner.png',400000.00,450000.00,'available','','',1,NULL,'2026-06-09 20:08:05'),(60,9,'Nick Liên Quân REG #471','Trắng thông tin','lq_sieure_banner.png',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(61,9,'Nick Liên Quân REG #472','Trắng thông tin','lq_sieure_banner.png',180000.00,230000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(62,17,'Nick Free Fire Tự Chọn #121','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(63,17,'Nick Free Fire Tự Chọn #122','VIP Free Fire','ff_tuchon_img.jpg',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(64,17,'Nick Free Fire Tự Chọn #123','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(65,17,'Nick Free Fire Tự Chọn #124','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(66,17,'Nick Free Fire Tự Chọn #125','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(67,17,'Nick Free Fire Tự Chọn #126','VIP Free Fire','ff_tuchon_img.jpg',100000.00,150000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(68,17,'Nick Free Fire Tự Chọn #127','VIP Free Fire','ff_tuchon_img.jpg',100000.00,150000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(69,17,'Nick Free Fire Tự Chọn #128','VIP Free Fire','ff_tuchon_img.jpg',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(70,17,'Nick Free Fire Tự Chọn #129','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(71,17,'Nick Free Fire Tự Chọn #130','VIP Free Fire','ff_tuchon_img.jpg',300000.00,350000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(72,17,'Nick Free Fire Tự Chọn #131','VIP Free Fire','ff_tuchon_img.jpg',200000.00,250000.00,'available','','',1,NULL,'2026-06-09 20:08:06'),(73,17,'Nick Free Fire Tự Chọn #132','VIP Free Fire','ff_tuchon_img.jpg',100000.00,150000.00,'available','','',1,NULL,'2026-06-09 20:08:06');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `old_price` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Liên Quân','Túi mù + nick tự chọn','lien-quan',NULL,NULL,NULL),(2,NULL,'Free Fire','Túi mù + nick tự chọn','free-fire',NULL,NULL,NULL),(3,NULL,'Nick Roblox','Túi mù + nick tự chọn','nick-roblox',NULL,NULL,NULL),(4,NULL,'Liên Minh + TFT','Liên Minh + TFT','lien-minh-tft',NULL,NULL,NULL),(5,NULL,'Các Game Khác','Nick Nhiều Game','cac-game-khac',NULL,NULL,NULL),(6,NULL,'Dịch Vụ Anime Last Stand','','dich-vu-anime-last-stand',NULL,NULL,NULL),(7,1,'Nick Tự Chọn Siêu Rẻ',NULL,'nick-tu-chon-sieu-re','1779355908_Nick VIP.jpg',0.00,0.00),(8,1,'Nick VIP',NULL,'nick-vip','https://via.placeholder.com/400x200/FF9800/ffffff?text=Nick+VIP',0.00,0.00),(9,1,'Nick Liên Quân REG',NULL,'nick-lien-quan-reg','1779355908_Nick VIP.jpg',0.00,0.00),(10,1,'Túi Mù 1 Nghìn',NULL,'tui-mu-1-nghin','menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg',1000.00,2000.00),(11,1,'Túi Mù 20K',NULL,'tui-mu-20k','menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg',20000.00,40000.00),(12,1,'Túi Mù 99K',NULL,'tui-mu-99k','1779355920_Nick BLOX FRUITS.jpg',99000.00,198000.00),(13,1,'Túi Mù 299K',NULL,'tui-mu-299k','menugame/anh-linh-thu-dau-truong-chan-ly-1.jpg',299000.00,598000.00),(14,1,'Túi mù 699K',NULL,'tui-mu-699k','menugame/7.jpg',699000.00,1398000.00),(15,1,'Nick Tự Chọn Siêu Rẻ','','nick-t-ch-n-si-u-r-','https://via.placeholder.com/400x200/4CAF50/ffffff?text=Nick+Tu+Chon',NULL,NULL),(16,1,'Nick Liên Quân REG','','nick-li-n-qu-n-reg','https://via.placeholder.com/400x200/2196F3/ffffff?text=Nick+REG',NULL,NULL),(17,2,'Nick Free Fire tự chọn','','nick-free-fire-t-ch-n','https://via.placeholder.com/400x200/FF5722/ffffff?text=Free+Fire+Tu+Chon',NULL,NULL),(18,3,'ACC FISCH TỰ CHỌN','','acc-fisch-t-ch-n','https://via.placeholder.com/400x200/00bcd4/ffffff?text=ACC+FISCH',NULL,NULL),(19,3,'Nick BLOX FRUITS','','nick-blox-fruits','https://via.placeholder.com/400x200/4caf50/ffffff?text=BLOX+FRUITS',NULL,NULL),(20,3,'ACC GROW A GARDEN','','acc-grow-a-garden','https://via.placeholder.com/400x200/8bc34a/ffffff?text=GROW+A+GARDEN',NULL,NULL),(21,4,'Nick TFT Tự chọn','','nick-tft-t-ch-n','https://via.placeholder.com/400x200/9C27B0/ffffff?text=Nick+TFT+Tu+Chon',NULL,NULL),(22,4,'Nick Liên Minh Tự Chọn','','nick-li-n-minh-t-ch-n','https://via.placeholder.com/400x200/3F51B5/ffffff?text=Nick+LMHT+Tu+Chon',NULL,NULL),(23,5,'Nick PUBG MOBILE','','nick-pubg-mobile','https://via.placeholder.com/400x200/2196F3/ffffff?text=PUBG+MOBILE',NULL,NULL),(24,5,'Nick GENSHIN IMPACT','','nick-genshin-impact','https://via.placeholder.com/400x200/9c27b0/ffffff?text=GENSHIN+IMPACT',NULL,NULL),(25,5,'NICK VALORANT','','nick-valorant','https://via.placeholder.com/400x200/ff5722/ffffff?text=VALORANT',NULL,NULL),(26,5,'Nick FO4','','nick-fo4','https://via.placeholder.com/400x200/4caf50/ffffff?text=FIFA+Online+4',NULL,NULL),(27,5,'FC MOBILE','','fc-mobile','https://via.placeholder.com/400x200/ff9800/ffffff?text=FC+MOBILE',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Uy tín của shop',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'ShopMCuong - Chuyên Bán Nick Game Liên Quân và Free Fire Uy Tín','shopmcuong-chuyen-ban-nick-game-lien-quan-va-free-fire-uy-tin','news_shopmcuong.png','ShopMCuong - Chuyên Bán Nick Game Liên Quân và Free Fire Uy Tín. ShopMCuong.com là nơi bạn có thể tìm thấy những nick game Liên Quân và Free...','<h3>ShopMCuong - Địa chỉ mua bán nick Liên Quân & Free Fire uy tín hàng đầu</h3><p>ShopMCuong.com tự hào là điểm đến tin cậy của hàng nghìn game thủ trên khắp cả nước. Chúng tôi cung cấp các dịch vụ đa dạng bao gồm:</p><ul><li>Bán nick Liên Quân Mobile giá rẻ, acc có nhiều tướng và skin hot.</li><li>Bán nick Free Fire cực ngon, đầy đủ các loại súng nâng cấp.</li><li>Túi mù thử vận may với cơ hội trúng acc VIP cực cao chỉ với 1.000đ, 20.000đ.</li></ul><p>Đến với ShopMCuong.com, bạn hoàn toàn có thể yên tâm về chất lượng giao dịch tự động, nhanh chóng và chế độ bảo hành tài khoản trọn đời.</p>','Uy tín của shop','2026-03-04 07:08:05'),(2,'Cách Nhận Nick Free Fire Miễn Phí Và Tránh Bị Lừa Đảo','cach-nhan-nick-free-fire-mien-phi-va-tranh-bi-lua-dao','menugame/Hinh-nen-free-fire-3d-huyen-thoai.jpg','Tìm hiểu các phương pháp nhận tài khoản Free Fire miễn phí an toàn, và cách phòng tránh các website lừa đảo chiếm đoạt tài khoản game của bạn.','<p>Hiện nay có rất nhiều trang web giả mạo tặng nick Free Fire miễn phí để lừa đảo thông tin người dùng. Hãy cùng ShopGaming tìm hiểu cách bảo vệ tài khoản của bạn khỏi các chiêu trò lừa đảo tinh vi...</p><h4>Cách nhận diện trang web lừa đảo:</h4><ul><li>Yêu cầu nhập mật khẩu tài khoản Garena hoặc Facebook trực tiếp trên các web lạ không thuộc Garena.</li><li>Hứa hẹn tặng vật phẩm, kim cương số lượng lớn miễn phí.</li><li>Giao diện web sơ sài, sai chính tả, không có mã số thuế hoặc thông tin liên hệ rõ ràng.</li></ul>','Hướng dẫn','2026-03-05 02:30:15'),(3,'Bí Quyết Mua Túi Mù Tỷ Lệ Trúng Nick VIP Cao Nhất','bi-quyet-mua-tui-mu-ty-le-trung-nick-vip-cao-nhat','menugame/3.jpg','Chia sẻ kinh nghiệm săn túi mù Liên Quân và Free Fire tại ShopGaming để dễ dàng nhận được nick có tướng và trang phục giới hạn siêu xịn.','<p>Túi mù đang là trào lưu cực hot tại ShopGaming với mức giá siêu hạt dẻ chỉ từ 1.000đ. Để gia tăng tỷ lệ mở được tài khoản ngon, bạn nên tham khảo các khung giờ vàng và mẹo lựa chọn dưới đây.</p><h4>Mẹo nhỏ cho game thủ:</h4><ol><li><strong>Mua số lượng lớn cùng lúc:</strong> Thay vì mua lẻ tẻ, hãy mua theo combo từ 5-10 túi để tăng cơ hội trúng acc ngon.</li><li><strong>Săn giờ vàng:</strong> Các khung giờ 12h trưa hoặc 20h tối là thời điểm admin cập nhật thêm acc VIP vào hệ thống.</li><li><strong>Đọc kỹ mô tả:</strong> Mỗi loại túi mù đều có tỷ lệ trúng và danh sách phần quà khác nhau.</li></ol>','Kinh nghiệm chơi','2026-03-06 11:24:40');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` enum('deposit','purchase') NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `trans_id` varchar(100) DEFAULT NULL,
  `network` varchar(50) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `declared_value` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `balance` decimal(15,2) DEFAULT 0.00,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$6GFvdvU8Tgld.76iql6dmO5.9XDOXX4/ot95kiHJawnsoJtXdFXtq','admin@shopaccgame.com',10000000.00,'admin','2026-06-09 20:08:03'),(2,'user','$2y$10$KmCso2YvrUbkzUmbDnRJfeVnJXXTYRQq5ARBfX.RefLPZz1T3PZuW','user@shopaccgame.com',500000.00,'user','2026-06-09 20:08:04');
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

-- Dump completed on 2026-06-10 15:28:38
