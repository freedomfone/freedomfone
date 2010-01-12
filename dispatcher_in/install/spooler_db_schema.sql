-- MySQL dump 10.11
--
-- Host: localhost    Database: spooler_in
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny2

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
-- Table structure for table `bin`
--

DROP TABLE IF EXISTS `bin`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` varchar(200) default NULL,
  `Body` varchar(200) default NULL,
  `status` tinyint(1) default '0',
  `from` varchar(100) default NULL,
  `login` varchar(50) default NULL,
  `proto` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `callback_in`
--

DROP TABLE IF EXISTS `callback_in`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `callback_in` (
  `id` int(10) unsigned NOT NULL auto_increment,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cdr`
--

DROP TABLE IF EXISTS `cdr`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cdr` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` varchar(200) default NULL,
  `Channel-State` varchar(50) default NULL,
  `Channel-State-Number` varchar(100) default NULL,
  `Unique-ID` varchar(50) default NULL,
  `Caller-Caller-ID-Name` smallint(6) default NULL,
  `Caller-Caller-ID-Number` smallint(6) default NULL,
  `Caller-Destination-Number` varchar(50) default NULL,
  `Caller-Unique-ID` varchar(50) default NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `lm_in`
--

DROP TABLE IF EXISTS `lm_in`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `lm_in` (
  `id` int(10) unsigned NOT NULL auto_increment,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `monitor_ivr`
--

DROP TABLE IF EXISTS `monitor_ivr`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `monitor_ivr` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` varchar(200) default NULL,
  `FF-IVR-Unique-ID` varchar(100) default NULL,
  `FF-IVR-IVR-Name` varchar(50) default NULL,
  `FF-IVR-IVR-Node-Digit` smallint(6) default '0',
  `FF-IVR-IVR-Node-Unique-ID` smallint(6) default '0',
  `FF-IVR-Caller-ID-Number` varchar(50) default NULL,
  `FF-IVR-Destination-Number` varchar(50) default NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `poll_in`
--

DROP TABLE IF EXISTS `poll_in`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poll_in` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Event-Subclass` varchar(50) default NULL,
  `FreeSWITCH-IPv4` varchar(200) default NULL,
  `Event-Date-Timestamp` varchar(200) default NULL,
  `Body` varchar(200) default NULL,
  `status` tinyint(1) default '0',
  `from` varchar(100) default NULL,
  `login` varchar(50) default NULL,
  `proto` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-01-12 17:49:14
