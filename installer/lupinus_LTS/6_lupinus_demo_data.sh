#!/bin/bash
#Script to add demo data

SVNROOT=/usr/local/freedomfone
DEMO_DIR= $SVNROOT/installer/lupinus_LTS/demo/

/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/freedomfone_demo_data.sql

cp $DEMO_DIR/ivr_nodes     $SVNROOT/gui/app/webroot/freedomfone/ivr/100/nodes/
cp $DEMO_DIR/ivr_ivr     $SVNROOT/gui/app/webroot/freedomfone/ivr/100/ivr/
cp $DEMO_DIR/lam_ivr   $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/audio_menu/
cp $DEMO_DIR/lam_inbox $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/messages/







