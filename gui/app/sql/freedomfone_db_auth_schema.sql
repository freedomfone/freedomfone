-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
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
) ENGINE=InnoDB AUTO_INCREMENT=667 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,1332),(2,1,NULL,NULL,'Pages',2,53),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'uploadFiles',5,6),(5,2,NULL,NULL,'wav2mp3',7,8),(6,2,NULL,NULL,'wavDuration',9,10),(7,2,NULL,NULL,'getExt',11,12),(8,2,NULL,NULL,'getFilename',13,14),(9,2,NULL,NULL,'logRefresh',15,16),(10,2,NULL,NULL,'getTimezone',17,18),(11,2,NULL,NULL,'getLanguage',19,20),(12,2,NULL,NULL,'checkMyIp',21,22),(13,2,NULL,NULL,'getInstance',23,24),(14,2,NULL,NULL,'isActive',25,26),(15,2,NULL,NULL,'emptyDir',27,28),(16,2,NULL,NULL,'refreshAll',29,30),(17,2,NULL,NULL,'dateToString',31,32),(18,2,NULL,NULL,'headerGetStatus',33,34),(19,2,NULL,NULL,'getServiceName',35,36),(20,2,NULL,NULL,'getPhoneBooks',37,38),(21,2,NULL,NULL,'authAccess',39,40),(22,2,NULL,NULL,'sweeper',41,42),(23,2,NULL,NULL,'add',43,44),(24,2,NULL,NULL,'edit',45,46),(25,2,NULL,NULL,'index',47,48),(26,2,NULL,NULL,'view',49,50),(27,2,NULL,NULL,'delete',51,52),(28,1,NULL,NULL,'Tags',54,103),(29,28,NULL,NULL,'index',55,56),(30,28,NULL,NULL,'add',57,58),(31,28,NULL,NULL,'edit',59,60),(32,28,NULL,NULL,'delete',61,62),(33,28,NULL,NULL,'uploadFiles',63,64),(34,28,NULL,NULL,'wav2mp3',65,66),(35,28,NULL,NULL,'wavDuration',67,68),(36,28,NULL,NULL,'getExt',69,70),(37,28,NULL,NULL,'getFilename',71,72),(38,28,NULL,NULL,'logRefresh',73,74),(39,28,NULL,NULL,'getTimezone',75,76),(40,28,NULL,NULL,'getLanguage',77,78),(41,28,NULL,NULL,'checkMyIp',79,80),(42,28,NULL,NULL,'getInstance',81,82),(43,28,NULL,NULL,'isActive',83,84),(44,28,NULL,NULL,'emptyDir',85,86),(45,28,NULL,NULL,'refreshAll',87,88),(46,28,NULL,NULL,'dateToString',89,90),(47,28,NULL,NULL,'headerGetStatus',91,92),(48,28,NULL,NULL,'getServiceName',93,94),(49,28,NULL,NULL,'getPhoneBooks',95,96),(50,28,NULL,NULL,'authAccess',97,98),(51,28,NULL,NULL,'sweeper',99,100),(52,28,NULL,NULL,'view',101,102),(53,1,NULL,NULL,'PhoneBooks',104,155),(54,53,NULL,NULL,'index',105,106),(55,53,NULL,NULL,'add',107,108),(56,53,NULL,NULL,'edit',109,110),(57,53,NULL,NULL,'delete',111,112),(58,53,NULL,NULL,'export',113,114),(59,53,NULL,NULL,'uploadFiles',115,116),(60,53,NULL,NULL,'wav2mp3',117,118),(61,53,NULL,NULL,'wavDuration',119,120),(62,53,NULL,NULL,'getExt',121,122),(63,53,NULL,NULL,'getFilename',123,124),(64,53,NULL,NULL,'logRefresh',125,126),(65,53,NULL,NULL,'getTimezone',127,128),(66,53,NULL,NULL,'getLanguage',129,130),(67,53,NULL,NULL,'checkMyIp',131,132),(68,53,NULL,NULL,'getInstance',133,134),(69,53,NULL,NULL,'isActive',135,136),(70,53,NULL,NULL,'emptyDir',137,138),(71,53,NULL,NULL,'refreshAll',139,140),(72,53,NULL,NULL,'dateToString',141,142),(73,53,NULL,NULL,'headerGetStatus',143,144),(74,53,NULL,NULL,'getServiceName',145,146),(75,53,NULL,NULL,'getPhoneBooks',147,148),(76,53,NULL,NULL,'authAccess',149,150),(77,53,NULL,NULL,'sweeper',151,152),(78,53,NULL,NULL,'view',153,154),(79,1,NULL,NULL,'Batches',156,207),(80,79,NULL,NULL,'index',157,158),(81,79,NULL,NULL,'disp',159,160),(82,79,NULL,NULL,'add',161,162),(83,79,NULL,NULL,'delete',163,164),(84,79,NULL,NULL,'uploadFiles',165,166),(85,79,NULL,NULL,'wav2mp3',167,168),(86,79,NULL,NULL,'wavDuration',169,170),(87,79,NULL,NULL,'getExt',171,172),(88,79,NULL,NULL,'getFilename',173,174),(89,79,NULL,NULL,'logRefresh',175,176),(90,79,NULL,NULL,'getTimezone',177,178),(91,79,NULL,NULL,'getLanguage',179,180),(92,79,NULL,NULL,'checkMyIp',181,182),(93,79,NULL,NULL,'getInstance',183,184),(94,79,NULL,NULL,'isActive',185,186),(95,79,NULL,NULL,'emptyDir',187,188),(96,79,NULL,NULL,'refreshAll',189,190),(97,79,NULL,NULL,'dateToString',191,192),(98,79,NULL,NULL,'headerGetStatus',193,194),(99,79,NULL,NULL,'getServiceName',195,196),(100,79,NULL,NULL,'getPhoneBooks',197,198),(101,79,NULL,NULL,'authAccess',199,200),(102,79,NULL,NULL,'sweeper',201,202),(103,79,NULL,NULL,'edit',203,204),(104,79,NULL,NULL,'view',205,206),(105,1,NULL,NULL,'Cdr',208,273),(106,105,NULL,NULL,'refresh',209,210),(107,105,NULL,NULL,'general',211,212),(108,105,NULL,NULL,'index',213,214),(109,105,NULL,NULL,'del',215,216),(110,105,NULL,NULL,'process',217,218),(111,105,NULL,NULL,'output',219,220),(112,105,NULL,NULL,'export',221,222),(113,105,NULL,NULL,'statistics',223,224),(114,105,NULL,NULL,'delete',225,226),(115,105,NULL,NULL,'overview',227,228),(116,105,NULL,NULL,'uploadFiles',229,230),(117,105,NULL,NULL,'wav2mp3',231,232),(118,105,NULL,NULL,'wavDuration',233,234),(119,105,NULL,NULL,'getExt',235,236),(120,105,NULL,NULL,'getFilename',237,238),(121,105,NULL,NULL,'logRefresh',239,240),(122,105,NULL,NULL,'getTimezone',241,242),(123,105,NULL,NULL,'getLanguage',243,244),(124,105,NULL,NULL,'checkMyIp',245,246),(125,105,NULL,NULL,'getInstance',247,248),(126,105,NULL,NULL,'isActive',249,250),(127,105,NULL,NULL,'emptyDir',251,252),(128,105,NULL,NULL,'refreshAll',253,254),(129,105,NULL,NULL,'dateToString',255,256),(130,105,NULL,NULL,'headerGetStatus',257,258),(131,105,NULL,NULL,'getServiceName',259,260),(132,105,NULL,NULL,'getPhoneBooks',261,262),(133,105,NULL,NULL,'authAccess',263,264),(134,105,NULL,NULL,'sweeper',265,266),(135,105,NULL,NULL,'add',267,268),(136,105,NULL,NULL,'edit',269,270),(137,105,NULL,NULL,'view',271,272),(138,1,NULL,NULL,'LmMenus',274,333),(139,138,NULL,NULL,'index',275,276),(140,138,NULL,NULL,'create',277,278),(141,138,NULL,NULL,'add',279,280),(142,138,NULL,NULL,'edit',281,282),(143,138,NULL,NULL,'download',283,284),(144,138,NULL,NULL,'delete',285,286),(145,138,NULL,NULL,'export',287,288),(146,138,NULL,NULL,'advanced_edit',289,290),(147,138,NULL,NULL,'advanced_add',291,292),(148,138,NULL,NULL,'uploadFiles',293,294),(149,138,NULL,NULL,'wav2mp3',295,296),(150,138,NULL,NULL,'wavDuration',297,298),(151,138,NULL,NULL,'getExt',299,300),(152,138,NULL,NULL,'getFilename',301,302),(153,138,NULL,NULL,'logRefresh',303,304),(154,138,NULL,NULL,'getTimezone',305,306),(155,138,NULL,NULL,'getLanguage',307,308),(156,138,NULL,NULL,'checkMyIp',309,310),(157,138,NULL,NULL,'getInstance',311,312),(158,138,NULL,NULL,'isActive',313,314),(159,138,NULL,NULL,'emptyDir',315,316),(160,138,NULL,NULL,'refreshAll',317,318),(161,138,NULL,NULL,'dateToString',319,320),(162,138,NULL,NULL,'headerGetStatus',321,322),(163,138,NULL,NULL,'getServiceName',323,324),(164,138,NULL,NULL,'getPhoneBooks',325,326),(165,138,NULL,NULL,'authAccess',327,328),(166,138,NULL,NULL,'sweeper',329,330),(167,138,NULL,NULL,'view',331,332),(168,1,NULL,NULL,'OfficeRoute',334,385),(169,168,NULL,NULL,'refresh',335,336),(170,168,NULL,NULL,'edit',337,338),(171,168,NULL,NULL,'uploadFiles',339,340),(172,168,NULL,NULL,'wav2mp3',341,342),(173,168,NULL,NULL,'wavDuration',343,344),(174,168,NULL,NULL,'getExt',345,346),(175,168,NULL,NULL,'getFilename',347,348),(176,168,NULL,NULL,'logRefresh',349,350),(177,168,NULL,NULL,'getTimezone',351,352),(178,168,NULL,NULL,'getLanguage',353,354),(179,168,NULL,NULL,'checkMyIp',355,356),(180,168,NULL,NULL,'getInstance',357,358),(181,168,NULL,NULL,'isActive',359,360),(182,168,NULL,NULL,'emptyDir',361,362),(183,168,NULL,NULL,'refreshAll',363,364),(184,168,NULL,NULL,'dateToString',365,366),(185,168,NULL,NULL,'headerGetStatus',367,368),(186,168,NULL,NULL,'getServiceName',369,370),(187,168,NULL,NULL,'getPhoneBooks',371,372),(188,168,NULL,NULL,'authAccess',373,374),(189,168,NULL,NULL,'sweeper',375,376),(190,168,NULL,NULL,'add',377,378),(191,168,NULL,NULL,'index',379,380),(192,168,NULL,NULL,'view',381,382),(193,168,NULL,NULL,'delete',383,384),(194,1,NULL,NULL,'Messages',386,445),(195,194,NULL,NULL,'refresh',387,388),(196,194,NULL,NULL,'index',389,390),(197,194,NULL,NULL,'disp',391,392),(198,194,NULL,NULL,'archive',393,394),(199,194,NULL,NULL,'view',395,396),(200,194,NULL,NULL,'edit',397,398),(201,194,NULL,NULL,'delete',399,400),(202,194,NULL,NULL,'process',401,402),(203,194,NULL,NULL,'download',403,404),(204,194,NULL,NULL,'uploadFiles',405,406),(205,194,NULL,NULL,'wav2mp3',407,408),(206,194,NULL,NULL,'wavDuration',409,410),(207,194,NULL,NULL,'getExt',411,412),(208,194,NULL,NULL,'getFilename',413,414),(209,194,NULL,NULL,'logRefresh',415,416),(210,194,NULL,NULL,'getTimezone',417,418),(211,194,NULL,NULL,'getLanguage',419,420),(212,194,NULL,NULL,'checkMyIp',421,422),(213,194,NULL,NULL,'getInstance',423,424),(214,194,NULL,NULL,'isActive',425,426),(215,194,NULL,NULL,'emptyDir',427,428),(216,194,NULL,NULL,'refreshAll',429,430),(217,194,NULL,NULL,'dateToString',431,432),(218,194,NULL,NULL,'headerGetStatus',433,434),(219,194,NULL,NULL,'getServiceName',435,436),(220,194,NULL,NULL,'getPhoneBooks',437,438),(221,194,NULL,NULL,'authAccess',439,440),(222,194,NULL,NULL,'sweeper',441,442),(223,194,NULL,NULL,'add',443,444),(224,1,NULL,NULL,'Groups',446,497),(225,224,NULL,NULL,'parentNode',447,448),(226,224,NULL,NULL,'index',449,450),(227,224,NULL,NULL,'uploadFiles',451,452),(228,224,NULL,NULL,'wav2mp3',453,454),(229,224,NULL,NULL,'wavDuration',455,456),(230,224,NULL,NULL,'getExt',457,458),(231,224,NULL,NULL,'getFilename',459,460),(232,224,NULL,NULL,'logRefresh',461,462),(233,224,NULL,NULL,'getTimezone',463,464),(234,224,NULL,NULL,'getLanguage',465,466),(235,224,NULL,NULL,'checkMyIp',467,468),(236,224,NULL,NULL,'getInstance',469,470),(237,224,NULL,NULL,'isActive',471,472),(238,224,NULL,NULL,'emptyDir',473,474),(239,224,NULL,NULL,'refreshAll',475,476),(240,224,NULL,NULL,'dateToString',477,478),(241,224,NULL,NULL,'headerGetStatus',479,480),(242,224,NULL,NULL,'getServiceName',481,482),(243,224,NULL,NULL,'getPhoneBooks',483,484),(244,224,NULL,NULL,'authAccess',485,486),(245,224,NULL,NULL,'sweeper',487,488),(246,224,NULL,NULL,'add',489,490),(247,224,NULL,NULL,'edit',491,492),(248,224,NULL,NULL,'view',493,494),(249,224,NULL,NULL,'delete',495,496),(250,1,NULL,NULL,'Logs',498,549),(251,250,NULL,NULL,'index',499,500),(252,250,NULL,NULL,'disp',501,502),(253,250,NULL,NULL,'uploadFiles',503,504),(254,250,NULL,NULL,'wav2mp3',505,506),(255,250,NULL,NULL,'wavDuration',507,508),(256,250,NULL,NULL,'getExt',509,510),(257,250,NULL,NULL,'getFilename',511,512),(258,250,NULL,NULL,'logRefresh',513,514),(259,250,NULL,NULL,'getTimezone',515,516),(260,250,NULL,NULL,'getLanguage',517,518),(261,250,NULL,NULL,'checkMyIp',519,520),(262,250,NULL,NULL,'getInstance',521,522),(263,250,NULL,NULL,'isActive',523,524),(264,250,NULL,NULL,'emptyDir',525,526),(265,250,NULL,NULL,'refreshAll',527,528),(266,250,NULL,NULL,'dateToString',529,530),(267,250,NULL,NULL,'headerGetStatus',531,532),(268,250,NULL,NULL,'getServiceName',533,534),(269,250,NULL,NULL,'getPhoneBooks',535,536),(270,250,NULL,NULL,'authAccess',537,538),(271,250,NULL,NULL,'sweeper',539,540),(272,250,NULL,NULL,'add',541,542),(273,250,NULL,NULL,'edit',543,544),(274,250,NULL,NULL,'view',545,546),(275,250,NULL,NULL,'delete',547,548),(276,1,NULL,NULL,'IvrMenus',550,609),(277,276,NULL,NULL,'index',551,552),(278,276,NULL,NULL,'add',553,554),(279,276,NULL,NULL,'add_selector',555,556),(280,276,NULL,NULL,'edit',557,558),(281,276,NULL,NULL,'delete',559,560),(282,276,NULL,NULL,'download',561,562),(283,276,NULL,NULL,'selectors',563,564),(284,276,NULL,NULL,'edit_selector',565,566),(285,276,NULL,NULL,'disp',567,568),(286,276,NULL,NULL,'uploadFiles',569,570),(287,276,NULL,NULL,'wav2mp3',571,572),(288,276,NULL,NULL,'wavDuration',573,574),(289,276,NULL,NULL,'getExt',575,576),(290,276,NULL,NULL,'getFilename',577,578),(291,276,NULL,NULL,'logRefresh',579,580),(292,276,NULL,NULL,'getTimezone',581,582),(293,276,NULL,NULL,'getLanguage',583,584),(294,276,NULL,NULL,'checkMyIp',585,586),(295,276,NULL,NULL,'getInstance',587,588),(296,276,NULL,NULL,'isActive',589,590),(297,276,NULL,NULL,'emptyDir',591,592),(298,276,NULL,NULL,'refreshAll',593,594),(299,276,NULL,NULL,'dateToString',595,596),(300,276,NULL,NULL,'headerGetStatus',597,598),(301,276,NULL,NULL,'getServiceName',599,600),(302,276,NULL,NULL,'getPhoneBooks',601,602),(303,276,NULL,NULL,'authAccess',603,604),(304,276,NULL,NULL,'sweeper',605,606),(305,276,NULL,NULL,'view',607,608),(306,1,NULL,NULL,'PhoneNumbers',610,659),(307,306,NULL,NULL,'add',611,612),(308,306,NULL,NULL,'delete',613,614),(309,306,NULL,NULL,'uploadFiles',615,616),(310,306,NULL,NULL,'wav2mp3',617,618),(311,306,NULL,NULL,'wavDuration',619,620),(312,306,NULL,NULL,'getExt',621,622),(313,306,NULL,NULL,'getFilename',623,624),(314,306,NULL,NULL,'logRefresh',625,626),(315,306,NULL,NULL,'getTimezone',627,628),(316,306,NULL,NULL,'getLanguage',629,630),(317,306,NULL,NULL,'checkMyIp',631,632),(318,306,NULL,NULL,'getInstance',633,634),(319,306,NULL,NULL,'isActive',635,636),(320,306,NULL,NULL,'emptyDir',637,638),(321,306,NULL,NULL,'refreshAll',639,640),(322,306,NULL,NULL,'dateToString',641,642),(323,306,NULL,NULL,'headerGetStatus',643,644),(324,306,NULL,NULL,'getServiceName',645,646),(325,306,NULL,NULL,'getPhoneBooks',647,648),(326,306,NULL,NULL,'authAccess',649,650),(327,306,NULL,NULL,'sweeper',651,652),(328,306,NULL,NULL,'edit',653,654),(329,306,NULL,NULL,'index',655,656),(330,306,NULL,NULL,'view',657,658),(331,1,NULL,NULL,'Votes',660,709),(332,331,NULL,NULL,'add',661,662),(333,331,NULL,NULL,'delete',663,664),(334,331,NULL,NULL,'uploadFiles',665,666),(335,331,NULL,NULL,'wav2mp3',667,668),(336,331,NULL,NULL,'wavDuration',669,670),(337,331,NULL,NULL,'getExt',671,672),(338,331,NULL,NULL,'getFilename',673,674),(339,331,NULL,NULL,'logRefresh',675,676),(340,331,NULL,NULL,'getTimezone',677,678),(341,331,NULL,NULL,'getLanguage',679,680),(342,331,NULL,NULL,'checkMyIp',681,682),(343,331,NULL,NULL,'getInstance',683,684),(344,331,NULL,NULL,'isActive',685,686),(345,331,NULL,NULL,'emptyDir',687,688),(346,331,NULL,NULL,'refreshAll',689,690),(347,331,NULL,NULL,'dateToString',691,692),(348,331,NULL,NULL,'headerGetStatus',693,694),(349,331,NULL,NULL,'getServiceName',695,696),(350,331,NULL,NULL,'getPhoneBooks',697,698),(351,331,NULL,NULL,'authAccess',699,700),(352,331,NULL,NULL,'sweeper',701,702),(353,331,NULL,NULL,'edit',703,704),(354,331,NULL,NULL,'index',705,706),(355,331,NULL,NULL,'view',707,708),(356,1,NULL,NULL,'MonitorIvr',710,769),(357,356,NULL,NULL,'index',711,712),(358,356,NULL,NULL,'del',713,714),(359,356,NULL,NULL,'refresh',715,716),(360,356,NULL,NULL,'process',717,718),(361,356,NULL,NULL,'export',719,720),(362,356,NULL,NULL,'output',721,722),(363,356,NULL,NULL,'delete',723,724),(364,356,NULL,NULL,'uploadFiles',725,726),(365,356,NULL,NULL,'wav2mp3',727,728),(366,356,NULL,NULL,'wavDuration',729,730),(367,356,NULL,NULL,'getExt',731,732),(368,356,NULL,NULL,'getFilename',733,734),(369,356,NULL,NULL,'logRefresh',735,736),(370,356,NULL,NULL,'getTimezone',737,738),(371,356,NULL,NULL,'getLanguage',739,740),(372,356,NULL,NULL,'checkMyIp',741,742),(373,356,NULL,NULL,'getInstance',743,744),(374,356,NULL,NULL,'isActive',745,746),(375,356,NULL,NULL,'emptyDir',747,748),(376,356,NULL,NULL,'refreshAll',749,750),(377,356,NULL,NULL,'dateToString',751,752),(378,356,NULL,NULL,'headerGetStatus',753,754),(379,356,NULL,NULL,'getServiceName',755,756),(380,356,NULL,NULL,'getPhoneBooks',757,758),(381,356,NULL,NULL,'authAccess',759,760),(382,356,NULL,NULL,'sweeper',761,762),(383,356,NULL,NULL,'add',763,764),(384,356,NULL,NULL,'edit',765,766),(385,356,NULL,NULL,'view',767,768),(386,1,NULL,NULL,'Users',770,825),(387,386,NULL,NULL,'refresh',771,772),(388,386,NULL,NULL,'index',773,774),(389,386,NULL,NULL,'view',775,776),(390,386,NULL,NULL,'edit',777,778),(391,386,NULL,NULL,'delete',779,780),(392,386,NULL,NULL,'process',781,782),(393,386,NULL,NULL,'add',783,784),(394,386,NULL,NULL,'disp',785,786),(395,386,NULL,NULL,'uploadFiles',787,788),(396,386,NULL,NULL,'wav2mp3',789,790),(397,386,NULL,NULL,'wavDuration',791,792),(398,386,NULL,NULL,'getExt',793,794),(399,386,NULL,NULL,'getFilename',795,796),(400,386,NULL,NULL,'logRefresh',797,798),(401,386,NULL,NULL,'getTimezone',799,800),(402,386,NULL,NULL,'getLanguage',801,802),(403,386,NULL,NULL,'checkMyIp',803,804),(404,386,NULL,NULL,'getInstance',805,806),(405,386,NULL,NULL,'isActive',807,808),(406,386,NULL,NULL,'emptyDir',809,810),(407,386,NULL,NULL,'refreshAll',811,812),(408,386,NULL,NULL,'dateToString',813,814),(409,386,NULL,NULL,'headerGetStatus',815,816),(410,386,NULL,NULL,'getServiceName',817,818),(411,386,NULL,NULL,'getPhoneBooks',819,820),(412,386,NULL,NULL,'authAccess',821,822),(413,386,NULL,NULL,'sweeper',823,824),(414,1,NULL,NULL,'FfUsers',826,881),(415,414,NULL,NULL,'login',827,828),(416,414,NULL,NULL,'logout',829,830),(417,414,NULL,NULL,'index',831,832),(418,414,NULL,NULL,'add',833,834),(419,414,NULL,NULL,'edit',835,836),(420,414,NULL,NULL,'delete',837,838),(421,414,NULL,NULL,'system_sweeper',839,840),(422,414,NULL,NULL,'uploadFiles',841,842),(423,414,NULL,NULL,'wav2mp3',843,844),(424,414,NULL,NULL,'wavDuration',845,846),(425,414,NULL,NULL,'getExt',847,848),(426,414,NULL,NULL,'getFilename',849,850),(427,414,NULL,NULL,'logRefresh',851,852),(428,414,NULL,NULL,'getTimezone',853,854),(429,414,NULL,NULL,'getLanguage',855,856),(430,414,NULL,NULL,'checkMyIp',857,858),(431,414,NULL,NULL,'getInstance',859,860),(432,414,NULL,NULL,'isActive',861,862),(433,414,NULL,NULL,'emptyDir',863,864),(434,414,NULL,NULL,'refreshAll',865,866),(435,414,NULL,NULL,'dateToString',867,868),(436,414,NULL,NULL,'headerGetStatus',869,870),(437,414,NULL,NULL,'getServiceName',871,872),(438,414,NULL,NULL,'getPhoneBooks',873,874),(439,414,NULL,NULL,'authAccess',875,876),(440,414,NULL,NULL,'sweeper',877,878),(441,414,NULL,NULL,'view',879,880),(442,1,NULL,NULL,'Polls',882,935),(443,442,NULL,NULL,'refresh',883,884),(444,442,NULL,NULL,'index',885,886),(445,442,NULL,NULL,'view',887,888),(446,442,NULL,NULL,'add',889,890),(447,442,NULL,NULL,'delete',891,892),(448,442,NULL,NULL,'unlink',893,894),(449,442,NULL,NULL,'edit',895,896),(450,442,NULL,NULL,'uploadFiles',897,898),(451,442,NULL,NULL,'wav2mp3',899,900),(452,442,NULL,NULL,'wavDuration',901,902),(453,442,NULL,NULL,'getExt',903,904),(454,442,NULL,NULL,'getFilename',905,906),(455,442,NULL,NULL,'logRefresh',907,908),(456,442,NULL,NULL,'getTimezone',909,910),(457,442,NULL,NULL,'getLanguage',911,912),(458,442,NULL,NULL,'checkMyIp',913,914),(459,442,NULL,NULL,'getInstance',915,916),(460,442,NULL,NULL,'isActive',917,918),(461,442,NULL,NULL,'emptyDir',919,920),(462,442,NULL,NULL,'refreshAll',921,922),(463,442,NULL,NULL,'dateToString',923,924),(464,442,NULL,NULL,'headerGetStatus',925,926),(465,442,NULL,NULL,'getServiceName',927,928),(466,442,NULL,NULL,'getPhoneBooks',929,930),(467,442,NULL,NULL,'authAccess',931,932),(468,442,NULL,NULL,'sweeper',933,934),(469,1,NULL,NULL,'Categories',936,985),(470,469,NULL,NULL,'index',937,938),(471,469,NULL,NULL,'add',939,940),(472,469,NULL,NULL,'edit',941,942),(473,469,NULL,NULL,'delete',943,944),(474,469,NULL,NULL,'uploadFiles',945,946),(475,469,NULL,NULL,'wav2mp3',947,948),(476,469,NULL,NULL,'wavDuration',949,950),(477,469,NULL,NULL,'getExt',951,952),(478,469,NULL,NULL,'getFilename',953,954),(479,469,NULL,NULL,'logRefresh',955,956),(480,469,NULL,NULL,'getTimezone',957,958),(481,469,NULL,NULL,'getLanguage',959,960),(482,469,NULL,NULL,'checkMyIp',961,962),(483,469,NULL,NULL,'getInstance',963,964),(484,469,NULL,NULL,'isActive',965,966),(485,469,NULL,NULL,'emptyDir',967,968),(486,469,NULL,NULL,'refreshAll',969,970),(487,469,NULL,NULL,'dateToString',971,972),(488,469,NULL,NULL,'headerGetStatus',973,974),(489,469,NULL,NULL,'getServiceName',975,976),(490,469,NULL,NULL,'getPhoneBooks',977,978),(491,469,NULL,NULL,'authAccess',979,980),(492,469,NULL,NULL,'sweeper',981,982),(493,469,NULL,NULL,'view',983,984),(494,1,NULL,NULL,'Processes',986,1043),(495,494,NULL,NULL,'index',987,988),(496,494,NULL,NULL,'system',989,990),(497,494,NULL,NULL,'start',991,992),(498,494,NULL,NULL,'stop',993,994),(499,494,NULL,NULL,'refresh',995,996),(500,494,NULL,NULL,'uploadFiles',997,998),(501,494,NULL,NULL,'wav2mp3',999,1000),(502,494,NULL,NULL,'wavDuration',1001,1002),(503,494,NULL,NULL,'getExt',1003,1004),(504,494,NULL,NULL,'getFilename',1005,1006),(505,494,NULL,NULL,'logRefresh',1007,1008),(506,494,NULL,NULL,'getTimezone',1009,1010),(507,494,NULL,NULL,'getLanguage',1011,1012),(508,494,NULL,NULL,'checkMyIp',1013,1014),(509,494,NULL,NULL,'getInstance',1015,1016),(510,494,NULL,NULL,'isActive',1017,1018),(511,494,NULL,NULL,'emptyDir',1019,1020),(512,494,NULL,NULL,'refreshAll',1021,1022),(513,494,NULL,NULL,'dateToString',1023,1024),(514,494,NULL,NULL,'headerGetStatus',1025,1026),(515,494,NULL,NULL,'getServiceName',1027,1028),(516,494,NULL,NULL,'getPhoneBooks',1029,1030),(517,494,NULL,NULL,'authAccess',1031,1032),(518,494,NULL,NULL,'sweeper',1033,1034),(519,494,NULL,NULL,'add',1035,1036),(520,494,NULL,NULL,'edit',1037,1038),(521,494,NULL,NULL,'view',1039,1040),(522,494,NULL,NULL,'delete',1041,1042),(523,1,NULL,NULL,'Nodes',1044,1095),(524,523,NULL,NULL,'index',1045,1046),(525,523,NULL,NULL,'add',1047,1048),(526,523,NULL,NULL,'delete',1049,1050),(527,523,NULL,NULL,'edit',1051,1052),(528,523,NULL,NULL,'download',1053,1054),(529,523,NULL,NULL,'uploadFiles',1055,1056),(530,523,NULL,NULL,'wav2mp3',1057,1058),(531,523,NULL,NULL,'wavDuration',1059,1060),(532,523,NULL,NULL,'getExt',1061,1062),(533,523,NULL,NULL,'getFilename',1063,1064),(534,523,NULL,NULL,'logRefresh',1065,1066),(535,523,NULL,NULL,'getTimezone',1067,1068),(536,523,NULL,NULL,'getLanguage',1069,1070),(537,523,NULL,NULL,'checkMyIp',1071,1072),(538,523,NULL,NULL,'getInstance',1073,1074),(539,523,NULL,NULL,'isActive',1075,1076),(540,523,NULL,NULL,'emptyDir',1077,1078),(541,523,NULL,NULL,'refreshAll',1079,1080),(542,523,NULL,NULL,'dateToString',1081,1082),(543,523,NULL,NULL,'headerGetStatus',1083,1084),(544,523,NULL,NULL,'getServiceName',1085,1086),(545,523,NULL,NULL,'getPhoneBooks',1087,1088),(546,523,NULL,NULL,'authAccess',1089,1090),(547,523,NULL,NULL,'sweeper',1091,1092),(548,523,NULL,NULL,'view',1093,1094),(549,1,NULL,NULL,'Bin',1096,1155),(550,549,NULL,NULL,'refresh',1097,1098),(551,549,NULL,NULL,'index',1099,1100),(552,549,NULL,NULL,'disp',1101,1102),(553,549,NULL,NULL,'process',1103,1104),(554,549,NULL,NULL,'delete',1105,1106),(555,549,NULL,NULL,'export',1107,1108),(556,549,NULL,NULL,'outgoing',1109,1110),(557,549,NULL,NULL,'uploadFiles',1111,1112),(558,549,NULL,NULL,'wav2mp3',1113,1114),(559,549,NULL,NULL,'wavDuration',1115,1116),(560,549,NULL,NULL,'getExt',1117,1118),(561,549,NULL,NULL,'getFilename',1119,1120),(562,549,NULL,NULL,'logRefresh',1121,1122),(563,549,NULL,NULL,'getTimezone',1123,1124),(564,549,NULL,NULL,'getLanguage',1125,1126),(565,549,NULL,NULL,'checkMyIp',1127,1128),(566,549,NULL,NULL,'getInstance',1129,1130),(567,549,NULL,NULL,'isActive',1131,1132),(568,549,NULL,NULL,'emptyDir',1133,1134),(569,549,NULL,NULL,'refreshAll',1135,1136),(570,549,NULL,NULL,'dateToString',1137,1138),(571,549,NULL,NULL,'headerGetStatus',1139,1140),(572,549,NULL,NULL,'getServiceName',1141,1142),(573,549,NULL,NULL,'getPhoneBooks',1143,1144),(574,549,NULL,NULL,'authAccess',1145,1146),(575,549,NULL,NULL,'sweeper',1147,1148),(576,549,NULL,NULL,'add',1149,1150),(577,549,NULL,NULL,'edit',1151,1152),(578,549,NULL,NULL,'view',1153,1154),(579,1,NULL,NULL,'Settings',1156,1205),(580,579,NULL,NULL,'index',1157,1158),(581,579,NULL,NULL,'uploadFiles',1159,1160),(582,579,NULL,NULL,'wav2mp3',1161,1162),(583,579,NULL,NULL,'wavDuration',1163,1164),(584,579,NULL,NULL,'getExt',1165,1166),(585,579,NULL,NULL,'getFilename',1167,1168),(586,579,NULL,NULL,'logRefresh',1169,1170),(587,579,NULL,NULL,'getTimezone',1171,1172),(588,579,NULL,NULL,'getLanguage',1173,1174),(589,579,NULL,NULL,'checkMyIp',1175,1176),(590,579,NULL,NULL,'getInstance',1177,1178),(591,579,NULL,NULL,'isActive',1179,1180),(592,579,NULL,NULL,'emptyDir',1181,1182),(593,579,NULL,NULL,'refreshAll',1183,1184),(594,579,NULL,NULL,'dateToString',1185,1186),(595,579,NULL,NULL,'headerGetStatus',1187,1188),(596,579,NULL,NULL,'getServiceName',1189,1190),(597,579,NULL,NULL,'getPhoneBooks',1191,1192),(598,579,NULL,NULL,'authAccess',1193,1194),(599,579,NULL,NULL,'sweeper',1195,1196),(600,579,NULL,NULL,'add',1197,1198),(601,579,NULL,NULL,'edit',1199,1200),(602,579,NULL,NULL,'view',1201,1202),(603,579,NULL,NULL,'delete',1203,1204),(604,1,NULL,NULL,'Api',1206,1277),(605,604,NULL,NULL,'get',1207,1208),(606,604,NULL,NULL,'bin',1209,1210),(607,604,NULL,NULL,'polls',1211,1212),(608,604,NULL,NULL,'lm_menus',1213,1214),(609,604,NULL,NULL,'messages',1215,1216),(610,604,NULL,NULL,'categories',1217,1218),(611,604,NULL,NULL,'tags',1219,1220),(612,604,NULL,NULL,'cdr',1221,1222),(613,604,NULL,NULL,'services',1223,1224),(614,604,NULL,NULL,'users',1225,1226),(615,604,NULL,NULL,'system',1227,1228),(616,604,NULL,NULL,'uploadFiles',1229,1230),(617,604,NULL,NULL,'wav2mp3',1231,1232),(618,604,NULL,NULL,'wavDuration',1233,1234),(619,604,NULL,NULL,'getExt',1235,1236),(620,604,NULL,NULL,'getFilename',1237,1238),(621,604,NULL,NULL,'logRefresh',1239,1240),(622,604,NULL,NULL,'getTimezone',1241,1242),(623,604,NULL,NULL,'getLanguage',1243,1244),(624,604,NULL,NULL,'checkMyIp',1245,1246),(625,604,NULL,NULL,'getInstance',1247,1248),(626,604,NULL,NULL,'isActive',1249,1250),(627,604,NULL,NULL,'emptyDir',1251,1252),(628,604,NULL,NULL,'refreshAll',1253,1254),(629,604,NULL,NULL,'dateToString',1255,1256),(630,604,NULL,NULL,'headerGetStatus',1257,1258),(631,604,NULL,NULL,'getServiceName',1259,1260),(632,604,NULL,NULL,'getPhoneBooks',1261,1262),(633,604,NULL,NULL,'authAccess',1263,1264),(634,604,NULL,NULL,'sweeper',1265,1266),(635,604,NULL,NULL,'add',1267,1268),(636,604,NULL,NULL,'edit',1269,1270),(637,604,NULL,NULL,'index',1271,1272),(638,604,NULL,NULL,'view',1273,1274),(639,604,NULL,NULL,'delete',1275,1276),(640,1,NULL,NULL,'Channels',1278,1331),(641,640,NULL,NULL,'index',1279,1280),(642,640,NULL,NULL,'audio_services',1281,1282),(643,640,NULL,NULL,'refresh',1283,1284),(644,640,NULL,NULL,'edit',1285,1286),(645,640,NULL,NULL,'uploadFiles',1287,1288),(646,640,NULL,NULL,'wav2mp3',1289,1290),(647,640,NULL,NULL,'wavDuration',1291,1292),(648,640,NULL,NULL,'getExt',1293,1294),(649,640,NULL,NULL,'getFilename',1295,1296),(650,640,NULL,NULL,'logRefresh',1297,1298),(651,640,NULL,NULL,'getTimezone',1299,1300),(652,640,NULL,NULL,'getLanguage',1301,1302),(653,640,NULL,NULL,'checkMyIp',1303,1304),(654,640,NULL,NULL,'getInstance',1305,1306),(655,640,NULL,NULL,'isActive',1307,1308),(656,640,NULL,NULL,'emptyDir',1309,1310),(657,640,NULL,NULL,'refreshAll',1311,1312),(658,640,NULL,NULL,'dateToString',1313,1314),(659,640,NULL,NULL,'headerGetStatus',1315,1316),(660,640,NULL,NULL,'getServiceName',1317,1318),(661,640,NULL,NULL,'getPhoneBooks',1319,1320),(662,640,NULL,NULL,'authAccess',1321,1322),(663,640,NULL,NULL,'sweeper',1323,1324),(664,640,NULL,NULL,'add',1325,1326),(665,640,NULL,NULL,'view',1327,1328),(666,640,NULL,NULL,'delete',1329,1330);
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,442,'-1','-1','-1','-1'),(4,2,444,'1','1','1','1'),(5,2,445,'1','1','1','1'),(6,2,443,'1','1','1','1'),(7,2,194,'-1','-1','-1','-1'),(8,2,196,'1','1','1','1'),(9,2,197,'1','1','1','1'),(10,2,198,'1','1','1','1'),(11,2,200,'1','1','1','1'),(12,2,199,'1','1','1','1'),(13,2,195,'1','1','1','1'),(14,2,469,'-1','-1','-1','-1'),(15,2,470,'1','1','1','1'),(16,2,28,'-1','-1','-1','-1'),(17,2,29,'1','1','1','1'),(18,2,138,'-1','-1','-1','-1'),(19,2,139,'1','1','1','1'),(20,2,549,'-1','-1','-1','-1'),(21,2,551,'1','1','1','1'),(22,2,550,'1','1','1','1'),(23,2,554,'1','1','1','1'),(24,2,552,'1','1','1','1'),(25,2,79,'-1','-1','-1','-1'),(26,2,80,'1','1','1','1'),(27,2,82,'1','1','1','1'),(28,2,81,'1','1','1','1'),(29,2,83,'1','1','1','1'),(30,2,276,'-1','-1','-1','-1'),(31,2,277,'1','1','1','1'),(32,2,283,'1','1','1','1'),(33,2,523,'-1','-1','-1','-1'),(34,2,524,'1','1','1','1'),(35,2,386,'-1','-1','-1','-1'),(36,2,388,'1','1','1','1'),(37,2,389,'1','1','1','1'),(38,2,53,'-1','-1','-1','-1'),(39,2,54,'1','1','1','1'),(40,2,105,'-1','-1','-1','-1'),(41,2,108,'1','1','1','1'),(42,2,113,'1','1','1','1'),(43,2,107,'1','1','1','1'),(44,2,115,'1','1','1','1'),(45,2,106,'1','1','1','1'),(46,2,356,'-1','-1','-1','-1'),(47,2,357,'1','1','1','1'),(48,2,359,'1','1','1','1'),(49,2,494,'-1','-1','-1','-1'),(50,2,495,'1','1','1','1'),(51,2,499,'1','1','1','1'),(52,2,496,'1','1','1','1'),(53,2,579,'-1','-1','-1','-1'),(54,2,580,'1','1','1','1'),(55,2,640,'-1','-1','-1','-1'),(56,2,641,'1','1','1','1'),(57,2,643,'1','1','1','1'),(58,2,642,'1','1','1','1'),(59,2,168,'-1','-1','-1','-1'),(60,2,169,'1','1','1','1'),(61,2,250,'-1','-1','-1','-1'),(62,2,414,'-1','-1','-1','-1'),(63,2,224,'-1','-1','-1','-1');
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

-- Dump completed on 2013-12-17 23:30:11
