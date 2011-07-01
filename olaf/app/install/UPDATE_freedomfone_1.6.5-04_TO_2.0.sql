-- 
-- Update script for Freedom Fone 1.6.5-04 to 2.0 
--

alter table `cdr` add `quick_hangup` varchar(10) default NULL;
alter table `channels` add `sim_inserted` varchar(20) default NULL;


alter table `ivr_menus` drop `option1_id`;
alter table `ivr_menus` drop `option2_id`;
alter table `ivr_menus` drop `option3_id`;
alter table `ivr_menus` drop `option4_id`;
alter table `ivr_menus` drop `option5_id`;
alter table `ivr_menus` drop `option6_id`;
alter table `ivr_menus` drop `option7_id`;
alter table `ivr_menus` drop `option8_id`;
alter table `ivr_menus` drop `option9_id`;
alter table `ivr_menus` drop `option1_type`;
alter table `ivr_menus` drop `option2_type`;
alter table `ivr_menus` drop `option3_type`;
alter table `ivr_menus` drop `option4_type`;
alter table `ivr_menus` drop `option5_type`;
alter table `ivr_menus` drop `option6_type`;
alter table `ivr_menus` drop `option7_type`;
alter table `ivr_menus` drop `option8_type`;
alter table `ivr_menus` drop `option9_type`;
alter table `ivr_menus` drop `parent` tinyint(1) default '0',
alter table `ivr_menus` add `switcher_type` varchar(50) NOT NULL;
alter table `ivr_menus` add `ivr_type` varchar(50) NOT NULL;

alter table `lm_menus` add `created` int(11) NOT NULL;
alter table `lm_menus` add `modified` int(11) NOT NULL;
alter table `lm_menus` add `lmMaxreclen` int(6) default '120';


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


alter table `messages` add `quick_hangup` varchar(10) default NULL;
alter table `monitor_ivr` add `service` varchar(10) default NULL;
alter table `monitor_ivr` add `lm_menu_id` int(11) default NULL;
alter table `monitor_ivr` add `ivr_menu_id` int(11) default NULL;
alter table `nodes` drop `instance_id`;

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


  

