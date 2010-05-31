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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL auto_increment,
  `iso3166` varchar(10) NOT NULL default '',
  `name_en` varchar(60) NOT NULL default '0',
  `name_fr` varchar(60) NOT NULL default '0',
  `name_pt` varchar(60) NOT NULL default '0',
  `name_es` varchar(60) NOT NULL default '0',
  `name_ar` varchar(60) default NULL,
  `name_sw` varchar(60) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name_en` (`iso3166`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AD','Andorra','Andorre','Andorra','Andorra','أندورا','Andora'),(2,'AF','Afghanistan','Afghanistan','Afeganistão','Afganistán','أفغانستان','Afuganistani'),(3,'AL','Albania','Albanie','Albânia','Albania','ألبانيا','Albania'),(4,'DZ','Algeria','Algérie','Argélia','Argelia','الجزائر','Aljeria'),(5,'AS','American Samoa','Samoa américaines','Samoa Americana','Samoa Americana','ساموا الأمريكية','Samoa ya Marekani'),(6,'AO','Angola','Angola','Angola','Angola','أنجولا','Angola'),(7,'AI','Anguilla','Anguilla','Anguilla','Anguila','أنجويلا','Anguilla'),(8,'AG','Antigua and Barbuda','Antigua-et-Barbuda','Antígua e Barbuda','Antigua y Barbuda','أنتيجوا وبربودا','Antigua na Barbuda'),(9,'AR','Argentina','Argentine','Argentina','Argentina','الأرجنتين','Ajentina'),(10,'AM','Armenia','Arménie','Armênia','Armenia','أرمينيا','Armenia'),(11,'AW','Aruba','Aruba','Aruba','Aruba','آروبا','Aruba'),(12,'AU','Australia','Australie','Austrália','Australia','أستراليا','Australia'),(13,'AT','Austria','Autriche','Áustria','Austria','النمسا','Austria'),(14,'AZ','Azerbaijan','Azerbaïdjan','Azerbaijão','Azerbaiyán','أذربيجان','Azabajani'),(15,'BS','Bahamas','Bahamas','Bahamas','Bahamas','الباهاما','Bahama'),(16,'BH','Bahrain','Bahreïn','Bahrain','Bahréin','البحرين','Bahareni'),(17,'BD','Bangladesh','Bangladesh','Bangladesh','Bangladesh','بنجلاديش','Bangladeshi'),(18,'BB','Barbados','Barbade','Barbados','Barbados','بربادوس','Babadosi'),(19,'BY','Belarus','Belarus','Belarus','Bielorrusia','روسيا البيضاء','Belarusi'),(20,'BE','Belgium','Belgique','Bélgica','Bélgica','بلجيكا','Ubelgiji'),(21,'BZ','Belize','Belize','Belize','Belice','بليز','Belize'),(22,'BJ','Benin','Bénin','Benin','Benín','بنين','Benini'),(23,'BM','Bermuda','Bermudes','Bermudas','Bermudas','برمودا','Bermuda'),(24,'BT','Bhutan','Bhoutan','Butão','Bután','بوتان','Butani'),(25,'BO','Bolivia','Bolivie','Bolívia','Bolivia','بوليفيا','Bolivia'),(26,'BA','Bosnia and Herzegovina','Bosnie-Herzégovine','Bósnia-Herzegovina','Bosnia y Herzegovina','البوسنة والهرسك','Bosnia na Hezegovina'),(27,'BW','Botswana','Botswana','Botsuana','Botsuana','بتسوانا','Botswana'),(28,'BR','Brazil','Brésil','Brasil','Brasil','البرازيل','Brazili'),(29,'IO','British Indian Ocean Territory','Territoire britannique de l’océan Indien','Território Britânico do Oceano Índico','Territorio Británico del Océano Índico','المحيط الهندي البريطاني','Eneo la Uingereza katika Bahari Hindi'),(30,'VG','British Virgin Islands','Îles Vierges britanniques','Ilhas Virgens Britânicas','Islas Vírgenes Británicas','جزر فرجين البريطانية','Visiwa vya Virgin vya Uingereza'),(31,'BN','Brunei','Brunei','Brunei','Brunéi','بروناي','Brunei'),(32,'BG','Bulgaria','Bulgarie','Bulgária','Bulgaria','بلغاريا','Bulgaria'),(33,'BF','Burkina Faso','Burkina Faso','Burquina Faso','Burkina Faso','بوركينا فاسو','Bukinafaso'),(34,'BI','Burundi','Burundi','Burundi','Burundi','بوروندي','Burundi'),(35,'KH','Cambodia','Cambodge','Camboja','Camboya','كمبوديا','Kambodia'),(36,'CM','Cameroon','Cameroun','República dos Camarões','Camerún','الكاميرون','Kameruni'),(37,'CA','Canada','Canada','Canadá','Canadá','كندا','Kanada'),(38,'CV','Cape Verde Islands','Cap-Vert','Cabo Verde','Cabo Verde','الرأس الأخضر','Kepuvede'),(39,'KY','Cayman Islands','Îles Caïmanes','Ilhas Caiman','Islas Caimán','جزر الكايمن','Visiwa vya Kayman'),(40,'CF','Central African Republic','République centrafricaine','República Centro-Africana','República Centroafricana','جمهورية إفريقيا الوسطى','Jamhuri ya Afrika ya Kati'),(41,'TD','Chad','Tchad','Chade','Chad','تشاد','Chadi'),(42,'CL','Chile','Chili','Chile','Chile','شيلي','Chile'),(43,'CN','China','Chine','China','China','الصين','China'),(44,'CO','Colombia','Colombie','Colômbia','Colombia','كولومبيا','Kolombia'),(45,'KM','Comoros','Comores','Comores','Comoras','جزر القمر','Komoro'),(46,'CG','Congo','Congo','Congo','Congo','الكونغو - برازافيل','Kongo'),(47,'CK','Cook Islands','Îles Cook','Ilhas Cook','Islas Cook','جزر كوك','Visiwa vya Cook'),(48,'CR','Costa Rica','Costa Rica','Costa Rica','Costa Rica','كوستاريكا','Kostarika'),(49,'CI','Côte d\'Ivoire','Côte d’Ivoire','Costa do Marfim','Costa de Marfil','ساحل العاج','Kodivaa'),(50,'HR','Croatia','Croatie','Croácia','Croacia','كرواتيا','Korasia'),(51,'CU','Cuba','Cuba','Cuba','Cuba','كوبا','Kuba'),(52,'CY','Cyprus','Chypre','Chipre','Chipre','قبرص','Kuprosi'),(53,'CZ','Czech Republic','République tchèque','República Tcheca','República Checa','جمهورية التشيك','Jamhuri ya Cheki'),(54,'CD','Democratic Republic of the Congo','République démocratique du Congo','Congo-Kinshasa','República Democrática del Congo','جمهورية الكونغو الديمقراطية','Jamhuri ya Kidemokrasia ya Kongo'),(55,'DK','Denmark','Danemark','Dinamarca','Dinamarca','الدانمرك','Denmaki'),(56,'DJ','Djibouti','Djibouti','Djibuti','Yibuti','جيبوتي','Jibuti'),(57,'DM','Dominica','Dominique','Dominica','Dominica','دومينيكا','Dominika'),(58,'DO','Dominican Republic','République dominicaine','República Dominicana','República Dominicana','جمهورية الدومينيك','Jamhuri ya Dominika'),(59,'TL','East Timor','Timor oriental','Timor Leste','Timor Oriental','تيمور الشرقية','Timori ya Mashariki'),(60,'EC','Ecuador','Équateur','Equador','Ecuador','الإكوادور','Ekwado'),(61,'EG','Egypt','Égypte','Egito','Egipto','مصر','Misri'),(62,'SV','El Salvador','Salvador','El Salvador','El Salvador','السلفادور','Elsavado'),(63,'GQ','Equatorial Guinea','Guinée équatoriale','Guiné Equatorial','Guinea Ecuatorial','غينيا الاستوائية','Ginekweta'),(64,'ER','Eritrea','Érythrée','Eritréia','Eritrea','أريتريا','Eritrea'),(65,'EE','Estonia','Estonie','Estônia','Estonia','استونيا','Estonia'),(66,'ET','Ethiopia','Éthiopie','Etiópia','Etiopía','إثيوبيا','Uhabeshi'),(67,'FK','Falkland Islands','Iles Malouines','Ilhas Malvinas','Islas Malvinas','جزر فوكلاند','Visiwa vya Falkland'),(68,'FJ','Fiji','Fidji','Fiji','Fiyi','فيجي','Fiji'),(69,'FI','Finland','Finlande','Finlândia','Finlandia','فنلندا','Ufini'),(70,'FR','France','France','França','Francia','فرنسا','Ufaransa'),(71,'GF','French Guiana','Guyane française','Guiana Francesa','Guayana Francesa','غويانا','Gwiyana ya Ufaransa'),(72,'PF','French Polynesia','Polynésie française','Polinésia Francesa','Polinesia Francesa','بولينيزيا الفرنسية','Polinesia ya Ufaransa'),(73,'GA','Gabon','Gabon','Gabão','Gabón','الجابون','Gaboni'),(74,'GM','Gambia','Gambie','Gâmbia','Gambia','غامبيا','Gambia'),(75,'GE','Georgia','Géorgie','Geórgia','Georgia','جورجيا','Jojia'),(76,'DE','Germany','Allemagne','Alemanha','Alemania','ألمانيا','Ujerumani'),(77,'GH','Ghana','Ghana','Gana','Ghana','غانا','Ghana'),(78,'GI','Gibraltar','Gibraltar','Gibraltar','Gibraltar','جبل طارق','Jibralta'),(79,'GR','Greece','Grèce','Grécia','Grecia','اليونان','Ugiriki'),(80,'GL','Greenland','Groenland','Groênlandia','Groenlandia','جرينلاند','Grinlandi'),(81,'GD','Grenada','Grenade','Granada','Granada','جرينادا','Grenada'),(82,'GP','Guadeloupe','Guadeloupe','Guadalupe','Guadalupe','جوادلوب','Gwadelupe'),(83,'GU','Guam','Guam','Guam','Guam','جوام','Gwam'),(84,'GT','Guatemala','Guatemala','Guatemala','Guatemala','جواتيمالا','Gwatemala'),(85,'GN','Guinea','Guinée','Guiné','Guinea','غينيا','Gine'),(86,'GW','Guinea-Bissau','Guinée-Bissau','Guiné Bissau','Guinea-Bissau','غينيا بيساو','Ginebisau'),(87,'GY','Guyana','Guyana','Guiana','Guyana','غيانا','Guyana'),(88,'HT','Haiti','Haïti','Haiti','Haití','هايتي','Haiti'),(89,'HN','Honduras','Honduras','Honduras','Honduras','هندوراس','Hondurasi'),(90,'HU','Hungary','Hongrie','Hungria','Hungría','المجر','Hungaria'),(91,'IS','Iceland','Islande','Islândia','Islandia','أيسلندا','Aislandi'),(92,'IN','India','Inde','Índia','India','الهند','India'),(93,'ID','Indonesia','Indonésie','Indonésia','Indonesia','اندونيسيا','Indonesia'),(94,'IR','Iran','Iran','Irã','Irán','إيران','Uajemi'),(95,'IQ','Iraq','Irak','Iraque','Iraq','العراق','Iraki'),(96,'IE','Ireland','Irlande','Irlanda','Irlanda','أيرلاندا','Ayalandi'),(97,'IL','Israel','Israël','Israel','Israel','إسرائيل','Israeli'),(98,'IT','Italy','Italie','Itália','Italia','إيطاليا','Italia'),(99,'JM','Jamaica','Jamaïque','Jamaica','Jamaica','جامايكا','Jamaika'),(100,'JP','Japan','Japon','Japão','Japón','اليابان','Japani'),(101,'JO','Jordan','Jordanie','Jordânia','Jordania','الأردن','Yordani'),(102,'KZ','Kazakhstan','Kazakhstan','Casaquistão','Kazajistán','كازاخستان','Kazakistani'),(103,'KE','Kenya','Kenya','Quênia','Kenia','كينيا','Kenya'),(104,'KI','Kiribati','Kiribati','Quiribati','Kiribati','كيريباتي','Kiribati'),(105,'KP','Korea, North','Corée du Nord','Coréia do Norte','Corea del Norte','كوريا الشمالية','Korea Kaskazini'),(106,'KR','Korea, South','Corée du Sud','Coréia do Sul','Corea del Sur','كوريا الجنوبية','Korea Kusini'),(107,'KW','Kuwait','Koweït','Kuwait','Kuwait','الكويت','Kuwaiti'),(108,'KG','Kyrgyzstan','Kirghizistan','Quirguistão','Kirguistán','قرغيزستان','Kirigizistani'),(109,'LA','Laos','Laos','Laos','Laos','لاوس','Laosi'),(110,'LV','Latvia','Lettonie','Letônia','Letonia','لاتفيا','Lativia'),(111,'LB','Lebanon','Liban','Líbano','Líbano','لبنان','Lebanoni'),(112,'LS','Lesotho','Lesotho','Lesoto','Lesoto','ليسوتو','Lesoto'),(113,'LR','Liberia','Liberia','Libéria','Liberia','ليبيريا','Liberia'),(114,'LY','Libya','Libye','Líbia','Libia','ليبيا','Libya'),(115,'LI','Liechtenstein','Liechtenstein','Liechtenstein','Liechtenstein','ليختنشتاين','Lishenteni'),(116,'LT','Lithuania','Lituanie','Lituânia','Lituania','ليتوانيا','Litwania'),(117,'LU','Luxembourg','Luxembourg','Luxemburgo','Luxemburgo','لوكسمبورج','Lasembagi'),(118,'MK','Macedonia','Macédoine','Macedônia','Macedonia','مقدونيا','Masedonia'),(119,'MG','Madagascar','Madagascar','Madagascar','Madagascar','مدغشقر','Bukini'),(120,'MW','Malawi','Malawi','Malawi','Malaui','ملاوي','Malawi'),(121,'MY','Malaysia','Malaisie','Malásia','Malasia','ماليزيا','Malesia'),(122,'MV','Maldives','Maldives','Maldivas','Maldivas','جزر الملديف','Modivu'),(123,'ML','Mali','Mali','Mali','Mali','مالي','Mali'),(124,'MT','Malta','Malte','Malta','Malta','مالطا','Malta'),(125,'MH','Marshall Islands','Îles Marshall','Ilhas Marshall','Islas Marshall','جزر المارشال','Visiwa vya Marshal'),(126,'MQ','Martinique','Martinique','Martinica','Martinica','مارتينيك','Martiniki'),(127,'MR','Mauritania','Mauritanie','Mauritânia','Mauritania','موريتانيا','Moritania'),(128,'MU','Mauritius','Maurice','Maurício','Mauricio','موريشيوس','Morisi'),(129,'YT','Mayotte','Mayotte','Mayotte','Mayotte','مايوت','Mayotte'),(130,'MX','Mexico','Mexique','México','México','المكسيك','Meksiko'),(131,'FM','Micronesia','Micronésie','Micronésia','Micronesia','ميكرونيزيا','Mikronesia'),(132,'MD','Moldova','Moldavie','Moldávia','Moldavia','مولدافيا','Moldova'),(133,'MC','Monaco','Monaco','Mônaco','Mónaco','موناكو','Monako'),(134,'MN','Mongolia','Mongolie','Mongólia','Mongolia','منغوليا','Mongolia'),(135,'MS','Montserrat','Montserrat','Montserrat','Montserrat','مونتسرات','Montserrati'),(136,'MA','Morocco','Maroc','Marrocos','Marruecos','المغرب','Moroko'),(137,'MZ','Mozambique','Mozambique','Moçambique','Mozambique','موزمبيق','Msumbiji'),(138,'MM','Myanmar','Myanmar','Mianmar','Myanmar','ميانمار','Myama'),(139,'NA','Namibia','Namibie','Namíbia','Namibia','ناميبيا','Namibia'),(140,'NR','Nauru','Nauru','Nauru','Nauru','نورو','Nauru'),(141,'NP','Nepal','Népal','Nepal','Nepal','نيبال','Nepali'),(142,'NL','Netherlands','Pays-Bas','Holanda','Países Bajos','هولندا','Uholanzi'),(143,'AN','Netherlands Antilles','Antilles néerlandaises','Antilhas Holandesas','Antillas Neerlandesas','جزر الأنتيل الهولندية','Antili za Uholanzi'),(144,'NC','New Caledonia','Nouvelle-Calédonie','Nova Caledônia','Nueva Caledonia','كاليدونيا الجديدة','Nyukaledonia'),(145,'NZ','New Zealand','Nouvelle-Zélande','Nova Zelândia','Nueva Zelanda','نيوزيلاندا','Nyuzilandi'),(146,'NI','Nicaragua','Nicaragua','Nicarágua','Nicaragua','نيكاراجوا','Nikaragwa'),(147,'NE','Niger','Niger','Níger','Níger','النيجر','Nijeri'),(148,'NG','Nigeria','Nigeria','Nigéria','Nigeria','نيجيريا','Nijeria'),(149,'NU','Niue','Nioué','Niue','Isla Niue','نيوي','Niue'),(150,'NF','Norfolk Island','Île Norfolk','Ilhas Norfolk','Isla Norfolk','جزيرة نورفوك','Kisiwa cha Norfok'),(151,'MP','Northern Mariana Islands','Îles Mariannes du Nord','Ilhas Marianas do Norte','Islas Marianas del Norte','جزر ماريانا الشمالية','Visiwa vya Mariana vya Kaskazini'),(152,'NO','Norway','Norvège','Noruega','Noruega','النرويج','Norwe'),(153,'OM','Oman','Oman','Omã','Omán','عمان','Omani'),(154,'PK','Pakistan','Pakistan','Paquistão','Pakistán','باكستان','Pakistani'),(155,'PW','Palau','Palau','Palau','Palau','بالاو','Palau'),(156,'PS','Palestinian West Bank and Gaza','Territoire palestinien','Território da Palestina','Palestina','فلسطين','Ukingo wa Magharibi na Ukanda wa Gaza wa Palestina'),(157,'PA','Panama','Panama','Panamá','Panamá','بنما','Panama'),(158,'PG','Papua New Guinea','Papouasie-Nouvelle-Guinée','Papua-Nova Guiné','Papúa Nueva Guinea','بابوا غينيا الجديدة','Papua'),(159,'PY','Paraguay','Paraguay','Paraguai','Paraguay','باراجواي','Paragwai'),(160,'PE','Peru','Pérou','Peru','Perú','بيرو','Peru'),(161,'PH','Philippines','Philippines','Filipinas','Filipinas','الفيلبين','Filipino'),(162,'PN','Pitcairn','Pitcairn','Pitcairn','Pitcairn','بتكايرن','Pitkairni'),(163,'PL','Poland','Pologne','Polônia','Polonia','بولندا','Polandi'),(164,'PT','Portugal','Portugal','Portugal','Portugal','البرتغال','Ureno'),(165,'PR','Puerto Rico','Porto Rico','Porto Rico','Puerto Rico','بورتوريكو','Pwetoriko'),(166,'QA','Qatar','Qatar','Catar','Qatar','قطر','Katari'),(167,'RE','Réunion','Réunion','Reunião','Reunión','روينيون','Riyunioni'),(168,'RO','Romania','Roumanie','Romênia','Rumanía','رومانيا','Romania'),(169,'RU','Russia','Russie','Rússia','Rusia','روسيا','Urusi'),(170,'RW','Rwanda','Rwanda','Ruanda','Ruanda','رواندا','Rwanda'),(171,'SH','Saint Helena','Sainte-Hélène','Santa Helena','Santa Elena','سانت هيلنا','Santahelena'),(172,'KN','Saint Kitts and Nevis','Saint-Christophe-et-Niévès','São Cristovão e Nevis','San Cristóbal y Nieves','سانت كيتس ونيفيس','Santakitzi na Nevis'),(173,'LC','Saint Lucia','Sainte-Lucie','Santa Lúcia','Santa Lucía','سانت لوسيا','Santalusia'),(174,'PM','Saint Pierre and Miquelon','Saint-Pierre-et-Miquelon','Saint Pierre e Miquelon','San Pedro y Miquelón','سانت بيير وميكولون','Santapieri na Mikeloni'),(175,'VC','Saint Vincent and the Grenadines','Saint-Vincent-et-les Grenadines','São Vicente e Granadinas','San Vicente y las Granadinas','سانت فنسنت وغرنادين','Santavisenti na Grenadini'),(176,'WS','Samoa','Samoa','Samoa','Samoa','ساموا','Samoa'),(177,'SM','San Marino','Saint-Marin','San Marino','San Marino','سان مارينو','Samarino'),(178,'ST','São Tomé and Príncipe','São Tomé-et-Príncipe','São Tomé e Príncipe','Santo Tomé y Príncipe','ساو تومي وبرينسيبي','Sao Tome na Principe'),(179,'SA','Saudi Arabia','Arabie saoudite','Arábia Saudita','Arabia Saudí','المملكة العربية السعودية','Saudi'),(180,'SN','Senegal','Sénégal','Senegal','Senegal','السنغال','Senegali'),(181,'CS','Serbia and Montenegro','Serbie-et-Monténégro','Sérvia e Montenegro','Serbia y Montenegro','صربيا والجبل الأسود','Serbia na Montenegro'),(182,'SC','Seychelles','Seychelles','Seychelles','Seychelles','سيشل','Shelisheli'),(183,'SL','Sierra Leone','Sierra Leone','Serra Leoa','Sierra Leona','سيراليون','Siera Leoni'),(184,'SG','Singapore','Singapour','Cingapura','Singapur','سنغافورة','Singapoo'),(185,'SK','Slovakia','Slovaquie','Eslováquia','Eslovaquia','سلوفاكيا','Slovakia'),(186,'SI','Slovenia','Slovénie','Eslovênia','Eslovenia','سلوفينيا','Slovenia'),(187,'SB','Solomon Islands','Îles Salomon','Ilhas Salomão','Islas Salomón','جزر سليمان','Visiwa vya Solomon'),(188,'SO','Somalia','Somalie','Somália','Somalia','الصومال','Somalia'),(189,'ZA','South Africa','Afrique du Sud','África do Sul','Sudáfrica','جمهورية جنوب افريقيا','Afrika Kusini'),(190,'ES','Spain','Espagne','Espanha','España','أسبانيا','Hispania'),(191,'LK','Sri Lanka','Sri Lanka','Sri Lanka','Sri Lanka','سريلانكا','Sirilanka'),(192,'SD','Sudan','Soudan','Sudão','Sudán','السودان','Sudani'),(193,'SR','Suriname','Surinam','Suriname','Surinam','سورينام','Surinamu'),(194,'SZ','Swaziland','Swaziland','Suazilândia','Suazilandia','سوازيلاند','Uswazi'),(195,'SE','Sweden','Suède','Suécia','Suecia','السويد','Uswidi'),(196,'CH','Switzerland','Suisse','Suíça','Suiza','سويسرا','Uswisi'),(197,'SY','Syria','Syrie','Síria','Siria','سوريا','Siria'),(198,'TW','Taiwan','Taiwan','Taiwan','Taiwán','تايوان','Taiwani'),(199,'TJ','Tajikistan','Tadjikistan','Tadjiquistão','Tayikistán','طاجكستان','Tajikistani'),(200,'TZ','Tanzania','Tanzanie','Tanzânia','Tanzania','تانزانيا','Tanzania'),(201,'TH','Thailand','Thaïlande','Tailândia','Tailandia','تايلند','Tailandi'),(202,'TG','Togo','Togo','Togo','Togo','توجو','Togo'),(203,'TK','Tokelau','Tokelau','Tokelau','Tokelau','توكيلو','Tokelau'),(204,'TO','Tonga','Tonga','Tonga','Tonga','تونجا','Tonga'),(205,'TT','Trinidad and Tobago','Trinité-et-Tobago','Trinidad e Tobago','Trinidad y Tobago','ترينيداد وتوباغو','Trinidad na Tobago'),(206,'TN','Tunisia','Tunisie','Tunísia','Túnez','تونس','Tunisia'),(207,'TR','Turkey','Turquie','Turquia','Turquía','تركيا','Uturuki'),(208,'TM','Turkmenistan','Turkménistan','Turcomenistão','Turkmenistán','تركمانستان','Turukimenistani'),(209,'TC','Turks and Caicos Islands','Îles Turks et Caïques','Ilhas Turks e Caicos','Islas Turcas y Caicos','جزر الترك وجايكوس','Visiwa vya Turki na Kaiko'),(210,'TV','Tuvalu','Tuvalu','Tuvalu','Tuvalu','توفالو','Tuvalu'),(211,'VI','U.S. Virgin Islands','Îles Vierges des États-Unis','Ilhas Virgens dos EUA','Islas Vírgenes de los Estados Unidos','جزر فرجين الأمريكية','Visiwa vya Virgin vya Marekani'),(212,'UG','Uganda','Ouganda','Uganda','Uganda','أوغندا','Uganda'),(213,'UA','Ukraine','Ukraine','Ucrânia','Ucrania','أوكرانيا','Ukraini'),(214,'AE','United Arab Emirates','Émirats arabes unis','Emirados Árabes Unidos','Emiratos Árabes Unidos','الإمارات العربية المتحدة','Falme za Kiarabu'),(215,'GB','United Kingdom','Royaume-Uni','Reino Unido','Reino Unido','المملكة المتحدة','Uingereza'),(216,'UY','Uruguay','Uruguay','Uruguai','Uruguay','أورجواي','Urugwai'),(217,'US','USA','États-Unis','Estados Unidos','Estados Unidos','الولايات المتحدة الأمريكية','Marekani'),(218,'UZ','Uzbekistan','Ouzbékistan','Uzbequistão','Uzbekistán','أوزبكستان','Uzibekistani'),(219,'VU','Vanuatu','Vanuatu','Vanuatu','Vanuatu','فانواتو','Vanuatu'),(220,'VA','Vatican State','État de la Cité du Vatican','Vaticano','Ciudad del Vaticano','الفاتيكان','Vatikani'),(221,'VE','Venezuela','Venezuela','Venezuela','Venezuela','فنزويلا','Venezuela'),(222,'VN','Vietnam','Vietnam','Vietnã','Vietnam','فيتنام','Vietinamu'),(223,'WF','Wallis and Futuna','Wallis-et-Futuna','Wallis e Futuna','Wallis y Futuna','جزر والس وفوتونا','Walis na Futuna'),(224,'YE','Yemen','Yémen','Iêmen','Yemen','اليمن','Yemeni'),(225,'ZM','Zambia','Zambie','Zâmbia','Zambia','زامبيا','Zambia'),(226,'ZW','Zimbabwe','Zimbabwe','Zimbábue','Zimbabue','زيمبابوي','Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


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
  `option1_id` int(11) default NULL,
  `option1_type` varchar(50) default NULL,
  `option2_id` int(11) default NULL,
  `option2_type` varchar(50) default NULL,
  `option3_id` int(11) default NULL,
  `option3_type` varchar(50) default NULL,
  `option4_id` int(11) default NULL,
  `option4_type` varchar(50) default NULL,
  `option5_id` int(11) default NULL,
  `option5_type` varchar(50) default NULL,
  `option6_id` int(11) default NULL,
  `option6_type` varchar(50) default NULL,
  `option7_id` int(11) default NULL,
  `option7_type` varchar(50) default NULL,
  `option8_id` int(11) default NULL,
  `option8_type` varchar(50) default NULL,
  `option9_id` int(11) default NULL,
  `option9_type` varchar(50) default NULL,
  `parent` tinyint(1) default '0',
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  `mode_long` tinyint(1) default '0',
  `mode_short` tinyint(1) default '0',
  `mode_exit` tinyint(1) default '0',
  `mode_invalid` tinyint(1) default '0',
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
  `trunk` smallint(6) NOT NULL,
  `lmWelcomeMessage` text,
  `lmInformMessage` text,
  `lmInvalidMessage` text,
  `lmLongMessage` text,
  `lmSelectMessage` text,
  `lmDeleteMessage` text,
  `lmSaveMessage` text,
  `lmGoodbyeMessage` text,
  `instance_id` int(6) NOT NULL,
  `modeWelcome` tinyint(4) default '0',
  `modeInform` tinyint(4) default '0',
  `modeInvalid` tinyint(4) default '0',
  `modeLong` tinyint(4) default '0',
  `modeSelect` tinyint(4) default '0',
  `modeDelete` tinyint(4) default '0',
  `modeSave` tinyint(4) default '0',
  `modeGoodbye` tinyint(4) default '0',
  `title` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `instance_id` (`instance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `lm_menus`
--

LOCK TABLES `lm_menus` WRITE;
/*!40000 ALTER TABLE `lm_menus` DISABLE KEYS */;
INSERT INTO `lm_menus` VALUES (1,1,'Welcome to my message service.','Record your message after the beep. To finish, press #.','','Get to the point!','','','','',100,0,0,0,0,0,0,0,0,'Default LAM');
/*!40000 ALTER TABLE `lm_menus` ENABLE KEYS */;
UNLOCK TABLES;

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
  `title` varchar(100) default NULL,
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
  `instance_id` int(6) NOT NULL,
  `title` varchar(200) NOT NULL,
  `file` varchar(100) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `modified` int(11) unsigned default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'language',0,'eng',0,'env'),(2,'length',0,NULL,20,'lam'),(3,'silence',0,NULL,60,'lam'),(4,'domain',0,'http://demo.freedomfone.org',0,'env'),(5,'ip_address',0,'192.168.1.10',0,'env'),(6,'timezone',0,'Africa/Sao_Tome',250,'env'),(7,'overwrite_event',0,'',1,'env');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


--
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
  `phone1` varchar(50) default NULL,
  `phone2` varchar(50) default NULL,
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
  `instance_id` int(6) NOT NULL,
  `acl_id` int(11) unsigned default '0',
  `new` tinyint(4) default '1',
  `country_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `votes`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-05-31 16:57:18
