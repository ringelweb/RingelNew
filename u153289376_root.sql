-- MySQL dump 10.16  Distrib 10.1.24-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u153289376_root
-- ------------------------------------------------------
-- Server version	10.1.24-MariaDB

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
-- Table structure for table `buyer_info`
--

DROP TABLE IF EXISTS `buyer_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyer_info` (
  `buyerid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `buyername` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profilepic` varchar(255) NOT NULL,
  PRIMARY KEY (`buyerid`),
  KEY `buyerid` (`buyerid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyer_info`
--

/*!40000 ALTER TABLE `buyer_info` DISABLE KEYS */;
INSERT INTO `buyer_info` VALUES (1,'mahesh.susarla96@gmail.com','Mahesh','9703515596','Chennai','male','Screen Shot 2017-07-01 at 17.03.04.png'),(2,'vineela.aari@gmail.com','Vineela','9177696908','Gachibowli','female','furniture2.jpeg'),(3,'xyzabc@gmail.com','XyzAbc','7893020209','Chennai','Male',' '),(17,'inayat.rdec@gmail.com','inayat hussain','1111111164','XXXXXXXXXXXXX','male','b23f13bcc13ceff02e76111321fd0c1f--motivational-monday-quotes-inspirational-love-quotes.jpg'),(19,'ianyat.rddd@hh.com','sonam','9311982277','muradnagar','male','shop.png'),(20,'admin@admin.com','i am admin','9311982278','noida','male',' '),(21,'','inayat','','','male',' ');
/*!40000 ALTER TABLE `buyer_info` ENABLE KEYS */;

--
-- Table structure for table `buyer_users`
--

DROP TABLE IF EXISTS `buyer_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyer_users` (
  `buyerid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`buyerid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyer_users`
--

/*!40000 ALTER TABLE `buyer_users` DISABLE KEYS */;
INSERT INTO `buyer_users` VALUES (1,'Manasa Susarla','371728046053dc6c91e5d286f967d9ee'),(2,'Vineela Aari','28d58b23474397087b3674f4901955a2'),(3,'Xyz Abc','472dc90ed439d118ad3a205dda96eaf0'),(11,'sarfarazhussain','25f9e794323b453885f5181f1b624d0b'),(12,'admin','d41d8cd98f00b204e9800998ecf8427e'),(13,'inayatLovely','f6d36264d64afe7485f65854cf5c1f3c'),(14,'inayaasfffffsaf','d98bcb28df1de541e95a6722c5e983ea'),(15,'ffffffff','e10adc3949ba59abbe56e057f20f883e'),(16,'inayat','f964515faff55e772c6212fcbe4c76f2'),(17,'adminadmin','d41d8cd98f00b204e9800998ecf8427e'),(18,'testtest','d41d8cd98f00b204e9800998ecf8427e'),(19,'javajava','d41d8cd98f00b204e9800998ecf8427e'),(20,'amul','badbe6f8bff5f4e9863904fbe413988e'),(21,'testing','ae2b1fca515949e5d54fb22b8ed95575'),(22,'qwerty','fa3cae44adc77ebb22255501a5e07ee8'),(23,'abc','e99a18c428cb38d5f260853678922e03'),(24,'adminnew','d3698036132b78ae31c3f03d377758d8'),(25,'loveme','74d738020dca22a731e30058ac7242ee');
/*!40000 ALTER TABLE `buyer_users` ENABLE KEYS */;

--
-- Table structure for table `org_info`
--

DROP TABLE IF EXISTS `org_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_info` (
  `sellerid` int(11) NOT NULL AUTO_INCREMENT,
  `orgname` varchar(40) NOT NULL,
  `category` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `siteurl` text NOT NULL,
  `coverimage` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`sellerid`),
  KEY `sellerid` (`sellerid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_info`
--

/*!40000 ALTER TABLE `org_info` DISABLE KEYS */;
INSERT INTO `org_info` VALUES (1,'Lifestyle','clothing','Vizag','7416791415','lifestyle1234@gmail.com','https://www.lifestylestore1.com','intro-bg_1_.jpg','Summer Sale has started'),(2,'WestSide','clothing','Mumbai','9999999999','westside@gmail.com','http://www.westsidestore.com','images.jpeg','New Collection Launched'),(3,'DAMN','FOOD','NOIDA','9311982278','inayat.rdec@gmail.com','http://www.google.com','feeling-feelings-hard-hard-life-Favim.com-1039643.jpg','inayat'),(4,'dsadsads','sdadsada','jhuhuhuhuhuhu','9311982278','i@h.c','http://www.goe.com','','kk'),(5,'inayat','ok','dasdad','9311982278','xyz.asdf@gmail.com','http://www.gssoe.com','','dasdas'),(6,'OPERA','bcebc','dasdas','5451545515','pp@gmail.com','http://dsjbhvhbasd.com','','dasdad'),(7,'sdalnjknjnjknadasd','dasnjnjsda','sadada','9069448198','','','IMG-20170810-WA0012.jpeg','dsada'),(8,'','','','9311982284','','','',''),(9,'ola store','taxi','ghaziabad','7894589658','inayat.ec@gmail.com','http://jio.com','butterfly-silhouette-10-48-242206.png','best store for mobile'),(10,'inayat','zzzzzzzzz','','7894589658','u@g.ciom','http://da.com','',''),(11,'ola taxi','taxi','ASDdffffffss','9393939393','ola@gmail.com','http://www.ola.com','IMG-20170809-WA0003.jpg','taxi service');
/*!40000 ALTER TABLE `org_info` ENABLE KEYS */;

--
-- Table structure for table `product_info`
--

DROP TABLE IF EXISTS `product_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_info` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `sellerid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productimage` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productid`),
  KEY `sellerid` (`sellerid`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_info`
--

/*!40000 ALTER TABLE `product_info` DISABLE KEYS */;
INSERT INTO `product_info` VALUES (1,1,'sony camera','6.jpg','digital','30','Great Camera',NULL),(2,1,'fossil watch','10.jpg','digital','5','metal',NULL),(3,1,'DSLR','1.jpg','digital','30','Sony Camera',NULL),(4,2,'Van Heusen','22.jpg','clothing','10','STriped shirt',NULL),(8,2,'Louis Vuitton Shirt','25.jpg','clothing','30','White shirt',NULL),(28,7,'fd','b53927e8645435354415ae975b7dedd8--cheated-on-quotes-cheating-quotes.jpg','fd','4','f','2017-07-25 23:38:36'),(29,7,'fafa','continue.png','fafa44','33','afsa','2017-07-26 22:28:56'),(30,10,'certificate','20287097_1395323147188958_3625603435780262480_o.jpg','xxxx','7','certificate issued by IRCTC .well begin awith the demo here','2017-07-27 09:31:59'),(31,11,'boomer','IMG-20170809-WA0003.jpg','taxi','5','dsadad','2017-08-14 12:47:21');
/*!40000 ALTER TABLE `product_info` ENABLE KEYS */;

--
-- Table structure for table `product_likes`
--

DROP TABLE IF EXISTS `product_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `Buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  PRIMARY KEY (`like_id`),
  UNIQUE KEY `unique_index` (`product_id`,`Buyer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_likes`
--

/*!40000 ALTER TABLE `product_likes` DISABLE KEYS */;
INSERT INTO `product_likes` VALUES (35,1,1,20),(37,2,1,20),(38,28,7,20),(47,8,2,19),(48,1,19,1),(50,2,19,1),(51,28,19,7),(57,3,19,1),(62,4,19,2),(67,8,19,2),(68,30,19,10),(69,28,22,7),(70,1,22,1),(71,1,23,1),(72,1,24,1),(73,2,24,1);
/*!40000 ALTER TABLE `product_likes` ENABLE KEYS */;

--
-- Table structure for table `productreview`
--

DROP TABLE IF EXISTS `productreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productreview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `buyerid` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productreview`
--

/*!40000 ALTER TABLE `productreview` DISABLE KEYS */;
INSERT INTO `productreview` VALUES (56,1,1,19,'dddd'),(57,28,7,19,'okok'),(58,4,2,19,'good'),(59,1,1,19,'ssssssssssss'),(60,1,1,19,'ianysst'),(61,1,1,19,'ok'),(62,1,1,19,'good quality'),(63,1,1,19,'ok'),(64,1,1,19,'XX'),(65,1,1,19,'send'),(66,2,1,19,'fsnfs'),(67,2,1,19,'fsnfs'),(68,30,10,19,'best product'),(69,2,1,19,'ADF'),(70,1,1,19,'very bad camera .'),(71,31,11,19,'hhggj'),(72,3,1,24,'inahaytdgdhdfbncjf'),(73,1,1,24,'camera dha hai'),(74,31,11,25,'jshhdf');
/*!40000 ALTER TABLE `productreview` ENABLE KEYS */;

--
-- Table structure for table `pvt_msgs`
--

DROP TABLE IF EXISTS `pvt_msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pvt_msgs` (
  `msgid` int(11) NOT NULL AUTO_INCREMENT,
  `_to` varchar(255) NOT NULL,
  `_from` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `_read` varchar(3) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msgid`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvt_msgs`
--

/*!40000 ALTER TABLE `pvt_msgs` DISABLE KEYS */;
INSERT INTO `pvt_msgs` VALUES (38,'1','javajava','amskmkkmkm','no','2017-07-25 23:00:22'),(39,'1','javajava','ssssssssssssssssssss','no','2017-07-25 23:00:41'),(40,'1','javajava','ssssssssssssssssssss','no','2017-07-25 23:01:33'),(41,'1','','fuck you','no','2017-07-26 01:37:06'),(42,'1','javajava','fuck you','no','2017-07-26 01:39:45'),(43,'4','javajava','ok','no','2017-07-26 01:42:00'),(44,'4','javajava','lk','no','2017-07-26 01:43:10'),(45,'4','javajava','lk','no','2017-07-26 01:48:34'),(46,'7','javajava','hlo b','no','2017-07-26 01:48:44'),(47,'7','javajava','hlo b','no','2017-07-26 01:59:57'),(48,'1','javajava','plplp','no','2017-07-26 12:17:16'),(49,'1','javajava','inaya','no','2017-07-26 12:21:21'),(50,'7','javajava','inayatttt','no','2017-07-26 12:21:45'),(51,'1','javajava','message\r\n','no','2017-07-26 12:38:53'),(52,'1','javajava','message\r\n','no','2017-07-26 12:45:30'),(53,'1','javajava','dasd','no','2017-07-26 13:57:17'),(54,'7','javajava','','no','2017-07-26 15:55:53'),(55,'1','javajava','rewrw','no','2017-07-26 17:32:08'),(56,'1','javajava','hii','no','2017-07-26 22:08:15'),(57,'1','javajava','','no','2017-07-26 23:43:30'),(58,'10','javajava','heo','no','2017-07-27 09:37:33'),(59,'7','javajava','hlo','no','2017-07-27 09:39:56'),(60,'1','javajava','Hi','no','2017-07-28 15:37:21'),(61,'1','javajava','fsedskh','no','2017-08-01 12:52:33'),(62,'1','javajava','fsedskh','no','2017-08-01 12:54:24'),(63,'11','javajava','jola','no','2017-08-20 04:17:52');
/*!40000 ALTER TABLE `pvt_msgs` ENABLE KEYS */;

--
-- Table structure for table `seller_accinfo`
--

DROP TABLE IF EXISTS `seller_accinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seller_accinfo` (
  `sellerid` int(11) NOT NULL,
  `bankaccount` varchar(255) NOT NULL,
  `ifsc` varchar(255) NOT NULL,
  `holdername` varchar(255) NOT NULL,
  `branchaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`sellerid`),
  KEY `sellerid` (`sellerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller_accinfo`
--

/*!40000 ALTER TABLE `seller_accinfo` DISABLE KEYS */;
INSERT INTO `seller_accinfo` VALUES (1,'1234567891567807979','7777777777777777777','Vineela Aari','Chaitanya Bharathi Institute Of Technology, Gandipet'),(7,'','','','');
/*!40000 ALTER TABLE `seller_accinfo` ENABLE KEYS */;

--
-- Table structure for table `seller_follow`
--

DROP TABLE IF EXISTS `seller_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seller_follow` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `sellerid` int(11) NOT NULL,
  `buyerid` int(11) NOT NULL,
  PRIMARY KEY (`followid`),
  KEY `sellerid` (`sellerid`),
  KEY `buyerid` (`buyerid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller_follow`
--

/*!40000 ALTER TABLE `seller_follow` DISABLE KEYS */;
INSERT INTO `seller_follow` VALUES (1,1,3),(5,2,3),(6,10,0),(7,2,0);
/*!40000 ALTER TABLE `seller_follow` ENABLE KEYS */;

--
-- Table structure for table `seller_info`
--

DROP TABLE IF EXISTS `seller_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seller_info` (
  `sellerid` int(11) NOT NULL AUTO_INCREMENT,
  `ownername` varchar(80) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `bank_details_filled` varchar(3) NOT NULL,
  PRIMARY KEY (`sellerid`),
  KEY `sellerid` (`sellerid`),
  KEY `sellerid_2` (`sellerid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller_info`
--

/*!40000 ALTER TABLE `seller_info` DISABLE KEYS */;
INSERT INTO `seller_info` VALUES (1,'Manasa Susarla','Female','1996-06-21','Dilsukhnagar','','vineela.aari@gmail.com','yes'),(2,'Vineela AAari','Female','2017-06-17','Mumbai','7416791415','vinee.aari@gmail.com','no'),(3,'inayat','Male','2017-07-12','dsadsad','9311982278','ini@gmail.com','no'),(4,'ksnkands','Male','2017-07-25','snjdnjsfs','9069448198','inayat.rdec@gmail.com','no'),(5,'jaydeep','Male','2017-07-25','dasda','9311999959','iniiiiii@gmail.com','no'),(6,'dsajjbkbasdvh','Male','2017-07-18','dsadad','9311982278','inayat@h.com','no'),(7,'ajj sjajs','Male','2017-07-19','dasdadadsdadqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq','','oopp@gmail.com','yes'),(8,'','Male','0000-00-00','','9069448198','inayat@gmail.com','no'),(9,'inayat hussain','Male','2017-07-12','ghaziabad','7854785698','ianyat.rfff@gmail.com','no'),(10,'dddddddddddddddd','Male','0000-00-00','','9888888888','t@m.com','no'),(11,'avishek rawat','Male','2017-08-18','dasdsad','9633696666','abc@gmail.com','no');
/*!40000 ALTER TABLE `seller_info` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'lifestyle123','db01ee8b798b3f9593c111b7b2fcde27'),(2,'vineela123','87aa6f0e31737011537be8a7801c3437'),(3,'inayat786','827ccb0eea8a706c4c34a16891f84e7b'),(4,'inayat','827ccb0eea8a706c4c34a16891f84e7b'),(5,'inayat.asdf@gmail.com','827ccb0eea8a706c4c34a16891f84e7b'),(6,'pkchaudhary','79bed72e8b80e5b238d7de3597e38335'),(7,'admin','e03cdad1a6e43d6ab3a07089801fb723'),(8,'iam mad','827ccb0eea8a706c4c34a16891f84e7b'),(9,'olastore','78a744a47c3fd273622ac26b18436d7f'),(10,'inayatqwerty','71b3b26aaa319e0cdf6fdb8429c112b0'),(11,'avishek','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-04 11:25:17
