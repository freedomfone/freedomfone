INSERT INTO `ivr_menus` VALUES (1,100,'Cholera','','','','','1. Welcome. cholera_menu_welcome.wav','2. Instructions. cholera_menu_options_160610_final.wav','3. Goodbye. cholera_goodbye.wav','4. Invalid. cholera_invalid_selection.wav',1292924823,1292927669,0,0,0,0,false,'ivr');

INSERT INTO `mappings` VALUES (1,1,'node',1,1,NULL,NULL,NULL), (2,1,'node',2,2,NULL,NULL,NULL), (3,1,'node',3,3,NULL,NULL,NULL), (4,1,'node',4,4,NULL,NULL,NULL),(5,1,'lam',5,NULL,1,NULL,NULL);

INSERT INTO `nodes` VALUES (1,'Cholera 1','1292926356_Press_1._cholera_menu_ch_1_symptoms_and_prevention',128,1292926360,1292926360),(2,'Cholera 2','1292926376_Press_2._cholera_menu_ch_2_treatment',104,1292926380,1292926380),(3,'Cholera 3','1292926427_Press_3._cholera_menu_ch_3_where_to_go',41,1292926431,1292926431),(4,'Cholera 4','1292926445_Press_4._cholera_menu_ch_4_feature_tsitsi_unicef',59,1292926449,1292926449);

INSERT INTO `messages` VALUES (1,55566678,'No title',0,'efb25e98-0ce6-11e0-b030-e123b6921c64',NULL,1292924705,0,'http%3A//192.168.1.10/freedomfone16/freedomfone/leave_message/100/messages/',1,1,19,100,NULL,NULL,'true'),(2,'55566677','No title',0,'3afa7f20-0ce7-11e0-b033-e123b6921c64',NULL,1292924825,0,'http%3A//192.168.1.10/freedomfone16/freedomfone/leave_message/100/messages/',1,1,19,100,NULL,NULL,'true');

INSERT INTO `lm_menus` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,100,'true','Test Leave-a-message','accept','1286471300','1286471300',120);