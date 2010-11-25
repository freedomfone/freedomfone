-- 
-- Update script for Freedom Fone 1.6.5-01 to 1.6.5-03
--

-- 
-- Updated table structure for tables `channels` and `users`
-- 

alter table channels add `title` varchar(50) DEFAULT NULL;
alter table channels add `msisdn` varchar(50) DEFAULT NULL;
alter table users add `count_bin` int(11) unsigned default NULL;

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
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 SET character_set_client = @saved_cs_client;
 
