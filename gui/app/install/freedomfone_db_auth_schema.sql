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
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=580 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,1158),(2,1,NULL,NULL,'Pages',2,51),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'uploadFiles',5,6),(5,2,NULL,NULL,'wav2mp3',7,8),(6,2,NULL,NULL,'wavDuration',9,10),(7,2,NULL,NULL,'getExt',11,12),(8,2,NULL,NULL,'getFilename',13,14),(9,2,NULL,NULL,'logRefresh',15,16),(10,2,NULL,NULL,'getTimezone',17,18),(11,2,NULL,NULL,'checkMyIp',19,20),(12,2,NULL,NULL,'getInstance',21,22),(13,2,NULL,NULL,'isActive',23,24),(14,2,NULL,NULL,'emptyDir',25,26),(15,2,NULL,NULL,'refreshAll',27,28),(16,2,NULL,NULL,'dateToString',29,30),(17,2,NULL,NULL,'headerGetStatus',31,32),(18,2,NULL,NULL,'getServiceName',33,34),(19,2,NULL,NULL,'getPhoneBooks',35,36),(20,2,NULL,NULL,'authAccess',37,38),(21,2,NULL,NULL,'system_sweeper',39,40),(22,2,NULL,NULL,'add',41,42),(23,2,NULL,NULL,'edit',43,44),(24,2,NULL,NULL,'index',45,46),(25,2,NULL,NULL,'view',47,48),(26,2,NULL,NULL,'delete',49,50),(27,1,NULL,NULL,'LmMenus',52,109),(28,27,NULL,NULL,'index',53,54),(29,27,NULL,NULL,'create',55,56),(30,27,NULL,NULL,'add',57,58),(31,27,NULL,NULL,'edit',59,60),(32,27,NULL,NULL,'download',61,62),(33,27,NULL,NULL,'delete',63,64),(34,27,NULL,NULL,'export',65,66),(35,27,NULL,NULL,'advanced_edit',67,68),(36,27,NULL,NULL,'advanced_add',69,70),(37,27,NULL,NULL,'uploadFiles',71,72),(38,27,NULL,NULL,'wav2mp3',73,74),(39,27,NULL,NULL,'wavDuration',75,76),(40,27,NULL,NULL,'getExt',77,78),(41,27,NULL,NULL,'getFilename',79,80),(42,27,NULL,NULL,'logRefresh',81,82),(43,27,NULL,NULL,'getTimezone',83,84),(44,27,NULL,NULL,'checkMyIp',85,86),(45,27,NULL,NULL,'getInstance',87,88),(46,27,NULL,NULL,'isActive',89,90),(47,27,NULL,NULL,'emptyDir',91,92),(48,27,NULL,NULL,'refreshAll',93,94),(49,27,NULL,NULL,'dateToString',95,96),(50,27,NULL,NULL,'headerGetStatus',97,98),(51,27,NULL,NULL,'getServiceName',99,100),(52,27,NULL,NULL,'getPhoneBooks',101,102),(53,27,NULL,NULL,'authAccess',103,104),(54,27,NULL,NULL,'system_sweeper',105,106),(55,27,NULL,NULL,'view',107,108),(56,1,NULL,NULL,'PhoneNumbers',110,157),(57,56,NULL,NULL,'add',111,112),(58,56,NULL,NULL,'delete',113,114),(59,56,NULL,NULL,'uploadFiles',115,116),(60,56,NULL,NULL,'wav2mp3',117,118),(61,56,NULL,NULL,'wavDuration',119,120),(62,56,NULL,NULL,'getExt',121,122),(63,56,NULL,NULL,'getFilename',123,124),(64,56,NULL,NULL,'logRefresh',125,126),(65,56,NULL,NULL,'getTimezone',127,128),(66,56,NULL,NULL,'checkMyIp',129,130),(67,56,NULL,NULL,'getInstance',131,132),(68,56,NULL,NULL,'isActive',133,134),(69,56,NULL,NULL,'emptyDir',135,136),(70,56,NULL,NULL,'refreshAll',137,138),(71,56,NULL,NULL,'dateToString',139,140),(72,56,NULL,NULL,'headerGetStatus',141,142),(73,56,NULL,NULL,'getServiceName',143,144),(74,56,NULL,NULL,'getPhoneBooks',145,146),(75,56,NULL,NULL,'authAccess',147,148),(76,56,NULL,NULL,'system_sweeper',149,150),(77,56,NULL,NULL,'edit',151,152),(78,56,NULL,NULL,'index',153,154),(79,56,NULL,NULL,'view',155,156),(80,1,NULL,NULL,'Tags',158,205),(81,80,NULL,NULL,'index',159,160),(82,80,NULL,NULL,'add',161,162),(83,80,NULL,NULL,'edit',163,164),(84,80,NULL,NULL,'delete',165,166),(85,80,NULL,NULL,'uploadFiles',167,168),(86,80,NULL,NULL,'wav2mp3',169,170),(87,80,NULL,NULL,'wavDuration',171,172),(88,80,NULL,NULL,'getExt',173,174),(89,80,NULL,NULL,'getFilename',175,176),(90,80,NULL,NULL,'logRefresh',177,178),(91,80,NULL,NULL,'getTimezone',179,180),(92,80,NULL,NULL,'checkMyIp',181,182),(93,80,NULL,NULL,'getInstance',183,184),(94,80,NULL,NULL,'isActive',185,186),(95,80,NULL,NULL,'emptyDir',187,188),(96,80,NULL,NULL,'refreshAll',189,190),(97,80,NULL,NULL,'dateToString',191,192),(98,80,NULL,NULL,'headerGetStatus',193,194),(99,80,NULL,NULL,'getServiceName',195,196),(100,80,NULL,NULL,'getPhoneBooks',197,198),(101,80,NULL,NULL,'authAccess',199,200),(102,80,NULL,NULL,'system_sweeper',201,202),(103,80,NULL,NULL,'view',203,204),(104,1,NULL,NULL,'Groups',206,253),(105,104,NULL,NULL,'index',207,208),(106,104,NULL,NULL,'uploadFiles',209,210),(107,104,NULL,NULL,'wav2mp3',211,212),(108,104,NULL,NULL,'wavDuration',213,214),(109,104,NULL,NULL,'getExt',215,216),(110,104,NULL,NULL,'getFilename',217,218),(111,104,NULL,NULL,'logRefresh',219,220),(112,104,NULL,NULL,'getTimezone',221,222),(113,104,NULL,NULL,'checkMyIp',223,224),(114,104,NULL,NULL,'getInstance',225,226),(115,104,NULL,NULL,'isActive',227,228),(116,104,NULL,NULL,'emptyDir',229,230),(117,104,NULL,NULL,'refreshAll',231,232),(118,104,NULL,NULL,'dateToString',233,234),(119,104,NULL,NULL,'headerGetStatus',235,236),(120,104,NULL,NULL,'getServiceName',237,238),(121,104,NULL,NULL,'getPhoneBooks',239,240),(122,104,NULL,NULL,'authAccess',241,242),(123,104,NULL,NULL,'system_sweeper',243,244),(124,104,NULL,NULL,'add',245,246),(125,104,NULL,NULL,'edit',247,248),(126,104,NULL,NULL,'view',249,250),(127,104,NULL,NULL,'delete',251,252),(128,1,NULL,NULL,'Polls',254,305),(129,128,NULL,NULL,'refresh',255,256),(130,128,NULL,NULL,'index',257,258),(131,128,NULL,NULL,'view',259,260),(132,128,NULL,NULL,'add',261,262),(133,128,NULL,NULL,'delete',263,264),(134,128,NULL,NULL,'unlink',265,266),(135,128,NULL,NULL,'edit',267,268),(136,128,NULL,NULL,'uploadFiles',269,270),(137,128,NULL,NULL,'wav2mp3',271,272),(138,128,NULL,NULL,'wavDuration',273,274),(139,128,NULL,NULL,'getExt',275,276),(140,128,NULL,NULL,'getFilename',277,278),(141,128,NULL,NULL,'logRefresh',279,280),(142,128,NULL,NULL,'getTimezone',281,282),(143,128,NULL,NULL,'checkMyIp',283,284),(144,128,NULL,NULL,'getInstance',285,286),(145,128,NULL,NULL,'isActive',287,288),(146,128,NULL,NULL,'emptyDir',289,290),(147,128,NULL,NULL,'refreshAll',291,292),(148,128,NULL,NULL,'dateToString',293,294),(149,128,NULL,NULL,'headerGetStatus',295,296),(150,128,NULL,NULL,'getServiceName',297,298),(151,128,NULL,NULL,'getPhoneBooks',299,300),(152,128,NULL,NULL,'authAccess',301,302),(153,128,NULL,NULL,'system_sweeper',303,304),(154,1,NULL,NULL,'IvrMenus',306,363),(155,154,NULL,NULL,'index',307,308),(156,154,NULL,NULL,'add',309,310),(157,154,NULL,NULL,'add_selector',311,312),(158,154,NULL,NULL,'edit',313,314),(159,154,NULL,NULL,'delete',315,316),(160,154,NULL,NULL,'download',317,318),(161,154,NULL,NULL,'selectors',319,320),(162,154,NULL,NULL,'edit_selector',321,322),(163,154,NULL,NULL,'disp',323,324),(164,154,NULL,NULL,'uploadFiles',325,326),(165,154,NULL,NULL,'wav2mp3',327,328),(166,154,NULL,NULL,'wavDuration',329,330),(167,154,NULL,NULL,'getExt',331,332),(168,154,NULL,NULL,'getFilename',333,334),(169,154,NULL,NULL,'logRefresh',335,336),(170,154,NULL,NULL,'getTimezone',337,338),(171,154,NULL,NULL,'checkMyIp',339,340),(172,154,NULL,NULL,'getInstance',341,342),(173,154,NULL,NULL,'isActive',343,344),(174,154,NULL,NULL,'emptyDir',345,346),(175,154,NULL,NULL,'refreshAll',347,348),(176,154,NULL,NULL,'dateToString',349,350),(177,154,NULL,NULL,'headerGetStatus',351,352),(178,154,NULL,NULL,'getServiceName',353,354),(179,154,NULL,NULL,'getPhoneBooks',355,356),(180,154,NULL,NULL,'authAccess',357,358),(181,154,NULL,NULL,'system_sweeper',359,360),(182,154,NULL,NULL,'view',361,362),(183,1,NULL,NULL,'Messages',364,421),(184,183,NULL,NULL,'refresh',365,366),(185,183,NULL,NULL,'index',367,368),(186,183,NULL,NULL,'disp',369,370),(187,183,NULL,NULL,'archive',371,372),(188,183,NULL,NULL,'view',373,374),(189,183,NULL,NULL,'edit',375,376),(190,183,NULL,NULL,'delete',377,378),(191,183,NULL,NULL,'process',379,380),(192,183,NULL,NULL,'download',381,382),(193,183,NULL,NULL,'uploadFiles',383,384),(194,183,NULL,NULL,'wav2mp3',385,386),(195,183,NULL,NULL,'wavDuration',387,388),(196,183,NULL,NULL,'getExt',389,390),(197,183,NULL,NULL,'getFilename',391,392),(198,183,NULL,NULL,'logRefresh',393,394),(199,183,NULL,NULL,'getTimezone',395,396),(200,183,NULL,NULL,'checkMyIp',397,398),(201,183,NULL,NULL,'getInstance',399,400),(202,183,NULL,NULL,'isActive',401,402),(203,183,NULL,NULL,'emptyDir',403,404),(204,183,NULL,NULL,'refreshAll',405,406),(205,183,NULL,NULL,'dateToString',407,408),(206,183,NULL,NULL,'headerGetStatus',409,410),(207,183,NULL,NULL,'getServiceName',411,412),(208,183,NULL,NULL,'getPhoneBooks',413,414),(209,183,NULL,NULL,'authAccess',415,416),(210,183,NULL,NULL,'system_sweeper',417,418),(211,183,NULL,NULL,'add',419,420),(212,1,NULL,NULL,'Votes',422,469),(213,212,NULL,NULL,'add',423,424),(214,212,NULL,NULL,'delete',425,426),(215,212,NULL,NULL,'uploadFiles',427,428),(216,212,NULL,NULL,'wav2mp3',429,430),(217,212,NULL,NULL,'wavDuration',431,432),(218,212,NULL,NULL,'getExt',433,434),(219,212,NULL,NULL,'getFilename',435,436),(220,212,NULL,NULL,'logRefresh',437,438),(221,212,NULL,NULL,'getTimezone',439,440),(222,212,NULL,NULL,'checkMyIp',441,442),(223,212,NULL,NULL,'getInstance',443,444),(224,212,NULL,NULL,'isActive',445,446),(225,212,NULL,NULL,'emptyDir',447,448),(226,212,NULL,NULL,'refreshAll',449,450),(227,212,NULL,NULL,'dateToString',451,452),(228,212,NULL,NULL,'headerGetStatus',453,454),(229,212,NULL,NULL,'getServiceName',455,456),(230,212,NULL,NULL,'getPhoneBooks',457,458),(231,212,NULL,NULL,'authAccess',459,460),(232,212,NULL,NULL,'system_sweeper',461,462),(233,212,NULL,NULL,'edit',463,464),(234,212,NULL,NULL,'index',465,466),(235,212,NULL,NULL,'view',467,468),(236,1,NULL,NULL,'Nodes',470,519),(237,236,NULL,NULL,'index',471,472),(238,236,NULL,NULL,'add',473,474),(239,236,NULL,NULL,'delete',475,476),(240,236,NULL,NULL,'edit',477,478),(241,236,NULL,NULL,'download',479,480),(242,236,NULL,NULL,'uploadFiles',481,482),(243,236,NULL,NULL,'wav2mp3',483,484),(244,236,NULL,NULL,'wavDuration',485,486),(245,236,NULL,NULL,'getExt',487,488),(246,236,NULL,NULL,'getFilename',489,490),(247,236,NULL,NULL,'logRefresh',491,492),(248,236,NULL,NULL,'getTimezone',493,494),(249,236,NULL,NULL,'checkMyIp',495,496),(250,236,NULL,NULL,'getInstance',497,498),(251,236,NULL,NULL,'isActive',499,500),(252,236,NULL,NULL,'emptyDir',501,502),(253,236,NULL,NULL,'refreshAll',503,504),(254,236,NULL,NULL,'dateToString',505,506),(255,236,NULL,NULL,'headerGetStatus',507,508),(256,236,NULL,NULL,'getServiceName',509,510),(257,236,NULL,NULL,'getPhoneBooks',511,512),(258,236,NULL,NULL,'authAccess',513,514),(259,236,NULL,NULL,'system_sweeper',515,516),(260,236,NULL,NULL,'view',517,518),(261,1,NULL,NULL,'Channels',520,569),(262,261,NULL,NULL,'index',521,522),(263,261,NULL,NULL,'refresh',523,524),(264,261,NULL,NULL,'edit',525,526),(265,261,NULL,NULL,'uploadFiles',527,528),(266,261,NULL,NULL,'wav2mp3',529,530),(267,261,NULL,NULL,'wavDuration',531,532),(268,261,NULL,NULL,'getExt',533,534),(269,261,NULL,NULL,'getFilename',535,536),(270,261,NULL,NULL,'logRefresh',537,538),(271,261,NULL,NULL,'getTimezone',539,540),(272,261,NULL,NULL,'checkMyIp',541,542),(273,261,NULL,NULL,'getInstance',543,544),(274,261,NULL,NULL,'isActive',545,546),(275,261,NULL,NULL,'emptyDir',547,548),(276,261,NULL,NULL,'refreshAll',549,550),(277,261,NULL,NULL,'dateToString',551,552),(278,261,NULL,NULL,'headerGetStatus',553,554),(279,261,NULL,NULL,'getServiceName',555,556),(280,261,NULL,NULL,'getPhoneBooks',557,558),(281,261,NULL,NULL,'authAccess',559,560),(282,261,NULL,NULL,'system_sweeper',561,562),(283,261,NULL,NULL,'add',563,564),(284,261,NULL,NULL,'view',565,566),(285,261,NULL,NULL,'delete',567,568),(286,1,NULL,NULL,'PhoneBooks',570,619),(287,286,NULL,NULL,'index',571,572),(288,286,NULL,NULL,'add',573,574),(289,286,NULL,NULL,'edit',575,576),(290,286,NULL,NULL,'delete',577,578),(291,286,NULL,NULL,'export',579,580),(292,286,NULL,NULL,'uploadFiles',581,582),(293,286,NULL,NULL,'wav2mp3',583,584),(294,286,NULL,NULL,'wavDuration',585,586),(295,286,NULL,NULL,'getExt',587,588),(296,286,NULL,NULL,'getFilename',589,590),(297,286,NULL,NULL,'logRefresh',591,592),(298,286,NULL,NULL,'getTimezone',593,594),(299,286,NULL,NULL,'checkMyIp',595,596),(300,286,NULL,NULL,'getInstance',597,598),(301,286,NULL,NULL,'isActive',599,600),(302,286,NULL,NULL,'emptyDir',601,602),(303,286,NULL,NULL,'refreshAll',603,604),(304,286,NULL,NULL,'dateToString',605,606),(305,286,NULL,NULL,'headerGetStatus',607,608),(306,286,NULL,NULL,'getServiceName',609,610),(307,286,NULL,NULL,'getPhoneBooks',611,612),(308,286,NULL,NULL,'authAccess',613,614),(309,286,NULL,NULL,'system_sweeper',615,616),(310,286,NULL,NULL,'view',617,618),(311,1,NULL,NULL,'OfficeRoute',620,669),(312,311,NULL,NULL,'refresh',621,622),(313,311,NULL,NULL,'edit',623,624),(314,311,NULL,NULL,'uploadFiles',625,626),(315,311,NULL,NULL,'wav2mp3',627,628),(316,311,NULL,NULL,'wavDuration',629,630),(317,311,NULL,NULL,'getExt',631,632),(318,311,NULL,NULL,'getFilename',633,634),(319,311,NULL,NULL,'logRefresh',635,636),(320,311,NULL,NULL,'getTimezone',637,638),(321,311,NULL,NULL,'checkMyIp',639,640),(322,311,NULL,NULL,'getInstance',641,642),(323,311,NULL,NULL,'isActive',643,644),(324,311,NULL,NULL,'emptyDir',645,646),(325,311,NULL,NULL,'refreshAll',647,648),(326,311,NULL,NULL,'dateToString',649,650),(327,311,NULL,NULL,'headerGetStatus',651,652),(328,311,NULL,NULL,'getServiceName',653,654),(329,311,NULL,NULL,'getPhoneBooks',655,656),(330,311,NULL,NULL,'authAccess',657,658),(331,311,NULL,NULL,'system_sweeper',659,660),(332,311,NULL,NULL,'add',661,662),(333,311,NULL,NULL,'index',663,664),(334,311,NULL,NULL,'view',665,666),(335,311,NULL,NULL,'delete',667,668),(336,1,NULL,NULL,'Settings',670,717),(337,336,NULL,NULL,'index',671,672),(338,336,NULL,NULL,'uploadFiles',673,674),(339,336,NULL,NULL,'wav2mp3',675,676),(340,336,NULL,NULL,'wavDuration',677,678),(341,336,NULL,NULL,'getExt',679,680),(342,336,NULL,NULL,'getFilename',681,682),(343,336,NULL,NULL,'logRefresh',683,684),(344,336,NULL,NULL,'getTimezone',685,686),(345,336,NULL,NULL,'checkMyIp',687,688),(346,336,NULL,NULL,'getInstance',689,690),(347,336,NULL,NULL,'isActive',691,692),(348,336,NULL,NULL,'emptyDir',693,694),(349,336,NULL,NULL,'refreshAll',695,696),(350,336,NULL,NULL,'dateToString',697,698),(351,336,NULL,NULL,'headerGetStatus',699,700),(352,336,NULL,NULL,'getServiceName',701,702),(353,336,NULL,NULL,'getPhoneBooks',703,704),(354,336,NULL,NULL,'authAccess',705,706),(355,336,NULL,NULL,'system_sweeper',707,708),(356,336,NULL,NULL,'add',709,710),(357,336,NULL,NULL,'edit',711,712),(358,336,NULL,NULL,'view',713,714),(359,336,NULL,NULL,'delete',715,716),(360,1,NULL,NULL,'Cdr',718,781),(361,360,NULL,NULL,'refresh',719,720),(362,360,NULL,NULL,'general',721,722),(363,360,NULL,NULL,'index',723,724),(364,360,NULL,NULL,'del',725,726),(365,360,NULL,NULL,'process',727,728),(366,360,NULL,NULL,'output',729,730),(367,360,NULL,NULL,'export',731,732),(368,360,NULL,NULL,'statistics',733,734),(369,360,NULL,NULL,'delete',735,736),(370,360,NULL,NULL,'overview',737,738),(371,360,NULL,NULL,'uploadFiles',739,740),(372,360,NULL,NULL,'wav2mp3',741,742),(373,360,NULL,NULL,'wavDuration',743,744),(374,360,NULL,NULL,'getExt',745,746),(375,360,NULL,NULL,'getFilename',747,748),(376,360,NULL,NULL,'logRefresh',749,750),(377,360,NULL,NULL,'getTimezone',751,752),(378,360,NULL,NULL,'checkMyIp',753,754),(379,360,NULL,NULL,'getInstance',755,756),(380,360,NULL,NULL,'isActive',757,758),(381,360,NULL,NULL,'emptyDir',759,760),(382,360,NULL,NULL,'refreshAll',761,762),(383,360,NULL,NULL,'dateToString',763,764),(384,360,NULL,NULL,'headerGetStatus',765,766),(385,360,NULL,NULL,'getServiceName',767,768),(386,360,NULL,NULL,'getPhoneBooks',769,770),(387,360,NULL,NULL,'authAccess',771,772),(388,360,NULL,NULL,'system_sweeper',773,774),(389,360,NULL,NULL,'add',775,776),(390,360,NULL,NULL,'edit',777,778),(391,360,NULL,NULL,'view',779,780),(392,1,NULL,NULL,'Users',782,835),(393,392,NULL,NULL,'refresh',783,784),(394,392,NULL,NULL,'index',785,786),(395,392,NULL,NULL,'view',787,788),(396,392,NULL,NULL,'edit',789,790),(397,392,NULL,NULL,'delete',791,792),(398,392,NULL,NULL,'process',793,794),(399,392,NULL,NULL,'add',795,796),(400,392,NULL,NULL,'disp',797,798),(401,392,NULL,NULL,'uploadFiles',799,800),(402,392,NULL,NULL,'wav2mp3',801,802),(403,392,NULL,NULL,'wavDuration',803,804),(404,392,NULL,NULL,'getExt',805,806),(405,392,NULL,NULL,'getFilename',807,808),(406,392,NULL,NULL,'logRefresh',809,810),(407,392,NULL,NULL,'getTimezone',811,812),(408,392,NULL,NULL,'checkMyIp',813,814),(409,392,NULL,NULL,'getInstance',815,816),(410,392,NULL,NULL,'isActive',817,818),(411,392,NULL,NULL,'emptyDir',819,820),(412,392,NULL,NULL,'refreshAll',821,822),(413,392,NULL,NULL,'dateToString',823,824),(414,392,NULL,NULL,'headerGetStatus',825,826),(415,392,NULL,NULL,'getServiceName',827,828),(416,392,NULL,NULL,'getPhoneBooks',829,830),(417,392,NULL,NULL,'authAccess',831,832),(418,392,NULL,NULL,'system_sweeper',833,834),(419,1,NULL,NULL,'Bin',836,889),(420,419,NULL,NULL,'index',837,838),(421,419,NULL,NULL,'process',839,840),(422,419,NULL,NULL,'delete',841,842),(423,419,NULL,NULL,'export',843,844),(424,419,NULL,NULL,'refresh',845,846),(425,419,NULL,NULL,'uploadFiles',847,848),(426,419,NULL,NULL,'wav2mp3',849,850),(427,419,NULL,NULL,'wavDuration',851,852),(428,419,NULL,NULL,'getExt',853,854),(429,419,NULL,NULL,'getFilename',855,856),(430,419,NULL,NULL,'logRefresh',857,858),(431,419,NULL,NULL,'getTimezone',859,860),(432,419,NULL,NULL,'checkMyIp',861,862),(433,419,NULL,NULL,'getInstance',863,864),(434,419,NULL,NULL,'isActive',865,866),(435,419,NULL,NULL,'emptyDir',867,868),(436,419,NULL,NULL,'refreshAll',869,870),(437,419,NULL,NULL,'dateToString',871,872),(438,419,NULL,NULL,'headerGetStatus',873,874),(439,419,NULL,NULL,'getServiceName',875,876),(440,419,NULL,NULL,'getPhoneBooks',877,878),(441,419,NULL,NULL,'authAccess',879,880),(442,419,NULL,NULL,'system_sweeper',881,882),(443,419,NULL,NULL,'add',883,884),(444,419,NULL,NULL,'edit',885,886),(445,419,NULL,NULL,'view',887,888),(446,1,NULL,NULL,'Logs',890,939),(447,446,NULL,NULL,'index',891,892),(448,446,NULL,NULL,'disp',893,894),(449,446,NULL,NULL,'uploadFiles',895,896),(450,446,NULL,NULL,'wav2mp3',897,898),(451,446,NULL,NULL,'wavDuration',899,900),(452,446,NULL,NULL,'getExt',901,902),(453,446,NULL,NULL,'getFilename',903,904),(454,446,NULL,NULL,'logRefresh',905,906),(455,446,NULL,NULL,'getTimezone',907,908),(456,446,NULL,NULL,'checkMyIp',909,910),(457,446,NULL,NULL,'getInstance',911,912),(458,446,NULL,NULL,'isActive',913,914),(459,446,NULL,NULL,'emptyDir',915,916),(460,446,NULL,NULL,'refreshAll',917,918),(461,446,NULL,NULL,'dateToString',919,920),(462,446,NULL,NULL,'headerGetStatus',921,922),(463,446,NULL,NULL,'getServiceName',923,924),(464,446,NULL,NULL,'getPhoneBooks',925,926),(465,446,NULL,NULL,'authAccess',927,928),(466,446,NULL,NULL,'system_sweeper',929,930),(467,446,NULL,NULL,'add',931,932),(468,446,NULL,NULL,'edit',933,934),(469,446,NULL,NULL,'view',935,936),(470,446,NULL,NULL,'delete',937,938),(471,1,NULL,NULL,'FfUsers',940,995),(472,471,NULL,NULL,'login',941,942),(473,471,NULL,NULL,'logout',943,944),(474,471,NULL,NULL,'index',945,946),(475,471,NULL,NULL,'add',947,948),(476,471,NULL,NULL,'edit',949,950),(477,471,NULL,NULL,'delete',951,952),(478,471,NULL,NULL,'sweep',953,954),(479,471,NULL,NULL,'initDB',955,956),(480,471,NULL,NULL,'uploadFiles',957,958),(481,471,NULL,NULL,'wav2mp3',959,960),(482,471,NULL,NULL,'wavDuration',961,962),(483,471,NULL,NULL,'getExt',963,964),(484,471,NULL,NULL,'getFilename',965,966),(485,471,NULL,NULL,'logRefresh',967,968),(486,471,NULL,NULL,'getTimezone',969,970),(487,471,NULL,NULL,'checkMyIp',971,972),(488,471,NULL,NULL,'getInstance',973,974),(489,471,NULL,NULL,'isActive',975,976),(490,471,NULL,NULL,'emptyDir',977,978),(491,471,NULL,NULL,'refreshAll',979,980),(492,471,NULL,NULL,'dateToString',981,982),(493,471,NULL,NULL,'headerGetStatus',983,984),(494,471,NULL,NULL,'getServiceName',985,986),(495,471,NULL,NULL,'getPhoneBooks',987,988),(496,471,NULL,NULL,'authAccess',989,990),(497,471,NULL,NULL,'system_sweeper',991,992),(498,471,NULL,NULL,'view',993,994),(499,1,NULL,NULL,'MonitorIvr',996,1053),(500,499,NULL,NULL,'index',997,998),(501,499,NULL,NULL,'del',999,1000),(502,499,NULL,NULL,'refresh',1001,1002),(503,499,NULL,NULL,'process',1003,1004),(504,499,NULL,NULL,'export',1005,1006),(505,499,NULL,NULL,'output',1007,1008),(506,499,NULL,NULL,'delete',1009,1010),(507,499,NULL,NULL,'uploadFiles',1011,1012),(508,499,NULL,NULL,'wav2mp3',1013,1014),(509,499,NULL,NULL,'wavDuration',1015,1016),(510,499,NULL,NULL,'getExt',1017,1018),(511,499,NULL,NULL,'getFilename',1019,1020),(512,499,NULL,NULL,'logRefresh',1021,1022),(513,499,NULL,NULL,'getTimezone',1023,1024),(514,499,NULL,NULL,'checkMyIp',1025,1026),(515,499,NULL,NULL,'getInstance',1027,1028),(516,499,NULL,NULL,'isActive',1029,1030),(517,499,NULL,NULL,'emptyDir',1031,1032),(518,499,NULL,NULL,'refreshAll',1033,1034),(519,499,NULL,NULL,'dateToString',1035,1036),(520,499,NULL,NULL,'headerGetStatus',1037,1038),(521,499,NULL,NULL,'getServiceName',1039,1040),(522,499,NULL,NULL,'getPhoneBooks',1041,1042),(523,499,NULL,NULL,'authAccess',1043,1044),(524,499,NULL,NULL,'system_sweeper',1045,1046),(525,499,NULL,NULL,'add',1047,1048),(526,499,NULL,NULL,'edit',1049,1050),(527,499,NULL,NULL,'view',1051,1052),(528,1,NULL,NULL,'Processes',1054,1109),(529,528,NULL,NULL,'index',1055,1056),(530,528,NULL,NULL,'system',1057,1058),(531,528,NULL,NULL,'start',1059,1060),(532,528,NULL,NULL,'stop',1061,1062),(533,528,NULL,NULL,'refresh',1063,1064),(534,528,NULL,NULL,'uploadFiles',1065,1066),(535,528,NULL,NULL,'wav2mp3',1067,1068),(536,528,NULL,NULL,'wavDuration',1069,1070),(537,528,NULL,NULL,'getExt',1071,1072),(538,528,NULL,NULL,'getFilename',1073,1074),(539,528,NULL,NULL,'logRefresh',1075,1076),(540,528,NULL,NULL,'getTimezone',1077,1078),(541,528,NULL,NULL,'checkMyIp',1079,1080),(542,528,NULL,NULL,'getInstance',1081,1082),(543,528,NULL,NULL,'isActive',1083,1084),(544,528,NULL,NULL,'emptyDir',1085,1086),(545,528,NULL,NULL,'refreshAll',1087,1088),(546,528,NULL,NULL,'dateToString',1089,1090),(547,528,NULL,NULL,'headerGetStatus',1091,1092),(548,528,NULL,NULL,'getServiceName',1093,1094),(549,528,NULL,NULL,'getPhoneBooks',1095,1096),(550,528,NULL,NULL,'authAccess',1097,1098),(551,528,NULL,NULL,'system_sweeper',1099,1100),(552,528,NULL,NULL,'add',1101,1102),(553,528,NULL,NULL,'edit',1103,1104),(554,528,NULL,NULL,'view',1105,1106),(555,528,NULL,NULL,'delete',1107,1108),(556,1,NULL,NULL,'Categories',1110,1157),(557,556,NULL,NULL,'index',1111,1112),(558,556,NULL,NULL,'add',1113,1114),(559,556,NULL,NULL,'edit',1115,1116),(560,556,NULL,NULL,'delete',1117,1118),(561,556,NULL,NULL,'uploadFiles',1119,1120),(562,556,NULL,NULL,'wav2mp3',1121,1122),(563,556,NULL,NULL,'wavDuration',1123,1124),(564,556,NULL,NULL,'getExt',1125,1126),(565,556,NULL,NULL,'getFilename',1127,1128),(566,556,NULL,NULL,'logRefresh',1129,1130),(567,556,NULL,NULL,'getTimezone',1131,1132),(568,556,NULL,NULL,'checkMyIp',1133,1134),(569,556,NULL,NULL,'getInstance',1135,1136),(570,556,NULL,NULL,'isActive',1137,1138),(571,556,NULL,NULL,'emptyDir',1139,1140),(572,556,NULL,NULL,'refreshAll',1141,1142),(573,556,NULL,NULL,'dateToString',1143,1144),(574,556,NULL,NULL,'headerGetStatus',1145,1146),(575,556,NULL,NULL,'getServiceName',1147,1148),(576,556,NULL,NULL,'getPhoneBooks',1149,1150),(577,556,NULL,NULL,'authAccess',1151,1152),(578,556,NULL,NULL,'system_sweeper',1153,1154),(579,556,NULL,NULL,'view',1155,1156);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL auto_increment,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL default '0',
  `_read` varchar(2) NOT NULL default '0',
  `_update` varchar(2) NOT NULL default '0',
  `_delete` varchar(2) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,128,'-1','-1','-1','-1'),(4,2,130,'1','1','1','1'),(5,2,131,'1','1','1','1'),(6,2,129,'1','1','1','1'),(7,2,183,'-1','-1','-1','-1'),(8,2,185,'1','1','1','1'),(9,2,186,'1','1','1','1'),(10,2,187,'1','1','1','1'),(11,2,189,'1','1','1','1'),(12,2,188,'1','1','1','1'),(13,2,184,'1','1','1','1'),(14,2,556,'-1','-1','-1','-1'),(15,2,557,'1','1','1','1'),(16,2,80,'-1','-1','-1','-1'),(17,2,81,'1','1','1','1'),(18,2,27,'-1','-1','-1','-1'),(19,2,28,'1','1','1','1'),(20,2,419,'-1','-1','-1','-1'),(21,2,420,'1','1','1','1'),(22,2,424,'1','1','1','1'),(23,2,154,'-1','-1','-1','-1'),(24,2,155,'1','1','1','1'),(25,2,161,'1','1','1','1'),(26,2,236,'-1','-1','-1','-1'),(27,2,237,'1','1','1','1'),(28,2,392,'-1','-1','-1','-1'),(29,2,394,'1','1','1','1'),(30,2,395,'1','1','1','1'),(31,2,286,'-1','-1','-1','-1'),(32,2,287,'1','1','1','1'),(33,2,360,'-1','-1','-1','-1'),(34,2,363,'1','1','1','1'),(35,2,368,'1','1','1','1'),(36,2,362,'1','1','1','1'),(37,2,370,'1','1','1','1'),(38,2,361,'1','1','1','1'),(39,2,499,'-1','-1','-1','-1'),(40,2,500,'1','1','1','1'),(41,2,502,'1','1','1','1'),(42,2,528,'-1','-1','-1','-1'),(43,2,529,'1','1','1','1'),(44,2,533,'1','1','1','1'),(45,2,530,'1','1','1','1'),(46,2,336,'-1','-1','-1','-1'),(47,2,337,'1','1','1','1'),(48,2,261,'-1','-1','-1','-1'),(49,2,262,'1','1','1','1'),(50,2,263,'1','1','1','1'),(51,2,311,'-1','-1','-1','-1'),(52,2,312,'1','1','1','1'),(53,2,446,'-1','-1','-1','-1'),(54,2,471,'-1','-1','-1','-1'),(55,2,104,'-1','-1','-1','-1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ff_users`
--

DROP TABLE IF EXISTS `ff_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ff_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

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

-- Dump completed on 2011-09-29 10:26:09
