#!/bin/bash
#Script to reset the DB

SVNROOT=/usr/local/freedomfone

echo "The audio files will be deleted! after pressing ENTER, CTRL-C to abort"
read
find $SVNROOT/freeswitch/scripts -type f -name *wav -print0 | xargs -0 rm -f 
find $SVNROOT/freeswitch/scripts -type f -name *meta -print0 | xargs -0 rm -f 
find $SVNROOT/freeswitch/scripts -type f -name *mp3 -print0 | xargs -0 rm -f
find $SVNROOT/freeswitch/scripts -type f -name ivr.xml -print0 | xargs -0 rm -f

instance=100
while [ $instance -lt 120 ] ; do
cp $SVNROOT/freeswitch/scripts/freedomfone/leave_message/instance/instance.conf $SVNROOT/freeswitch/scripts/freedomfone/leave_message/$instance/conf/$instance.conf 
cp $SVNROOT/freeswitch/scripts/freedomfone/leave_message/instance/instance_core.conf $SVNROOT/freeswitch/scripts/freedomfone/leave_message/$instance/conf/$instance'_core.conf'
instance=$(( $instance + 1 ))
done

bash $SVNROOT/extras/fix_perms_gui.sh
bash $SVNROOT/extras/fix_perms_fs.sh


/usr/bin/mysql -u root -p < $SVNROOT/gui/app/install/freedomfone_db_createdb_user.sql  
/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/freedomfone_db_schema.sql
/usr/bin/mysql -u root -p < $SVNROOT/dispatcher_in/install/spooler_db_createdb_user.sql  
/usr/bin/mysql -u root -p spooler_in < $SVNROOT/dispatcher_in/install/spooler_db_schema.sql  
