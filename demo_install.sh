#!/bin/bash
#Script to add demo data

#Path to Freedom Fone
SVNROOT=/opt/freedomfone/

#Path to demo data
DEMODIR=/opt/freedomfone/demo/

#Set your root mysql password here
PWD=""

#Update database with demo info
/usr/bin/mysql -u root --password=$PWD freedomfone < $SVNROOT/gui/app/sql/freedomfone_demo_data.sql

#Copy demo files to Freedom Fone

cp $DEMODIR/ivr_nodes/* $SVNROOT/gui/app/webroot/freedomfone/ivr/nodes/
cp $DEMODIR/ivr_ivr/*.mp3   $SVNROOT/gui/app/webroot/freedomfone/ivr/100/ivr/
cp $DEMODIR/ivr_ivr/*.wav   $SVNROOT/gui/app/webroot/freedomfone/ivr/100/ivr/
cp $DEMODIR/ivr_ivr/ivr.xml   $SVNROOT/gui/app/webroot/freedomfone/ivr/100/conf/
cp $DEMODIR/ivr_ivr/ivr.xml   $SVNROOT/xml_curl/
cp $DEMODIR/lam_ivr/*   $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/audio_menu/
cp $DEMODIR/lam_inbox/* $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/messages/
