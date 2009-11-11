-- MySQL dump 10.11
--
-- Host: localhost    Database: spooler_in
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny2
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `callback_in`
--
use spooler_in;

SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `callback_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` bigint(20) unsigned default NULL,
  `login` varchar(50) default NULL,
  `proto` varchar(10) default NULL,
  `from` varchar(100) default NULL,
  `FF-StartTimeEpoch` bigint(20) unsigned default NULL,
  `FF-FinishTimeEpoch` bigint(20) default NULL,
  `FF-CallerID` varchar(50) default '0',
  `FF-CallerName` varchar(50) default '0',
  `FF-To` varchar(100) default NULL,
  `FF-InstanceID` int(6) default NULL,
  `Body` varchar(160) default NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
);
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `lm_in`
--

SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `lm_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` bigint(20) unsigned default NULL,
  `FF-URI` varchar(150) default NULL,
  `FF-InstanceID` smallint(6) default NULL,
  `FF-FileID` varchar(200) default NULL,
  `FF-CallerID` tinyint(5) default '0',
  `FF-CallerName` varchar(50) default NULL,
  `FF-StartTimeEpoch` bigint(20) unsigned default NULL,
  `FF-FinishTimeEpoch` bigint(20) unsigned default NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
);
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `poll_in`
--

SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poll_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` varchar(200) default NULL,
  `Body` varchar(200) default NULL,
  `status` tinyint(1) default '0',
  `sender` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
);
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-10-15 10:44:46
