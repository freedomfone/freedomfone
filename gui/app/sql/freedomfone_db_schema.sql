-- MySQL dump 10.11
--
-- Host: localhost    Database: freedomfone
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5.5

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
-- Table structure for table `acls`
--

DROP TABLE IF EXISTS `acls`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `acls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `acls`
--

LOCK TABLES `acls` WRITE;
/*!40000 ALTER TABLE `acls` DISABLE KEYS */;
INSERT INTO `acls` VALUES (1,'None','No criteria'),(2,'White','Allow always'),(3,'Black','Deny always');
/*!40000 ALTER TABLE `acls` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `batches`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `batches` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `sender` varchar(50) NOT NULL,
  `body` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gateway_type` varchar(5) NOT NULL,
  `gateway_id` varchar(50) NOT NULL,
  `created` int(11) unsigned  NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `bin`
--

DROP TABLE IF EXISTS `bin`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `instance_id` int(6) NOT NULL,
  `body` varchar(200) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `created` int(10) unsigned default NULL,
  `mode` varchar(50) default NULL,
  `proto` varchar(25) default NULL,
  `channel` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `longname` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
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
  `channel_state` varchar(50) default NULL,
  `epoch` int(10) unsigned default NULL,
  `call_id` varchar(100) NOT NULL,
  `caller_name` varchar(50) default NULL,
  `caller_number` varchar(50) default NULL,
  `extension` smallint(6) default NULL,
  `application` varchar(50) default NULL,
  `proto` varchar(10) default NULL,
  `length` int(11) unsigned default '0',
  `user_id` int(11) unsigned default NULL,
  `title` varchar(100) default NULL,
  `quick_hangup` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `channels` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `epoch` int(11) unsigned default NULL,
  `interface_name` varchar(50) default NULL,
  `interface_id` smallint(6) default NULL,
  `active` tinyint(1) default NULL,
  `not_registered` tinyint(1) default NULL,
  `home_network_registered` tinyint(1) default NULL,
  `roaming_registered` tinyint(1) default NULL,
  `got_signal` smallint(6) default NULL,
  `running` tinyint(1) default NULL,
  `imei` varchar(100) default NULL,
  `imsi` varchar(100) default NULL,
  `controldev_dead` tinyint(1) default NULL,
  `controldevice_name` varchar(50) default NULL,
  `no_sound` tinyint(1) default NULL,
  `playback_boost` float(8,3) default NULL,
  `capture_boost` float(8,3) default NULL,
  `ib_calls` int(6) default NULL,
  `ob_calls` int(6) default NULL,
  `ib_failed_calls` int(6) default NULL,
  `ob_failed_calls` int(6) default NULL,
  `interface_state` int(6) default NULL,
  `phone_callflow` int(6) default NULL,
  `during-call` tinyint(1) default NULL,
  `sim_inserted` varchar(20) default NULL,
  `title` varchar(50) default NULL,
  `msisdn` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `ivr_menus`
--

DROP TABLE IF EXISTS `ivr_menus`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ivr_menus` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `instance_id` int(6) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message_long` text,
  `message_short` text,
  `message_exit` text,
  `message_invalid` text,
  `file_long` text,
  `file_short` text,
  `file_exit` text,
  `file_invalid` text,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  `mode_long` tinyint(1) default '0',
  `mode_short` tinyint(1) default '0',
  `mode_exit` tinyint(1) default '0',
  `mode_invalid` tinyint(1) default '0',
  `switcher_type` varchar(50) NOT NULL,
  `ivr_type` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `lm_menus`
--

DROP TABLE IF EXISTS `lm_menus`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `lm_menus` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `lmWelcomeMessage` text,
  `lmInformMessage` text,
  `lmInvalidMessage` text,
  `lmLongMessage` text,
  `lmSelectMessage` text,
  `lmDeleteMessage` text,
  `lmSaveMessage` text,
  `lmGoodbyeMessage` text,
  `instance_id` int(6) NOT NULL,
  `lmForceTTS` tinyint(4) default '0',
  `title` varchar(50) default NULL,
  `lmOnHangup` varchar(20) default 'accept',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `lmMaxreclen` int(6) default '120',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `instance_id` (`instance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `mappings`
--

DROP TABLE IF EXISTS `mappings`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mappings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `ivr_menu_id` int(11) default NULL,
  `type` varchar(10) default NULL,
  `digit` int(6) default NULL,
  `node_id` int(11) default NULL,
  `lam_id` int(11) default NULL,
  `ivr_id` int(11) default NULL,
  `instance_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `mapping_ivr` (`ivr_menu_id`,`digit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `sender` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL default 'No title',
  `rate` smallint(6) default '0',
  `file` varchar(200) NOT NULL,
  `category_id` int(11) unsigned default NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  `url` varchar(100) default NULL,
  `new` tinyint(1) default '1',
  `status` tinyint(4) default '1',
  `length` int(11) default NULL,
  `instance_id` int(6) NOT NULL,
  `user_id` int(11) unsigned default NULL,
  `comment` varchar(300) default NULL,
  `quick_hangup` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--                                                                                                                                                                                               
-- Table structure for table `messages_tags`                                                                                                                                                     
--                                                                                                                                                                                               
                                                                                                                                                                                                 
DROP TABLE IF EXISTS `messages_tags`;                                                                                                                                                            
SET @saved_cs_client     = @@character_set_client;                                                                                                                                               
SET character_set_client = utf8;                                                                                                                                                                 
CREATE TABLE `messages_tags` (                                                                                                                                                                   
  `id` int(11) unsigned NOT NULL auto_increment,                                                                                                                                                 
  `message_id` int(11) unsigned default NULL,                                                                                                                                                    
  `tag_id` int(11) unsigned default NULL,                                                                                                                                                        
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
  `cdr_id` int(10) unsigned default NULL,
  `epoch` int(10) unsigned default NULL,
  `call_id` varchar(100) NOT NULL,
  `ivr_code` varchar(100) NOT NULL,
  `digit` smallint(6) default NULL,
  `node_id` int(10) unsigned default NULL,
  `caller_number` varchar(50) default NULL,
  `extension` smallint(6) default NULL,
  `type` varchar(10) default NULL,
  `service` varchar(10) default NULL,
  `lm_menu_id` int(11) default NULL,
  `ivr_menu_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `nodes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `file` varchar(100) NOT NULL,
  `duration` int(11) unsigned default '0',
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `office_route`
--

DROP TABLE IF EXISTS `office_route`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `office_route` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `line_id` smallint(6) default NULL,
  `imei` varchar(100) default NULL,
  `signal_level` varchar(20) default NULL,
  `sim_inserted` varchar(50) default NULL,
  `network_registration` varchar(50) default NULL,
  `operator_name` varchar(100) default NULL,
  `ip_addr` varchar(20) default NULL,
  `created` int(11) unsigned default NULL,
  `modified` int(11) unsigned default NULL,
  `imsi` varchar(50) default NULL,
  `title` varchar(50) default NULL,
  `msisdn` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `phone_books`
--

DROP TABLE IF EXISTS `phone_books`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phone_books` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `phone_books_users`
--

DROP TABLE IF EXISTS `phone_books_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phone_books_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned default NULL,
  `phone_book_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `phone_numbers`
--

DROP TABLE IF EXISTS `phone_numbers`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phone_numbers` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `polls` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `question` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created` int(10) unsigned default NULL,
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `status` tinyint(4) default NULL,
  `instance_id` int(6) NOT NULL,
  `invalid_open` int(10) unsigned default '0',
  `invalid_closed` int(10) unsigned default '0',
  `invalid_early` int(10) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `processes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `status` tinyint(2) default NULL,
  `start_cmd` varchar(200) default NULL,
  `instance_id` int(6) NOT NULL,
  `title` varchar(50) default NULL,
  `start_time` int(10) unsigned default '0',
  `last_seen` int(10) unsigned default '0',
  `interupt` varchar(30) default NULL,
  `type` varchar(10) NOT NULL default 'pid',
  `script` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `processes`
--

LOCK TABLES `processes` WRITE;
/*!40000 ALTER TABLE `processes` DISABLE KEYS */;
INSERT INTO `processes` VALUES (1,'dispatcher_in',0,'dispatcher_in/dispatcherESL.php --log=/opt/freedomfone/log/tmp/dispatcher_in.log > /dev/null 2>&1 & echo $!',100,'Incoming dispatcher',0,0,'Unmanaged','run','/usr/bin/php'),(2,'dispatcher_out',0,'dispatcher_out/dispatcher_out.php > /dev/null 2>&1 & echo $!',100,'Outgoing dispatcher',0,0,'','run','/usr/bin/php'),(3,'dispatcher_in_version',NULL,'dispatcher_in/dispatcherESL.php -V',100,'Incoming dispatcher version',0,0,NULL,'version','/usr/bin/php');
/*!40000 ALTER TABLE `processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value_float` float default '0',
  `value_string` varchar(50) default NULL,
  `value_int` int(11) default '0',
  `type` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'language',0,'eng',0,'env'),(2,'length',0,NULL,20,'lam'),(3,'silence',0,NULL,60,'lam'),(4,'domain',0,'http://demo.freedomfone.org',0,'env'),(5,'ip_address',0,'127.0.0.1',0,'env'),(6,'timezone',0,'Africa/Harare',250,'env'),(7,'overwrite_event',0,'',1,'env'),(8,'prefix',0,NULL,263,'env');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `sms_receivers`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `sms_receivers` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `batch_id` int(11) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


----
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `longname` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `surname` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `skype` varchar(50) default NULL,
  `organization` varchar(50) default NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  `count_poll` int(11) unsigned default NULL,
  `count_ivr` int(11) unsigned default NULL,
  `count_lam` int(11) unsigned default NULL,
  `count_bin` int(11) unsigned default NULL,
  `count_callback` int(11) unsigned default NULL,
  `first_app` varchar(10) default NULL,
  `first_epoch` int(11) unsigned default NULL,
  `last_app` varchar(10) default NULL,
  `last_epoch` int(11) unsigned default NULL,
  `acl_id` int(11) unsigned default '0',
  `new` tinyint(4) default '1',

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


DROP TABLE IF EXISTS `votes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `poll_id` int(10) unsigned NOT NULL,
  `chtext` varchar(128) default NULL,
  `chvotes` int(10) unsigned default '0',
  `votes_closed` int(10) unsigned default '0',
  `votes_early` int(10) unsigned default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `poll_chtext` (`poll_id`,`chtext`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL auto_increment,
  `countrycode` char(80) collate utf8_bin NOT NULL,
  `countryprefix` char(80) collate utf8_bin NOT NULL,
  `name` varchar(80) collate utf8_bin default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `countries`
--


INSERT INTO `countries` VALUES (1,'AFG','93','Afghanistan'),(2,'ALB','355','Albania'),(3,'DZA','213','Algeria'),(4,'ASM','684','American Samoa'),(5,'AND','376','Andorra'),(6,'AGO','244','Angola'),(7,'AIA','1264','Anguilla'),(8,'ATA','672','Antarctica'),(9,'ATG','1268','Antigua And Barbuda'),(10,'ARG','54','Argentina'),(11,'ARM','374','Armenia'),(12,'ABW','297','Aruba'),(13,'AUS','61','Australia'),(14,'AUT','43','Austria'),(15,'AZE','994','Azerbaijan'),(16,'BHS','1242','Bahamas'),(17,'BHR','973','Bahrain'),(18,'BGD','880','Bangladesh'),(19,'BRB','1246','Barbados'),(20,'BLR','375','Belarus'),(21,'BEL','32','Belgium'),(22,'BLZ','501','Belize'),(23,'BEN','229','Benin'),(24,'BMU','1441','Bermuda'),(25,'BTN','975','Bhutan'),(26,'BOL','591','Bolivia'),(27,'BIH','387','Bosnia And Herzegovina'),(28,'BWA','267','Botswana'),(29,'BVT','0','Bouvet Island'),(30,'BRA','55','Brazil'),(31,'IOT','1284','British Indian Ocean Territory'),(32,'BRN','673','Brunei Darussalam'),(33,'BGR','359','Bulgaria'),(34,'BFA','226','Burkina Faso'),(35,'BDI','257','Burundi'),(36,'KHM','855','Cambodia'),(37,'CMR','237','Cameroon'),(38,'CAN','1','Canada'),(39,'CPV','238','Cape Verde'),(40,'CYM','1345','Cayman Islands'),(41,'CAF','236','Central African Republic'),(42,'TCD','235','Chad'),(43,'CHL','56','Chile'),(44,'CHN','86','China'),(45,'CXR','618','Christmas Island'),(46,'CCK','61','Cocos (Keeling); Islands'),(47,'COL','57','Colombia'),(48,'COM','269','Comoros'),(49,'COG','242','Congo'),(50,'COD','243','Congo, The Democratic Republic Of The'),(51,'COK','682','Cook Islands'),(52,'CRI','506','Costa Rica'),(54,'HRV','385','Croatia'),(55,'CUB','53','Cuba'),(56,'CYP','357','Cyprus'),(57,'CZE','420','Czech Republic'),(58,'DNK','45','Denmark'),(59,'DJI','253','Djibouti'),(60,'DMA','1767','Dominica'),(61,'DOM','1809','Dominican Republic'),(62,'ECU','593','Ecuador'),(63,'EGY','20','Egypt'),(64,'SLV','503','El Salvador'),(65,'GNQ','240','Equatorial Guinea'),(66,'ERI','291','Eritrea'),(67,'EST','372','Estonia'),(68,'ETH','251','Ethiopia'),(69,'FLK','500','Falkland Islands (Malvinas);'),(70,'FRO','298','Faroe Islands'),(71,'FJI','679','Fiji'),(72,'FIN','358','Finland'),(73,'FRA','33','France'),(74,'GUF','596','French Guiana'),(75,'PYF','594','French Polynesia'),(76,'ATF','689','French Southern Territories'),(77,'GAB','241','Gabon'),(78,'GMB','220','Gambia'),(79,'GEO','995','Georgia'),(80,'DEU','49','Germany'),(81,'GHA','233','Ghana'),(82,'GIB','350','Gibraltar'),(83,'GRC','30','Greece'),(84,'GRL','299','Greenland'),(85,'GRD','1473','Grenada'),(86,'GLP','590','Guadeloupe'),(87,'GUM','1671','Guam'),(88,'GTM','502','Guatemala'),(89,'GIN','224','Guinea'),(90,'GNB','245','Guinea-Bissau'),(91,'GUY','592','Guyana'),(92,'HTI','509','Haiti'),(93,'HMD','0','Heard Island And McDonald Islands'),(94,'VAT','0','Holy See (Vatican City State);'),(95,'HND','504','Honduras'),(96,'HKG','852','Hong Kong'),(97,'HUN','36','Hungary'),(98,'ISL','354','Iceland'),(99,'IND','91','India'),(100,'IDN','62','Indonesia'),(101,'IRN','98','Iran, Islamic Republic Of'),(102,'IRQ','964','Iraq'),(103,'IRL','353','Ireland'),(104,'ISR','972','Israel'),(105,'ITA','39','Italy'),(106,'JAM','1876','Jamaica'),(107,'JPN','81','Japan'),(108,'JOR','962','Jordan'),(109,'KAZ','7','Kazakhstan'),(110,'KEN','254','Kenya'),(111,'KIR','686','Kiribati'),(112,'PRK','850','Korea, Democratic People\'s Republic Of'),(113,'KOR','82','Korea, Republic of'),(114,'KWT','965','Kuwait'),(115,'KGZ','996','Kyrgyzstan'),(116,'LAO','856','Lao People\'s Democratic Republic'),(117,'LVA','371','Latvia'),(118,'LBN','961','Lebanon'),(119,'LSO','266','Lesotho'),(120,'LBR','231','Liberia'),(121,'LBY','218','Libyan Arab Jamahiriya'),(122,'LIE','423','Liechtenstein'),(123,'LTU','370','Lithuania'),(124,'LUX','352','Luxembourg'),(125,'MAC','853','Macao'),(126,'MKD','389','Macedonia, The Former Yugoslav Republic Of'),(127,'MDG','261','Madagascar'),(128,'MWI','265','Malawi'),(129,'MYS','60','Malaysia'),(130,'MDV','960','Maldives'),(131,'MLI','223','Mali'),(132,'MLT','356','Malta'),(133,'MHL','692','Marshall islands'),(134,'MTQ','596','Martinique'),(135,'MRT','222','Mauritania'),(136,'MUS','230','Mauritius'),(137,'MYT','269','Mayotte'),(138,'MEX','52','Mexico'),(139,'FSM','691','Micronesia, Federated States Of'),(140,'MDA','1808','Moldova, Republic Of'),(141,'MCO','377','Monaco'),(142,'MNG','976','Mongolia'),(143,'MSR','1664','Montserrat'),(144,'MAR','212','Morocco'),(145,'MOZ','258','Mozambique'),(146,'MMR','95','Myanmar'),(147,'NAM','264','Namibia'),(148,'NRU','674','Nauru'),(149,'NPL','977','Nepal'),(150,'NLD','31','Netherlands'),(151,'ANT','599','Netherlands Antilles'),(152,'NCL','687','New Caledonia'),(153,'NZL','64','New Zealand'),(154,'NIC','505','Nicaragua'),(155,'NER','227','Niger'),(156,'NGA','234','Nigeria'),(157,'NIU','683','Niue'),(158,'NFK','672','Norfolk Island'),(159,'MNP','1670','Northern Mariana Islands'),(160,'NOR','47','Norway'),(161,'OMN','968','Oman'),(162,'PAK','92','Pakistan'),(163,'PLW','680','Palau'),(164,'PSE','970','Palestinian Territory, Occupied'),(165,'PAN','507','Panama'),(166,'PNG','675','Papua New Guinea'),(167,'PRY','595','Paraguay'),(168,'PER','51','Peru'),(169,'PHL','63','Philippines'),(170,'PCN','0','Pitcairn'),(171,'POL','48','Poland'),(172,'PRT','351','Portugal'),(173,'PRI','1787','Puerto Rico'),(174,'QAT','974','Qatar'),(175,'REU','262','Reunion'),(176,'ROU','40','Romania'),(177,'RUS','7','Russian Federation'),(178,'RWA','250','Rwanda'),(179,'SHN','290','Saint Helena'),(180,'KNA','1869','Saint Kitts And Nevis'),(181,'LCA','1758','Saint Lucia'),(182,'SPM','508','Saint Pierre And Miquelon'),(183,'VCT','1784','Saint Vincent And The Grenadines'),(184,'WSM','685','Samoa'),(185,'SMR','378','San Marino'),(186,'STP','239','SÃ£o TomÃ© and PrÃ­ncipe'),(187,'SAU','966','Saudi Arabia'),(188,'SEN','221','Senegal'),(189,'SYC','248','Seychelles'),(190,'SLE','232','Sierra Leone'),(191,'SGP','65','Singapore'),(192,'SVK','421','Slovakia'),(193,'SVN','386','Slovenia'),(194,'SLB','677','Solomon Islands'),(195,'SOM','252','Somalia'),(196,'ZAF','27','South Africa'),(197,'SGS','0','South Georgia And The South Sandwich Islands'),(198,'ESP','34','Spain'),(199,'LKA','94','Sri Lanka'),(200,'SDN','249','Sudan'),(201,'SUR','597','Suriname'),(202,'SJM','0','Svalbard and Jan Mayen'),(203,'SWZ','268','Swaziland'),(204,'SWE','46','Sweden'),(205,'CHE','41','Switzerland'),(206,'SYR','963','Syrian Arab Republic'),(207,'TWN','886','Taiwan, Province Of China'),(208,'TJK','992','Tajikistan'),(209,'TZA','255','Tanzania, United Republic Of'),(210,'THA','66','Thailand'),(211,'TLS','670','Timor-Leste'),(212,'TGO','228','Togo'),(213,'TKL','690','Tokelau'),(214,'TON','676','Tonga'),(215,'TTO','1868','Trinidad And Tobago'),(216,'TUN','216','Tunisia'),(217,'TUR','90','Turkey'),(218,'TKM','993','Turkmenistan'),(219,'TCA','1649','Turks And Caicos Islands'),(220,'TUV','688','Tuvalu'),(221,'UGA','256','Uganda'),(222,'UKR','380','Ukraine'),(223,'ARE','971','United Arab Emirates'),(224,'GBR','44','United Kingdom'),(225,'USA','1','United States'),(226,'UMI','0','United States Minor Outlying Islands'),(227,'URY','598','Uruguay'),(228,'UZB','998','Uzbekistan'),(229,'VUT','678','Vanuatu'),(230,'VEN','58','Venezuela'),(231,'VNM','84','Vietnam'),(232,'VGB','1284','Virgin Islands, British'),(233,'VIR','808','Virgin Islands, U.S.'),(234,'WLF','681','Wallis And Futuna'),(235,'ESH','0','Western Sahara'),(236,'YEM','967','Yemen'),(237,'YUG','0','Yugoslavia'),(238,'ZMB','260','Zambia'),(239,'ZWE','263','Zimbabwe'),(240,'ASC','0','Ascension Island'),(241,'DGA','0','Diego Garcia'),(242,'XNM','0','Inmarsat'),(243,'TMP','0','East timor'),(244,'AK','0','Alaska'),(245,'HI','0','Hawaii'),(53,'CIV','225','CÃ´te d\'Ivoire'),(246,'ALA','35818','Aland Islands'),(247,'BLM','0','Saint Barthelemy'),(248,'GGY','441481','Guernsey'),(249,'IMN','441624','Isle of Man'),(250,'JEY','441534','Jersey'),(251,'MAF','0','Saint Martin'),(252,'MNE','382','Montenegro, Republic of'),(253,'SRB','381','Serbia, Republic of'),(254,'CPT','0','Clipperton Island'),(255,'TAA','0','Tristan da Cunha');


