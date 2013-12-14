#Script to reset the DB
SVNROOT=/opt/freedomfone/

#Set your root mysql password here
PWD=""
/usr/bin/mysql -u root --password=$PWD < $SVNROOT/gui/app/sql/freedomfone_db_createdb_user.sql
/usr/bin/mysql -u root --password=$PWD freedomfone < $SVNROOT/gui/app/sql/freedomfone_db_schema.sql
/usr/bin/mysql -u root --password=$PWD < $SVNROOT/dispatcher_in/sql/spooler_db_createdb_user.sql
/usr/bin/mysql -u root --password=$PWD spooler_in < $SVNROOT/dispatcher_in/sql/spooler_db_schema.sql

#For RBAC
/usr/bin/mysql -u root --password=$PWD freedomfone < $SVNROOT/gui/app/sql/freedomfone_db_auth_schema.sql

#For GAMMU
/usr/bin/mysql -u root --password=$PWD < $SVNROOT/gammu-smsd/sql/gammu_db_createdb_user.sql
/usr/bin/mysql -u root --password=$PWD gammu < $SVNROOT/gui/gammu-smsd/sql/gammu_db_schema.sql

