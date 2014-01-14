

--
-- Table structure for table `bin`
--

DROP TABLE IF EXISTS `bin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(6) NOT NULL,
  `body` varchar(200) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `created` int(10) unsigned DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `proto` varchar(25) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `hw_unit` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `callback_in`
--

DROP TABLE IF EXISTS `callback_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(6) NOT NULL,
  `created` int(10) unsigned DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `receiver` varchar(100) DEFAULT NULL,
  `body` varchar(160) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `proto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `callback_jobs`
--

DROP TABLE IF EXISTS `callback_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(20) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `service` smallint(5) unsigned NOT NULL,
  `retries` tinyint(3) unsigned DEFAULT NULL,
  `retry_interval` smallint(5) unsigned DEFAULT NULL,
  `max_duration` smallint(5) unsigned DEFAULT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `callback_retries`
--

DROP TABLE IF EXISTS `callback_retries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_retries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `callback_job_job_id` int(10) unsigned NOT NULL,
  `epoch` int(10) unsigned NOT NULL,
  `causeLegA` varchar(100) NOT NULL,
  `causeLegB` varchar(100) NOT NULL,
  `bridge_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `callback_settings`
--

DROP TABLE IF EXISTS `callback_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(10) unsigned NOT NULL,
  `sms_code` varchar(10) NOT NULL DEFAULT 'CALLBACK',
  `response_type` smallint(6) NOT NULL DEFAULT '0',
  `limit_user` smallint(6) NOT NULL DEFAULT '20',
  `limit_time` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `callback_status`
--

DROP TABLE IF EXISTS `callback_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `longname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cdr`
--

DROP TABLE IF EXISTS `cdr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel_state` varchar(50) DEFAULT NULL,
  `epoch` int(10) unsigned DEFAULT NULL,
  `call_id` varchar(100) NOT NULL,
  `caller_name` varchar(50) DEFAULT NULL,
  `caller_number` varchar(50) DEFAULT NULL,
  `extension` smallint(6) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `proto` varchar(25) DEFAULT NULL,
  `length` int(11) unsigned DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `quick_hangup` varchar(10) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=374 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `epoch` int(11) unsigned DEFAULT NULL,
  `interface_name` varchar(50) DEFAULT NULL,
  `interface_id` smallint(6) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `not_registered` tinyint(1) DEFAULT NULL,
  `home_network_registered` tinyint(1) DEFAULT NULL,
  `roaming_registered` tinyint(1) DEFAULT NULL,
  `got_signal` smallint(6) DEFAULT NULL,
  `running` tinyint(1) DEFAULT NULL,
  `imei` varchar(100) DEFAULT NULL,
  `imsi` varchar(100) DEFAULT NULL,
  `controldev_dead` tinyint(1) DEFAULT NULL,
  `controldevice_name` varchar(50) DEFAULT NULL,
  `no_sound` tinyint(1) DEFAULT NULL,
  `playback_boost` float(8,3) DEFAULT NULL,
  `capture_boost` float(8,3) DEFAULT NULL,
  `ib_calls` int(6) DEFAULT NULL,
  `ob_calls` int(6) DEFAULT NULL,
  `ib_failed_calls` int(6) DEFAULT NULL,
  `ob_failed_calls` int(6) DEFAULT NULL,
  `interface_state` int(6) DEFAULT NULL,
  `phone_callflow` int(6) DEFAULT NULL,
  `during-call` tinyint(1) DEFAULT NULL,
  `sim_inserted` varchar(20) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `msisdn` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countrycode` char(80) COLLATE utf8_bin NOT NULL,
  `countryprefix` char(80) COLLATE utf8_bin NOT NULL,
  `name` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `gateway_types`
--

DROP TABLE IF EXISTS `gateway_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gateway_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `ivr_menus`
--

DROP TABLE IF EXISTS `ivr_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ivr_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `modified` int(11) unsigned DEFAULT '0',
  `mode_long` tinyint(1) DEFAULT '0',
  `mode_short` tinyint(1) DEFAULT '0',
  `mode_exit` tinyint(1) DEFAULT '0',
  `mode_invalid` tinyint(1) DEFAULT '0',
  `switcher_type` varchar(50) NOT NULL,
  `ivr_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lm_menus`
--

DROP TABLE IF EXISTS `lm_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lm_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lmWelcomeMessage` text,
  `lmInformMessage` text,
  `lmInvalidMessage` text,
  `lmLongMessage` text,
  `lmSelectMessage` text,
  `lmDeleteMessage` text,
  `lmSaveMessage` text,
  `lmGoodbyeMessage` text,
  `instance_id` int(6) NOT NULL,
  `lmForceTTS` tinyint(4) DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `lmOnHangup` varchar(20) DEFAULT 'accept',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `lmMaxreclen` int(6) DEFAULT '120',
  PRIMARY KEY (`id`),
  UNIQUE KEY `instance_id` (`instance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mappings`
--

DROP TABLE IF EXISTS `mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mappings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ivr_menu_id` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `digit` int(6) DEFAULT NULL,
  `node_id` int(11) DEFAULT NULL,
  `lam_id` int(11) DEFAULT NULL,
  `ivr_id` int(11) DEFAULT NULL,
  `instance_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mapping_ivr` (`ivr_menu_id`,`digit`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT 'No title',
  `rate` smallint(6) DEFAULT '0',
  `file` varchar(200) NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned DEFAULT '0',
  `url` varchar(100) DEFAULT NULL,
  `new` tinyint(1) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `length` int(11) DEFAULT NULL,
  `instance_id` int(6) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `quick_hangup` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages_tags`
--

DROP TABLE IF EXISTS `messages_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(11) unsigned DEFAULT NULL,
  `tag_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor_ivr`
--

DROP TABLE IF EXISTS `monitor_ivr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor_ivr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cdr_id` int(10) unsigned DEFAULT NULL,
  `epoch` int(10) unsigned DEFAULT NULL,
  `call_id` varchar(100) NOT NULL,
  `ivr_code` varchar(100) NOT NULL,
  `digit` smallint(6) DEFAULT NULL,
  `node_id` int(10) unsigned DEFAULT NULL,
  `caller_number` varchar(50) DEFAULT NULL,
  `extension` smallint(6) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `service` varchar(10) DEFAULT NULL,
  `lm_menu_id` int(11) DEFAULT NULL,
  `ivr_menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `file` varchar(100) NOT NULL,
  `duration` int(11) unsigned DEFAULT '0',
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `office_route`
--

DROP TABLE IF EXISTS `office_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `line_id` smallint(6) DEFAULT NULL,
  `imei` varchar(100) DEFAULT NULL,
  `signal_level` varchar(20) DEFAULT NULL,
  `sim_inserted` varchar(50) DEFAULT NULL,
  `network_registration` varchar(50) DEFAULT NULL,
  `operator_name` varchar(100) DEFAULT NULL,
  `ip_addr` varchar(20) DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  `modified` int(11) unsigned DEFAULT NULL,
  `imsi` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `msisdn` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phone_books`
--

DROP TABLE IF EXISTS `phone_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phone_books_users`
--

DROP TABLE IF EXISTS `phone_books_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_books_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `phone_book_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phone_numbers`
--

DROP TABLE IF EXISTS `phone_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_numbers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created` int(10) unsigned DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `instance_id` int(6) NOT NULL,
  `invalid_open` int(10) unsigned DEFAULT '0',
  `invalid_closed` int(10) unsigned DEFAULT '0',
  `invalid_early` int(10) unsigned DEFAULT '0',
  `hw_unit` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `start_cmd` varchar(200) DEFAULT NULL,
  `instance_id` int(6) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `start_time` int(10) unsigned DEFAULT '0',
  `last_seen` int(10) unsigned DEFAULT '0',
  `interupt` varchar(30) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'pid',
  `script` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value_float` float DEFAULT '0',
  `value_string` varchar(50) DEFAULT NULL,
  `value_int` int(11) DEFAULT '0',
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms_gateways`
--

DROP TABLE IF EXISTS `sms_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_gateways` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL,
  `gateway_type_id` smallint(6) DEFAULT NULL,
  `gateway_code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms_receivers`
--

DROP TABLE IF EXISTS `sms_receivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_receivers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sms_gateway_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `longname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned DEFAULT '0',
  `count_poll` int(11) unsigned DEFAULT NULL,
  `count_ivr` int(11) unsigned DEFAULT NULL,
  `count_lam` int(11) unsigned DEFAULT NULL,
  `count_bin` int(11) unsigned DEFAULT NULL,
  `count_callback` int(11) unsigned DEFAULT NULL,
  `first_app` varchar(10) DEFAULT NULL,
  `first_epoch` int(11) unsigned DEFAULT NULL,
  `last_app` varchar(10) DEFAULT NULL,
  `last_epoch` int(11) unsigned DEFAULT NULL,
  `acl_id` int(11) unsigned DEFAULT '0',
  `new` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(10) unsigned NOT NULL,
  `chtext` varchar(128) DEFAULT NULL,
  `chvotes` int(10) unsigned DEFAULT '0',
  `votes_closed` int(10) unsigned DEFAULT '0',
  `votes_early` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `poll_chtext` (`poll_id`,`chtext`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-14 12:27:55
