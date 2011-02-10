#!/bin/bash
#Script to reset the DB
find /usr/local/freedomfone/freeswitch/scripts -type f -name *wav -print0 | xargs -0 rm -f 
find /usr/local/freedomfone/freeswitch/scripts -type f -name *mp3 -print0 | xargs -0 rm -f
SVNROOT=/usr/local/freedomfone
/usr/bin/mysql -u root -p < $SVNROOT/gui/app/install/freedomfone_db_createdb_user.sql  
/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/freedomfone_db_schema.sql
/usr/bin/mysql -u root -p < $SVNROOT/dispatcher_in/install/spooler_db_createdb_user.sql  
/usr/bin/mysql -u root -p spooler_in < $SVNROOT/dispatcher_in/install/spooler_db_schema.sql  
