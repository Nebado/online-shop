-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.7.30

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'ELECTRONICS',1,1),(2,'CLOTHES',1,1),(3,'FOODS AND BEVERAGES',1,1),(4,'HEALTH & BEAUTY\r\n',1,1),(5,'SPORTS & LEISURE',1,1),(6,'BOOKS & ENTERTAINMENTS',1,1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_new` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Iphone 7','34561','Apple',500,NULL,'Just Apple Phone',1,1,1,1,1,NULL,1),(2,'Samsung S8','23411','Samsung',700,NULL,'Samsung is the best',1,1,1,1,1,NULL,1),(3,'LG','178375','LG',565,NULL,'LG is okey',1,1,1,1,1,NULL,1),(4,'Rasper','28341','Rasper',1000,NULL,'Rasper is inovation in the world',1,1,1,1,1,NULL,1),(5,'Lenovo R33','234141','Lenovo',145,NULL,'Lenovo',1,1,1,1,1,NULL,1),(6,'Fly A38','32424','Fly',180,NULL,'Fly',1,1,1,1,1,NULL,1),(7,'Sony S1','23841','Sony',494,NULL,'Company Sony',1,1,1,1,1,NULL,1),(8,'Dell XPS 15','24324','Dell',3000,NULL,'Company Dell',1,2,1,1,1,NULL,1),(9,'LG X38','23432','LG',1300,NULL,'Company LG',1,2,1,1,1,NULL,1),(10,'HP Probook 14','3848','HP',1003,NULL,'Company HP',1,2,1,1,1,NULL,1),(11,'Lenovo SP2','3844','Lenovo',800,NULL,'Company Lenovo',1,2,1,1,1,NULL,1),(12,'Honor R48','37472','Honor',3000,NULL,'Company Honor',1,2,1,1,1,NULL,1),(13,'Acer Ri38','388421','Acer',3000,NULL,'Company Acer',1,2,1,1,1,NULL,1),(14,'Stream Q5','324235','Stream',10000,NULL,'Company Stream',1,2,1,1,1,NULL,1),(15,'Canon A3','34234','Canon ',5000,NULL,'Company Canon',1,3,1,1,1,NULL,1),(16,'Nikon R8','34324','Nikon',2853,NULL,'Company Nikon',1,3,1,1,1,NULL,1),(17,'Eos Range','342421','Fjiame',3000,NULL,'Company Fjiame',1,1,1,1,1,NULL,1),(18,'Midrange D2','34242','Midrange ',4000,NULL,'Company Midrange ',1,3,1,1,1,NULL,1),(19,'Lumix TI3','115543','Lumix',5000,NULL,'Company Lumix',1,3,1,1,1,NULL,1),(20,'Rosa Ki 10','237415','Rosa ',4300,NULL,'Company Rosa',1,3,1,1,1,NULL,1),(21,'Sand T14','3424','Sand ',3002,NULL,'Company Sand',1,3,1,1,1,NULL,1),(22,'Yeti R7','2384','Yeti ',2000,NULL,'Company Yeti',1,1,1,1,1,NULL,1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (1,'John','38035828858','Call me.',0,'2020-05-18 15:25:17','{\"52\":3,\"51\":1}',3);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_category`
--

LOCK TABLES `sub_category` WRITE;
/*!40000 ALTER TABLE `sub_category` DISABLE KEYS */;
INSERT INTO `sub_category` VALUES (1,'Mobile Phones',1,1,1),(2,'Computers, Tablets & Laptop',1,1,1),(3,'Cameras',1,1,1),(4,'Sound & Visions',1,1,1),(5,'Women\'s Clothing',1,2,1),(6,'Women\'s Shoes',1,2,1),(7,'Women\'s Hand Bags',1,2,1),(8,'Men\'s Clothing',1,2,1),(9,'Men\'s Shoes',1,2,1),(10,'Kids Clothing',1,2,1);
/*!40000 ALTER TABLE `sub_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postcode` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `additional_info` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','Rocket','admin@admin.web','123456','2000-01-08','Rosy inc.','street 23','New York','Arizona',2858285,'USA','Additional information','3777777777773','2020-05-14 09:05:42',1,'admin'),(2,'Rop','Loco','loco@mga.com','123456','2008-01-12','Cop','street 282','San Diego','[\"5\"]',18385,'[\"1\"]','Additional information','123456789123','2020-05-14 12:38:02',1,NULL),(3,'Test','Test','test@gmail.com','123456','2011-11-11','Test','test','Test','[\"1\"]',1341516,'[\"1\"]','test','12345678912','2020-05-14 14:49:46',1,NULL),(4,'Rony','Locky','rony@gma.com','123456','2012-12-12','Rony','street 211','New York','[\"1\"]',1315151,'[\"1\"]','TEST','123456789121','2020-05-14 14:51:56',1,NULL);
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

-- Dump completed on 2020-06-15 19:06:00
