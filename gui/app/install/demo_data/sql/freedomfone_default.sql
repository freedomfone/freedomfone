LOCK TABLES `nodes` WRITE;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
INSERT INTO `nodes` VALUES (1,100,'Cholera 1','1283974722_cholera_menu_ch_1_symptoms_and_prevention',128,1283974726,1283974726),(2,100,'Cholera 2','1283974749_cholera_menu_ch_2_treatment',104,1283974753,1283974753),(3,100,'Cholera 3','1283974889_cholera_menu_ch_3_where_to_go',41,1283974893,1283974893),(4,100,'Cholera 4','1283974906_cholera_menu_ch_4_feature_tsitsi_unicef',59,1283974910,1283974910);
/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `ivr_menus` WRITE;
/*!40000 ALTER TABLE `ivr_menus` DISABLE KEYS */;
INSERT INTO `ivr_menus` VALUES (1,100,'Cholera','','','','','cholera_welcome.mp3','cholera_instructions.mp3','cholera_goodbye.mp3','cholera_invalid.mp3',1,'node',2,'node',3,'node',4,'node',NULL,'lam',NULL,'node',NULL,'node',NULL,'node',NULL,NULL,1,1283975296,1283975296,0,0,0,0);
/*!40000 ALTER TABLE `ivr_menus` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'555123456','Cholera report',4,'2b896460-bb8f-11df-977b-e1a41225c8e1',NULL,1283980972,1283981377,'http%3A//127.0.0.1/freedomfone/freedomfone/leave_message/100/messages/',0,1,19,0,NULL,'');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

