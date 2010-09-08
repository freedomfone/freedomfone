#!/bin/bash
#Script to reset database, and populate with demo data.

SVNROOT=/usr/local/freedomfone


echo "Remove uploaded files from IVR and LAM component"
echo ""
rm -Rf $SVNROOT/gui/app/webroot/freedomfone/ivr/100/ivr/*
rm -Rf $SVNROOT/gui/app/webroot/freedomfone/ivr/100/nodes/*
rm -Rf $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/audio_menu/*
rm -Rf $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/messages/*


echo "Add demo files to IVR (IVR instructions and Nodes)"
echo ""
cp $SVNROOT/gui/app/install/demo_data/ivr/*    $SVNROOT/gui/app/webroot/freedomfone/ivr/100/ivr/
cp $SVNROOT/gui/app/install/demo_data/nodes/*  $SVNROOT/gui/app/webroot/freedomfone/ivr/100/nodes/

echo "Add demo files to LAM (IVR menu and Inbox)"
echo ""
cp $SVNROOT/gui/app/install/demo_data/lam/*    $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/audio_menu/
cp $SVNROOT/gui/app/install/demo_data/inbox/*  $SVNROOT/gui/app/webroot/freedomfone/leave_message/100/messages/

echo "Reset database"
echo ""
/usr/bin/mysql -u root -p < $SVNROOT/gui/app/install/freedomfone_db_createdb_user.sql
/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/freedomfone_db_schema.sql
/usr/bin/mysql -u root -p < $SVNROOT/dispatcher_in/install/spooler_db_createdb_user.sql
/usr/bin/mysql -u root -p spooler_in < $SVNROOT/dispatcher_in/install/spooler_db_schema.sql


echo "Populating tables with default data"
echo ""
/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/demo_data/sql/freedomfone_default.sql



