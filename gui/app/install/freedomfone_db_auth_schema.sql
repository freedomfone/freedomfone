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
) ENGINE=MyISAM AUTO_INCREMENT=535 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,1068),(2,1,NULL,NULL,'Pages',2,47),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'uploadFiles',5,6),(5,2,NULL,NULL,'wav2mp3',7,8),(6,2,NULL,NULL,'wavDuration',9,10),(7,2,NULL,NULL,'getExt',11,12),(8,2,NULL,NULL,'getFilename',13,14),(9,2,NULL,NULL,'logRefresh',15,16),(10,2,NULL,NULL,'getTimezone',17,18),(11,2,NULL,NULL,'checkMyIp',19,20),(12,2,NULL,NULL,'getInstance',21,22),(13,2,NULL,NULL,'isActive',23,24),(14,2,NULL,NULL,'emptyDir',25,26),(15,2,NULL,NULL,'refreshAll',27,28),(16,2,NULL,NULL,'dateToString',29,30),(17,2,NULL,NULL,'headerGetStatus',31,32),(18,2,NULL,NULL,'getServiceName',33,34),(19,2,NULL,NULL,'getPhoneBooks',35,36),(20,2,NULL,NULL,'add',37,38),(21,2,NULL,NULL,'edit',39,40),(22,2,NULL,NULL,'index',41,42),(23,2,NULL,NULL,'view',43,44),(24,2,NULL,NULL,'delete',45,46),(25,1,NULL,NULL,'LmMenus',48,101),(26,25,NULL,NULL,'index',49,50),(27,25,NULL,NULL,'create',51,52),(28,25,NULL,NULL,'add',53,54),(29,25,NULL,NULL,'edit',55,56),(30,25,NULL,NULL,'download',57,58),(31,25,NULL,NULL,'delete',59,60),(32,25,NULL,NULL,'export',61,62),(33,25,NULL,NULL,'advanced_edit',63,64),(34,25,NULL,NULL,'advanced_add',65,66),(35,25,NULL,NULL,'uploadFiles',67,68),(36,25,NULL,NULL,'wav2mp3',69,70),(37,25,NULL,NULL,'wavDuration',71,72),(38,25,NULL,NULL,'getExt',73,74),(39,25,NULL,NULL,'getFilename',75,76),(40,25,NULL,NULL,'logRefresh',77,78),(41,25,NULL,NULL,'getTimezone',79,80),(42,25,NULL,NULL,'checkMyIp',81,82),(43,25,NULL,NULL,'getInstance',83,84),(44,25,NULL,NULL,'isActive',85,86),(45,25,NULL,NULL,'emptyDir',87,88),(46,25,NULL,NULL,'refreshAll',89,90),(47,25,NULL,NULL,'dateToString',91,92),(48,25,NULL,NULL,'headerGetStatus',93,94),(49,25,NULL,NULL,'getServiceName',95,96),(50,25,NULL,NULL,'getPhoneBooks',97,98),(51,25,NULL,NULL,'view',99,100),(52,1,NULL,NULL,'PhoneNumbers',102,145),(53,52,NULL,NULL,'add',103,104),(54,52,NULL,NULL,'delete',105,106),(55,52,NULL,NULL,'uploadFiles',107,108),(56,52,NULL,NULL,'wav2mp3',109,110),(57,52,NULL,NULL,'wavDuration',111,112),(58,52,NULL,NULL,'getExt',113,114),(59,52,NULL,NULL,'getFilename',115,116),(60,52,NULL,NULL,'logRefresh',117,118),(61,52,NULL,NULL,'getTimezone',119,120),(62,52,NULL,NULL,'checkMyIp',121,122),(63,52,NULL,NULL,'getInstance',123,124),(64,52,NULL,NULL,'isActive',125,126),(65,52,NULL,NULL,'emptyDir',127,128),(66,52,NULL,NULL,'refreshAll',129,130),(67,52,NULL,NULL,'dateToString',131,132),(68,52,NULL,NULL,'headerGetStatus',133,134),(69,52,NULL,NULL,'getServiceName',135,136),(70,52,NULL,NULL,'getPhoneBooks',137,138),(71,52,NULL,NULL,'edit',139,140),(72,52,NULL,NULL,'index',141,142),(73,52,NULL,NULL,'view',143,144),(74,1,NULL,NULL,'Tags',146,189),(75,74,NULL,NULL,'index',147,148),(76,74,NULL,NULL,'add',149,150),(77,74,NULL,NULL,'edit',151,152),(78,74,NULL,NULL,'delete',153,154),(79,74,NULL,NULL,'uploadFiles',155,156),(80,74,NULL,NULL,'wav2mp3',157,158),(81,74,NULL,NULL,'wavDuration',159,160),(82,74,NULL,NULL,'getExt',161,162),(83,74,NULL,NULL,'getFilename',163,164),(84,74,NULL,NULL,'logRefresh',165,166),(85,74,NULL,NULL,'getTimezone',167,168),(86,74,NULL,NULL,'checkMyIp',169,170),(87,74,NULL,NULL,'getInstance',171,172),(88,74,NULL,NULL,'isActive',173,174),(89,74,NULL,NULL,'emptyDir',175,176),(90,74,NULL,NULL,'refreshAll',177,178),(91,74,NULL,NULL,'dateToString',179,180),(92,74,NULL,NULL,'headerGetStatus',181,182),(93,74,NULL,NULL,'getServiceName',183,184),(94,74,NULL,NULL,'getPhoneBooks',185,186),(95,74,NULL,NULL,'view',187,188),(96,1,NULL,NULL,'Groups',190,233),(97,96,NULL,NULL,'index',191,192),(98,96,NULL,NULL,'add',193,194),(99,96,NULL,NULL,'uploadFiles',195,196),(100,96,NULL,NULL,'wav2mp3',197,198),(101,96,NULL,NULL,'wavDuration',199,200),(102,96,NULL,NULL,'getExt',201,202),(103,96,NULL,NULL,'getFilename',203,204),(104,96,NULL,NULL,'logRefresh',205,206),(105,96,NULL,NULL,'getTimezone',207,208),(106,96,NULL,NULL,'checkMyIp',209,210),(107,96,NULL,NULL,'getInstance',211,212),(108,96,NULL,NULL,'isActive',213,214),(109,96,NULL,NULL,'emptyDir',215,216),(110,96,NULL,NULL,'refreshAll',217,218),(111,96,NULL,NULL,'dateToString',219,220),(112,96,NULL,NULL,'headerGetStatus',221,222),(113,96,NULL,NULL,'getServiceName',223,224),(114,96,NULL,NULL,'getPhoneBooks',225,226),(115,96,NULL,NULL,'edit',227,228),(116,96,NULL,NULL,'view',229,230),(117,96,NULL,NULL,'delete',231,232),(118,1,NULL,NULL,'Polls',234,281),(119,118,NULL,NULL,'refresh',235,236),(120,118,NULL,NULL,'index',237,238),(121,118,NULL,NULL,'view',239,240),(122,118,NULL,NULL,'add',241,242),(123,118,NULL,NULL,'delete',243,244),(124,118,NULL,NULL,'unlink',245,246),(125,118,NULL,NULL,'edit',247,248),(126,118,NULL,NULL,'uploadFiles',249,250),(127,118,NULL,NULL,'wav2mp3',251,252),(128,118,NULL,NULL,'wavDuration',253,254),(129,118,NULL,NULL,'getExt',255,256),(130,118,NULL,NULL,'getFilename',257,258),(131,118,NULL,NULL,'logRefresh',259,260),(132,118,NULL,NULL,'getTimezone',261,262),(133,118,NULL,NULL,'checkMyIp',263,264),(134,118,NULL,NULL,'getInstance',265,266),(135,118,NULL,NULL,'isActive',267,268),(136,118,NULL,NULL,'emptyDir',269,270),(137,118,NULL,NULL,'refreshAll',271,272),(138,118,NULL,NULL,'dateToString',273,274),(139,118,NULL,NULL,'headerGetStatus',275,276),(140,118,NULL,NULL,'getServiceName',277,278),(141,118,NULL,NULL,'getPhoneBooks',279,280),(142,1,NULL,NULL,'IvrMenus',282,335),(143,142,NULL,NULL,'index',283,284),(144,142,NULL,NULL,'add',285,286),(145,142,NULL,NULL,'add_selector',287,288),(146,142,NULL,NULL,'edit',289,290),(147,142,NULL,NULL,'delete',291,292),(148,142,NULL,NULL,'download',293,294),(149,142,NULL,NULL,'selectors',295,296),(150,142,NULL,NULL,'edit_selector',297,298),(151,142,NULL,NULL,'disp',299,300),(152,142,NULL,NULL,'uploadFiles',301,302),(153,142,NULL,NULL,'wav2mp3',303,304),(154,142,NULL,NULL,'wavDuration',305,306),(155,142,NULL,NULL,'getExt',307,308),(156,142,NULL,NULL,'getFilename',309,310),(157,142,NULL,NULL,'logRefresh',311,312),(158,142,NULL,NULL,'getTimezone',313,314),(159,142,NULL,NULL,'checkMyIp',315,316),(160,142,NULL,NULL,'getInstance',317,318),(161,142,NULL,NULL,'isActive',319,320),(162,142,NULL,NULL,'emptyDir',321,322),(163,142,NULL,NULL,'refreshAll',323,324),(164,142,NULL,NULL,'dateToString',325,326),(165,142,NULL,NULL,'headerGetStatus',327,328),(166,142,NULL,NULL,'getServiceName',329,330),(167,142,NULL,NULL,'getPhoneBooks',331,332),(168,142,NULL,NULL,'view',333,334),(169,1,NULL,NULL,'Messages',336,389),(170,169,NULL,NULL,'refresh',337,338),(171,169,NULL,NULL,'index',339,340),(172,169,NULL,NULL,'disp',341,342),(173,169,NULL,NULL,'archive',343,344),(174,169,NULL,NULL,'view',345,346),(175,169,NULL,NULL,'edit',347,348),(176,169,NULL,NULL,'delete',349,350),(177,169,NULL,NULL,'process',351,352),(178,169,NULL,NULL,'download',353,354),(179,169,NULL,NULL,'uploadFiles',355,356),(180,169,NULL,NULL,'wav2mp3',357,358),(181,169,NULL,NULL,'wavDuration',359,360),(182,169,NULL,NULL,'getExt',361,362),(183,169,NULL,NULL,'getFilename',363,364),(184,169,NULL,NULL,'logRefresh',365,366),(185,169,NULL,NULL,'getTimezone',367,368),(186,169,NULL,NULL,'checkMyIp',369,370),(187,169,NULL,NULL,'getInstance',371,372),(188,169,NULL,NULL,'isActive',373,374),(189,169,NULL,NULL,'emptyDir',375,376),(190,169,NULL,NULL,'refreshAll',377,378),(191,169,NULL,NULL,'dateToString',379,380),(192,169,NULL,NULL,'headerGetStatus',381,382),(193,169,NULL,NULL,'getServiceName',383,384),(194,169,NULL,NULL,'getPhoneBooks',385,386),(195,169,NULL,NULL,'add',387,388),(196,1,NULL,NULL,'Votes',390,433),(197,196,NULL,NULL,'add',391,392),(198,196,NULL,NULL,'delete',393,394),(199,196,NULL,NULL,'uploadFiles',395,396),(200,196,NULL,NULL,'wav2mp3',397,398),(201,196,NULL,NULL,'wavDuration',399,400),(202,196,NULL,NULL,'getExt',401,402),(203,196,NULL,NULL,'getFilename',403,404),(204,196,NULL,NULL,'logRefresh',405,406),(205,196,NULL,NULL,'getTimezone',407,408),(206,196,NULL,NULL,'checkMyIp',409,410),(207,196,NULL,NULL,'getInstance',411,412),(208,196,NULL,NULL,'isActive',413,414),(209,196,NULL,NULL,'emptyDir',415,416),(210,196,NULL,NULL,'refreshAll',417,418),(211,196,NULL,NULL,'dateToString',419,420),(212,196,NULL,NULL,'headerGetStatus',421,422),(213,196,NULL,NULL,'getServiceName',423,424),(214,196,NULL,NULL,'getPhoneBooks',425,426),(215,196,NULL,NULL,'edit',427,428),(216,196,NULL,NULL,'index',429,430),(217,196,NULL,NULL,'view',431,432),(218,1,NULL,NULL,'Nodes',434,479),(219,218,NULL,NULL,'index',435,436),(220,218,NULL,NULL,'add',437,438),(221,218,NULL,NULL,'delete',439,440),(222,218,NULL,NULL,'edit',441,442),(223,218,NULL,NULL,'download',443,444),(224,218,NULL,NULL,'uploadFiles',445,446),(225,218,NULL,NULL,'wav2mp3',447,448),(226,218,NULL,NULL,'wavDuration',449,450),(227,218,NULL,NULL,'getExt',451,452),(228,218,NULL,NULL,'getFilename',453,454),(229,218,NULL,NULL,'logRefresh',455,456),(230,218,NULL,NULL,'getTimezone',457,458),(231,218,NULL,NULL,'checkMyIp',459,460),(232,218,NULL,NULL,'getInstance',461,462),(233,218,NULL,NULL,'isActive',463,464),(234,218,NULL,NULL,'emptyDir',465,466),(235,218,NULL,NULL,'refreshAll',467,468),(236,218,NULL,NULL,'dateToString',469,470),(237,218,NULL,NULL,'headerGetStatus',471,472),(238,218,NULL,NULL,'getServiceName',473,474),(239,218,NULL,NULL,'getPhoneBooks',475,476),(240,218,NULL,NULL,'view',477,478),(241,1,NULL,NULL,'Channels',480,525),(242,241,NULL,NULL,'index',481,482),(243,241,NULL,NULL,'refresh',483,484),(244,241,NULL,NULL,'edit',485,486),(245,241,NULL,NULL,'uploadFiles',487,488),(246,241,NULL,NULL,'wav2mp3',489,490),(247,241,NULL,NULL,'wavDuration',491,492),(248,241,NULL,NULL,'getExt',493,494),(249,241,NULL,NULL,'getFilename',495,496),(250,241,NULL,NULL,'logRefresh',497,498),(251,241,NULL,NULL,'getTimezone',499,500),(252,241,NULL,NULL,'checkMyIp',501,502),(253,241,NULL,NULL,'getInstance',503,504),(254,241,NULL,NULL,'isActive',505,506),(255,241,NULL,NULL,'emptyDir',507,508),(256,241,NULL,NULL,'refreshAll',509,510),(257,241,NULL,NULL,'dateToString',511,512),(258,241,NULL,NULL,'headerGetStatus',513,514),(259,241,NULL,NULL,'getServiceName',515,516),(260,241,NULL,NULL,'getPhoneBooks',517,518),(261,241,NULL,NULL,'add',519,520),(262,241,NULL,NULL,'view',521,522),(263,241,NULL,NULL,'delete',523,524),(264,1,NULL,NULL,'PhoneBooks',526,571),(265,264,NULL,NULL,'index',527,528),(266,264,NULL,NULL,'add',529,530),(267,264,NULL,NULL,'edit',531,532),(268,264,NULL,NULL,'delete',533,534),(269,264,NULL,NULL,'export',535,536),(270,264,NULL,NULL,'uploadFiles',537,538),(271,264,NULL,NULL,'wav2mp3',539,540),(272,264,NULL,NULL,'wavDuration',541,542),(273,264,NULL,NULL,'getExt',543,544),(274,264,NULL,NULL,'getFilename',545,546),(275,264,NULL,NULL,'logRefresh',547,548),(276,264,NULL,NULL,'getTimezone',549,550),(277,264,NULL,NULL,'checkMyIp',551,552),(278,264,NULL,NULL,'getInstance',553,554),(279,264,NULL,NULL,'isActive',555,556),(280,264,NULL,NULL,'emptyDir',557,558),(281,264,NULL,NULL,'refreshAll',559,560),(282,264,NULL,NULL,'dateToString',561,562),(283,264,NULL,NULL,'headerGetStatus',563,564),(284,264,NULL,NULL,'getServiceName',565,566),(285,264,NULL,NULL,'getPhoneBooks',567,568),(286,264,NULL,NULL,'view',569,570),(287,1,NULL,NULL,'OfficeRoute',572,617),(288,287,NULL,NULL,'refresh',573,574),(289,287,NULL,NULL,'edit',575,576),(290,287,NULL,NULL,'uploadFiles',577,578),(291,287,NULL,NULL,'wav2mp3',579,580),(292,287,NULL,NULL,'wavDuration',581,582),(293,287,NULL,NULL,'getExt',583,584),(294,287,NULL,NULL,'getFilename',585,586),(295,287,NULL,NULL,'logRefresh',587,588),(296,287,NULL,NULL,'getTimezone',589,590),(297,287,NULL,NULL,'checkMyIp',591,592),(298,287,NULL,NULL,'getInstance',593,594),(299,287,NULL,NULL,'isActive',595,596),(300,287,NULL,NULL,'emptyDir',597,598),(301,287,NULL,NULL,'refreshAll',599,600),(302,287,NULL,NULL,'dateToString',601,602),(303,287,NULL,NULL,'headerGetStatus',603,604),(304,287,NULL,NULL,'getServiceName',605,606),(305,287,NULL,NULL,'getPhoneBooks',607,608),(306,287,NULL,NULL,'add',609,610),(307,287,NULL,NULL,'index',611,612),(308,287,NULL,NULL,'view',613,614),(309,287,NULL,NULL,'delete',615,616),(310,1,NULL,NULL,'Settings',618,661),(311,310,NULL,NULL,'index',619,620),(312,310,NULL,NULL,'uploadFiles',621,622),(313,310,NULL,NULL,'wav2mp3',623,624),(314,310,NULL,NULL,'wavDuration',625,626),(315,310,NULL,NULL,'getExt',627,628),(316,310,NULL,NULL,'getFilename',629,630),(317,310,NULL,NULL,'logRefresh',631,632),(318,310,NULL,NULL,'getTimezone',633,634),(319,310,NULL,NULL,'checkMyIp',635,636),(320,310,NULL,NULL,'getInstance',637,638),(321,310,NULL,NULL,'isActive',639,640),(322,310,NULL,NULL,'emptyDir',641,642),(323,310,NULL,NULL,'refreshAll',643,644),(324,310,NULL,NULL,'dateToString',645,646),(325,310,NULL,NULL,'headerGetStatus',647,648),(326,310,NULL,NULL,'getServiceName',649,650),(327,310,NULL,NULL,'getPhoneBooks',651,652),(328,310,NULL,NULL,'add',653,654),(329,310,NULL,NULL,'edit',655,656),(330,310,NULL,NULL,'view',657,658),(331,310,NULL,NULL,'delete',659,660),(332,1,NULL,NULL,'Cdr',662,721),(333,332,NULL,NULL,'refresh',663,664),(334,332,NULL,NULL,'general',665,666),(335,332,NULL,NULL,'index',667,668),(336,332,NULL,NULL,'del',669,670),(337,332,NULL,NULL,'process',671,672),(338,332,NULL,NULL,'output',673,674),(339,332,NULL,NULL,'export',675,676),(340,332,NULL,NULL,'statistics',677,678),(341,332,NULL,NULL,'delete',679,680),(342,332,NULL,NULL,'overview',681,682),(343,332,NULL,NULL,'uploadFiles',683,684),(344,332,NULL,NULL,'wav2mp3',685,686),(345,332,NULL,NULL,'wavDuration',687,688),(346,332,NULL,NULL,'getExt',689,690),(347,332,NULL,NULL,'getFilename',691,692),(348,332,NULL,NULL,'logRefresh',693,694),(349,332,NULL,NULL,'getTimezone',695,696),(350,332,NULL,NULL,'checkMyIp',697,698),(351,332,NULL,NULL,'getInstance',699,700),(352,332,NULL,NULL,'isActive',701,702),(353,332,NULL,NULL,'emptyDir',703,704),(354,332,NULL,NULL,'refreshAll',705,706),(355,332,NULL,NULL,'dateToString',707,708),(356,332,NULL,NULL,'headerGetStatus',709,710),(357,332,NULL,NULL,'getServiceName',711,712),(358,332,NULL,NULL,'getPhoneBooks',713,714),(359,332,NULL,NULL,'add',715,716),(360,332,NULL,NULL,'edit',717,718),(361,332,NULL,NULL,'view',719,720),(362,1,NULL,NULL,'Users',722,771),(363,362,NULL,NULL,'refresh',723,724),(364,362,NULL,NULL,'index',725,726),(365,362,NULL,NULL,'view',727,728),(366,362,NULL,NULL,'edit',729,730),(367,362,NULL,NULL,'delete',731,732),(368,362,NULL,NULL,'process',733,734),(369,362,NULL,NULL,'add',735,736),(370,362,NULL,NULL,'disp',737,738),(371,362,NULL,NULL,'uploadFiles',739,740),(372,362,NULL,NULL,'wav2mp3',741,742),(373,362,NULL,NULL,'wavDuration',743,744),(374,362,NULL,NULL,'getExt',745,746),(375,362,NULL,NULL,'getFilename',747,748),(376,362,NULL,NULL,'logRefresh',749,750),(377,362,NULL,NULL,'getTimezone',751,752),(378,362,NULL,NULL,'checkMyIp',753,754),(379,362,NULL,NULL,'getInstance',755,756),(380,362,NULL,NULL,'isActive',757,758),(381,362,NULL,NULL,'emptyDir',759,760),(382,362,NULL,NULL,'refreshAll',761,762),(383,362,NULL,NULL,'dateToString',763,764),(384,362,NULL,NULL,'headerGetStatus',765,766),(385,362,NULL,NULL,'getServiceName',767,768),(386,362,NULL,NULL,'getPhoneBooks',769,770),(387,1,NULL,NULL,'Bin',772,821),(388,387,NULL,NULL,'refresh',773,774),(389,387,NULL,NULL,'index',775,776),(390,387,NULL,NULL,'process',777,778),(391,387,NULL,NULL,'delete',779,780),(392,387,NULL,NULL,'export',781,782),(393,387,NULL,NULL,'uploadFiles',783,784),(394,387,NULL,NULL,'wav2mp3',785,786),(395,387,NULL,NULL,'wavDuration',787,788),(396,387,NULL,NULL,'getExt',789,790),(397,387,NULL,NULL,'getFilename',791,792),(398,387,NULL,NULL,'logRefresh',793,794),(399,387,NULL,NULL,'getTimezone',795,796),(400,387,NULL,NULL,'checkMyIp',797,798),(401,387,NULL,NULL,'getInstance',799,800),(402,387,NULL,NULL,'isActive',801,802),(403,387,NULL,NULL,'emptyDir',803,804),(404,387,NULL,NULL,'refreshAll',805,806),(405,387,NULL,NULL,'dateToString',807,808),(406,387,NULL,NULL,'headerGetStatus',809,810),(407,387,NULL,NULL,'getServiceName',811,812),(408,387,NULL,NULL,'getPhoneBooks',813,814),(409,387,NULL,NULL,'add',815,816),(410,387,NULL,NULL,'edit',817,818),(411,387,NULL,NULL,'view',819,820),(412,1,NULL,NULL,'Logs',822,867),(413,412,NULL,NULL,'index',823,824),(414,412,NULL,NULL,'disp',825,826),(415,412,NULL,NULL,'uploadFiles',827,828),(416,412,NULL,NULL,'wav2mp3',829,830),(417,412,NULL,NULL,'wavDuration',831,832),(418,412,NULL,NULL,'getExt',833,834),(419,412,NULL,NULL,'getFilename',835,836),(420,412,NULL,NULL,'logRefresh',837,838),(421,412,NULL,NULL,'getTimezone',839,840),(422,412,NULL,NULL,'checkMyIp',841,842),(423,412,NULL,NULL,'getInstance',843,844),(424,412,NULL,NULL,'isActive',845,846),(425,412,NULL,NULL,'emptyDir',847,848),(426,412,NULL,NULL,'refreshAll',849,850),(427,412,NULL,NULL,'dateToString',851,852),(428,412,NULL,NULL,'headerGetStatus',853,854),(429,412,NULL,NULL,'getServiceName',855,856),(430,412,NULL,NULL,'getPhoneBooks',857,858),(431,412,NULL,NULL,'add',859,860),(432,412,NULL,NULL,'edit',861,862),(433,412,NULL,NULL,'view',863,864),(434,412,NULL,NULL,'delete',865,866),(435,1,NULL,NULL,'FfUsers',868,917),(436,435,NULL,NULL,'login',869,870),(437,435,NULL,NULL,'logout',871,872),(438,435,NULL,NULL,'index',873,874),(439,435,NULL,NULL,'add',875,876),(440,435,NULL,NULL,'initDB',877,878),(441,435,NULL,NULL,'uploadFiles',879,880),(442,435,NULL,NULL,'wav2mp3',881,882),(443,435,NULL,NULL,'wavDuration',883,884),(444,435,NULL,NULL,'getExt',885,886),(445,435,NULL,NULL,'getFilename',887,888),(446,435,NULL,NULL,'logRefresh',889,890),(447,435,NULL,NULL,'getTimezone',891,892),(448,435,NULL,NULL,'checkMyIp',893,894),(449,435,NULL,NULL,'getInstance',895,896),(450,435,NULL,NULL,'isActive',897,898),(451,435,NULL,NULL,'emptyDir',899,900),(452,435,NULL,NULL,'refreshAll',901,902),(453,435,NULL,NULL,'dateToString',903,904),(454,435,NULL,NULL,'headerGetStatus',905,906),(455,435,NULL,NULL,'getServiceName',907,908),(456,435,NULL,NULL,'getPhoneBooks',909,910),(457,435,NULL,NULL,'edit',911,912),(458,435,NULL,NULL,'view',913,914),(459,435,NULL,NULL,'delete',915,916),(460,1,NULL,NULL,'MonitorIvr',918,971),(461,460,NULL,NULL,'index',919,920),(462,460,NULL,NULL,'del',921,922),(463,460,NULL,NULL,'refresh',923,924),(464,460,NULL,NULL,'process',925,926),(465,460,NULL,NULL,'export',927,928),(466,460,NULL,NULL,'output',929,930),(467,460,NULL,NULL,'delete',931,932),(468,460,NULL,NULL,'uploadFiles',933,934),(469,460,NULL,NULL,'wav2mp3',935,936),(470,460,NULL,NULL,'wavDuration',937,938),(471,460,NULL,NULL,'getExt',939,940),(472,460,NULL,NULL,'getFilename',941,942),(473,460,NULL,NULL,'logRefresh',943,944),(474,460,NULL,NULL,'getTimezone',945,946),(475,460,NULL,NULL,'checkMyIp',947,948),(476,460,NULL,NULL,'getInstance',949,950),(477,460,NULL,NULL,'isActive',951,952),(478,460,NULL,NULL,'emptyDir',953,954),(479,460,NULL,NULL,'refreshAll',955,956),(480,460,NULL,NULL,'dateToString',957,958),(481,460,NULL,NULL,'headerGetStatus',959,960),(482,460,NULL,NULL,'getServiceName',961,962),(483,460,NULL,NULL,'getPhoneBooks',963,964),(484,460,NULL,NULL,'add',965,966),(485,460,NULL,NULL,'edit',967,968),(486,460,NULL,NULL,'view',969,970),(487,1,NULL,NULL,'Processes',972,1023),(488,487,NULL,NULL,'index',973,974),(489,487,NULL,NULL,'system',975,976),(490,487,NULL,NULL,'start',977,978),(491,487,NULL,NULL,'stop',979,980),(492,487,NULL,NULL,'refresh',981,982),(493,487,NULL,NULL,'uploadFiles',983,984),(494,487,NULL,NULL,'wav2mp3',985,986),(495,487,NULL,NULL,'wavDuration',987,988),(496,487,NULL,NULL,'getExt',989,990),(497,487,NULL,NULL,'getFilename',991,992),(498,487,NULL,NULL,'logRefresh',993,994),(499,487,NULL,NULL,'getTimezone',995,996),(500,487,NULL,NULL,'checkMyIp',997,998),(501,487,NULL,NULL,'getInstance',999,1000),(502,487,NULL,NULL,'isActive',1001,1002),(503,487,NULL,NULL,'emptyDir',1003,1004),(504,487,NULL,NULL,'refreshAll',1005,1006),(505,487,NULL,NULL,'dateToString',1007,1008),(506,487,NULL,NULL,'headerGetStatus',1009,1010),(507,487,NULL,NULL,'getServiceName',1011,1012),(508,487,NULL,NULL,'getPhoneBooks',1013,1014),(509,487,NULL,NULL,'add',1015,1016),(510,487,NULL,NULL,'edit',1017,1018),(511,487,NULL,NULL,'view',1019,1020),(512,487,NULL,NULL,'delete',1021,1022),(513,1,NULL,NULL,'Categories',1024,1067),(514,513,NULL,NULL,'index',1025,1026),(515,513,NULL,NULL,'add',1027,1028),(516,513,NULL,NULL,'edit',1029,1030),(517,513,NULL,NULL,'delete',1031,1032),(518,513,NULL,NULL,'uploadFiles',1033,1034),(519,513,NULL,NULL,'wav2mp3',1035,1036),(520,513,NULL,NULL,'wavDuration',1037,1038),(521,513,NULL,NULL,'getExt',1039,1040),(522,513,NULL,NULL,'getFilename',1041,1042),(523,513,NULL,NULL,'logRefresh',1043,1044),(524,513,NULL,NULL,'getTimezone',1045,1046),(525,513,NULL,NULL,'checkMyIp',1047,1048),(526,513,NULL,NULL,'getInstance',1049,1050),(527,513,NULL,NULL,'isActive',1051,1052),(528,513,NULL,NULL,'emptyDir',1053,1054),(529,513,NULL,NULL,'refreshAll',1055,1056),(530,513,NULL,NULL,'dateToString',1057,1058),(531,513,NULL,NULL,'headerGetStatus',1059,1060),(532,513,NULL,NULL,'getServiceName',1061,1062),(533,513,NULL,NULL,'getPhoneBooks',1063,1064),(534,513,NULL,NULL,'view',1065,1066);
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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,10),(2,NULL,'Group',2,NULL,11,12),(3,1,'FfUser',1,NULL,2,3),(4,1,'FfUser',2,NULL,6,7),(7,1,'FfUser',5,NULL,4,5),(21,1,'FfUser',19,NULL,8,9);
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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,118,'-1','-1','-1','-1'),(4,2,332,'-1','-1','-1','-1'),(5,2,120,'1','1','1','1'),(6,2,121,'1','1','1','1'),(7,2,169,'-1','-1','-1','-1'),(8,2,171,'1','1','1','1'),(9,2,173,'1','1','1','1'),(10,2,175,'1','1','1','1'),(11,2,174,'1','1','1','1'),(12,2,172,'1','1','1','1'),(13,2,514,'1','1','1','1'),(14,2,75,'1','1','1','1'),(15,2,389,'1','1','1','1'),(16,2,219,'1','1','1','1'),(17,2,364,'1','1','1','1'),(18,2,365,'1','1','1','1'),(19,2,335,'1','1','1','1'),(20,2,340,'1','1','1','1'),(21,2,334,'1','1','1','1'),(22,2,342,'1','1','1','1'),(23,2,488,'1','1','1','1'),(24,2,311,'1','1','1','1'),(25,2,242,'1','1','1','1'),(26,2,513,'-1','-1','-1','-1'),(27,2,74,'-1','-1','-1','-1'),(28,2,387,'-1','-1','-1','-1'),(29,2,218,'-1','-1','-1','-1'),(30,2,362,'-1','-1','-1','-1'),(31,2,487,'-1','-1','-1','-1'),(32,2,310,'-1','-1','-1','-1'),(33,2,241,'-1','-1','-1','-1'),(34,2,412,'-1','-1','-1','-1'),(35,2,25,'-1','-1','-1','-1'),(36,2,26,'1','1','1','1'),(37,2,142,'-1','-1','-1','-1'),(38,2,143,'1','1','1','1'),(39,2,287,'-1','-1','-1','-1'),(40,2,307,'1','1','1','1'),(41,2,435,'-1','-1','-1','-1'),(42,2,96,'-1','-1','-1','-1'),(43,2,264,'-1','-1','-1','-1'),(44,2,265,'1','1','1','1'),(45,2,149,'1','1','1','1'),(46,2,460,'-1','-1','-1','-1'),(47,2,461,'1','1','1','1'),(48,2,492,'1','1','1','1'),(49,2,489,'1','1','1','1'),(50,2,243,'1','1','1','1'),(51,2,288,'1','1','1','1');
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
INSERT INTO `ff_users` VALUES (1,'admin','',1,'2011-09-19 13:34:47','2011-09-19 13:34:47');
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','2011-09-19 13:32:29','2011-09-19 13:32:29'),(2,'user','2011-09-19 13:32:34','2011-09-19 13:32:34');
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

-- Dump completed on 2011-09-28 11:11:34
