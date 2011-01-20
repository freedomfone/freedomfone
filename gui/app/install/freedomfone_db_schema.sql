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
  `instance_id` int(6) NOT NULL,
  `created` int(10) unsigned default NULL,
  `mode` varchar(10) default NULL,
  `sender` varchar(100) default NULL,
  `receiver` varchar(100) default NULL,
  `body` varchar(160) default NULL,
  `status` tinyint(2) default NULL,
  `proto` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `callback_settings`
--

DROP TABLE IF EXISTS `callback_settings`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `callback_settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `instance_id` int(10) unsigned NOT NULL,
  `sms_code` varchar(10) NOT NULL default 'CALLBACK',
  `response_type` smallint(6) NOT NULL default '0',
  `limit_user` smallint(6) NOT NULL default '20',
  `limit_time` smallint(6) default NULL,
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
  `user_id` varchar(50) default NULL,
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
  `number` varchar(200) NOT NULL,
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
INSERT INTO `processes` VALUES (1,'dispatcher_in',0,'dispatcher_in/dispatcherESL.php --log=/var/tmp/dispatcher_in.log > /dev/null 2>&1 & echo $!',100,'Incoming dispatcher',1290780002,1292513701,'Unmanaged','run','/usr/bin/php'),(2,'dispatcher_out',0,'dispatcher_out/dispatcher_out.php > /dev/null 2>&1 & echo $!',100,'Outgoing dispatcher',0,0,'','run','/usr/bin/php'),(3,'dispatcher_in_version',NULL,'dispatcher_in/dispatcherESL.php -V',100,'Incoming dispatcher version',0,0,NULL,'version','/usr/bin/php');
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
INSERT INTO `settings` VALUES (1,'language',0,'eng',0,'env'),(2,'length',0,NULL,20,'lam'),(3,'silence',0,NULL,60,'lam'),(4,'domain',0,'http://demo.freedomfone.org',0,'env'),(5,'ip_address',0,'127.0.0.1',0,'env'),(6,'timezone',0,'Africa/Harare',250,'env'),(7,'overwrite_event',0,'',1,'env');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

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
  `callback_count` int(11) unsigned default NULL,
  `first_app` varchar(10) default NULL,
  `first_epoch` int(11) unsigned default NULL,
  `last_app` varchar(10) default NULL,
  `last_epoch` int(11) unsigned default NULL,
  `acl_id` int(11) unsigned default '0',
  `new` tinyint(4) default '1',
  `count_bin` int(11) unsigned default NULL,
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



/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-12-16 16:31:29
