-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: freedomfone
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1-log

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
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,4),(2,NULL,'Group',2,NULL,5,8),(3,1,'FfUser',1,NULL,2,3),(4,2,'FfUser',2,NULL,6,7);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=660 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,1318),(2,1,NULL,NULL,'Api',2,63),(3,2,NULL,NULL,'get',3,4),(4,2,NULL,NULL,'bin',5,6),(5,2,NULL,NULL,'polls',7,8),(6,2,NULL,NULL,'lm_menus',9,10),(7,2,NULL,NULL,'messages',11,12),(8,2,NULL,NULL,'categories',13,14),(9,2,NULL,NULL,'tags',15,16),(10,2,NULL,NULL,'cdr',17,18),(11,2,NULL,NULL,'services',19,20),(12,2,NULL,NULL,'users',21,22),(13,2,NULL,NULL,'system',23,24),(14,2,NULL,NULL,'uploadFiles',25,26),(15,2,NULL,NULL,'wav2mp3',27,28),(16,2,NULL,NULL,'wavDuration',29,30),(17,2,NULL,NULL,'getExt',31,32),(18,2,NULL,NULL,'getFilename',33,34),(19,2,NULL,NULL,'logRefresh',35,36),(20,2,NULL,NULL,'getTimezone',37,38),(21,2,NULL,NULL,'getLanguage',39,40),(22,2,NULL,NULL,'checkMyIp',41,42),(23,2,NULL,NULL,'getInstance',43,44),(24,2,NULL,NULL,'isActive',45,46),(25,2,NULL,NULL,'emptyDir',47,48),(26,2,NULL,NULL,'refreshAll',49,50),(27,2,NULL,NULL,'dateToString',51,52),(28,2,NULL,NULL,'headerGetStatus',53,54),(29,2,NULL,NULL,'getServiceName',55,56),(30,2,NULL,NULL,'getPhoneBooks',57,58),(31,2,NULL,NULL,'authAccess',59,60),(32,2,NULL,NULL,'sweeper',61,62),(33,1,NULL,NULL,'Batches',64,111),(34,33,NULL,NULL,'index',65,66),(35,33,NULL,NULL,'disp',67,68),(36,33,NULL,NULL,'add',69,70),(37,33,NULL,NULL,'delete',71,72),(38,33,NULL,NULL,'uploadFiles',73,74),(39,33,NULL,NULL,'wav2mp3',75,76),(40,33,NULL,NULL,'wavDuration',77,78),(41,33,NULL,NULL,'getExt',79,80),(42,33,NULL,NULL,'getFilename',81,82),(43,33,NULL,NULL,'logRefresh',83,84),(44,33,NULL,NULL,'getTimezone',85,86),(45,33,NULL,NULL,'getLanguage',87,88),(46,33,NULL,NULL,'checkMyIp',89,90),(47,33,NULL,NULL,'getInstance',91,92),(48,33,NULL,NULL,'isActive',93,94),(49,33,NULL,NULL,'emptyDir',95,96),(50,33,NULL,NULL,'refreshAll',97,98),(51,33,NULL,NULL,'dateToString',99,100),(52,33,NULL,NULL,'headerGetStatus',101,102),(53,33,NULL,NULL,'getServiceName',103,104),(54,33,NULL,NULL,'getPhoneBooks',105,106),(55,33,NULL,NULL,'authAccess',107,108),(56,33,NULL,NULL,'sweeper',109,110),(57,1,NULL,NULL,'Bin',112,165),(58,57,NULL,NULL,'refresh',113,114),(59,57,NULL,NULL,'index',115,116),(60,57,NULL,NULL,'disp',117,118),(61,57,NULL,NULL,'process',119,120),(62,57,NULL,NULL,'delete',121,122),(63,57,NULL,NULL,'export',123,124),(64,57,NULL,NULL,'outgoing',125,126),(65,57,NULL,NULL,'uploadFiles',127,128),(66,57,NULL,NULL,'wav2mp3',129,130),(67,57,NULL,NULL,'wavDuration',131,132),(68,57,NULL,NULL,'getExt',133,134),(69,57,NULL,NULL,'getFilename',135,136),(70,57,NULL,NULL,'logRefresh',137,138),(71,57,NULL,NULL,'getTimezone',139,140),(72,57,NULL,NULL,'getLanguage',141,142),(73,57,NULL,NULL,'checkMyIp',143,144),(74,57,NULL,NULL,'getInstance',145,146),(75,57,NULL,NULL,'isActive',147,148),(76,57,NULL,NULL,'emptyDir',149,150),(77,57,NULL,NULL,'refreshAll',151,152),(78,57,NULL,NULL,'dateToString',153,154),(79,57,NULL,NULL,'headerGetStatus',155,156),(80,57,NULL,NULL,'getServiceName',157,158),(81,57,NULL,NULL,'getPhoneBooks',159,160),(82,57,NULL,NULL,'authAccess',161,162),(83,57,NULL,NULL,'sweeper',163,164),(84,1,NULL,NULL,'Categories',166,213),(85,84,NULL,NULL,'index',167,168),(86,84,NULL,NULL,'add',169,170),(87,84,NULL,NULL,'edit',171,172),(88,84,NULL,NULL,'delete',173,174),(89,84,NULL,NULL,'uploadFiles',175,176),(90,84,NULL,NULL,'wav2mp3',177,178),(91,84,NULL,NULL,'wavDuration',179,180),(92,84,NULL,NULL,'getExt',181,182),(93,84,NULL,NULL,'getFilename',183,184),(94,84,NULL,NULL,'logRefresh',185,186),(95,84,NULL,NULL,'getTimezone',187,188),(96,84,NULL,NULL,'getLanguage',189,190),(97,84,NULL,NULL,'checkMyIp',191,192),(98,84,NULL,NULL,'getInstance',193,194),(99,84,NULL,NULL,'isActive',195,196),(100,84,NULL,NULL,'emptyDir',197,198),(101,84,NULL,NULL,'refreshAll',199,200),(102,84,NULL,NULL,'dateToString',201,202),(103,84,NULL,NULL,'headerGetStatus',203,204),(104,84,NULL,NULL,'getServiceName',205,206),(105,84,NULL,NULL,'getPhoneBooks',207,208),(106,84,NULL,NULL,'authAccess',209,210),(107,84,NULL,NULL,'sweeper',211,212),(108,1,NULL,NULL,'Cdr',214,273),(109,108,NULL,NULL,'refresh',215,216),(110,108,NULL,NULL,'general',217,218),(111,108,NULL,NULL,'index',219,220),(112,108,NULL,NULL,'del',221,222),(113,108,NULL,NULL,'process',223,224),(114,108,NULL,NULL,'output',225,226),(115,108,NULL,NULL,'export',227,228),(116,108,NULL,NULL,'statistics',229,230),(117,108,NULL,NULL,'delete',231,232),(118,108,NULL,NULL,'overview',233,234),(119,108,NULL,NULL,'uploadFiles',235,236),(120,108,NULL,NULL,'wav2mp3',237,238),(121,108,NULL,NULL,'wavDuration',239,240),(122,108,NULL,NULL,'getExt',241,242),(123,108,NULL,NULL,'getFilename',243,244),(124,108,NULL,NULL,'logRefresh',245,246),(125,108,NULL,NULL,'getTimezone',247,248),(126,108,NULL,NULL,'getLanguage',249,250),(127,108,NULL,NULL,'checkMyIp',251,252),(128,108,NULL,NULL,'getInstance',253,254),(129,108,NULL,NULL,'isActive',255,256),(130,108,NULL,NULL,'emptyDir',257,258),(131,108,NULL,NULL,'refreshAll',259,260),(132,108,NULL,NULL,'dateToString',261,262),(133,108,NULL,NULL,'headerGetStatus',263,264),(134,108,NULL,NULL,'getServiceName',265,266),(135,108,NULL,NULL,'getPhoneBooks',267,268),(136,108,NULL,NULL,'authAccess',269,270),(137,108,NULL,NULL,'sweeper',271,272),(138,1,NULL,NULL,'Channels',274,321),(139,138,NULL,NULL,'index',275,276),(140,138,NULL,NULL,'audio_services',277,278),(141,138,NULL,NULL,'refresh',279,280),(142,138,NULL,NULL,'edit',281,282),(143,138,NULL,NULL,'uploadFiles',283,284),(144,138,NULL,NULL,'wav2mp3',285,286),(145,138,NULL,NULL,'wavDuration',287,288),(146,138,NULL,NULL,'getExt',289,290),(147,138,NULL,NULL,'getFilename',291,292),(148,138,NULL,NULL,'logRefresh',293,294),(149,138,NULL,NULL,'getTimezone',295,296),(150,138,NULL,NULL,'getLanguage',297,298),(151,138,NULL,NULL,'checkMyIp',299,300),(152,138,NULL,NULL,'getInstance',301,302),(153,138,NULL,NULL,'isActive',303,304),(154,138,NULL,NULL,'emptyDir',305,306),(155,138,NULL,NULL,'refreshAll',307,308),(156,138,NULL,NULL,'dateToString',309,310),(157,138,NULL,NULL,'headerGetStatus',311,312),(158,138,NULL,NULL,'getServiceName',313,314),(159,138,NULL,NULL,'getPhoneBooks',315,316),(160,138,NULL,NULL,'authAccess',317,318),(161,138,NULL,NULL,'sweeper',319,320),(162,1,NULL,NULL,'FfUsers',322,375),(163,162,NULL,NULL,'login',323,324),(164,162,NULL,NULL,'logout',325,326),(165,162,NULL,NULL,'index',327,328),(166,162,NULL,NULL,'add',329,330),(167,162,NULL,NULL,'edit',331,332),(168,162,NULL,NULL,'delete',333,334),(169,162,NULL,NULL,'system_sweeper',335,336),(170,162,NULL,NULL,'uploadFiles',337,338),(171,162,NULL,NULL,'wav2mp3',339,340),(172,162,NULL,NULL,'wavDuration',341,342),(173,162,NULL,NULL,'getExt',343,344),(174,162,NULL,NULL,'getFilename',345,346),(175,162,NULL,NULL,'logRefresh',347,348),(176,162,NULL,NULL,'getTimezone',349,350),(177,162,NULL,NULL,'getLanguage',351,352),(178,162,NULL,NULL,'checkMyIp',353,354),(179,162,NULL,NULL,'getInstance',355,356),(180,162,NULL,NULL,'isActive',357,358),(181,162,NULL,NULL,'emptyDir',359,360),(182,162,NULL,NULL,'refreshAll',361,362),(183,162,NULL,NULL,'dateToString',363,364),(184,162,NULL,NULL,'headerGetStatus',365,366),(185,162,NULL,NULL,'getServiceName',367,368),(186,162,NULL,NULL,'getPhoneBooks',369,370),(187,162,NULL,NULL,'authAccess',371,372),(188,162,NULL,NULL,'sweeper',373,374),(189,1,NULL,NULL,'Groups',376,421),(190,189,NULL,NULL,'build_acl',377,378),(191,189,NULL,NULL,'parentNode',379,380),(192,189,NULL,NULL,'index',381,382),(193,189,NULL,NULL,'uploadFiles',383,384),(194,189,NULL,NULL,'wav2mp3',385,386),(195,189,NULL,NULL,'wavDuration',387,388),(196,189,NULL,NULL,'getExt',389,390),(197,189,NULL,NULL,'getFilename',391,392),(198,189,NULL,NULL,'logRefresh',393,394),(199,189,NULL,NULL,'getTimezone',395,396),(200,189,NULL,NULL,'getLanguage',397,398),(201,189,NULL,NULL,'checkMyIp',399,400),(202,189,NULL,NULL,'getInstance',401,402),(203,189,NULL,NULL,'isActive',403,404),(204,189,NULL,NULL,'emptyDir',405,406),(205,189,NULL,NULL,'refreshAll',407,408),(206,189,NULL,NULL,'dateToString',409,410),(207,189,NULL,NULL,'headerGetStatus',411,412),(208,189,NULL,NULL,'getServiceName',413,414),(209,189,NULL,NULL,'getPhoneBooks',415,416),(210,189,NULL,NULL,'authAccess',417,418),(211,189,NULL,NULL,'sweeper',419,420),(212,1,NULL,NULL,'IvrMenus',422,479),(213,212,NULL,NULL,'index',423,424),(214,212,NULL,NULL,'add',425,426),(215,212,NULL,NULL,'add_selector',427,428),(216,212,NULL,NULL,'edit',429,430),(217,212,NULL,NULL,'delete',431,432),(218,212,NULL,NULL,'download',433,434),(219,212,NULL,NULL,'selectors',435,436),(220,212,NULL,NULL,'edit_selector',437,438),(221,212,NULL,NULL,'disp',439,440),(222,212,NULL,NULL,'uploadFiles',441,442),(223,212,NULL,NULL,'wav2mp3',443,444),(224,212,NULL,NULL,'wavDuration',445,446),(225,212,NULL,NULL,'getExt',447,448),(226,212,NULL,NULL,'getFilename',449,450),(227,212,NULL,NULL,'logRefresh',451,452),(228,212,NULL,NULL,'getTimezone',453,454),(229,212,NULL,NULL,'getLanguage',455,456),(230,212,NULL,NULL,'checkMyIp',457,458),(231,212,NULL,NULL,'getInstance',459,460),(232,212,NULL,NULL,'isActive',461,462),(233,212,NULL,NULL,'emptyDir',463,464),(234,212,NULL,NULL,'refreshAll',465,466),(235,212,NULL,NULL,'dateToString',467,468),(236,212,NULL,NULL,'headerGetStatus',469,470),(237,212,NULL,NULL,'getServiceName',471,472),(238,212,NULL,NULL,'getPhoneBooks',473,474),(239,212,NULL,NULL,'authAccess',475,476),(240,212,NULL,NULL,'sweeper',477,478),(241,1,NULL,NULL,'LmMenus',480,537),(242,241,NULL,NULL,'index',481,482),(243,241,NULL,NULL,'create',483,484),(244,241,NULL,NULL,'add',485,486),(245,241,NULL,NULL,'edit',487,488),(246,241,NULL,NULL,'download',489,490),(247,241,NULL,NULL,'delete',491,492),(248,241,NULL,NULL,'export',493,494),(249,241,NULL,NULL,'advanced_edit',495,496),(250,241,NULL,NULL,'advanced_add',497,498),(251,241,NULL,NULL,'uploadFiles',499,500),(252,241,NULL,NULL,'wav2mp3',501,502),(253,241,NULL,NULL,'wavDuration',503,504),(254,241,NULL,NULL,'getExt',505,506),(255,241,NULL,NULL,'getFilename',507,508),(256,241,NULL,NULL,'logRefresh',509,510),(257,241,NULL,NULL,'getTimezone',511,512),(258,241,NULL,NULL,'getLanguage',513,514),(259,241,NULL,NULL,'checkMyIp',515,516),(260,241,NULL,NULL,'getInstance',517,518),(261,241,NULL,NULL,'isActive',519,520),(262,241,NULL,NULL,'emptyDir',521,522),(263,241,NULL,NULL,'refreshAll',523,524),(264,241,NULL,NULL,'dateToString',525,526),(265,241,NULL,NULL,'headerGetStatus',527,528),(266,241,NULL,NULL,'getServiceName',529,530),(267,241,NULL,NULL,'getPhoneBooks',531,532),(268,241,NULL,NULL,'authAccess',533,534),(269,241,NULL,NULL,'sweeper',535,536),(270,1,NULL,NULL,'Logs',538,583),(271,270,NULL,NULL,'test',539,540),(272,270,NULL,NULL,'index',541,542),(273,270,NULL,NULL,'disp',543,544),(274,270,NULL,NULL,'uploadFiles',545,546),(275,270,NULL,NULL,'wav2mp3',547,548),(276,270,NULL,NULL,'wavDuration',549,550),(277,270,NULL,NULL,'getExt',551,552),(278,270,NULL,NULL,'getFilename',553,554),(279,270,NULL,NULL,'logRefresh',555,556),(280,270,NULL,NULL,'getTimezone',557,558),(281,270,NULL,NULL,'getLanguage',559,560),(282,270,NULL,NULL,'checkMyIp',561,562),(283,270,NULL,NULL,'getInstance',563,564),(284,270,NULL,NULL,'isActive',565,566),(285,270,NULL,NULL,'emptyDir',567,568),(286,270,NULL,NULL,'refreshAll',569,570),(287,270,NULL,NULL,'dateToString',571,572),(288,270,NULL,NULL,'headerGetStatus',573,574),(289,270,NULL,NULL,'getServiceName',575,576),(290,270,NULL,NULL,'getPhoneBooks',577,578),(291,270,NULL,NULL,'authAccess',579,580),(292,270,NULL,NULL,'sweeper',581,582),(293,1,NULL,NULL,'Messages',584,641),(294,293,NULL,NULL,'refresh',585,586),(295,293,NULL,NULL,'index',587,588),(296,293,NULL,NULL,'disp',589,590),(297,293,NULL,NULL,'archive',591,592),(298,293,NULL,NULL,'view',593,594),(299,293,NULL,NULL,'edit',595,596),(300,293,NULL,NULL,'delete',597,598),(301,293,NULL,NULL,'process',599,600),(302,293,NULL,NULL,'download',601,602),(303,293,NULL,NULL,'uploadFiles',603,604),(304,293,NULL,NULL,'wav2mp3',605,606),(305,293,NULL,NULL,'wavDuration',607,608),(306,293,NULL,NULL,'getExt',609,610),(307,293,NULL,NULL,'getFilename',611,612),(308,293,NULL,NULL,'logRefresh',613,614),(309,293,NULL,NULL,'getTimezone',615,616),(310,293,NULL,NULL,'getLanguage',617,618),(311,293,NULL,NULL,'checkMyIp',619,620),(312,293,NULL,NULL,'getInstance',621,622),(313,293,NULL,NULL,'isActive',623,624),(314,293,NULL,NULL,'emptyDir',625,626),(315,293,NULL,NULL,'refreshAll',627,628),(316,293,NULL,NULL,'dateToString',629,630),(317,293,NULL,NULL,'headerGetStatus',631,632),(318,293,NULL,NULL,'getServiceName',633,634),(319,293,NULL,NULL,'getPhoneBooks',635,636),(320,293,NULL,NULL,'authAccess',637,638),(321,293,NULL,NULL,'sweeper',639,640),(322,1,NULL,NULL,'MonitorIvr',642,695),(323,322,NULL,NULL,'index',643,644),(324,322,NULL,NULL,'del',645,646),(325,322,NULL,NULL,'refresh',647,648),(326,322,NULL,NULL,'process',649,650),(327,322,NULL,NULL,'export',651,652),(328,322,NULL,NULL,'output',653,654),(329,322,NULL,NULL,'delete',655,656),(330,322,NULL,NULL,'uploadFiles',657,658),(331,322,NULL,NULL,'wav2mp3',659,660),(332,322,NULL,NULL,'wavDuration',661,662),(333,322,NULL,NULL,'getExt',663,664),(334,322,NULL,NULL,'getFilename',665,666),(335,322,NULL,NULL,'logRefresh',667,668),(336,322,NULL,NULL,'getTimezone',669,670),(337,322,NULL,NULL,'getLanguage',671,672),(338,322,NULL,NULL,'checkMyIp',673,674),(339,322,NULL,NULL,'getInstance',675,676),(340,322,NULL,NULL,'isActive',677,678),(341,322,NULL,NULL,'emptyDir',679,680),(342,322,NULL,NULL,'refreshAll',681,682),(343,322,NULL,NULL,'dateToString',683,684),(344,322,NULL,NULL,'headerGetStatus',685,686),(345,322,NULL,NULL,'getServiceName',687,688),(346,322,NULL,NULL,'getPhoneBooks',689,690),(347,322,NULL,NULL,'authAccess',691,692),(348,322,NULL,NULL,'sweeper',693,694),(349,1,NULL,NULL,'Nodes',696,745),(350,349,NULL,NULL,'index',697,698),(351,349,NULL,NULL,'add',699,700),(352,349,NULL,NULL,'delete',701,702),(353,349,NULL,NULL,'edit',703,704),(354,349,NULL,NULL,'download',705,706),(355,349,NULL,NULL,'uploadFiles',707,708),(356,349,NULL,NULL,'wav2mp3',709,710),(357,349,NULL,NULL,'wavDuration',711,712),(358,349,NULL,NULL,'getExt',713,714),(359,349,NULL,NULL,'getFilename',715,716),(360,349,NULL,NULL,'logRefresh',717,718),(361,349,NULL,NULL,'getTimezone',719,720),(362,349,NULL,NULL,'getLanguage',721,722),(363,349,NULL,NULL,'checkMyIp',723,724),(364,349,NULL,NULL,'getInstance',725,726),(365,349,NULL,NULL,'isActive',727,728),(366,349,NULL,NULL,'emptyDir',729,730),(367,349,NULL,NULL,'refreshAll',731,732),(368,349,NULL,NULL,'dateToString',733,734),(369,349,NULL,NULL,'headerGetStatus',735,736),(370,349,NULL,NULL,'getServiceName',737,738),(371,349,NULL,NULL,'getPhoneBooks',739,740),(372,349,NULL,NULL,'authAccess',741,742),(373,349,NULL,NULL,'sweeper',743,744),(374,1,NULL,NULL,'OfficeRoute',746,789),(375,374,NULL,NULL,'refresh',747,748),(376,374,NULL,NULL,'edit',749,750),(377,374,NULL,NULL,'uploadFiles',751,752),(378,374,NULL,NULL,'wav2mp3',753,754),(379,374,NULL,NULL,'wavDuration',755,756),(380,374,NULL,NULL,'getExt',757,758),(381,374,NULL,NULL,'getFilename',759,760),(382,374,NULL,NULL,'logRefresh',761,762),(383,374,NULL,NULL,'getTimezone',763,764),(384,374,NULL,NULL,'getLanguage',765,766),(385,374,NULL,NULL,'checkMyIp',767,768),(386,374,NULL,NULL,'getInstance',769,770),(387,374,NULL,NULL,'isActive',771,772),(388,374,NULL,NULL,'emptyDir',773,774),(389,374,NULL,NULL,'refreshAll',775,776),(390,374,NULL,NULL,'dateToString',777,778),(391,374,NULL,NULL,'headerGetStatus',779,780),(392,374,NULL,NULL,'getServiceName',781,782),(393,374,NULL,NULL,'getPhoneBooks',783,784),(394,374,NULL,NULL,'authAccess',785,786),(395,374,NULL,NULL,'sweeper',787,788),(396,1,NULL,NULL,'Pages',790,831),(397,396,NULL,NULL,'display',791,792),(398,396,NULL,NULL,'uploadFiles',793,794),(399,396,NULL,NULL,'wav2mp3',795,796),(400,396,NULL,NULL,'wavDuration',797,798),(401,396,NULL,NULL,'getExt',799,800),(402,396,NULL,NULL,'getFilename',801,802),(403,396,NULL,NULL,'logRefresh',803,804),(404,396,NULL,NULL,'getTimezone',805,806),(405,396,NULL,NULL,'getLanguage',807,808),(406,396,NULL,NULL,'checkMyIp',809,810),(407,396,NULL,NULL,'getInstance',811,812),(408,396,NULL,NULL,'isActive',813,814),(409,396,NULL,NULL,'emptyDir',815,816),(410,396,NULL,NULL,'refreshAll',817,818),(411,396,NULL,NULL,'dateToString',819,820),(412,396,NULL,NULL,'headerGetStatus',821,822),(413,396,NULL,NULL,'getServiceName',823,824),(414,396,NULL,NULL,'getPhoneBooks',825,826),(415,396,NULL,NULL,'authAccess',827,828),(416,396,NULL,NULL,'sweeper',829,830),(417,1,NULL,NULL,'PhoneBooks',832,881),(418,417,NULL,NULL,'index',833,834),(419,417,NULL,NULL,'add',835,836),(420,417,NULL,NULL,'edit',837,838),(421,417,NULL,NULL,'delete',839,840),(422,417,NULL,NULL,'export',841,842),(423,417,NULL,NULL,'uploadFiles',843,844),(424,417,NULL,NULL,'wav2mp3',845,846),(425,417,NULL,NULL,'wavDuration',847,848),(426,417,NULL,NULL,'getExt',849,850),(427,417,NULL,NULL,'getFilename',851,852),(428,417,NULL,NULL,'logRefresh',853,854),(429,417,NULL,NULL,'getTimezone',855,856),(430,417,NULL,NULL,'getLanguage',857,858),(431,417,NULL,NULL,'checkMyIp',859,860),(432,417,NULL,NULL,'getInstance',861,862),(433,417,NULL,NULL,'isActive',863,864),(434,417,NULL,NULL,'emptyDir',865,866),(435,417,NULL,NULL,'refreshAll',867,868),(436,417,NULL,NULL,'dateToString',869,870),(437,417,NULL,NULL,'headerGetStatus',871,872),(438,417,NULL,NULL,'getServiceName',873,874),(439,417,NULL,NULL,'getPhoneBooks',875,876),(440,417,NULL,NULL,'authAccess',877,878),(441,417,NULL,NULL,'sweeper',879,880),(442,1,NULL,NULL,'PhoneNumbers',882,925),(443,442,NULL,NULL,'add',883,884),(444,442,NULL,NULL,'delete',885,886),(445,442,NULL,NULL,'uploadFiles',887,888),(446,442,NULL,NULL,'wav2mp3',889,890),(447,442,NULL,NULL,'wavDuration',891,892),(448,442,NULL,NULL,'getExt',893,894),(449,442,NULL,NULL,'getFilename',895,896),(450,442,NULL,NULL,'logRefresh',897,898),(451,442,NULL,NULL,'getTimezone',899,900),(452,442,NULL,NULL,'getLanguage',901,902),(453,442,NULL,NULL,'checkMyIp',903,904),(454,442,NULL,NULL,'getInstance',905,906),(455,442,NULL,NULL,'isActive',907,908),(456,442,NULL,NULL,'emptyDir',909,910),(457,442,NULL,NULL,'refreshAll',911,912),(458,442,NULL,NULL,'dateToString',913,914),(459,442,NULL,NULL,'headerGetStatus',915,916),(460,442,NULL,NULL,'getServiceName',917,918),(461,442,NULL,NULL,'getPhoneBooks',919,920),(462,442,NULL,NULL,'authAccess',921,922),(463,442,NULL,NULL,'sweeper',923,924),(464,1,NULL,NULL,'Polls',926,979),(465,464,NULL,NULL,'refresh',927,928),(466,464,NULL,NULL,'index',929,930),(467,464,NULL,NULL,'view',931,932),(468,464,NULL,NULL,'add',933,934),(469,464,NULL,NULL,'delete',935,936),(470,464,NULL,NULL,'unlink',937,938),(471,464,NULL,NULL,'edit',939,940),(472,464,NULL,NULL,'uploadFiles',941,942),(473,464,NULL,NULL,'wav2mp3',943,944),(474,464,NULL,NULL,'wavDuration',945,946),(475,464,NULL,NULL,'getExt',947,948),(476,464,NULL,NULL,'getFilename',949,950),(477,464,NULL,NULL,'logRefresh',951,952),(478,464,NULL,NULL,'getTimezone',953,954),(479,464,NULL,NULL,'getLanguage',955,956),(480,464,NULL,NULL,'checkMyIp',957,958),(481,464,NULL,NULL,'getInstance',959,960),(482,464,NULL,NULL,'isActive',961,962),(483,464,NULL,NULL,'emptyDir',963,964),(484,464,NULL,NULL,'refreshAll',965,966),(485,464,NULL,NULL,'dateToString',967,968),(486,464,NULL,NULL,'headerGetStatus',969,970),(487,464,NULL,NULL,'getServiceName',971,972),(488,464,NULL,NULL,'getPhoneBooks',973,974),(489,464,NULL,NULL,'authAccess',975,976),(490,464,NULL,NULL,'sweeper',977,978),(491,1,NULL,NULL,'Processes',980,1029),(492,491,NULL,NULL,'index',981,982),(493,491,NULL,NULL,'system',983,984),(494,491,NULL,NULL,'start',985,986),(495,491,NULL,NULL,'stop',987,988),(496,491,NULL,NULL,'refresh',989,990),(497,491,NULL,NULL,'uploadFiles',991,992),(498,491,NULL,NULL,'wav2mp3',993,994),(499,491,NULL,NULL,'wavDuration',995,996),(500,491,NULL,NULL,'getExt',997,998),(501,491,NULL,NULL,'getFilename',999,1000),(502,491,NULL,NULL,'logRefresh',1001,1002),(503,491,NULL,NULL,'getTimezone',1003,1004),(504,491,NULL,NULL,'getLanguage',1005,1006),(505,491,NULL,NULL,'checkMyIp',1007,1008),(506,491,NULL,NULL,'getInstance',1009,1010),(507,491,NULL,NULL,'isActive',1011,1012),(508,491,NULL,NULL,'emptyDir',1013,1014),(509,491,NULL,NULL,'refreshAll',1015,1016),(510,491,NULL,NULL,'dateToString',1017,1018),(511,491,NULL,NULL,'headerGetStatus',1019,1020),(512,491,NULL,NULL,'getServiceName',1021,1022),(513,491,NULL,NULL,'getPhoneBooks',1023,1024),(514,491,NULL,NULL,'authAccess',1025,1026),(515,491,NULL,NULL,'sweeper',1027,1028),(516,1,NULL,NULL,'Settings',1030,1071),(517,516,NULL,NULL,'index',1031,1032),(518,516,NULL,NULL,'uploadFiles',1033,1034),(519,516,NULL,NULL,'wav2mp3',1035,1036),(520,516,NULL,NULL,'wavDuration',1037,1038),(521,516,NULL,NULL,'getExt',1039,1040),(522,516,NULL,NULL,'getFilename',1041,1042),(523,516,NULL,NULL,'logRefresh',1043,1044),(524,516,NULL,NULL,'getTimezone',1045,1046),(525,516,NULL,NULL,'getLanguage',1047,1048),(526,516,NULL,NULL,'checkMyIp',1049,1050),(527,516,NULL,NULL,'getInstance',1051,1052),(528,516,NULL,NULL,'isActive',1053,1054),(529,516,NULL,NULL,'emptyDir',1055,1056),(530,516,NULL,NULL,'refreshAll',1057,1058),(531,516,NULL,NULL,'dateToString',1059,1060),(532,516,NULL,NULL,'headerGetStatus',1061,1062),(533,516,NULL,NULL,'getServiceName',1063,1064),(534,516,NULL,NULL,'getPhoneBooks',1065,1066),(535,516,NULL,NULL,'authAccess',1067,1068),(536,516,NULL,NULL,'sweeper',1069,1070),(537,1,NULL,NULL,'SmsGateways',1072,1121),(538,537,NULL,NULL,'index',1073,1074),(539,537,NULL,NULL,'disp',1075,1076),(540,537,NULL,NULL,'add',1077,1078),(541,537,NULL,NULL,'edit',1079,1080),(542,537,NULL,NULL,'delete',1081,1082),(543,537,NULL,NULL,'uploadFiles',1083,1084),(544,537,NULL,NULL,'wav2mp3',1085,1086),(545,537,NULL,NULL,'wavDuration',1087,1088),(546,537,NULL,NULL,'getExt',1089,1090),(547,537,NULL,NULL,'getFilename',1091,1092),(548,537,NULL,NULL,'logRefresh',1093,1094),(549,537,NULL,NULL,'getTimezone',1095,1096),(550,537,NULL,NULL,'getLanguage',1097,1098),(551,537,NULL,NULL,'checkMyIp',1099,1100),(552,537,NULL,NULL,'getInstance',1101,1102),(553,537,NULL,NULL,'isActive',1103,1104),(554,537,NULL,NULL,'emptyDir',1105,1106),(555,537,NULL,NULL,'refreshAll',1107,1108),(556,537,NULL,NULL,'dateToString',1109,1110),(557,537,NULL,NULL,'headerGetStatus',1111,1112),(558,537,NULL,NULL,'getServiceName',1113,1114),(559,537,NULL,NULL,'getPhoneBooks',1115,1116),(560,537,NULL,NULL,'authAccess',1117,1118),(561,537,NULL,NULL,'sweeper',1119,1120),(562,1,NULL,NULL,'Tags',1122,1169),(563,562,NULL,NULL,'index',1123,1124),(564,562,NULL,NULL,'add',1125,1126),(565,562,NULL,NULL,'edit',1127,1128),(566,562,NULL,NULL,'delete',1129,1130),(567,562,NULL,NULL,'uploadFiles',1131,1132),(568,562,NULL,NULL,'wav2mp3',1133,1134),(569,562,NULL,NULL,'wavDuration',1135,1136),(570,562,NULL,NULL,'getExt',1137,1138),(571,562,NULL,NULL,'getFilename',1139,1140),(572,562,NULL,NULL,'logRefresh',1141,1142),(573,562,NULL,NULL,'getTimezone',1143,1144),(574,562,NULL,NULL,'getLanguage',1145,1146),(575,562,NULL,NULL,'checkMyIp',1147,1148),(576,562,NULL,NULL,'getInstance',1149,1150),(577,562,NULL,NULL,'isActive',1151,1152),(578,562,NULL,NULL,'emptyDir',1153,1154),(579,562,NULL,NULL,'refreshAll',1155,1156),(580,562,NULL,NULL,'dateToString',1157,1158),(581,562,NULL,NULL,'headerGetStatus',1159,1160),(582,562,NULL,NULL,'getServiceName',1161,1162),(583,562,NULL,NULL,'getPhoneBooks',1163,1164),(584,562,NULL,NULL,'authAccess',1165,1166),(585,562,NULL,NULL,'sweeper',1167,1168),(586,1,NULL,NULL,'Users',1170,1225),(587,586,NULL,NULL,'refresh',1171,1172),(588,586,NULL,NULL,'index',1173,1174),(589,586,NULL,NULL,'view',1175,1176),(590,586,NULL,NULL,'edit',1177,1178),(591,586,NULL,NULL,'delete',1179,1180),(592,586,NULL,NULL,'process',1181,1182),(593,586,NULL,NULL,'add',1183,1184),(594,586,NULL,NULL,'disp',1185,1186),(595,586,NULL,NULL,'uploadFiles',1187,1188),(596,586,NULL,NULL,'wav2mp3',1189,1190),(597,586,NULL,NULL,'wavDuration',1191,1192),(598,586,NULL,NULL,'getExt',1193,1194),(599,586,NULL,NULL,'getFilename',1195,1196),(600,586,NULL,NULL,'logRefresh',1197,1198),(601,586,NULL,NULL,'getTimezone',1199,1200),(602,586,NULL,NULL,'getLanguage',1201,1202),(603,586,NULL,NULL,'checkMyIp',1203,1204),(604,586,NULL,NULL,'getInstance',1205,1206),(605,586,NULL,NULL,'isActive',1207,1208),(606,586,NULL,NULL,'emptyDir',1209,1210),(607,586,NULL,NULL,'refreshAll',1211,1212),(608,586,NULL,NULL,'dateToString',1213,1214),(609,586,NULL,NULL,'headerGetStatus',1215,1216),(610,586,NULL,NULL,'getServiceName',1217,1218),(611,586,NULL,NULL,'getPhoneBooks',1219,1220),(612,586,NULL,NULL,'authAccess',1221,1222),(613,586,NULL,NULL,'sweeper',1223,1224),(614,1,NULL,NULL,'Votes',1226,1269),(615,614,NULL,NULL,'add',1227,1228),(616,614,NULL,NULL,'delete',1229,1230),(617,614,NULL,NULL,'uploadFiles',1231,1232),(618,614,NULL,NULL,'wav2mp3',1233,1234),(619,614,NULL,NULL,'wavDuration',1235,1236),(620,614,NULL,NULL,'getExt',1237,1238),(621,614,NULL,NULL,'getFilename',1239,1240),(622,614,NULL,NULL,'logRefresh',1241,1242),(623,614,NULL,NULL,'getTimezone',1243,1244),(624,614,NULL,NULL,'getLanguage',1245,1246),(625,614,NULL,NULL,'checkMyIp',1247,1248),(626,614,NULL,NULL,'getInstance',1249,1250),(627,614,NULL,NULL,'isActive',1251,1252),(628,614,NULL,NULL,'emptyDir',1253,1254),(629,614,NULL,NULL,'refreshAll',1255,1256),(630,614,NULL,NULL,'dateToString',1257,1258),(631,614,NULL,NULL,'headerGetStatus',1259,1260),(632,614,NULL,NULL,'getServiceName',1261,1262),(633,614,NULL,NULL,'getPhoneBooks',1263,1264),(634,614,NULL,NULL,'authAccess',1265,1266),(635,614,NULL,NULL,'sweeper',1267,1268),(636,1,NULL,NULL,'AclExtras',1270,1271),(637,1,NULL,NULL,'DebugKit',1272,1317),(638,637,NULL,NULL,'ToolbarAccess',1273,1316),(639,638,NULL,NULL,'history_state',1274,1275),(640,638,NULL,NULL,'sql_explain',1276,1277),(641,638,NULL,NULL,'uploadFiles',1278,1279),(642,638,NULL,NULL,'wav2mp3',1280,1281),(643,638,NULL,NULL,'wavDuration',1282,1283),(644,638,NULL,NULL,'getExt',1284,1285),(645,638,NULL,NULL,'getFilename',1286,1287),(646,638,NULL,NULL,'logRefresh',1288,1289),(647,638,NULL,NULL,'getTimezone',1290,1291),(648,638,NULL,NULL,'getLanguage',1292,1293),(649,638,NULL,NULL,'checkMyIp',1294,1295),(650,638,NULL,NULL,'getInstance',1296,1297),(651,638,NULL,NULL,'isActive',1298,1299),(652,638,NULL,NULL,'emptyDir',1300,1301),(653,638,NULL,NULL,'refreshAll',1302,1303),(654,638,NULL,NULL,'dateToString',1304,1305),(655,638,NULL,NULL,'headerGetStatus',1306,1307),(656,638,NULL,NULL,'getServiceName',1308,1309),(657,638,NULL,NULL,'getPhoneBooks',1310,1311),(658,638,NULL,NULL,'authAccess',1312,1313),(659,638,NULL,NULL,'sweeper',1314,1315);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,464,'-1','-1','-1','-1'),(4,2,466,'1','1','1','1'),(5,2,467,'1','1','1','1'),(6,2,465,'1','1','1','1'),(7,2,293,'-1','-1','-1','-1'),(8,2,295,'1','1','1','1'),(9,2,296,'1','1','1','1'),(10,2,297,'1','1','1','1'),(11,2,299,'1','1','1','1'),(12,2,298,'1','1','1','1'),(13,2,294,'1','1','1','1'),(14,2,84,'-1','-1','-1','-1'),(15,2,85,'1','1','1','1'),(16,2,562,'-1','-1','-1','-1'),(17,2,563,'1','1','1','1'),(18,2,241,'-1','-1','-1','-1'),(19,2,242,'1','1','1','1'),(20,2,57,'-1','-1','-1','-1'),(21,2,59,'1','1','1','1'),(22,2,58,'1','1','1','1'),(23,2,62,'1','1','1','1'),(24,2,60,'1','1','1','1'),(25,2,33,'-1','-1','-1','-1'),(26,2,34,'1','1','1','1'),(27,2,35,'1','1','1','1'),(28,2,537,'-1','-1','-1','-1'),(29,2,538,'1','1','1','1'),(30,2,212,'-1','-1','-1','-1'),(31,2,213,'1','1','1','1'),(32,2,219,'1','1','1','1'),(33,2,349,'-1','-1','-1','-1'),(34,2,350,'1','1','1','1'),(35,2,586,'-1','-1','-1','-1'),(36,2,588,'1','1','1','1'),(37,2,589,'1','1','1','1'),(38,2,417,'-1','-1','-1','-1'),(39,2,418,'1','1','1','1'),(40,2,108,'-1','-1','-1','-1'),(41,2,111,'1','1','1','1'),(42,2,116,'1','1','1','1'),(43,2,110,'1','1','1','1'),(44,2,118,'1','1','1','1'),(45,2,109,'1','1','1','1'),(46,2,322,'-1','-1','-1','-1'),(47,2,323,'1','1','1','1'),(48,2,325,'1','1','1','1'),(49,2,491,'-1','-1','-1','-1'),(50,2,492,'1','1','1','1'),(51,2,496,'1','1','1','1'),(52,2,493,'1','1','1','1'),(53,2,516,'-1','-1','-1','-1'),(54,2,517,'1','1','1','1'),(55,2,138,'-1','-1','-1','-1'),(56,2,139,'1','1','1','1'),(57,2,141,'1','1','1','1'),(58,2,140,'1','1','1','1'),(59,2,374,'-1','-1','-1','-1'),(60,2,375,'1','1','1','1'),(61,2,270,'-1','-1','-1','-1'),(62,2,162,'-1','-1','-1','-1'),(63,2,189,'-1','-1','-1','-1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--
-- Table structure for table `ff_users`
--

DROP TABLE IF EXISTS `ff_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ff_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(48) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ff_users`
--

LOCK TABLES `ff_users` WRITE;
/*!40000 ALTER TABLE `ff_users` DISABLE KEYS */;
INSERT INTO `ff_users` VALUES (1,'admin','6f04cfa963380dee68a9bfe8bdff14784af284a7',1,'2011-09-29 11:42:41','2011-09-29 11:42:41');
/*!40000 ALTER TABLE `ff_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','2011-09-29 11:42:21','2011-09-29 11:42:21'),(2,'user','2011-09-29 11:42:26','2011-09-29 11:42:26');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-14 12:49:59
