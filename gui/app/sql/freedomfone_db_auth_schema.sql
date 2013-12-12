-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: freedomfone
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,1278),(2,1,NULL,NULL,'Pages',2,53),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'uploadFiles',5,6),(5,2,NULL,NULL,'wav2mp3',7,8),(6,2,NULL,NULL,'wavDuration',9,10),(7,2,NULL,NULL,'getExt',11,12),(8,2,NULL,NULL,'getFilename',13,14),(9,2,NULL,NULL,'logRefresh',15,16),(10,2,NULL,NULL,'getTimezone',17,18),(11,2,NULL,NULL,'getLanguage',19,20),(12,2,NULL,NULL,'checkMyIp',21,22),(13,2,NULL,NULL,'getInstance',23,24),(14,2,NULL,NULL,'isActive',25,26),(15,2,NULL,NULL,'emptyDir',27,28),(16,2,NULL,NULL,'refreshAll',29,30),(17,2,NULL,NULL,'dateToString',31,32),(18,2,NULL,NULL,'headerGetStatus',33,34),(19,2,NULL,NULL,'getServiceName',35,36),(20,2,NULL,NULL,'getPhoneBooks',37,38),(21,2,NULL,NULL,'authAccess',39,40),(22,2,NULL,NULL,'sweeper',41,42),(23,2,NULL,NULL,'add',43,44),(24,2,NULL,NULL,'edit',45,46),(25,2,NULL,NULL,'index',47,48),(26,2,NULL,NULL,'view',49,50),(27,2,NULL,NULL,'delete',51,52),(28,1,NULL,NULL,'Tags',54,103),(29,28,NULL,NULL,'index',55,56),(30,28,NULL,NULL,'add',57,58),(31,28,NULL,NULL,'edit',59,60),(32,28,NULL,NULL,'delete',61,62),(33,28,NULL,NULL,'uploadFiles',63,64),(34,28,NULL,NULL,'wav2mp3',65,66),(35,28,NULL,NULL,'wavDuration',67,68),(36,28,NULL,NULL,'getExt',69,70),(37,28,NULL,NULL,'getFilename',71,72),(38,28,NULL,NULL,'logRefresh',73,74),(39,28,NULL,NULL,'getTimezone',75,76),(40,28,NULL,NULL,'getLanguage',77,78),(41,28,NULL,NULL,'checkMyIp',79,80),(42,28,NULL,NULL,'getInstance',81,82),(43,28,NULL,NULL,'isActive',83,84),(44,28,NULL,NULL,'emptyDir',85,86),(45,28,NULL,NULL,'refreshAll',87,88),(46,28,NULL,NULL,'dateToString',89,90),(47,28,NULL,NULL,'headerGetStatus',91,92),(48,28,NULL,NULL,'getServiceName',93,94),(49,28,NULL,NULL,'getPhoneBooks',95,96),(50,28,NULL,NULL,'authAccess',97,98),(51,28,NULL,NULL,'sweeper',99,100),(52,28,NULL,NULL,'view',101,102),(53,1,NULL,NULL,'PhoneBooks',104,155),(54,53,NULL,NULL,'index',105,106),(55,53,NULL,NULL,'add',107,108),(56,53,NULL,NULL,'edit',109,110),(57,53,NULL,NULL,'delete',111,112),(58,53,NULL,NULL,'export',113,114),(59,53,NULL,NULL,'uploadFiles',115,116),(60,53,NULL,NULL,'wav2mp3',117,118),(61,53,NULL,NULL,'wavDuration',119,120),(62,53,NULL,NULL,'getExt',121,122),(63,53,NULL,NULL,'getFilename',123,124),(64,53,NULL,NULL,'logRefresh',125,126),(65,53,NULL,NULL,'getTimezone',127,128),(66,53,NULL,NULL,'getLanguage',129,130),(67,53,NULL,NULL,'checkMyIp',131,132),(68,53,NULL,NULL,'getInstance',133,134),(69,53,NULL,NULL,'isActive',135,136),(70,53,NULL,NULL,'emptyDir',137,138),(71,53,NULL,NULL,'refreshAll',139,140),(72,53,NULL,NULL,'dateToString',141,142),(73,53,NULL,NULL,'headerGetStatus',143,144),(74,53,NULL,NULL,'getServiceName',145,146),(75,53,NULL,NULL,'getPhoneBooks',147,148),(76,53,NULL,NULL,'authAccess',149,150),(77,53,NULL,NULL,'sweeper',151,152),(78,53,NULL,NULL,'view',153,154),(79,1,NULL,NULL,'Cdr',156,221),(80,79,NULL,NULL,'refresh',157,158),(81,79,NULL,NULL,'general',159,160),(82,79,NULL,NULL,'index',161,162),(83,79,NULL,NULL,'del',163,164),(84,79,NULL,NULL,'process',165,166),(85,79,NULL,NULL,'output',167,168),(86,79,NULL,NULL,'export',169,170),(87,79,NULL,NULL,'statistics',171,172),(88,79,NULL,NULL,'delete',173,174),(89,79,NULL,NULL,'overview',175,176),(90,79,NULL,NULL,'uploadFiles',177,178),(91,79,NULL,NULL,'wav2mp3',179,180),(92,79,NULL,NULL,'wavDuration',181,182),(93,79,NULL,NULL,'getExt',183,184),(94,79,NULL,NULL,'getFilename',185,186),(95,79,NULL,NULL,'logRefresh',187,188),(96,79,NULL,NULL,'getTimezone',189,190),(97,79,NULL,NULL,'getLanguage',191,192),(98,79,NULL,NULL,'checkMyIp',193,194),(99,79,NULL,NULL,'getInstance',195,196),(100,79,NULL,NULL,'isActive',197,198),(101,79,NULL,NULL,'emptyDir',199,200),(102,79,NULL,NULL,'refreshAll',201,202),(103,79,NULL,NULL,'dateToString',203,204),(104,79,NULL,NULL,'headerGetStatus',205,206),(105,79,NULL,NULL,'getServiceName',207,208),(106,79,NULL,NULL,'getPhoneBooks',209,210),(107,79,NULL,NULL,'authAccess',211,212),(108,79,NULL,NULL,'sweeper',213,214),(109,79,NULL,NULL,'add',215,216),(110,79,NULL,NULL,'edit',217,218),(111,79,NULL,NULL,'view',219,220),(112,1,NULL,NULL,'LmMenus',222,281),(113,112,NULL,NULL,'index',223,224),(114,112,NULL,NULL,'create',225,226),(115,112,NULL,NULL,'add',227,228),(116,112,NULL,NULL,'edit',229,230),(117,112,NULL,NULL,'download',231,232),(118,112,NULL,NULL,'delete',233,234),(119,112,NULL,NULL,'export',235,236),(120,112,NULL,NULL,'advanced_edit',237,238),(121,112,NULL,NULL,'advanced_add',239,240),(122,112,NULL,NULL,'uploadFiles',241,242),(123,112,NULL,NULL,'wav2mp3',243,244),(124,112,NULL,NULL,'wavDuration',245,246),(125,112,NULL,NULL,'getExt',247,248),(126,112,NULL,NULL,'getFilename',249,250),(127,112,NULL,NULL,'logRefresh',251,252),(128,112,NULL,NULL,'getTimezone',253,254),(129,112,NULL,NULL,'getLanguage',255,256),(130,112,NULL,NULL,'checkMyIp',257,258),(131,112,NULL,NULL,'getInstance',259,260),(132,112,NULL,NULL,'isActive',261,262),(133,112,NULL,NULL,'emptyDir',263,264),(134,112,NULL,NULL,'refreshAll',265,266),(135,112,NULL,NULL,'dateToString',267,268),(136,112,NULL,NULL,'headerGetStatus',269,270),(137,112,NULL,NULL,'getServiceName',271,272),(138,112,NULL,NULL,'getPhoneBooks',273,274),(139,112,NULL,NULL,'authAccess',275,276),(140,112,NULL,NULL,'sweeper',277,278),(141,112,NULL,NULL,'view',279,280),(142,1,NULL,NULL,'OfficeRoute',282,333),(143,142,NULL,NULL,'refresh',283,284),(144,142,NULL,NULL,'edit',285,286),(145,142,NULL,NULL,'uploadFiles',287,288),(146,142,NULL,NULL,'wav2mp3',289,290),(147,142,NULL,NULL,'wavDuration',291,292),(148,142,NULL,NULL,'getExt',293,294),(149,142,NULL,NULL,'getFilename',295,296),(150,142,NULL,NULL,'logRefresh',297,298),(151,142,NULL,NULL,'getTimezone',299,300),(152,142,NULL,NULL,'getLanguage',301,302),(153,142,NULL,NULL,'checkMyIp',303,304),(154,142,NULL,NULL,'getInstance',305,306),(155,142,NULL,NULL,'isActive',307,308),(156,142,NULL,NULL,'emptyDir',309,310),(157,142,NULL,NULL,'refreshAll',311,312),(158,142,NULL,NULL,'dateToString',313,314),(159,142,NULL,NULL,'headerGetStatus',315,316),(160,142,NULL,NULL,'getServiceName',317,318),(161,142,NULL,NULL,'getPhoneBooks',319,320),(162,142,NULL,NULL,'authAccess',321,322),(163,142,NULL,NULL,'sweeper',323,324),(164,142,NULL,NULL,'add',325,326),(165,142,NULL,NULL,'index',327,328),(166,142,NULL,NULL,'view',329,330),(167,142,NULL,NULL,'delete',331,332),(168,1,NULL,NULL,'Messages',334,393),(169,168,NULL,NULL,'refresh',335,336),(170,168,NULL,NULL,'index',337,338),(171,168,NULL,NULL,'disp',339,340),(172,168,NULL,NULL,'archive',341,342),(173,168,NULL,NULL,'view',343,344),(174,168,NULL,NULL,'edit',345,346),(175,168,NULL,NULL,'delete',347,348),(176,168,NULL,NULL,'process',349,350),(177,168,NULL,NULL,'download',351,352),(178,168,NULL,NULL,'uploadFiles',353,354),(179,168,NULL,NULL,'wav2mp3',355,356),(180,168,NULL,NULL,'wavDuration',357,358),(181,168,NULL,NULL,'getExt',359,360),(182,168,NULL,NULL,'getFilename',361,362),(183,168,NULL,NULL,'logRefresh',363,364),(184,168,NULL,NULL,'getTimezone',365,366),(185,168,NULL,NULL,'getLanguage',367,368),(186,168,NULL,NULL,'checkMyIp',369,370),(187,168,NULL,NULL,'getInstance',371,372),(188,168,NULL,NULL,'isActive',373,374),(189,168,NULL,NULL,'emptyDir',375,376),(190,168,NULL,NULL,'refreshAll',377,378),(191,168,NULL,NULL,'dateToString',379,380),(192,168,NULL,NULL,'headerGetStatus',381,382),(193,168,NULL,NULL,'getServiceName',383,384),(194,168,NULL,NULL,'getPhoneBooks',385,386),(195,168,NULL,NULL,'authAccess',387,388),(196,168,NULL,NULL,'sweeper',389,390),(197,168,NULL,NULL,'add',391,392),(198,1,NULL,NULL,'Groups',394,445),(199,198,NULL,NULL,'parentNode',395,396),(200,198,NULL,NULL,'index',397,398),(201,198,NULL,NULL,'uploadFiles',399,400),(202,198,NULL,NULL,'wav2mp3',401,402),(203,198,NULL,NULL,'wavDuration',403,404),(204,198,NULL,NULL,'getExt',405,406),(205,198,NULL,NULL,'getFilename',407,408),(206,198,NULL,NULL,'logRefresh',409,410),(207,198,NULL,NULL,'getTimezone',411,412),(208,198,NULL,NULL,'getLanguage',413,414),(209,198,NULL,NULL,'checkMyIp',415,416),(210,198,NULL,NULL,'getInstance',417,418),(211,198,NULL,NULL,'isActive',419,420),(212,198,NULL,NULL,'emptyDir',421,422),(213,198,NULL,NULL,'refreshAll',423,424),(214,198,NULL,NULL,'dateToString',425,426),(215,198,NULL,NULL,'headerGetStatus',427,428),(216,198,NULL,NULL,'getServiceName',429,430),(217,198,NULL,NULL,'getPhoneBooks',431,432),(218,198,NULL,NULL,'authAccess',433,434),(219,198,NULL,NULL,'sweeper',435,436),(220,198,NULL,NULL,'add',437,438),(221,198,NULL,NULL,'edit',439,440),(222,198,NULL,NULL,'view',441,442),(223,198,NULL,NULL,'delete',443,444),(224,1,NULL,NULL,'Logs',446,497),(225,224,NULL,NULL,'index',447,448),(226,224,NULL,NULL,'disp',449,450),(227,224,NULL,NULL,'uploadFiles',451,452),(228,224,NULL,NULL,'wav2mp3',453,454),(229,224,NULL,NULL,'wavDuration',455,456),(230,224,NULL,NULL,'getExt',457,458),(231,224,NULL,NULL,'getFilename',459,460),(232,224,NULL,NULL,'logRefresh',461,462),(233,224,NULL,NULL,'getTimezone',463,464),(234,224,NULL,NULL,'getLanguage',465,466),(235,224,NULL,NULL,'checkMyIp',467,468),(236,224,NULL,NULL,'getInstance',469,470),(237,224,NULL,NULL,'isActive',471,472),(238,224,NULL,NULL,'emptyDir',473,474),(239,224,NULL,NULL,'refreshAll',475,476),(240,224,NULL,NULL,'dateToString',477,478),(241,224,NULL,NULL,'headerGetStatus',479,480),(242,224,NULL,NULL,'getServiceName',481,482),(243,224,NULL,NULL,'getPhoneBooks',483,484),(244,224,NULL,NULL,'authAccess',485,486),(245,224,NULL,NULL,'sweeper',487,488),(246,224,NULL,NULL,'add',489,490),(247,224,NULL,NULL,'edit',491,492),(248,224,NULL,NULL,'view',493,494),(249,224,NULL,NULL,'delete',495,496),(250,1,NULL,NULL,'IvrMenus',498,557),(251,250,NULL,NULL,'index',499,500),(252,250,NULL,NULL,'add',501,502),(253,250,NULL,NULL,'add_selector',503,504),(254,250,NULL,NULL,'edit',505,506),(255,250,NULL,NULL,'delete',507,508),(256,250,NULL,NULL,'download',509,510),(257,250,NULL,NULL,'selectors',511,512),(258,250,NULL,NULL,'edit_selector',513,514),(259,250,NULL,NULL,'disp',515,516),(260,250,NULL,NULL,'uploadFiles',517,518),(261,250,NULL,NULL,'wav2mp3',519,520),(262,250,NULL,NULL,'wavDuration',521,522),(263,250,NULL,NULL,'getExt',523,524),(264,250,NULL,NULL,'getFilename',525,526),(265,250,NULL,NULL,'logRefresh',527,528),(266,250,NULL,NULL,'getTimezone',529,530),(267,250,NULL,NULL,'getLanguage',531,532),(268,250,NULL,NULL,'checkMyIp',533,534),(269,250,NULL,NULL,'getInstance',535,536),(270,250,NULL,NULL,'isActive',537,538),(271,250,NULL,NULL,'emptyDir',539,540),(272,250,NULL,NULL,'refreshAll',541,542),(273,250,NULL,NULL,'dateToString',543,544),(274,250,NULL,NULL,'headerGetStatus',545,546),(275,250,NULL,NULL,'getServiceName',547,548),(276,250,NULL,NULL,'getPhoneBooks',549,550),(277,250,NULL,NULL,'authAccess',551,552),(278,250,NULL,NULL,'sweeper',553,554),(279,250,NULL,NULL,'view',555,556),(280,1,NULL,NULL,'PhoneNumbers',558,607),(281,280,NULL,NULL,'add',559,560),(282,280,NULL,NULL,'delete',561,562),(283,280,NULL,NULL,'uploadFiles',563,564),(284,280,NULL,NULL,'wav2mp3',565,566),(285,280,NULL,NULL,'wavDuration',567,568),(286,280,NULL,NULL,'getExt',569,570),(287,280,NULL,NULL,'getFilename',571,572),(288,280,NULL,NULL,'logRefresh',573,574),(289,280,NULL,NULL,'getTimezone',575,576),(290,280,NULL,NULL,'getLanguage',577,578),(291,280,NULL,NULL,'checkMyIp',579,580),(292,280,NULL,NULL,'getInstance',581,582),(293,280,NULL,NULL,'isActive',583,584),(294,280,NULL,NULL,'emptyDir',585,586),(295,280,NULL,NULL,'refreshAll',587,588),(296,280,NULL,NULL,'dateToString',589,590),(297,280,NULL,NULL,'headerGetStatus',591,592),(298,280,NULL,NULL,'getServiceName',593,594),(299,280,NULL,NULL,'getPhoneBooks',595,596),(300,280,NULL,NULL,'authAccess',597,598),(301,280,NULL,NULL,'sweeper',599,600),(302,280,NULL,NULL,'edit',601,602),(303,280,NULL,NULL,'index',603,604),(304,280,NULL,NULL,'view',605,606),(305,1,NULL,NULL,'Votes',608,657),(306,305,NULL,NULL,'add',609,610),(307,305,NULL,NULL,'delete',611,612),(308,305,NULL,NULL,'uploadFiles',613,614),(309,305,NULL,NULL,'wav2mp3',615,616),(310,305,NULL,NULL,'wavDuration',617,618),(311,305,NULL,NULL,'getExt',619,620),(312,305,NULL,NULL,'getFilename',621,622),(313,305,NULL,NULL,'logRefresh',623,624),(314,305,NULL,NULL,'getTimezone',625,626),(315,305,NULL,NULL,'getLanguage',627,628),(316,305,NULL,NULL,'checkMyIp',629,630),(317,305,NULL,NULL,'getInstance',631,632),(318,305,NULL,NULL,'isActive',633,634),(319,305,NULL,NULL,'emptyDir',635,636),(320,305,NULL,NULL,'refreshAll',637,638),(321,305,NULL,NULL,'dateToString',639,640),(322,305,NULL,NULL,'headerGetStatus',641,642),(323,305,NULL,NULL,'getServiceName',643,644),(324,305,NULL,NULL,'getPhoneBooks',645,646),(325,305,NULL,NULL,'authAccess',647,648),(326,305,NULL,NULL,'sweeper',649,650),(327,305,NULL,NULL,'edit',651,652),(328,305,NULL,NULL,'index',653,654),(329,305,NULL,NULL,'view',655,656),(330,1,NULL,NULL,'MonitorIvr',658,717),(331,330,NULL,NULL,'index',659,660),(332,330,NULL,NULL,'del',661,662),(333,330,NULL,NULL,'refresh',663,664),(334,330,NULL,NULL,'process',665,666),(335,330,NULL,NULL,'export',667,668),(336,330,NULL,NULL,'output',669,670),(337,330,NULL,NULL,'delete',671,672),(338,330,NULL,NULL,'uploadFiles',673,674),(339,330,NULL,NULL,'wav2mp3',675,676),(340,330,NULL,NULL,'wavDuration',677,678),(341,330,NULL,NULL,'getExt',679,680),(342,330,NULL,NULL,'getFilename',681,682),(343,330,NULL,NULL,'logRefresh',683,684),(344,330,NULL,NULL,'getTimezone',685,686),(345,330,NULL,NULL,'getLanguage',687,688),(346,330,NULL,NULL,'checkMyIp',689,690),(347,330,NULL,NULL,'getInstance',691,692),(348,330,NULL,NULL,'isActive',693,694),(349,330,NULL,NULL,'emptyDir',695,696),(350,330,NULL,NULL,'refreshAll',697,698),(351,330,NULL,NULL,'dateToString',699,700),(352,330,NULL,NULL,'headerGetStatus',701,702),(353,330,NULL,NULL,'getServiceName',703,704),(354,330,NULL,NULL,'getPhoneBooks',705,706),(355,330,NULL,NULL,'authAccess',707,708),(356,330,NULL,NULL,'sweeper',709,710),(357,330,NULL,NULL,'add',711,712),(358,330,NULL,NULL,'edit',713,714),(359,330,NULL,NULL,'view',715,716),(360,1,NULL,NULL,'Users',718,773),(361,360,NULL,NULL,'refresh',719,720),(362,360,NULL,NULL,'index',721,722),(363,360,NULL,NULL,'view',723,724),(364,360,NULL,NULL,'edit',725,726),(365,360,NULL,NULL,'delete',727,728),(366,360,NULL,NULL,'process',729,730),(367,360,NULL,NULL,'add',731,732),(368,360,NULL,NULL,'disp',733,734),(369,360,NULL,NULL,'uploadFiles',735,736),(370,360,NULL,NULL,'wav2mp3',737,738),(371,360,NULL,NULL,'wavDuration',739,740),(372,360,NULL,NULL,'getExt',741,742),(373,360,NULL,NULL,'getFilename',743,744),(374,360,NULL,NULL,'logRefresh',745,746),(375,360,NULL,NULL,'getTimezone',747,748),(376,360,NULL,NULL,'getLanguage',749,750),(377,360,NULL,NULL,'checkMyIp',751,752),(378,360,NULL,NULL,'getInstance',753,754),(379,360,NULL,NULL,'isActive',755,756),(380,360,NULL,NULL,'emptyDir',757,758),(381,360,NULL,NULL,'refreshAll',759,760),(382,360,NULL,NULL,'dateToString',761,762),(383,360,NULL,NULL,'headerGetStatus',763,764),(384,360,NULL,NULL,'getServiceName',765,766),(385,360,NULL,NULL,'getPhoneBooks',767,768),(386,360,NULL,NULL,'authAccess',769,770),(387,360,NULL,NULL,'sweeper',771,772),(388,1,NULL,NULL,'FfUsers',774,831),(389,388,NULL,NULL,'parentNode',775,776),(390,388,NULL,NULL,'login',777,778),(391,388,NULL,NULL,'logout',779,780),(392,388,NULL,NULL,'index',781,782),(393,388,NULL,NULL,'add',783,784),(394,388,NULL,NULL,'edit',785,786),(395,388,NULL,NULL,'delete',787,788),(396,388,NULL,NULL,'system_sweeper',789,790),(397,388,NULL,NULL,'uploadFiles',791,792),(398,388,NULL,NULL,'wav2mp3',793,794),(399,388,NULL,NULL,'wavDuration',795,796),(400,388,NULL,NULL,'getExt',797,798),(401,388,NULL,NULL,'getFilename',799,800),(402,388,NULL,NULL,'logRefresh',801,802),(403,388,NULL,NULL,'getTimezone',803,804),(404,388,NULL,NULL,'getLanguage',805,806),(405,388,NULL,NULL,'checkMyIp',807,808),(406,388,NULL,NULL,'getInstance',809,810),(407,388,NULL,NULL,'isActive',811,812),(408,388,NULL,NULL,'emptyDir',813,814),(409,388,NULL,NULL,'refreshAll',815,816),(410,388,NULL,NULL,'dateToString',817,818),(411,388,NULL,NULL,'headerGetStatus',819,820),(412,388,NULL,NULL,'getServiceName',821,822),(413,388,NULL,NULL,'getPhoneBooks',823,824),(414,388,NULL,NULL,'authAccess',825,826),(415,388,NULL,NULL,'sweeper',827,828),(416,388,NULL,NULL,'view',829,830),(417,1,NULL,NULL,'Polls',832,885),(418,417,NULL,NULL,'refresh',833,834),(419,417,NULL,NULL,'index',835,836),(420,417,NULL,NULL,'view',837,838),(421,417,NULL,NULL,'add',839,840),(422,417,NULL,NULL,'delete',841,842),(423,417,NULL,NULL,'unlink',843,844),(424,417,NULL,NULL,'edit',845,846),(425,417,NULL,NULL,'uploadFiles',847,848),(426,417,NULL,NULL,'wav2mp3',849,850),(427,417,NULL,NULL,'wavDuration',851,852),(428,417,NULL,NULL,'getExt',853,854),(429,417,NULL,NULL,'getFilename',855,856),(430,417,NULL,NULL,'logRefresh',857,858),(431,417,NULL,NULL,'getTimezone',859,860),(432,417,NULL,NULL,'getLanguage',861,862),(433,417,NULL,NULL,'checkMyIp',863,864),(434,417,NULL,NULL,'getInstance',865,866),(435,417,NULL,NULL,'isActive',867,868),(436,417,NULL,NULL,'emptyDir',869,870),(437,417,NULL,NULL,'refreshAll',871,872),(438,417,NULL,NULL,'dateToString',873,874),(439,417,NULL,NULL,'headerGetStatus',875,876),(440,417,NULL,NULL,'getServiceName',877,878),(441,417,NULL,NULL,'getPhoneBooks',879,880),(442,417,NULL,NULL,'authAccess',881,882),(443,417,NULL,NULL,'sweeper',883,884),(444,1,NULL,NULL,'Categories',886,935),(445,444,NULL,NULL,'index',887,888),(446,444,NULL,NULL,'add',889,890),(447,444,NULL,NULL,'edit',891,892),(448,444,NULL,NULL,'delete',893,894),(449,444,NULL,NULL,'uploadFiles',895,896),(450,444,NULL,NULL,'wav2mp3',897,898),(451,444,NULL,NULL,'wavDuration',899,900),(452,444,NULL,NULL,'getExt',901,902),(453,444,NULL,NULL,'getFilename',903,904),(454,444,NULL,NULL,'logRefresh',905,906),(455,444,NULL,NULL,'getTimezone',907,908),(456,444,NULL,NULL,'getLanguage',909,910),(457,444,NULL,NULL,'checkMyIp',911,912),(458,444,NULL,NULL,'getInstance',913,914),(459,444,NULL,NULL,'isActive',915,916),(460,444,NULL,NULL,'emptyDir',917,918),(461,444,NULL,NULL,'refreshAll',919,920),(462,444,NULL,NULL,'dateToString',921,922),(463,444,NULL,NULL,'headerGetStatus',923,924),(464,444,NULL,NULL,'getServiceName',925,926),(465,444,NULL,NULL,'getPhoneBooks',927,928),(466,444,NULL,NULL,'authAccess',929,930),(467,444,NULL,NULL,'sweeper',931,932),(468,444,NULL,NULL,'view',933,934),(469,1,NULL,NULL,'Processes',936,993),(470,469,NULL,NULL,'index',937,938),(471,469,NULL,NULL,'system',939,940),(472,469,NULL,NULL,'start',941,942),(473,469,NULL,NULL,'stop',943,944),(474,469,NULL,NULL,'refresh',945,946),(475,469,NULL,NULL,'uploadFiles',947,948),(476,469,NULL,NULL,'wav2mp3',949,950),(477,469,NULL,NULL,'wavDuration',951,952),(478,469,NULL,NULL,'getExt',953,954),(479,469,NULL,NULL,'getFilename',955,956),(480,469,NULL,NULL,'logRefresh',957,958),(481,469,NULL,NULL,'getTimezone',959,960),(482,469,NULL,NULL,'getLanguage',961,962),(483,469,NULL,NULL,'checkMyIp',963,964),(484,469,NULL,NULL,'getInstance',965,966),(485,469,NULL,NULL,'isActive',967,968),(486,469,NULL,NULL,'emptyDir',969,970),(487,469,NULL,NULL,'refreshAll',971,972),(488,469,NULL,NULL,'dateToString',973,974),(489,469,NULL,NULL,'headerGetStatus',975,976),(490,469,NULL,NULL,'getServiceName',977,978),(491,469,NULL,NULL,'getPhoneBooks',979,980),(492,469,NULL,NULL,'authAccess',981,982),(493,469,NULL,NULL,'sweeper',983,984),(494,469,NULL,NULL,'add',985,986),(495,469,NULL,NULL,'edit',987,988),(496,469,NULL,NULL,'view',989,990),(497,469,NULL,NULL,'delete',991,992),(498,1,NULL,NULL,'Nodes',994,1045),(499,498,NULL,NULL,'index',995,996),(500,498,NULL,NULL,'add',997,998),(501,498,NULL,NULL,'delete',999,1000),(502,498,NULL,NULL,'edit',1001,1002),(503,498,NULL,NULL,'download',1003,1004),(504,498,NULL,NULL,'uploadFiles',1005,1006),(505,498,NULL,NULL,'wav2mp3',1007,1008),(506,498,NULL,NULL,'wavDuration',1009,1010),(507,498,NULL,NULL,'getExt',1011,1012),(508,498,NULL,NULL,'getFilename',1013,1014),(509,498,NULL,NULL,'logRefresh',1015,1016),(510,498,NULL,NULL,'getTimezone',1017,1018),(511,498,NULL,NULL,'getLanguage',1019,1020),(512,498,NULL,NULL,'checkMyIp',1021,1022),(513,498,NULL,NULL,'getInstance',1023,1024),(514,498,NULL,NULL,'isActive',1025,1026),(515,498,NULL,NULL,'emptyDir',1027,1028),(516,498,NULL,NULL,'refreshAll',1029,1030),(517,498,NULL,NULL,'dateToString',1031,1032),(518,498,NULL,NULL,'headerGetStatus',1033,1034),(519,498,NULL,NULL,'getServiceName',1035,1036),(520,498,NULL,NULL,'getPhoneBooks',1037,1038),(521,498,NULL,NULL,'authAccess',1039,1040),(522,498,NULL,NULL,'sweeper',1041,1042),(523,498,NULL,NULL,'view',1043,1044),(524,1,NULL,NULL,'Bin',1046,1103),(525,524,NULL,NULL,'refresh',1047,1048),(526,524,NULL,NULL,'index',1049,1050),(527,524,NULL,NULL,'delete',1051,1052),(528,524,NULL,NULL,'process',1053,1054),(529,524,NULL,NULL,'disp',1055,1056),(530,524,NULL,NULL,'export',1057,1058),(531,524,NULL,NULL,'uploadFiles',1059,1060),(532,524,NULL,NULL,'wav2mp3',1061,1062),(533,524,NULL,NULL,'wavDuration',1063,1064),(534,524,NULL,NULL,'getExt',1065,1066),(535,524,NULL,NULL,'getFilename',1067,1068),(536,524,NULL,NULL,'logRefresh',1069,1070),(537,524,NULL,NULL,'getTimezone',1071,1072),(538,524,NULL,NULL,'getLanguage',1073,1074),(539,524,NULL,NULL,'checkMyIp',1075,1076),(540,524,NULL,NULL,'getInstance',1077,1078),(541,524,NULL,NULL,'isActive',1079,1080),(542,524,NULL,NULL,'emptyDir',1081,1082),(543,524,NULL,NULL,'refreshAll',1083,1084),(544,524,NULL,NULL,'dateToString',1085,1086),(545,524,NULL,NULL,'headerGetStatus',1087,1088),(546,524,NULL,NULL,'getServiceName',1089,1090),(547,524,NULL,NULL,'getPhoneBooks',1091,1092),(548,524,NULL,NULL,'authAccess',1093,1094),(549,524,NULL,NULL,'sweeper',1095,1096),(550,524,NULL,NULL,'add',1097,1098),(551,524,NULL,NULL,'edit',1099,1100),(552,524,NULL,NULL,'view',1101,1102),(553,1,NULL,NULL,'Settings',1104,1153),(554,553,NULL,NULL,'index',1105,1106),(555,553,NULL,NULL,'uploadFiles',1107,1108),(556,553,NULL,NULL,'wav2mp3',1109,1110),(557,553,NULL,NULL,'wavDuration',1111,1112),(558,553,NULL,NULL,'getExt',1113,1114),(559,553,NULL,NULL,'getFilename',1115,1116),(560,553,NULL,NULL,'logRefresh',1117,1118),(561,553,NULL,NULL,'getTimezone',1119,1120),(562,553,NULL,NULL,'getLanguage',1121,1122),(563,553,NULL,NULL,'checkMyIp',1123,1124),(564,553,NULL,NULL,'getInstance',1125,1126),(565,553,NULL,NULL,'isActive',1127,1128),(566,553,NULL,NULL,'emptyDir',1129,1130),(567,553,NULL,NULL,'refreshAll',1131,1132),(568,553,NULL,NULL,'dateToString',1133,1134),(569,553,NULL,NULL,'headerGetStatus',1135,1136),(570,553,NULL,NULL,'getServiceName',1137,1138),(571,553,NULL,NULL,'getPhoneBooks',1139,1140),(572,553,NULL,NULL,'authAccess',1141,1142),(573,553,NULL,NULL,'sweeper',1143,1144),(574,553,NULL,NULL,'add',1145,1146),(575,553,NULL,NULL,'edit',1147,1148),(576,553,NULL,NULL,'view',1149,1150),(577,553,NULL,NULL,'delete',1151,1152),(578,1,NULL,NULL,'Api',1154,1225),(579,578,NULL,NULL,'get',1155,1156),(580,578,NULL,NULL,'bin',1157,1158),(581,578,NULL,NULL,'polls',1159,1160),(582,578,NULL,NULL,'lm_menus',1161,1162),(583,578,NULL,NULL,'messages',1163,1164),(584,578,NULL,NULL,'categories',1165,1166),(585,578,NULL,NULL,'tags',1167,1168),(586,578,NULL,NULL,'cdr',1169,1170),(587,578,NULL,NULL,'services',1171,1172),(588,578,NULL,NULL,'users',1173,1174),(589,578,NULL,NULL,'system',1175,1176),(590,578,NULL,NULL,'uploadFiles',1177,1178),(591,578,NULL,NULL,'wav2mp3',1179,1180),(592,578,NULL,NULL,'wavDuration',1181,1182),(593,578,NULL,NULL,'getExt',1183,1184),(594,578,NULL,NULL,'getFilename',1185,1186),(595,578,NULL,NULL,'logRefresh',1187,1188),(596,578,NULL,NULL,'getTimezone',1189,1190),(597,578,NULL,NULL,'getLanguage',1191,1192),(598,578,NULL,NULL,'checkMyIp',1193,1194),(599,578,NULL,NULL,'getInstance',1195,1196),(600,578,NULL,NULL,'isActive',1197,1198),(601,578,NULL,NULL,'emptyDir',1199,1200),(602,578,NULL,NULL,'refreshAll',1201,1202),(603,578,NULL,NULL,'dateToString',1203,1204),(604,578,NULL,NULL,'headerGetStatus',1205,1206),(605,578,NULL,NULL,'getServiceName',1207,1208),(606,578,NULL,NULL,'getPhoneBooks',1209,1210),(607,578,NULL,NULL,'authAccess',1211,1212),(608,578,NULL,NULL,'sweeper',1213,1214),(609,578,NULL,NULL,'add',1215,1216),(610,578,NULL,NULL,'edit',1217,1218),(611,578,NULL,NULL,'index',1219,1220),(612,578,NULL,NULL,'view',1221,1222),(613,578,NULL,NULL,'delete',1223,1224),(614,1,NULL,NULL,'Channels',1226,1277),(615,614,NULL,NULL,'index',1227,1228),(616,614,NULL,NULL,'refresh',1229,1230),(617,614,NULL,NULL,'edit',1231,1232),(618,614,NULL,NULL,'uploadFiles',1233,1234),(619,614,NULL,NULL,'wav2mp3',1235,1236),(620,614,NULL,NULL,'wavDuration',1237,1238),(621,614,NULL,NULL,'getExt',1239,1240),(622,614,NULL,NULL,'getFilename',1241,1242),(623,614,NULL,NULL,'logRefresh',1243,1244),(624,614,NULL,NULL,'getTimezone',1245,1246),(625,614,NULL,NULL,'getLanguage',1247,1248),(626,614,NULL,NULL,'checkMyIp',1249,1250),(627,614,NULL,NULL,'getInstance',1251,1252),(628,614,NULL,NULL,'isActive',1253,1254),(629,614,NULL,NULL,'emptyDir',1255,1256),(630,614,NULL,NULL,'refreshAll',1257,1258),(631,614,NULL,NULL,'dateToString',1259,1260),(632,614,NULL,NULL,'headerGetStatus',1261,1262),(633,614,NULL,NULL,'getServiceName',1263,1264),(634,614,NULL,NULL,'getPhoneBooks',1265,1266),(635,614,NULL,NULL,'authAccess',1267,1268),(636,614,NULL,NULL,'sweeper',1269,1270),(637,614,NULL,NULL,'add',1271,1272),(638,614,NULL,NULL,'view',1273,1274),(639,614,NULL,NULL,'delete',1275,1276);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,417,'-1','-1','-1','-1'),(4,2,419,'1','1','1','1'),(5,2,420,'1','1','1','1'),(6,2,418,'1','1','1','1'),(7,2,168,'-1','-1','-1','-1'),(8,2,170,'1','1','1','1'),(9,2,171,'1','1','1','1'),(10,2,172,'1','1','1','1'),(11,2,174,'1','1','1','1'),(12,2,173,'1','1','1','1'),(13,2,169,'1','1','1','1'),(14,2,444,'-1','-1','-1','-1'),(15,2,445,'1','1','1','1'),(16,2,28,'-1','-1','-1','-1'),(17,2,29,'1','1','1','1'),(18,2,112,'-1','-1','-1','-1'),(19,2,113,'1','1','1','1'),(20,2,524,'-1','-1','-1','-1'),(21,2,526,'1','1','1','1'),(22,2,525,'1','1','1','1'),(23,2,527,'1','1','1','1'),(24,2,529,'1','1','1','1'),(25,2,250,'-1','-1','-1','-1'),(26,2,251,'1','1','1','1'),(27,2,257,'1','1','1','1'),(28,2,498,'-1','-1','-1','-1'),(29,2,499,'1','1','1','1'),(30,2,360,'-1','-1','-1','-1'),(31,2,362,'1','1','1','1'),(32,2,363,'1','1','1','1'),(33,2,53,'-1','-1','-1','-1'),(34,2,54,'1','1','1','1'),(35,2,79,'-1','-1','-1','-1'),(36,2,82,'1','1','1','1'),(37,2,87,'1','1','1','1'),(38,2,81,'1','1','1','1'),(39,2,89,'1','1','1','1'),(40,2,80,'1','1','1','1'),(41,2,330,'-1','-1','-1','-1'),(42,2,331,'1','1','1','1'),(43,2,333,'1','1','1','1'),(44,2,469,'-1','-1','-1','-1'),(45,2,470,'1','1','1','1'),(46,2,474,'1','1','1','1'),(47,2,471,'1','1','1','1'),(48,2,553,'-1','-1','-1','-1'),(49,2,554,'1','1','1','1'),(50,2,614,'-1','-1','-1','-1'),(51,2,615,'1','1','1','1'),(52,2,616,'1','1','1','1'),(53,2,142,'-1','-1','-1','-1'),(54,2,143,'1','1','1','1'),(55,2,224,'-1','-1','-1','-1'),(56,2,388,'-1','-1','-1','-1'),(57,2,198,'-1','-1','-1','-1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ff_users`
--

DROP TABLE IF EXISTS `ff_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ff_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
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

-- Dump completed on 2013-12-12 22:00:05
